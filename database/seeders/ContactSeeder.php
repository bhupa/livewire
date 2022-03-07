<?php

namespace Database\Seeders;

use App\Models\Contacts;
use Illuminate\Database\Seeder;
use Faker\Factory;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $faker = Factory::create();
        for ($i = 0; $i < 20; $i++) {
            $data[] =[
                'name'=>$faker->name,
                'email'=>$faker->email
            ];
          }

          Contacts::insert($data);
    }
}
