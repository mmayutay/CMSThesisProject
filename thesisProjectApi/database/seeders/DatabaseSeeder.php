<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\cms_users;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        cms_users::create([
            'lastname' => 'Niere',
            'firstname' => 'Marichu',
            'birthday' => '09/30/1999',
            'age' => '21',
            'address' => 'Talamban',
            'marital_status' => 'COMPLICATED',
            'email' => 'goddess@gg.ph',
            'contact_number' => '09110101110',
            'facebook' => 'chu@face.book',
            'instagram' => 'chu@insta.gram',
            'twitter' => 'chu@twit.ter',
            'leader' => 'DU30',
            'category' => 'Professional',
            'isCGVIP' => 'yes',
            'isSCVIP' => 'no',
            'auxilliary' => 'gsjgs',
            'ministries' => 'dgfsdgr'
        ]);
    }
}
