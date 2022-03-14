@extends('layouts.app')

@section('content')
{{-- 定数 --}}
@php
    $per_page_list = \App\Enums\PerPageList::toSelectArray();
@endphp

{{-- メッセージ --}}
@if (session('result'))
    <div class='alert alert-success text-center'>投稿しました。</div>
@endif

{{-- スレッド一覧 --}}
<div class='w-50 mx-auto'>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="m-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- 新規投稿フォーム --}}
    @auth
        <form action="{{ route('sureddo.create') }}" method='POST' name='tokoran_form'>
            @csrf
            <input type='hidden' name='user_id' value="{{ Auth::id() }}">
            <label>投稿</label>
            <textarea class='form-control mb-2' rows='3' name='text'></textarea>
            <button class='btn btn-primary'>投稿</button>
        </form>
    @endauth
    <div class='row'>
        <div class='col-md-8'></div>
        <label class='col-form-label col-md-2'>ページ数</label>
        <select class='form-control col-md-2 js-per-page' name='page_num'>
            <option value='' hidden></option>
            @foreach ($per_page_list as $per_page_key => $per_page_item)
            <option value="{{ $per_page_key }}"
                @if(request()->page_num === old('page_num', \App\Enums\PerPageList::getDescription($per_page_key))) selected @endif>
                {{ $per_page_item }}
            </option>
            @endforeach
        </select>            
    </div>
    @foreach ($sureddo_list as $i => $sureddo)
        <table class='table'>
            <thead class='thead-light'>
                <tr>
                    <th>{{ $i+1 }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $sureddo->text }}</td>
                </tr>
                <tr>
                    <td>
                        @auth
                        <button type='button' class='btn btn-primary' data-toggle='collapse' data-target="{{ '#collapse-henshin-' . $i }}" >返信</button>
                        @endauth
                        <button type='button' class='btn btn-primary' data-toggle='collapse' data-target="{{ '#collapse-henshin-ichiran-' . $i }}" {{ ($sureddo->ko_sureddo->count() < 1) ? 'disabled': '' }}>返信一覧</button>
                        {{-- 返信 --}}
                        @auth
                        <div class='row mt-2 mb-2'>
                            <div class='col-md-1'></div>
                            <div class='collapse col-md-11' id="{{ 'collapse-henshin-' . $i }}">
                                <form action="{{ route('sureddo.create') }}" method='POST' name='tokoran_form'>
                                    @csrf
                                    <input type='hidden' name='user_id' value="{{ Auth::id() }}">
                                    <input type='hidden' name='sureddo_id' value="{{ $sureddo->id }}"
                                    <label>投稿</label>
                                    <textarea class='form-control mb-2' rows='3' name='henshin_text'></textarea>
                                    <button class='btn btn-primary'>投稿</button>
                                </form>
                            </div>
                        </div>
                        @endauth
                        {{-- 返信一覧 --}}
                        @foreach ($sureddo->ko_sureddo as $ko_sureddo)
                        <div class='row'>
                            <div class='col-md-1'></div>
                            <div class='collapse col-md-11' id="{{ 'collapse-henshin-ichiran-' . $i }}">
                                <textarea class='form-control' readonly>{{ $ko_sureddo->text }}</textarea>
                            </div>
                        </div>
                        @endforeach
                    </td>

                </tr>
            </tbody>
        </table>
    @endforeach

{{-- pager --}}
    @if ($sureddo_list->hasPages())
        {{ $sureddo_list->links() }}
    @else
        <div class='g_pager'>
            <a class='prev'></a>
            <a class='current' href='#text'>1</a>
            <a class='next'></a>
        </div>
    @endif
</div>


<script type="module" src="{{ mix('js/sureddo/index.js') }}"></script>
@endsection


