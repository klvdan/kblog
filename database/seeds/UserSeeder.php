<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * 
     * $ php artisan make:seeder UserSeeder
     * re-building database
     * $ php artisan migrate:fresh --seed 
     * seeding
     * $ php artisan db:seed
     * $ php artisan db:seed --class=UserSeeder
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'kelvin',
            'email' => 'kelvinyokou@gmail.com',
            'password' => Hash::make('d83d542d9ec91cdaab76dc7d76c54108')
        ]);
    }
}
