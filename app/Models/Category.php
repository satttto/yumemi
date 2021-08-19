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
        'name',
        'parent_category_id',
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
