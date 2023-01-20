<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Interfaces\UserStatusInterface;
use App\Models\User;
use App\Models\Company;
use App\Models\SubscriptionPlan;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CreateDefaultRecord extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-default-record';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Default Record';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $RoleItems = [

            [
                'slug' => 'admin',
                'name' => 'Admin',
                'description' => 'Admin Role',
                'level' => 2
            ],
            [
                'slug' => 'user',
                'name' => 'User',
                'description' => 'User Role',
                'level' => 3
            ],
            [
                'slug' => 'developer',
                'name' => 'Developer',
                'description' => 'Developer Role',
                'level' => 4
            ],
        ];

        $Permissionitems = [
            [
                'name'        => 'Can View Users',
                'slug'        => 'view.users',
                'description' => 'Can view users',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Create Users',
                'slug'        => 'create.users',
                'description' => 'Can create new users',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Edit Users',
                'slug'        => 'edit.users',
                'description' => 'Can edit users',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Delete Users',
                'slug'        => 'delete.users',
                'description' => 'Can delete users',
                'model'       => 'Permission',
            ],
        ];





        /*
        * Add Role Items
        */
        dump("Running Roles table seeder");
        foreach ($RoleItems as $RoleItem) {
            $newRoleItem = config('roles.models.role')::where('slug', '=', $RoleItem['slug'])->first();
            if ($newRoleItem === null) {
                $newRoleItem = config('roles.models.role')::create([
                    'name'          => $RoleItem['name'],
                    'slug'          => $RoleItem['slug'],
                    'description'   => $RoleItem['description'],
                    'level'         => $RoleItem['level'],
                ]);
            }
        }
        dump("Role table seeder ran successfully");

        /*
         * Add Permission Items
         *
         */
        dump("Running Permission table seeder");
        foreach ($Permissionitems as $Permissionitem) {
            $newPermissionitem = config('roles.models.permission')::where('slug', '=', $Permissionitem['slug'])->first();
            if ($newPermissionitem === null) {
                $newPermissionitem = config('roles.models.permission')::create([
                    'name'          => $Permissionitem['name'],
                    'slug'          => $Permissionitem['slug'],
                    'description'   => $Permissionitem['description'],
                    'model'         => $Permissionitem['model'],
                ]);
            }
        }
        dump("Permission table seeder ran successfully");


        dump("Running User table seeder");
        $userRole = config('roles.models.role')::where('name', '=', 'User')->first();
        $developerRole = config('roles.models.role')::where('name', '=', 'Developer')->first();
        $AdminRole = config('roles.models.role')::where('name', '=', 'Admin')->first();
        $permissions = config('roles.models.permission')::all();

        /*
         * Add Record
         *
         */
        if (User::where('email', '=', 'admin@advancestreamstats.com')->first() === null) {
            $newUser = User::create([
                'firstname'     => 'Advance',
                'middlename'     => 'Stream',
                'lastname'     => 'Admin',
                'email'    => 'admin@advancestreamstats.com',
                'country' => 'United Kingdom',
                'state' => 'London',
                'phoneNumber' => '07576499190',
                'is_verified' => true,
                'is_active' => UserStatusInterface::ACTIVE,
                'can_login' => true,
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ]);

            $newUser->attachRole($AdminRole);
            foreach ($permissions as $permission) {
                $newUser->attachPermission($permission);
            }
        }

        if (User::where('email', '=', 'user@advancestreamstats.com')->first() === null) {
            $newUser = User::create([
                'firstname'     => 'Advance',
                'middlename'     => 'Stream',
                'lastname'     => 'User',
                'email'    => 'user@advancestreamstats.com',
                'country' => 'United Kingdom',
                'state' => 'London',
                'phoneNumber' => '07576499191',
                'is_verified' => true,
                'is_active' => UserStatusInterface::ACTIVE,
                'can_login' => true,
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ]);

            $newUser->attachRole($userRole);
            foreach ($permissions as $permission) {
                $newUser->attachPermission($permission);
            }
        }

        if (User::where('email', '=', 'developer@advancestreamstats.com')->first() === null) {
            $newUser = User::create([
                'firstname'     => 'Developer',
                'middlename'     => 'Advance',
                'lastname'     => 'Stream',
                'email'    => 'developer@advancestreamstats.com',
                'country' => 'United Kingdom',
                'state' => 'London',
                'phoneNumber' => '07576499191',
                'is_verified' => true,
                'is_active' => UserStatusInterface::ACTIVE,
                'can_login' => true,
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ]);

            $newUser->attachRole($developerRole);
            foreach ($permissions as $permission) {
                $newUser->attachPermission($permission);
            }
        }

        dump("User table seeder ran successfully");
    }
}
