<?php

namespace App\Models;

use App\Models\Candidate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vote extends Model
{
    use HasFactory;
    protected $fillable = ['candidate_id','judge_id','category_id','criteria'];

    public function candidate() :BelongsTo{
        return $this->belongsTo(Candidate::class);
    }
}
