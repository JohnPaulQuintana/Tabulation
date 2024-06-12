<?php

namespace App\Models;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Player extends Model
{
    use HasFactory;
    protected $fillable = ['team_id', 'name','profile'];

    public function team() :BelongsTo{
        return $this->belongsTo(Team::class);
    }
}
