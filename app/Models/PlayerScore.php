<?php

namespace App\Models;

use App\Models\Player;
use App\Models\PlayerTotalScore;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PlayerScore extends Model
{
    use HasFactory;
    protected $fillable = ['game_id','team_id','event_id','judge_id','player_id','score'];

    public function player(): BelongsTo{
        return $this->belongsTo(Player::class);
    }

}
