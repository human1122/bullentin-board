<?php

namespace App\Models;

use App\Models\Sureddo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KoSureddo extends Model
{
    protected $fillable = ['sureddo_id', 'user_id', 'text'];

    /**
     * sureddo取得
     *
     * @return BelongsTo
     */
    public function sureddo(): BelongsTo
    {
        return $this->belongsTo(Sureddo::class);
    }
}
