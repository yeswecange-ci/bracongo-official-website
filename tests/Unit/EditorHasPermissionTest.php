<?php

namespace Tests\Unit;

use App\Models\Permission;
use App\Models\User;
use App\Models\UserPermission;
use Database\Seeders\RbacSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditorHasPermissionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RbacSeeder::class);
    }

    public function test_editor_without_delegated_permissions_gets_role_defaults(): void
    {
        $editor = User::factory()->create();

        $this->assertTrue($editor->hasPermission('content.read'));
        $this->assertTrue($editor->hasPermission('content.edit'));
        $this->assertTrue($editor->hasPermission('content.delete'));
        $this->assertTrue($editor->hasPermission('content.publish'));
    }

    public function test_editor_with_only_content_read_delegated_cannot_edit_or_delete(): void
    {
        $editor = User::factory()->create();
        $readId = Permission::query()->where('code', 'content.read')->value('id');

        UserPermission::query()->create([
            'user_id' => $editor->id,
            'permission_id' => $readId,
            'effect' => 'allow',
        ]);

        $editor->refresh();

        $this->assertTrue($editor->hasPermission('content.read'));
        $this->assertFalse($editor->hasPermission('content.edit'));
        $this->assertFalse($editor->hasPermission('content.delete'));
        $this->assertFalse($editor->hasPermission('content.publish'));
    }

    public function test_unknown_permission_code_returns_false(): void
    {
        $editor = User::factory()->create();

        $this->assertFalse($editor->hasPermission('nonexistent.permission'));
    }
}
