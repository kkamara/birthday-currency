@if(session('flashSuccess'))
    <div class="alert alert-success" role="alert">
        {{ session('flashSuccess') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session('flashWarning'))
    <div class="alert alert-warning" role="alert">
        {{ session('flashWarning') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session('flashDanger'))
    <div class="alert alert-danger" role="alert">
        {{ session('flashDanger') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
