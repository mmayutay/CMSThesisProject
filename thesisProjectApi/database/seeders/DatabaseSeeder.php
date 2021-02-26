<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\cms_users;
use DB;

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
        DB::table('cms_users')->insert(array(
            array(
                'lastname' => 'Chu',
                'firstname' => 'Machuy',
                'birthday' => '11/03/2004',
                'age' => '20',
                'gender' => 'Female',
                'address' => 'Talamban',
                'marital_status' => 'Single',
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
            ),
            array(
                'lastname' => 'Bustamante',
                'firstname' => 'Cristina',
                'birthday' => '11/24/1999',
                'age' => '21',
                'gender' => 'Female',
                'address' => 'Talamban',
                'marital_status' => 'Single',
                'email' => 'pretty@gmail.com',
                'contact_number' => '09000000001',
                'facebook' => 'tinay@face.book',
                'instagram' => 'tinay@insta.gram',
                'twitter' => 'tinay@twit.ter',
                'leader' => 'jj',
                'category' => 'Kpop',
                'isCGVIP' => 'no',
                'isSCVIP' => 'yes',
                'auxilliary' => 'hehehe',
                'ministries' => 'asdfghjkl'
            )
            ));
            DB::table('cms_attendances')->insert(array(
                array(
                    'leader' => 'Mars',
                    'member' => 'Lyn',
                    'type' => 'SC',
                    'date' => 'Sunday February 7, 2021'
                )
                ));
    }
}
