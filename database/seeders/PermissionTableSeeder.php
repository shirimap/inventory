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
            'ongeza-bidhaa',
            'futa-bidhaa',
            'hariri-bidhaa',
            'ona-bidhaa',
            'ongeza-tawi',
            'ona-tawi',
            'futa-tawi',
            'hariri-tawi',
            'ongeza-muuzaji',
            'ona-muuzaji',
            'futa-muuzaji',
            'hariri-muuzaji',
            'ongeza-jukumu',
            'futa-jukumu',
            'hariri-jukumu',
            'ona-jukumu',
            'ongeza-mkokoteni',
            'futa-mkokoteni',
            'hariri-mkokoteni',
            'ona-mkokoteni',
            'ongeza-punguzo',
            'ona-mauzo',
            'futa-mauzo',
            'futa-order',
            'hariri-order',
            'ongeza-order',
            'tengeneza-invoive',
            'tengeneza-preInvoice',
            'tengeneza-report',
            'fanya-mauzo',
            'wasimamizi-duka',

         ];

         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
