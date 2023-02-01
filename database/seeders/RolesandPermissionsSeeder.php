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

        $addNewUser = 'add_new_user';
        $editUserInfo = 'edit_user_info';
        $destroyUser = 'delete_user';
        $suspendEmployer = 'suspend_employer';
        $approveEmployer = 'approve_employer';
        $suspendFreelancer = 'suspend_Freelancer';
        $approveFreelancer = 'approve_Freelancer';

        $viewFreelancer = 'view_freelancer';
        $hireFreelancer = 'hire_freelancer';
        $interviewFreelancer = 'interview_freelancer';

        $createProfile = 'create_profile';
        $viewEmployer = 'view_employer';

        Permission::create(['name'=>$addNewUser]);
        Permission::create(['name'=>$editUserInfo]);
        Permission::create(['name'=>$destroyUser]);
        Permission::create(['name'=>$suspendEmployer]);
        Permission::create(['name'=>$approveEmployer]);
        Permission::create(['name'=>$suspendFreelancer]);
        Permission::create(['name'=>$approveFreelancer]);

        Permission::create(['name'=>$viewFreelancer]);
        Permission::create(['name'=>$hireFreelancer]);
        Permission::create(['name'=>$interviewFreelancer]);

        Permission::create(['name'=>$createProfile]);
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
                $interviewFreelancer
            ]);

        Role::create(['name' => $freelancer])
            ->givePermissionTo([
                $createProfile,
                $viewEmployer
            ]);
    }
}
