<?php

namespace App\Services;

use App\Models\Sureddo;
use Illuminate\Database\Eloquent\Collection;

class SureddoService {
    protected $Sureddo;

    public function __construct(Sureddo $sureddo) {
        $this->Sureddo = $sureddo;
    }

    /**
     * スレッド一覧取得
     *
     * @return Collection
     */
    public function getAll(): Collection {
        $with = ['user'];
        $result = $this->Sureddo->with($with)->get();

        return $result;
    }

    /**
     * スレッド作成
     *
     * @param Int $user_id
     * @param String $text
     * @return Sureddo
     */
    public function create(Int $user_id, String $text): Sureddo {
        $result = $this->Sureddo->create([
            'user_id' => $user_id,
            'text' => $text,
        ]);

        return $result;
    }
}