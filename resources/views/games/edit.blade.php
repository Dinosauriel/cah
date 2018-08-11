@extends('layouts.master')

@section('page_title')
New Game
@endsection

@section('content')
<div class="row mt-3">
    <example-component></example-component>

    <form class="col col-sm-8" method="POST" action="/games/asdf/update">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="game_name">Name</label>
            <input type="text" class="form-control" id="game_name" name="game_name"  value="{{ $game->name }}" required>
        </div>
        <div class="form-group">
            <label for="game_points">Points</label>
            <input type="number" class="form-control" id="game_points" aria-describedby="game_points_help" value="{{ $game->points_required }}" min="1" max="64" name="game_name" required>
            <small id="game_points_help" class="form-text text-muted">How many points are required to win?</small>
        </div>
        @include('forms.errors')
        <button type="submit" class="btn btn-primary">Start Game</button>
    </form>



    <div class="col col-sm-4">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Invite</h5>
                <p class="card-text">{{ $game->getDraftUrl() }}</p>
                <button type="button" class="btn btn-primary">Copy Link</button>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                Players
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    Cras justo odio
                    <button type="button" class="btn btn-primary btn-sm float-right">Kick</button>
                </li>
            </ul>
        </div>

        <a class="btn btn-danger btn-block mt-3" href="{{ $game->getDeleteUrl() }}">Delete Game</a>
    </div>
</div>
@endsection
@section('scripts')

@endsection