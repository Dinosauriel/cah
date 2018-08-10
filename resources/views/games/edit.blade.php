@extends('layouts.master')

@section('page_title')
New Game
@endsection

@section('content')
<div class="row mt-3">
    <form class="col-sm-8">
        <div class="form-group">
            <label for="game_name">Name</label>
            <input type="text" class="form-control" id="game_name" aria-describedby="">
        </div>
        <div class="form-group">
            <label for="game_points">Points</label>
            <input type="number" class="form-control" id="game_points" aria-describedby="game_points_help" value="8" min="1" max="64">
            <small id="game_points_help" class="form-text text-muted">How many points are required to win?</small>
        </div>
        <button type="submit" class="btn btn-primary">Start Game</button>
    </form>
    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Invite</h5>
                <p class="card-text">https://domain.com/games/asdf</p>
                <a href="#" class="btn btn-primary">Copy Link</a>
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
    </div>
</div>
@endsection
@section('scripts')

@endsection