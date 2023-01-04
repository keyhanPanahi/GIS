<?php

namespace Database\Seeders\Admin\Map;

use App\Models\Admin\Map\PropertyType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $propertyTypes = [
            ['name' => 'زمین' , 'status' => 1],
            ['name' => 'ساختمان' , 'status' => 1],
            ['name' => 'مجتمع' , 'status' => 1],
        ];

        foreach ($propertyTypes as $propertyType){
            PropertyType::create($propertyType);
        }
    }
}
