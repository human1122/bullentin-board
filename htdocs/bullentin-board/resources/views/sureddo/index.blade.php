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
            <label>新規投稿</label>
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
    <hr>
    @foreach ($sureddo_list as $i => $sureddo)
        <dl class='clearfix'>
            <dt class='float-left mr-2'>{{ $i+1 }}</dt>
            <dd class='float-left'>{{ $sureddo->name }}</dd>
        </dl>
        <div class='text-break'>
            {{ $sureddo->text }}
        </div>
        <hr>
    @endforeach

{{-- pager --}}
    @if ($sureddo_list->hasPages())
        {{ $sureddo_list->links() }}
    @else
        <div class='g_pager'>
            <a class='prev'></a>
            <a class='current' href=''>1</a>
            <a class='next'></a>
        </div>
    @endif
</div>


<script type="module" src="{{ mix('js/sureddo/index.js') }}"></script>
@endsection


