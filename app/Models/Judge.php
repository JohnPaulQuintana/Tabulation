<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Judge extends Model
{
    use HasFactory;

    protected $fillable = ['event_id','user_id','name','address','position','code', 'profile'];

    public function event() :BelongsTo{
        return $this->belongsTo(Event::class);
    }

    public function user() :BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function votes() :HasMany{
        return $this->hasMany(Vote::class);
    }
}
