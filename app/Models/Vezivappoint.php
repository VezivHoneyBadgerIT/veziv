<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vezivappoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'app_date',
        'full_name',
        'phone',
        'email',
    ];

}
