<?php

namespace App\Models;

use App\Models\Event;
use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasFactory;
    protected $fillable = ['event_id','profile','team_name'];

    public function event() :BelongsTo{
        return $this->belongsTo(Event::class);
    }

    public function players() :HasMany{
        return $this->hasMany(Player::class);
    }
}
