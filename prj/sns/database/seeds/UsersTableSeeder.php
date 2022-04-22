<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 1; $i <= 10; $i++) {
            DB::table('users')->insert([
                'username' => 'test_user' .$i,
                'mail'  => 'TEST' .$i. '@gmail.com',
                'password' => Hash::make('12345678'),
                'bio' => 'ぼくは山田博です',
            ]);
        }
    }
}
