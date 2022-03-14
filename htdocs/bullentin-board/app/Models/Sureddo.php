<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sureddo extends Model
{
    protected $fillable = ['user_id', 'text'];

    /**
     * user取得
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    /**
     * ko_sureddo取得
     *
     * @return BelongsTo
     */
    public function ko_sureddo(): HasMany
    {
        return $this->hasMany(KoSureddo::class);
    }
}