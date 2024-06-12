<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SportCategory extends Model
{
    use HasFactory;
    protected $fillable = ['event_id','category'];

    public function event() :BelongsTo{
        return $this->belongsTo(Event::class);
    }
}
