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
                'lastname' => 'Yorong',
                'firstname' => 'Raymond',
                'birthday' => '03/12/1999',
                'age' => '22',
                'gender' => 'Male',
                'address' => 'Talamban',
                'marital_status' => 'Single',
                'email' => 'raymond@gmail.com',
                'contact_number' => '09356472800',
                'facebook' => 'Raymond Jay Yorong',
                'instagram' => '@yorong',
                'twitter' => 'chu@twit.ter',
                'leader' => '',
                'category' => 'Professional',
                'isCGVIP' => 'false',
                'isSCVIP' => 'false',
                'auxilliary' => 'Blessed Youth',
                'ministries' => 'PraiseAndWorship'
            ),
            array(
                'lastname' => 'Gamboa',
                'firstname' => 'Ma. Lyn',
                'birthday' => '08/06/1999',
                'age' => '21',
                'gender' => 'Female',
                'address' => 'Talamban',
                'marital_status' => 'Single',
                'email' => 'carizon.mars@gmail.com',
                'contact_number' => '09356472800',
                'facebook' => 'Ma Lyn Gamboa',
                'instagram' => '@gamboa',
                'twitter' => 'tinay@twit.ter',
                'leader' => '',
                'category' => 'Asian',
                'isCGVIP' => 'false',
                'isSCVIP' => 'false',
                'auxilliary' => 'Blessed Youth',
                'ministries' => 'Multimedia'
            )
            ));
            DB::table('userroles_i_ds')->insert(array(
                array(
                    'id' => '0',
                    'roles' => 'Admin'
                ),
                array(
                    'id' => '1',
                    'roles' => 'Pastor'
                ),
                array(
                    'id' => '12',
                    'roles' => 'Primary Leader'
                ),
                array(
                    'id' => '144',
                    'roles' => 'Member'
                ),
            // DB::table('cms_attendances')->insert(array(
            //     array(
            //         'leader' => 'Mars',
            //         'member' => 'Lyn',
            //         'type' => 'SC',
            //         'date' => 'Sunday February 7, 2021'
            //     )
                ));
            
            $this->call(CMSAccountsSeeder::class);
            

    }
}
