<?php

namespace App\Models;

use App\Models\PlayerScore;
use App\Models\PlayerTotalScore;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Player extends Model
{
    use HasFactory;
    protected $fillable = ['team_id', 'name','profile'];

    public function team() :BelongsTo{
        return $this->belongsTo(Team::class);
    }

    public function playerScore() :HasMany{
        return $this->hasMany(PlayerScore::class);
    }

    public function playerTotalScore(): HasOne{
        return $this->hasOne(PlayerTotalScore::class);
    }
}
