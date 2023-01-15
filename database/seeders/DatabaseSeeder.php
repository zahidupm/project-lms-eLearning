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

        $defaultPermissions = ['lead-management', 'create-admin', 'user-management'];
        foreach($defaultPermissions as $permission) {
            Permission::create(['name' => $permission]);
        }

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
            'user_id' => $teacher->id,
            'price' => 500
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
            $role->givePermissionTo(Permission::all());
        } elseif($type == 'Leads') {
            $role->givePermissionTo('lead-management');
        }


        $user->assignRole($role);

        return $user;
    }
}
