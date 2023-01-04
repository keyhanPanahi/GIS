<?php

namespace Database\Seeders\Admin\Map;

use App\Models\Admin\Map\PlaceStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlaceStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $placeStatuses = [
          ['name' => 'جدید' , 'status' => 1],
          ['name' => 'اصلاحی' , 'status' => 1],
          ['name' => 'تایید شده' , 'status' => 1],
        ];

        foreach ($placeStatuses as $placeStatus){
            PlaceStatus::create($placeStatus);
        }
    }
}
