<?php

namespace App\Models;

use App\Models\SportCategory;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GameResult extends Model
{
    use HasFactory;
    protected $fillable = ['sport_category_id','team_id','status','result'];

    public function sportCategory() :BelongsTo{
        return $this->belongsTo(SportCategory::class);
    }

    public function team() :BelongsTo{
        return $this->belongsTo(Team::class);
    }
}
