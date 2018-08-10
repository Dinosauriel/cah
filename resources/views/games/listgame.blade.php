<div class="card mt-3 mb-3">
    <div class="card-body">
        <h5 class="card-title">{{ $game->name }}</h5>
        <h6 class="card-subtitle mb-2 text-muted">Owner</h6>
        <a href=" {{ $game->getDraftUrl() }} " class="card-link">View</a>
        <a href=" {{ $game->getDeleteUrl() }} " class="card-link">Delete</a>
    </div>
</div>