<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $user = new \App\User;

        $user->name = 'abdul mobeen';
        $user->email = 'mobeen@admin.com';
        $user->password = bcrypt('lkjlkj');
        $user->save();
    }

}
