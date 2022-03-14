<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Requests\SureddoRequest;
use App\Services\SureddoService;

class SureddoController extends Controller
{
    protected $SureddoService;

    public function __construct(SureddoService $sureddoService) {
        $this->SureddoService = $sureddoService;
    }

    /**
     * スレッド一覧画面表示
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        // スレッドの表示数取得
        if ($request->page) {
            $page_num = session()->get('page_num');
        } else if(is_numeric($request->page_num)) {
            $page_num = $request->page_num ?? 25;
            session()->put('page_num', $page_num);
        } else {
            $page_num = 25;
            session()->put('page_num', $page_num);
        }

        $sureddo_list = $this->SureddoService->getAll()->paginate($page_num);
        return view('sureddo.index', compact('sureddo_list'));
    }

    /**
     * スレッド作成
     *
     * @param SureddoRequest $request
     * @return RedirectResponse
     */
    public function create(SureddoRequest $request): RedirectResponse
    {
        $text = empty($request->sureddo_id) ? $request->text : $request->henshin_text;
        $result = $this->SureddoService->create($request->user_id, $text, $request->sureddo_id);

        return redirect('/')->with('result', $result);
    }
}
