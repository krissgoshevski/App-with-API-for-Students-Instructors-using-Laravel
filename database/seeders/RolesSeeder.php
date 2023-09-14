<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['instructor', 'student'];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
    }


    /**
     * way 2 
     * 
     *  public function run(): void
    {
        $roles = ['instructor', 'student'];

        foreach ($roles as $roleName) {
            $role = new Role();
            $role->name = $roleName;
            $role->save();
        }
    }
     */
}
