<?php

namespace App\Models;

use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PercentageScore extends Model
{
    use HasFactory;
    protected $fillable = ['vote_id','candidate_id','judge_id','category_id','total_score'];

    // belongs to candidates
    public function candidate() :BelongsTo{
        return $this->belongsTo(Candidate::class);
    }

    //belongs to vote
    public function votes() :BelongsTo{
        return $this->belongsTo(Vote::class);
    }
}
