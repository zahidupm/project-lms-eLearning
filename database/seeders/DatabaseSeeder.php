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

        // $user = new User;
        // $user->name = 'Super Admin';
        // $user->email = 'super@admin.com';
        // $user->password = bcrypt('password');
        // $user->save();

        // $user = User::create([
        //     'name' => 'Super Admin',
        //     'email' => 'super-admin@lms.test',
        //     'password' => bcrypt('password')
        // ]);

        // $role = Role::create([
        //     'name' => 'Super Admin',
        // ]);

        // $permission = Permission::create([
        //     'name' => 'create-admin'
        // ]);

        // $role->givePermissionTo($permission);
        // $permission->assignRole($role);

        // $user->assignRole($role);

        // $communicationRole = Role::create([
        //     'name' => 'Communication'
        // ]);

        // $user = User::create([
        //     'name' => 'Communication Team',
        //     'email' => 'communication@lms.test',
        //     'password' => bcrypt('password')
        // ]);

        // $user->assignRole($communicationRole);

        $this->create_user_with_role('Super Admin', 'Super Admin', 'super-admin@lms.test');
        $this->create_user_with_role('Communication', 'Communication Team', 'communication@lms.test');
        $teacher = $this->create_user_with_role('Teacher', 'Teacher', 'teacher@lms.test');
        $this->create_user_with_role('Leads', 'Leads', 'leads@lms.test');




        // create leads
        Lead::factory(100)->create();

        $course = Course::create([
            'name'=> 'Laravel',
            'description' => 'Laravel is a web application framework with expressive, elegant syntax, We have a owerfaskdfo poqwehfaosd',
            'image' => 'https://laravel.com/img/logomark.min.svg',
            'user_id' => $teacher->id
        ]);

        Curriculum::factory(10)->create();
    }

    private function create_user_with_role($type, $name, $email) {
        $role = Role::create([
            'name' => $type
        ]);

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt('password')
        ]);

        if($type == 'Super Admin') {
            $permission = Permission::create([
                'name' => 'create-admin'
            ]);
            $role->givePermissionTo($permission);
        }


        $user->assignRole($role);

        return $user;
    }
}
