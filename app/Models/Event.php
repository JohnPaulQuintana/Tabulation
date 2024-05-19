<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Judge;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name','details','type','image','status'];

    public function category() :HasMany{
        return $this->hasMany(Category::class);
    }

    public function judge() :HasMany{
        return $this->hasMany(Judge::class);
    }
}
