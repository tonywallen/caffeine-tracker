<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Account
 * @package App\Models
 */
class Drink extends Model
{
    protected $table = 'drinks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'caffeine',
    ];
}
