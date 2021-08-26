<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ParentCategory;
use App\Models\Task;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text_jp',
        'parent_category_id',
        'sort_number',
    ];

    public function parentCategory()
    {
        return $this->belongsTo(parentCategory::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
