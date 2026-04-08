#!/usr/bin/env python3
"""
Renomme les images du merchandising dans public/img pour qu'elles correspondent
aux noms attendus par database/seeders/MerchandisingProduitsSeeder.php.

Usage (depuis la racine du projet Laravel) :
  python scripts/rename_merch_images.py              # simulation (rien n'est modifié)
  python scripts/rename_merch_images.py --apply     # renommage réel

Options :
  --img-dir PATH   Dossier images (défaut : public/img sous la racine du projet)
"""

from __future__ import annotations

import argparse
import re
import shutil
import sys
from difflib import SequenceMatcher
from pathlib import Path

# Même ordre et mêmes alias que MerchandisingProduitsSeeder::definitions()
# La cible de renommage est le premier alias (celui testé en premier par le seeder).
MERCH_DEFINITIONS: list[dict[str, object]] = [
    {
        "nom": "Set de verres Primus (6 pcs)",
        "fichiers": [
            "set-de-verres-primus-6-pcs",
            "set-verres-primus",
            "verres-primus-6pcs",
            "primus-verres",
        ],
    },
    {
        "nom": "Glacière Bracongo",
        "fichiers": ["glaciere-bracongo", "glaciere", "cooler-bracongo"],
    },
    {
        "nom": "Casquette Bracongo",
        "fichiers": ["casquette-bracongo", "casquette", "cap-bracongo"],
    },
    {
        "nom": "Polo Bracongo Pro (bordeaux)",
        "fichiers": [
            "polo-bracongo-pro-bordeaux",
            "polo-bordeaux",
            "polo-bracongo-pro-1",
        ],
    },
    {
        "nom": "Polo Bracongo Pro (rouge)",
        "fichiers": [
            "polo-bracongo-pro-rouge",
            "polo-rouge",
            "polo-bracongo-pro-2",
        ],
    },
    {
        "nom": "T-shirt Bracongo",
        "fichiers": ["t-shirt-bracongo", "tshirt-bracongo", "tee-bracongo"],
    },
    {
        "nom": "Mug Primus",
        "fichiers": ["mug-primus", "mug-primus-bracongo", "tasse-primus"],
    },
]

EXTENSIONS = (".webp", ".jpg", ".jpeg", ".png", ".gif")


def _norm(s: str) -> str:
    s = s.casefold().strip()
    s = re.sub(r"[_\s]+", "-", s)
    return s


def _slugify_loose(s: str) -> str:
    """Approche proche d'un slug : minuscules, tirets, pas de ponctuation forte."""
    s = _norm(s)
    s = re.sub(r"[^a-z0-9\-]+", "-", s)
    return re.sub(r"-+", "-", s).strip("-")


def _score_stem_vs_alias(stem: str, alias: str) -> float:
    """Score 0..1 : correspondance entre nom de fichier (sans ext) et un alias attendu."""
    a = _norm(stem)
    b = _norm(alias)
    if a == b:
        return 1.0
    if a in b or b in a:
        return 0.92
    ratio = SequenceMatcher(None, a, b).ratio()
    # Sous-chaînes « utiles » (ex. polo + bordeaux)
    parts_a = set(a.split("-")) - {"", "jpg", "png", "webp"}
    parts_b = set(b.split("-"))
    if parts_a and parts_b and parts_a <= parts_b:
        return max(ratio, 0.85)
    return ratio


def _best_alias_score(stem: str, aliases: list[str]) -> float:
    return max(_score_stem_vs_alias(stem, al) for al in aliases)


def _collect_image_files(img_dir: Path) -> list[Path]:
    if not img_dir.is_dir():
        return []
    out: list[Path] = []
    for p in sorted(img_dir.iterdir()):
        if p.is_file() and p.suffix.lower() in EXTENSIONS:
            out.append(p)
    return out


def _expected_path(img_dir: Path, canonical: str) -> Path | None:
    """Retourne le chemin si un fichier canonical.ext existe déjà."""
    for ext in EXTENSIONS:
        cand = img_dir / f"{canonical}{ext}"
        if cand.is_file():
            return cand
    return None


def main() -> int:
    parser = argparse.ArgumentParser(description="Renommer les images merch pour MerchandisingProduitsSeeder.")
    parser.add_argument(
        "--apply",
        action="store_true",
        help="Effectuer les renommages (sinon simulation seulement).",
    )
    parser.add_argument(
        "--img-dir",
        type=Path,
        default=None,
        help="Dossier des images (défaut : public/img sous la racine du projet).",
    )
    args = parser.parse_args()

    script_dir = Path(__file__).resolve().parent
    project_root = script_dir.parent
    img_dir = args.img_dir or (project_root / "public" / "img")

    files = _collect_image_files(img_dir)
    if not files:
        print(f"Aucune image ({', '.join(EXTENSIONS)}) dans : {img_dir}", file=sys.stderr)
        return 1

    used: set[Path] = set()
    planned: list[tuple[Path, Path, str]] = []  # src, dest, raison

    for defn in MERCH_DEFINITIONS:
        aliases = [str(x) for x in defn["fichiers"]]  # type: ignore[list-item]
        canonical = aliases[0]
        nom = str(defn["nom"])

        existing = _expected_path(img_dir, canonical)
        if existing:
            used.add(existing.resolve())
            print(f"[OK] Déjà présent : {existing.name}  —  {nom}")
            continue

        candidates = [p for p in files if p.resolve() not in used]
        best: tuple[Path, float] | None = None
        for p in candidates:
            stem = p.stem
            sc = _best_alias_score(stem, aliases)
            alt = _best_alias_score(_slugify_loose(stem), aliases)
            sc = max(sc, alt)
            if best is None or sc > best[1]:
                best = (p, sc)

        if best is None:
            print(f"[!!] Aucun fichier à associer pour : {nom}")
            continue

        src, score = best
        if score < 0.55:
            print(
                f"[??] Correspondance faible ({score:.2f}) pour « {nom} » — fichier ignoré : {src.name}",
                file=sys.stderr,
            )
            continue

        ext = src.suffix.lower()
        dest = img_dir / f"{canonical}{ext}"
        if dest.resolve() != src.resolve():
            if dest.exists():
                print(
                    f"[!!] Cible occupée, skip : {src.name} -> {dest.name}  ({nom})",
                    file=sys.stderr,
                )
                used.add(src.resolve())
                continue
            planned.append((src, dest, f"{nom} (score={score:.2f})"))
        used.add(src.resolve())

    if not planned:
        print("\nAucun renommage nécessaire (ou aucune correspondance fiable).")
        return 0

    print(f"\n{'APPLIQUÉ' if args.apply else 'SIMULATION'} — {len(planned)} renommage(s) :\n")
    for src, dest, raison in planned:
        print(f"  {src.name}  ->  {dest.name}")
        print(f"      ({raison})")

    if not args.apply:
        print("\nRelance avec --apply pour écrire les changements sur le disque.")
        return 0

    for src, dest, _ in planned:
        shutil.move(str(src), str(dest))
        print(f"Renommé : {dest.name}")

    return 0


if __name__ == "__main__":
    raise SystemExit(main())
