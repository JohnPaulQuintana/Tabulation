<?php

namespace App\Models;

use App\Models\Event;
use App\Models\PercentageScore;
use App\Models\Vote;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Candidate extends Model
{
    use HasFactory;
    protected $fillable = ['event_id','profile','name','age', 'counter', 'isActive'];

    public function event() :BelongsTo{
        return $this->belongsTo(Event::class);
    }

    public function votes() :HasMany{
        return $this->hasMany(Vote::class);
    }

    //has many percentage score
    public function percentageScores() :HasMany{
        return $this->hasMany(PercentageScore::class);
    }
}
