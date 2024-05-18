<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = ['category_id','sub_category','percentage'];

    public function category() :BelongsTo{
        return $this->belongsTo(Category::class);
    }
}
