<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    public function todo_list()
    {
        return $this->belongsTo(TodoList::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * createInList - creates a todo at the first empty spot of a list, or at the end. 
     *
     * @param TodoList $todoList
     * @param User $user
     * @param string $title
     * @param string|null $description
     * @return Todo
     */
    public static function create_in_list(TodoList $todoList, User $user, string $title,  string $description = null): Todo
    {
        $otherTodos = $todoList->todos()->get();

        $order = get_gap_in_ordered_list($otherTodos);

        return self::create([
            'todo_list_id' => $todoList->id,
            'user_id' => $user->id,
            'title' => $title,
            'description' => $description,
            'order' => $order
        ]);
    }

    /**
     *  Will move this into a todolist at a certain order, displacing all other afterwards +1
     *  Todo and TodoList must be owned by same user, hook some policy to controller
     *
     * @param TodoList $todoList
     * @param integer $order
     * @return void
     */
    public function move_in_list(TodoList $todoList, int $order)
    {
        if ($this->todo_list === $todoList) {
            $todos = $todoList->todos()->where('id', '!=', $this->id)->orderBy('order')->get();

            $todos = $todos->slice($order);

            foreach ($todos as $todo) {
                $todo->order += 1;
                $todo->save();
            }

            $this->order = $order;
            $this->save();
        } else {
            $todos = $todoList->todos()->orderBy('order')->get();
            $todos = $todos->slice($order);

            foreach ($todos as $todo) {
                $todo->order += 1;
                $todo->save();
            }

            $this->todo_list()->associate($todoList);
            $this->order = $order;
            $this->save();
        }

        $todoList->normalize_todo_order();
    }
}
