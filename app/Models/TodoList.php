<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TodoList extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'order'
    ];
    /**
     * @return BelongsTo|User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function todos()
    {
        return $this->hasMany(Todo::class);
    }

    /**

     * @param User $user
     * @param string $title
     * @return void
     */
    public static function create_in_user(User $user, string $title)
    {
        $otherLists = $user->todo_lists;
        $order = get_gap_in_ordered_list($otherLists);

        return self::create([
            'user_id' => $user->id,
            'title' => $title,
            'order' => $order
        ]);
    }

    /**
     * Sorts all todos in the same order as they are, but at consistent integers (eg. 0, 1, 2, 3...)
     * @return void
     */
    public function normalize_todo_order()
    {
        $todos = $this->todos()->orderBy('order')->get();

        if ($length = count($todos)) {
            for ($i = 0; $i < $length; $i++) {
                $todos[$i]->order = $i;
                $todos[$i]->save();
            }
        }
    }
}
