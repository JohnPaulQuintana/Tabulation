<?php

namespace App\Models;

use App\Models\Event;
use App\Models\Vote;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Candidate extends Model
{
    use HasFactory;
    protected $fillable = ['event_id','profile','name','age'];

    public function event() :BelongsTo{
        return $this->belongsTo(Event::class);
    }

    public function votes() :HasMany{
        return $this->hasMany(Vote::class);
    }
}
