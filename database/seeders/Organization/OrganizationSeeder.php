<?php

namespace Database\Seeders\Organization;

use App\Models\Organization\Organization;
use App\Models\OrganizationEmployee\OrganizationEmployee;
use App\Modules\Organization\Models\Organization\Organization as ModelsOrganization;
use App\Modules\Organization\Models\organizationEmployee\OrganizationEmployee as ModelsOrganizationEmployee;
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
        ModelsOrganization::create([
            'name' => 'Organization3',
            'email' => 'organization3@example.com',
            'password' => Hash::make('123123123'),
            'phone' => '123123123123123',
            'image' => 'default.png',
            'type' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        ModelsOrganizationEmployee::create([
            'name' => 'Employee 3',
            'email' => 'employee3@example.com',
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
