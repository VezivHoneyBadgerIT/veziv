<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VezivAdmin extends Model
{
    use HasFactory;
    protected $fillable = [
        'home_message',
        'show_days',
        'apts_enabled',
        'day1',
        'day2',
        'day3',
        'day4',
        'day5',
        'day6',
        'day7',
        'apts_disabled_message',
    ];
}
