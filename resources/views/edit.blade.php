@extends('layouts.app')

@section('javascript')
<script src="/js/confirm.js"></script>
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            プラン編集
            <form class="card-body" id="delete-form" action="{{ route('destroy') }}" method="POST">
                @csrf
            <input type="hidden" name="plan_id" value="{{ $edit_plan['id'] }}"/>
            {{ $edit_plan['title'] }}
                <button type="submit" class="btn btn-primary" onclick="deleteHandle(event);">削除</button>
            </form>
        </div>
        {{-- route('store')と書くと→/store  --}}
        <form class="card-body my-card-body" action="{{ route('update') }}" method="POST">
            @csrf
            <input type="hidden" name="plan_id" value="{{ $edit_plan['id'] }}"/>
            <div class="form-group">
                ・行き先
                <textarea class="form-control" name="title" rows="1" placeholder="ここに行き先を入力してください">{{ $edit_plan['title'] }}</textarea>
                ・内容
                <textarea class="form-control" name="content" rows="3" placeholder="ここに予定内容を入力してください">{{ $edit_plan['content'] }}</textarea>
              </div>
              @error('title')
                    <div class="alert alert-danger">タイトルを入力してください</div>
              @enderror
              <button type="submit" class="btn btn-primary">更新</button>
            </form>
    </div>
@endsection
