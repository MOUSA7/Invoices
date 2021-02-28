<?php

use App\User;
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
        DB::table('users')->insert([
            'name' => 'Mousa',
            'email'=> 'eng.mousa.sh@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // password
            'remember_token' => Str::random(10),
            'created_at'=> date('d/m/y'),
            'updated_at'=> date('d/m/y')
        ]);

        // $this->call(UserSeeder::class);
        factory(User::class,1)->create();
        factory(\App\Master::class,2)->create();

        $brands = [
            'Nike','Apple','Zara','Canon','adidas'
        ];
        foreach ($brands as $brand){
            \App\Item::create([
                'name'=>$brand,
                'master_id'=>\App\Master::all()->random()->id

            ]);
        }

        \App\Details::create([
            'qty'=>10,
            'price' =>3,
            'total'=>30,
            'item_id' =>\App\Item::all()->random()->id,

        ]);







    }
}
