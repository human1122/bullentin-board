<?php

namespace App\Services;

use App\Models\KoSureddo;
use App\Models\Sureddo;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class SureddoService {
    protected $KoSureddo;
    protected $Sureddo;

    public function __construct(KoSureddo $koSureddo, Sureddo $sureddo) {
        $this->KoSureddo = $koSureddo;
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
     * @param Int $sureddo_id
     * @return bool
     */
    public function create(Int $user_id, String $text, ?Int $sureddo_id): bool
    {
        $result = false;
        DB::beginTransaction();
        try {
            if (empty($sureddo_id)) {
                $sureddo = $this->Sureddo->create([
                    'user_id' => $user_id,
                    'text' => $text,
                ]);
            } else {
                $ko_sureddo = $this->KoSureddo->create([
                    'sureddo_id' => $sureddo_id,
                    'user_id' => $user_id,
                    'text' => $text,
                ]);
            }

            $result = true;
            DB::commit();
        } catch(\Exception $e) {
            $result = false;
            logger($e->getMessage() . 'method:' . __METHOD__ . 'line:' . __LINE__);
            DB::rollback();
        }

        return $result;
    }
}