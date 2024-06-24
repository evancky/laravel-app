<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Todo;

class TodoSeeder extends Seeder
{
    public function run()
    {
        Todo::create([
            'title' => 'First Todo',
            'description' => 'This is the description for the first todo.',
            'status' => 'pending',
            'privacy' => 'public',
            'image' => null,
        ]);

        Todo::create([
            'title' => 'Second Todo',
            'description' => 'This is the description for the second todo.',
            'status' => 'completed',
            'privacy' => 'private',
            'image' => null,
        ]);
    }
}
