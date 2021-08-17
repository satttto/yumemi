<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ParentCategory;

class Category extends Model
{
    use HasFactory;

    const REMOTE_TOOL = 1;
    const ENVIRONMENT = 2;
    const SELF_DISCLOSURE = 3;
    const MENTAL_SECURITY = 4;
    const THANKS = 5;
    const FEEDBACK = 6;
    const LIFESTYLE = 7;
    const EAT_HABIT = 8;
    const EXERCISE = 9;
    const SLEEP = 10;
    const WORK_MANAGEMENT = 11;
    const PERFORMANCE = 12;
    const THINKING_HABIT = 13;
    const MINDSET = 14;
    const MEET_UP_100 = 15;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'parent_category_id',
    ];

    public function parentCategory()
    {
        return $this->belongsTo(ParentCategory::class, 'id', 'name');
    }
}
