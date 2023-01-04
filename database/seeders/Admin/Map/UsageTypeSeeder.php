<?php

namespace Database\Seeders\Admin\Map;

use App\Models\Admin\Map\UsageType;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usageTypes = [
            ['name' => 'مسکونی' , 'status' => 1],
            ['name' => 'تجاری' , 'status' => 1],
            ['name' => 'اداری' , 'status' => 1],
        ];

        foreach ($usageTypes as $usageType){
            UsageType::create($usageType);
        }
    }
}
