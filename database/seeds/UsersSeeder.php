<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Membuat role admin
    	
    	$adminRole = new Role();
    	$adminRole->name ="admin";
    	$adminRole->display_name = "Admin";
    	$adminRole->save();

    	//Membuat role member

    	$memberRole = new Role();
    	$memberRole->name ="member";
    	$memberRole->display_name= "Member";
    	$memberRole->save();

    	//Membuat sample admin

    	$admin = new User();
    	$admin->name = 'Admin Jos';
    	$admin->email = 'admin@gmail.com';
    	$admin->password = bcrypt('rahasia');
    	$admin->save();
    	$admin->attachRole($adminRole);

    	//Membuat sample member
        $member = new User();
        $member->name = "Joni Marko";
        $member->email = 'jonimarko@gmail.com';
        $member->clase_id = 1;
        $member->password = bcrypt('rahasia');
        $member->save();
        $member->attachRole($memberRole);

        $member = new User();
        $member->name = "Riki ES";
        $member->email = 'rikies@gmail.com';
        $member->clase_id = 4;
        $member->password = bcrypt('rahasia');
        $member->save();
        $member->attachRole($memberRole);

        $member = new User();
        $member->name = "Deni Z";
        $member->email = 'deni123@gmail.com';
        $member->clase_id = 3;
        $member->password = bcrypt('rahasia');
        $member->save();
        $member->attachRole($memberRole);

        $member = new User();
        $member->name = "Kuat Situmorang";
        $member->email = 'kuatsekali@gmail.com';
        $member->clase_id = 2;
        $member->password = bcrypt('rahasia');
        $member->save();
        $member->attachRole($memberRole);

    }
}
