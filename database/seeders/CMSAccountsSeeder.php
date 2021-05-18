<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;

class CMSAccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cms_accounts')->insert(array(
            array(
                'userid'  => 1,
                'username' => 'BHCFRYorong1',
                'password' => Hash::make('YorongMember1'),
                'roles' =>  1,
                )
            ));
    }
}
