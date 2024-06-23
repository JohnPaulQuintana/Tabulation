<?php

namespace App\Models;

use App\Models\Game;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Scorer extends Model
{
    use HasFactory;

    protected $fillable = ['game_id','team_id','event_id','judge_id'];

    public function game() :BelongsTo{
        return $this->belongsTo(Game::class);
    }

    public function team() :BelongsTo{
        return $this->belongsTo(Team::class);
    }

    public function judge() :BelongsTo{
        return $this->belongsTo(Judge::class);
    }
}
