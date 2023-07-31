<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'total_credits'=> 5,
            'gender' => 'male',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $admin_role = Role::create(['name' => 'admin']);


        $admin = \App\Models\User::create([
            'name' => 'Super Admin',
            'email' => 'admin@xinva.ai',
            'total_credits'=> 0,
            'gender' => 'male',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $admin->assignRole($admin_role);


        \App\Models\Plan::create([
            'name' => 'Xinva Pro',
            'slug' => 'xinva-pro',
            'amount' => 29,
            'currency' => 'USD',
            'credits' => 250,
            'type' => 'onetime',
            'paddle_subscription_plan_id' => '831534',
            'description' => '250 Credits for $29'
        ]);

        \App\Models\Plan::create([
            'name' => 'Xinva Pro+',
            'slug' => 'xinva-pro-plus',
            'amount' => 55,
            'currency' => 'USD',
            'credits' => 500,
            'type' => 'onetime',
            'paddle_subscription_plan_id' => '831640',
            'description' => '500 Credits for $55'
        ]);

        \App\Models\Plan::create([
            'name' => 'Monthly',
            'slug' => 'monthly',
            'amount' => 39,
            'currency' => 'USD',
            'credits' => 0,
            'type' => 'recurring',
            'paddle_subscription_plan_id' => '831631',
            'description' => 'Unlimited Credits'
        ]);

        \App\Models\Plan::create([
            'name' => 'Yearly',
            'slug' => 'yearly',
            'amount' => 239,
            'currency' => 'USD',
            'credits' => 0,
            'type' => 'recurring',
            'paddle_subscription_plan_id' => '831632',
            'description' => 'Unlimited Credits'
        ]);
    }
}
