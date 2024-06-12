<?php

namespace App\Models;

use App\Models\Candidate;
use App\Models\PercentageScore;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Vote extends Model
{
    use HasFactory;
    protected $fillable = ['candidate_id','judge_id','category_id','criteria'];

    public function candidate() :BelongsTo{
        return $this->belongsTo(Candidate::class);
    }

    // has many percentage votes
    public function percentages() :HasOne{
        return $this->hasOne(PercentageScore::class);
    }
}
