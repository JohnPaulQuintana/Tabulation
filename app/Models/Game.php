<?php

namespace App\Models;

use App\Models\Scorer;
use App\Models\SportCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Game extends Model
{
    use HasFactory;
    protected $fillable = ['sport_category_id','team_id','status'];

    public function sportCategory() :BelongsTo{
        return $this->belongsTo(SportCategory::class);
    }

    public function team() :BelongsTo{
        return $this->belongsTo(Team::class);
    }

    public function scorer() :HasOne{
        return $this->hasOne(Scorer::class);
    }
}
