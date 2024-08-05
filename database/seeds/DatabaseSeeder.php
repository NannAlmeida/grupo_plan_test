<?php

use App\Training;
use App\User;
use App\UserTraining;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'name' => 'Gestor',
                'email' => 'gestor@google.com',
                'password' => '$2a$10$wAICwRn18GpKseO8koWVr.ZOrmC6rUhkLYAt8F4eOz.G.Mzbcmt9i',
                'role' => 'M'
            ],
            [
                'name' => 'Funcionário 1',
                'email' => 'funcionario1@google.com',
                'password' => '$2a$10$wAICwRn18GpKseO8koWVr.ZOrmC6rUhkLYAt8F4eOz.G.Mzbcmt9i',
                'role' => 'E'
            ],
            [
                'name' => 'Funcionário 2',
                'email' => 'funcionario2@google.com',
                'password' => '$2a$10$wAICwRn18GpKseO8koWVr.ZOrmC6rUhkLYAt8F4eOz.G.Mzbcmt9i',
                'role' => 'E'
            ],
            [
                'name' => 'Funcionário 3',
                'email' => 'funcionario3@google.com',
                'password' => '$2a$10$wAICwRn18GpKseO8koWVr.ZOrmC6rUhkLYAt8F4eOz.G.Mzbcmt9i',
                'role' => 'E'
            ],
        ]);

        Training::insert([
            'name' => 'Integração',
            'description' => 'Integração na empresa',
            'start_date' => '2024-08-01',
            'end_date' => '2024-08-20'
        ]);

        UserTraining::insert([
            [
                'user_id' => 2,
                'training_id' => 1,
                'status' => 'A',
                'progress' => 15,
                'end_date' => null
            ],
            [
                'user_id' => 3,
                'training_id' => 1,
                'status' => 'I',
                'progress' => 0,
                'end_date' => null
            ],
            [
                'user_id' => 4,
                'training_id' => 1,
                'status' => 'C',
                'progress' => 100,
                'end_date' => '2024-08-06'
            ],
        ]);
    }
}
