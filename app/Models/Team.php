<?php

namespace App\Models;

use App\Models\Event;
use App\Models\GameResult;
use App\Models\Player;
use App\Models\Scorer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Team extends Model
{
    use HasFactory;
    protected $fillable = ['event_id','profile','team_name'];

    public function event() :BelongsTo{
        return $this->belongsTo(Event::class);
    }

    public function game() :HasMany{
        return $this->hasMany(Game::class);
    }

    public function players() :HasMany{
        return $this->hasMany(Player::class);
    }

    public function scorer() :HasOne{
        return $this->hasOne(Scorer::class);
    }
    
    public function playerTotalScore(): HasOne{
        return $this->hasOne(PlayerTotalScore::class);
    }

    public function gameResult() :HasMany{
        return $this->hasMany(GameResult::class);
    }
    
}
