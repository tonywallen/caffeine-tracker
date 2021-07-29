<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Account
 * @package App\Models
 */
class UserDrinkXref extends Model
{
    protected $table = 'user_drinks_xref';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'drink_id',
    ];
}
