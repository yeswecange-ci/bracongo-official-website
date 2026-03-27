@extends('admin.layouts.app')
@section('title', 'Invitations')

@push('header-left')
<div>
    <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Invitations</li>
    </ol></nav>
    <h6 class="a-topbar-page-title">Invitations</h6>
</div>
@endpush

@section('content')
@include('admin.layouts.partials.alerts')

<div class="row g-4">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-envelope-plus me-2" style="color:#E30613"></i>Nouvelle invitation</h5>
            </div>
            <div class="card-body">
                <p class="text-muted small mb-3">Un e-mail avec un lien d’acceptation sera envoyé. Délai d’expiration : <strong>{{ $invitationExpiresHours->label() }}</strong> (réglable dans <a href="{{ route('admin.parametres.edit') }}">Paramètres</a>).</p>
                <form action="{{ route('admin.invitations.store') }}" method="POST" id="form-invitation">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">E-mail</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required placeholder="prenom.nom@exemple.com">
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Rôle</label>
                        <select name="role" id="invitation-role" class="form-select @error('role') is-invalid @enderror" required>
                            @foreach($assignableRoles as $r)
                                <option value="{{ $r->value }}" @selected(old('role', $assignableRoles[0]->value) === $r->value)>{{ $r->label() }}</option>
                            @endforeach
                        </select>
                        @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div id="editor-permissions-block" class="mb-3 {{ old('role', $assignableRoles[0]->value) === \App\Enums\UserRole::Editor->value ? '' : 'd-none' }}">
                        <label class="form-label fw-semibold">Permissions éditeur <span class="text-muted fw-normal">(optionnel)</span></label>
                        <p class="small text-muted mb-2">Laissez tout décoché pour un éditeur avec toutes les permissions du rôle. Cochez uniquement les droits à accorder si vous voulez un sous-ensemble.</p>
                        @error('permission_ids')<div class="text-danger small mb-2">{{ $message }}</div>@enderror
                        <div class="border rounded p-3 bg-light" style="max-height:220px;overflow-y:auto;">
                            @forelse($editorPermissions as $perm)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permission_ids[]" value="{{ $perm->id }}" id="perm-{{ $perm->id }}"
                                        @checked(is_array(old('permission_ids')) && in_array((string) $perm->id, old('permission_ids', []), true))>
                                    <label class="form-check-label small" for="perm-{{ $perm->id }}">{{ $perm->label }} <span class="text-muted">({{ $perm->code }})</span></label>
                                </div>
                            @empty
                                <p class="small text-muted mb-0">Aucune permission définie (exécutez les migrations et le seeder RBAC).</p>
                            @endforelse
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-send me-1"></i>Envoyer l’invitation
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0"><i class="bi bi-list-ul me-2 text-secondary"></i>Historique</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>E-mail</th>
                                <th class="text-center">Rôle</th>
                                <th class="text-center">Statut</th>
                                <th class="text-center">Expire</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($invitations as $inv)
                            <tr>
                                <td>
                                    <div class="fw-semibold">{{ $inv->email }}</div>
                                    <div class="small text-muted">Par {{ $inv->inviter?->name ?? '—' }}</div>
                                </td>
                                <td class="text-center small">
                                    <span class="badge bg-light text-dark border" style="font-size:.72rem">{{ $inv->roleEnum()->label() }}</span>
                                </td>
                                <td class="text-center">
                                    @if($inv->accepted_at)
                                        <span class="a-status a-status--published">Acceptée</span>
                                    @elseif($inv->revoked_at)
                                        <span class="a-status a-status--draft">Révoquée</span>
                                    @elseif($inv->isExpired())
                                        <span class="a-status a-status--draft">Expirée</span>
                                    @else
                                        <span class="badge bg-light text-dark border" style="font-size:.72rem">En attente</span>
                                    @endif
                                </td>
                                <td class="text-center text-muted small">
                                    {{ $inv->expires_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="text-end">
                                    @if(!$inv->accepted_at && !$inv->revoked_at)
                                    <form action="{{ route('admin.invitations.destroy', $inv) }}" method="POST" class="d-inline" onsubmit="return confirm('Révoquer cette invitation ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="a-action-btn a-action-btn--danger" title="Révoquer">
                                            <i class="bi bi-slash-circle"></i>
                                        </button>
                                    </form>
                                    @else
                                    <span class="text-muted small">—</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5">
                                <div class="a-empty-state py-5">
                                    <i class="bi bi-inbox"></i>
                                    <p>Aucune invitation pour le moment.</p>
                                </div>
                            </td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
    var sel = document.getElementById('invitation-role');
    var block = document.getElementById('editor-permissions-block');
    if (!sel || !block) return;
    function sync() {
        var show = sel.value === 'editor';
        block.classList.toggle('d-none', !show);
    }
    sel.addEventListener('change', sync);
    sync();
})();
</script>
@endpush
