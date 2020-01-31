<?php

use Illuminate\Database\Seeder;

class ContributorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new Contributor();
        $user ->name = "aa bb";
        $user->email = "aa@bb.com";
        $user->password = crypt ("secret", "");
        $user->save();
    }
}
