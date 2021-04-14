<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roles = [
            "admins" => [
                "name" => "Administrators",
                "guard_name" => "web",
                "icon" => "fa fa-users",
            ],
            "developers"=>[
                "name" => "Developers",
                "guard_name" => "web",
                "icon" => "ff"
            ],
            "testers"=>[
                "name" => "Testers",
                "guard_name" => "web",
                "icon" => "ff"
            ],
            "AnalyticsUsers"=>[
                "name" => "Analytics_Users",
                "guard_name" => "web",
                "icon" => "ff"
            ],
        ];


        foreach($roles as $role){
            $nRoles = new Role();
            $nRoles->name = $role["name"];
            $nRoles->guard_name = $role["guard_name"];
            $nRoles->save();
        }


    }
}
