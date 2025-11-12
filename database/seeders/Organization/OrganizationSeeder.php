<?php

namespace Database\Seeders\Organization;

use App\Models\Organization\Organization;
use App\Models\OrganizationEmployee\OrganizationEmployee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Organization::create([
            'name' => 'Organization',
            'email' => 'organization@example.com',
            'password' => Hash::make('123123123'),
            'phone' => '123123123',
            'image' => 'default.png',
            'type' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        OrganizationEmployee::create([
            'name' => 'Employee 1',
            'email' => 'employee1@example.com',
            'password' => Hash::make('123123123'),
            'phone' => '123123123',
            'image' => 'default.png',
            'type' => 1,
            'is_master' => 1,
            'organization_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
