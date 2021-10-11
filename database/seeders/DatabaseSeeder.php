<?php

namespace Database\Seeders;

use App\Models\Todo;
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
        \App\Models\User::factory(10)->create();

        foreach (\App\Models\User::all() as $user) {
            $user->todo_lists()->create([
                'title' => "TodoList of $user->name",
            ]);
            $list = $user->todo_lists()->first();
            $todo1 = Todo::create_in_list($list, $user, "$user->name\s first list");
            $todo2 = Todo::create_in_list($list, $user, "$user->name\s second list");
            $todo3 = Todo::create_in_list($list, $user, "$user->name\s third list");
        }
    }
}
