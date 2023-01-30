<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class OrangSeeder extends Seeder
{
    public function run()
    {

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 100; $i++) {
            $data = [
                'name' => $faker->name,
                'address'    => $faker->address,
                'created_at' => Time::createFromTimestamp($faker->unixTime()),
                'updated_at' => Time::now(),
            ];

            $this->db->table('orang')->insert($data);
        }


        // Simple Queries
        // $this->db->query('INSERT INTO users (username, email) VALUES(:username:, :email:)', $data);

        // Using Query Builder (insertBatch for many data)
        // $this->db->table('orang')->insert($data);
    }
}
