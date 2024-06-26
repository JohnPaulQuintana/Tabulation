<?php

namespace App\Models;

use App\Models\Event;
use App\Models\Game;
use App\Models\GameResult;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SportCategory extends Model
{
    use HasFactory;
    protected $fillable = ['event_id','category'];

    public function event() :BelongsTo{
        return $this->belongsTo(Event::class);
    }

    public function game() :HasMany{
        return $this->hasMany(Game::class);
    }
    public function gameResults() :HasMany{
        return $this->hasMany(GameResult::class);
    }
}
