<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sureddo extends Model
{
    protected $fillable = ['user_id', 'text'];

    /**
     * user取得
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo {
        return $this->belongsTo('App\Models\User');
    }
}