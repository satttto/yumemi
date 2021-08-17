<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // TODO: IDの定数を追加して、migrationファイルを書きかえる。

    protected $fillable = [
        'level_id',
        'category_id',
        'description',
    ];
}
