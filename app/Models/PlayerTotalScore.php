<?php

namespace App\Models;

use App\Models\Player;
use App\Models\PlayerScore;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlayerTotalScore extends Model
{
    use HasFactory;
    protected $fillable = ['player_id','total_score','game_status', 'game_id'];

    public function playerScore() :BelongsTo{
        return $this->belongsTo(Player::class);
    }
}
