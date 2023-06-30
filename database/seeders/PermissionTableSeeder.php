<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'add-product',
            'view-product',
            'edit-product',
            'delete-product',

            'add-branch',
            'view-branch',
            'edit-branch',
            'delete-branch',
            
            'add-user',
            'view-user',
            'edit-user',
            'delete-user',

            'add-role',
            'view-role',
            'edit-role',
            'delete-role',

            'add-cart',
            'view-cart',
            'edit-cart',
            'delete-cart',

            'add-discount',
            
            'add-sell',
            'view-sell',
            'delete-sell',
            

            'add-order',
            'edit-order',
            'delete-order',

            'generate-invoive',
            'generate-preInvoice',
            'generate-report',

            'add-debt',
            'view-debt',
            'edit-debt',            
            'delete-debt',

            'add-expenses',
            'view-expenses',
            'edit-expenses',            
            'delete-expenses',

            'user-management',
            'setting'

         ];

         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
