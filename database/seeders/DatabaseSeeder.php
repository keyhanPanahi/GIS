<?php

namespace Database\Seeders;

use Database\Seeders\Admin\Map\PlaceStatusSeeder;
use Database\Seeders\Admin\Map\PropertyTypeSeeder;
use Database\Seeders\Admin\Map\UsageTypeSeeder;
use Database\Seeders\Admin\Membership\PermissionSeeder;
use Database\Seeders\Admin\Membership\RoleSeeder;
//use Database\Seeders\Membership\OrganizationSeeder;
use Database\Seeders\Membership\ExternalServerSeeder;
use Database\Seeders\Membership\SexSeeder;
use Database\Seeders\Membership\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            SexSeeder::class,
            UsageTypeSeeder::class,
            PropertyTypeSeeder::class,
            PlaceStatusSeeder::class,
            ExternalServerSeeder::class,
            UserSeeder::class,
        ]);
    }
}
