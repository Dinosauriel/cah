@extends('layouts.master')



@section('content')
    @foreach ($games as $game)
        @include('games.listgame')
    @endforeach
    <div class="row justify-content-end">
        <div class="col col-sm-3">
            <div class="card mt-4">
                <a href="{{ $newGameUrl }}" class="btn btn-success btn-block">Create New Game</a>
            </div>
        </div>
    </div>
@endsection