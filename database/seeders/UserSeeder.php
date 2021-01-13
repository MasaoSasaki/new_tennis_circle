<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('users')->truncate();
    $user = [
      'email' => 'user@example.com',
      'password' => bcrypt('user')
    ];

    \App\Models\User::create($user);
  }
}
