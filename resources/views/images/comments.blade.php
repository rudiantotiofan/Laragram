{{--  Comment Template  --}}
@if($comments->count() > 0)
    @foreach($comments as $item)
        <div class="row">
            <div class="col-sm-2">
                <div class="thumbnail">
                    <img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
                </div>
            </div>
            <div class="col-sm-10">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>{{ $item->name }}</strong> &nbsp;
                        <small><span class="text-muted">Post at, {{$item->created_at}}</span></small>
                    </div>
                    <div class="panel-body">
                        {{$item->text}}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif