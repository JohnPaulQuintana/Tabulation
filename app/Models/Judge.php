<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Judge extends Model
{
    use HasFactory;

    protected $fillable = ['event_id','name','address','position','code'];

    public function event() :BelongsTo{
        return $this->belongsTo(Event::class);
    }
}
