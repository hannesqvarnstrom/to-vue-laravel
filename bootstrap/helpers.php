<?php

use App\Models\Todo;
use App\Models\TodoList;
use Faker\Core\Number;

function get_gap_in_ordered_list($list): int
{
    global $order;
    $order = 0;

    if ($length = count($list)) {
        $order = $length;

        for ($i = 0; $i < $length; $i++) {
            $current = $list[$i]->order;
            $next = $list[$i + 1]->order ?? null;
            if ($current === $i && $next !== $i + 1) {
                $order = $i + 1;
                $i += $length;
            } else if ($current !== $i && $next === $i + 1) {
                $order = $i;
                $i += $length;
            }
        }
    }

    return $order;
}
