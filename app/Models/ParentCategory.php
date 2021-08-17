<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentCategory extends Model
{
    use HasFactory;

    const REMOTE_TOOL = 1;
    const ENVIRONMENT = 2;
    const PERSONAL = 3;
    const FEEDBACK = 4;
    const LIFE_HABIT = 5;
    const EXERCISE = 6;
    const SLEEP = 7;
    const WORK_HABIT = 8;
    const THNKING_HABIT = 9;
    const COMPANY_GOAL = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
    ];

}
