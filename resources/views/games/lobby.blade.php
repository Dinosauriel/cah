@extends('layouts.master')



@section('content')
    <game-list></game-list>
    <div class="row justify-content-end">
        <div class="col col-sm-3">
            <div class="card mt-4">
                <a href="{{ \App\Game::getStoreRoute() }}" class="btn btn-success btn-block">Create New Game</a>
            </div>
        </div>
    </div>
@endsection