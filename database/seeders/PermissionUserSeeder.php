<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use Helper;
use Illuminate\Database\Seeder;

class PermissionUserSeeder extends Seeder
{

    public function amerPermission($permisions)
    {

        $blockedPermissions = array(
            'user:show', 'user:delete', 'user:write',
        );


        foreach ($blockedPermissions as $permission ) { 
         
            array_splice($permisions, array_search($permission, $permisions ), 1);

        }

        return $permisions;

    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin = User::where('email', 'mohamdalhelal7@gmail.com')->first(); // admin user dynamic permissions

        $editor = User::where('email', 'amer@gmail.com')->first(); // editor upper user dynamic permissions

        $reviewer = User::where('email', 'alaa@gmail.com')->first(); // reviewer user dynamic permissions

        $adminPermissionsIds = Permission::whereIn('name', Helper::getPermissions())->pluck('id')->toArray();

        $editorPermissionsIds = Permission::whereIn('name', $this->amerPermission(Helper::getPermissions()))->pluck('id')->toArray();

        $reviewerPermissionsIds = Permission::where('name', 'report:show')->pluck('id')->toArray();

        $admin->permissions()->sync($adminPermissionsIds);

        $editor->permissions()->sync($editorPermissionsIds);

        $reviewer->permissions()->sync($reviewerPermissionsIds);

    }
}
