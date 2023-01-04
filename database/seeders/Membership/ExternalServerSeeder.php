<?php

namespace Database\Seeders\Membership;

use App\Models\Membership\ExternalServer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExternalServerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $servers = [
            [
                'address' => '192.168.1.20',
                'username' => 'ftpuser1',
                'password' => 'Sepehr.2014',
                'port' => '40021',
                'status' => 1,
            ],
        ];

        foreach($servers as $server){
            ExternalServer::create($server);
        }
    }

}
