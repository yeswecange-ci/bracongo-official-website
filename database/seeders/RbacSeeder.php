<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Database\Seeder;

class RbacSeeder extends Seeder
{
    public function run(): void
    {
        $definitions = [
            ['code' => 'users.view', 'label' => 'Voir les utilisateurs'],
            ['code' => 'users.manage', 'label' => 'Gérer les utilisateurs (complet)'],
            ['code' => 'users.invite', 'label' => 'Inviter des utilisateurs'],
            ['code' => 'users.assign_role_admin', 'label' => 'Attribuer le rôle administrateur'],
            ['code' => 'users.assign_role_super_admin', 'label' => 'Attribuer le rôle super administrateur'],
            ['code' => 'permissions.grant', 'label' => 'Accorder des permissions'],
            ['code' => 'permissions.revoke', 'label' => 'Révoquer des permissions'],
            ['code' => 'content.read', 'label' => 'Lire le contenu CMS'],
            ['code' => 'content.edit', 'label' => 'Modifier le contenu CMS'],
            ['code' => 'content.delete', 'label' => 'Supprimer le contenu CMS'],
            ['code' => 'content.publish', 'label' => 'Publier le contenu CMS'],
        ];

        $idsByCode = [];
        foreach ($definitions as $def) {
            $p = Permission::updateOrCreate(
                ['code' => $def['code']],
                ['label' => $def['label']]
            );
            $idsByCode[$def['code']] = $p->id;
        }

        RolePermission::query()->delete();

        $allCodes = array_keys($idsByCode);

        $this->attachRole(UserRole::SuperAdmin->value, $allCodes, $idsByCode);

        $adminCodes = [
            'users.view', 'users.invite', 'permissions.grant', 'permissions.revoke',
            'content.read', 'content.edit', 'content.delete', 'content.publish',
        ];
        $this->attachRole(UserRole::Admin->value, $adminCodes, $idsByCode);

        $editorCodes = [
            'content.read', 'content.edit', 'content.delete', 'content.publish',
        ];
        $this->attachRole(UserRole::Editor->value, $editorCodes, $idsByCode);
    }

    /**
     * @param  array<string, int>  $idsByCode
     * @param  list<string>  $codes
     */
    private function attachRole(string $role, array $codes, array $idsByCode): void
    {
        foreach ($codes as $code) {
            if (! isset($idsByCode[$code])) {
                continue;
            }
            RolePermission::firstOrCreate(
                [
                    'role' => $role,
                    'permission_id' => $idsByCode[$code],
                ],
                []
            );
        }
    }
}
