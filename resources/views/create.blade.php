@extends('layouts.app')

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  @yield('javascript')

  @section('javascript')
      <script src="/js/confirm.js"></script>
  @endsection

@section('content')
    <div class="card-body">
        <div class="card-header">
            編集
        </div>
        {{-- route('store')と書くと→/store  --}}
            <form class="card-body" action="{{ route('store') }}" method="POST">
                @error('title')
                    <div class="alert alert-danger">入力漏れがあります!</div>
                @enderror
                @csrf
                <div class="form-group">
                    <h6>新規予定作成</h6>
                    ・行き先
                    <textarea class="form-control" name="title" rows="1" placeholder="ここに行き先を入力してください"></textarea>
                    ・内容(時間、予算、やりたい事など)
                    <textarea class="form-control" name="content" rows="3" placeholder="ここに予定内容を入力してください"></textarea>
                    ・挿入するスケジュールを選んでください
                    @foreach ($travels as $travel)
                    <p class="form-check form-check-inline d-block">
                        <input type="radio" name="travel_title" value="{{ $travel['title'] }}" checked>
                            {{ $travel['title'] }}
                    </p>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-primary">予定作成</button>
            </form>

            <form class="card-body" action="{{ route('travel') }}" method="POST">
                @error('travel_title')
                    <div class="alert alert-danger">入力漏れがあります!</div>
                @enderror
                @csrf
                <div class="form-group">
                    <h6>新規スケジュール作成</h6>
                    <input type="text" class="form-control w-50 mb-3" name="travel_title" placeholder="スケジュール名を入力してください">
                </div>
                    <button type="submit" class="btn btn-primary">スケジュール作成</button>
            </form>

            <form class="form-group" id="delete-form" action="{{ route('destroy_travel') }}" method="POST">
                <div class="card-body">
                    <h6>スケジュール削除</h6>
                    @error('travel_id')
                      <div class="alert alert-danger">入力漏れがあります!</div>
                    @enderror
                    @csrf

                    @foreach ($travels as $travel)
                    <p class="form-check form-check-inline d-block">
                       <input type="radio" name="travel_id" value="{{ $travel['id'] }}">
                           {{ $travel['title'] }}
                    </p>
                    @endforeach
                    <button type="submit" onclick="deleteHandle(event)" class="btn btn-primary" checked>スケジュール削除</button>
                    </div>
            </form>
    </div>
@endsection
