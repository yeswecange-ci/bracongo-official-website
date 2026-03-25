# Récapitulatif de la base de données — Site BRACONGO

**Projet :** bracongo-official-website  
**Framework :** Laravel 12  
**Date :** 18 mars 2026

---

## 1. Vue d’ensemble

La base de données du site BRACONGO gère l’ensemble des contenus du site vitrine (pages, images, textes) ainsi que les données métier (marques, boissons, actualités). Elle comprend **22 tables**, organisées en plusieurs blocs fonctionnels.

---

## 2. Tables et structure

### 2.1. Authentification et système

| Table | Description | Clés étrangères |
|-------|-------------|-----------------|
| **users** | Comptes administrateurs | — |
| **sessions** | Sessions utilisateur (Laravel) | `user_id` → users.id |
| **password_reset_tokens** | Tokens de réinitialisation de mot de passe | — |
| **parametres_site** | Paramètres globaux (logo, favicon, couleur, suggestions de recherche) | — |

---

### 2.2. Pages et contenus éditoriaux (tables singleton — une ligne)

| Table | Description |
|-------|-------------|
| **page_welcome** | Page d’accueil avec âge (fond, titres, boutons majeurs/mineurs) |
| **page_accueil** | Page d’accueil principale (sections « Qui sommes-nous ? », « Nos marques », « Rejoignez-nous », « Actualités ») |
| **page_histoire** | Page « Notre histoire » (paragraphes, RSE, carte, présence nationale) |
| **page_contact** | Page contact (coordonnées, téléphones, adresse, liens) |
| **page_carriere** | Page carrière (hero, texte d’introduction) |
| **page_pro** | Page Bracongo Pro (description, avantages, fonctionnalités, app, CTA, PDF) |
| **footer_settings** | Configuration du footer (mission, adresse, téléphone, email, image certification, année copyright) |

**Remarque :** Ces tables ne possèdent pas de clé étrangère ; chacune stocke un seul enregistrement (ou un nombre fixe).

---

### 2.3. Contenus listés (sans relation directe)

| Table | Description | Champs principaux |
|-------|-------------|-------------------|
| **hero_slides** | Slider hero (page d’accueil) | image, alt, ordre, is_active |
| **valeurs** | Valeurs BRACONGO (lettre + description) | lettre, description, ordre |
| **offres_emploi** | Offres d’emploi | titre, description, image, lien, ordre, is_active |
| **messages_contact** | Messages du formulaire de contact | name, email, phone, subject, message, lu |
| **footer_gallery** | Images du bandeau footer | image, alt, ordre |
| **reseaux_sociaux** | Réseaux sociaux (Facebook, Instagram, Twitter…) | platform, url, ordre, is_active |

---

### 2.4. Navigation

| Table | Description | Relation |
|-------|-------------|----------|
| **navigation_items** | Éléments de menu (header, footer) | **Auto-référence** : `parent_id` → navigation_items.id |

**Relation :** Un item peut avoir un parent ; les items sans parent sont des entrées principales. Les sous-menus sont reliés via `parent_id`.

---

### 2.5. Marques & boissons

| Table | Description | Relation |
|-------|-------------|----------|
| **marques** | Marques BRACONGO (bières, gazeuses, eaux, énergisantes) | — |
| **boissons** | Boissons associées aux marques | `marque_id` → marques.id |

**Relation :** Une marque a plusieurs boissons. Une boisson appartient à une marque.  
Suppression en cascade : si une marque est supprimée, ses boissons le sont aussi.

---

### 2.6. Produits (back-office uniquement)

| Table | Description |
|-------|-------------|
| **produits** | Articles, goodies, merchandising (non affichés côté client) |

**Remarque :** Table indépendante, utilisée uniquement dans l’admin.

---

### 2.7. Actualités et événements

| Table | Description |
|-------|-------------|
| **news** | Actualités, événements, activations, sponsoring, communiqués, médiathèque |

**Champs principaux :** titre, slug, type, extrait, contenu, image, date_publication, date_evenement, lieu, lien_externe.

---

## 3. Schéma des relations

```
┌─────────────┐
│   users     │
└──────┬──────┘
       │ 1:N
       ▼
┌─────────────┐
│  sessions   │
└─────────────┘

┌──────────────────┐       ┌──────────────────┐
│ navigation_items │──────▶│ navigation_items │  (parent_id, auto-référence)
└──────────────────┘  1:N  └──────────────────┘

┌─────────────┐       ┌─────────────┐
│   marques   │──────▶│  boissons   │  (marque_id → marques.id)
└─────────────┘  1:N  └─────────────┘
```

**Tables sans relation :**  
parametres_site, page_welcome, page_accueil, page_histoire, page_contact, page_carriere, page_pro, footer_settings, hero_slides, valeurs, offres_emploi, messages_contact, footer_gallery, reseaux_sociaux, produits, news.

---

## 4. Interactions fonctionnelles (contexte d’usage)

| Contexte | Tables impliquées |
|----------|-------------------|
| **Authentification** | users, sessions, password_reset_tokens |
| **Page d’accueil** | page_accueil, hero_slides, marques (section « Nos marques »), news (actualités), page_carriere (CTA Rejoignez-nous) |
| **Page Histoire** | page_histoire, valeurs |
| **Page Contact** | page_contact (coordonnées), messages_contact (envoi formulaire) |
| **Page Carrière** | page_carriere, offres_emploi |
| **Marques & Boissons** | marques, boissons |
| **News & Actualités** | news |
| **Footer** | footer_settings, footer_gallery, reseaux_sociaux |
| **Navigation** | navigation_items |
| **Paramètres** | parametres_site |

---

## 5. Points importants

- Les tables de type « page » (page_welcome, page_accueil, etc.) sont des singletons : une seule ligne par table.
- **footer_settings** et **parametres_site** sont utilisés comme configurations globales.
- Seules **marques → boissons** et **navigation_items** (auto-référence) utilisent des clés étrangères.
- Les autres tables (hero_slides, offres_emploi, news, footer_gallery, etc.) sont des listes gérées indépendamment.
- Les images sont stockées par chemins relatifs (ex. `uploads/footer/`, `img/`).

---

*Document généré pour le projet BRACONGO — Site officiel.*
