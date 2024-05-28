<?php

namespace App\Models;

use App\Models\Event;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'category_name', 'status'];

    public function event() :BelongsTo{
        return $this->belongsTo(Event::class);
    }

    public function subCategory() :HasMany{
        return $this->hasMany(SubCategory::class);
    }
}
