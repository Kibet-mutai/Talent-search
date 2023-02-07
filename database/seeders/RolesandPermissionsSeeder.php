<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesandPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //permisions for app

        $addUser = 'add_user';
        $editUser = 'edit_user';
        $destroyUser = 'delete_user';
        $suspendEmployer = 'suspend_employer';
        $approveEmployer = 'approve_employer';
        $suspendFreelancer = 'suspend_Freelancer';
        $approveFreelancer = 'approve_Freelancer';

        $viewFreelancer = 'view_freelancer';
        $hireFreelancer = 'hire_freelancer';
        $interviewFreelancer = 'interview_freelancer';
        $createEmployer = 'create_employer';
        $editEmployer = 'edit_employer';
        $deleteEmployerProfile = 'delete_employer_profile';

        $createProfile = 'create_profile';
        $editProfile = 'edit_profile';
        $deleteProfile = 'delete_employer';
        $viewEmployer = 'view_employer';

        Permission::create(['name'=>$addUser]);
        Permission::create(['name'=>$editUser]);
        Permission::create(['name'=>$destroyUser]);
        Permission::create(['name'=>$suspendEmployer]);
        Permission::create(['name'=>$approveEmployer]);
        Permission::create(['name'=>$suspendFreelancer]);
        Permission::create(['name'=>$approveFreelancer]);


        Permission::create(['name' => $createEmployer]);
        Permission::create(['name' => $editEmployer]);
        Permission::create(['name' => $deleteEmployerProfile]);
        Permission::create(['name'=>$viewFreelancer]);
        Permission::create(['name'=>$hireFreelancer]);
        Permission::create(['name'=>$interviewFreelancer]);


        Permission::create(['name'=>$createProfile]);
        Permission::create(['name'=>$editProfile]);
        Permission::create(['name'=>$deleteProfile]);
        Permission::create(['name'=>$viewEmployer]);

        //Roles for users

        $superAdmin = 'super_admin';
        $employer = 'employer';
        $freelancer = 'freelancer';

        Role::create(['name' => $superAdmin])
            ->givePermissionTo(Permission::all());

        Role::create(['name' => $employer])
            ->givePermissionTo([
                $viewFreelancer,
                $hireFreelancer,
                $interviewFreelancer,
                $createEmployer,
                $deleteEmployerProfile,
                $editEmployer
            ]);

        Role::create(['name' => $freelancer])
            ->givePermissionTo([
                $createProfile,
                $editProfile,
                $deleteProfile,
                $viewEmployer
            ]);
    }
}
