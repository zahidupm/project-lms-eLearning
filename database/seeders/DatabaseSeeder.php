<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Lead;
use App\Models\Course;
use App\Models\Curriculum;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory()->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $user = new User;
        $user->name = 'Super Admin';
        $user->email = 'super@admin.com';
        $user->password = bcrypt('password');
        $user->save();

        $role = Role::create([
            'name' => 'Super Admin',
        ]);

        $permission = Permission::create([
            'name' => 'create-admin'
        ]);

        $role->givePermissionTo($permission);
        $permission->assignRole($role);

        $user->assignRole($role);

        $communicationRole = Role::create([
            'name' => 'Communication'
        ]);

        // create leads
        Lead::factory(100)->create();

        $course = Course::create([
            'name'=> 'Laravel',
            'description' => 'Laravel is a web application framework with expressive, elegant syntax, We have a owerfaskdfo poqwehfaosd',
            'image' => 'https://laravel.com/img/logomark.min.svg',
        ]);

        Curriculum::factory(10)->create();
    }
}
