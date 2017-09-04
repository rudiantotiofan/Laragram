@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                <span style="font-size:22px">All Member Album</span>
                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif  
                    <div id="imageContent">
                        @if($albums->count()>0)
                            <div class="grid">
                                <div class="grid-sizer"></div>
                                <?php $i=0;?>
                                @foreach($albums as $item)
                                <?php $i++?>
                                    <div class="col-sm-3">
                                        <div class="thumbnail" style="margin-bottom:0px">
                                            <div id="" class="carousel slide myCarousel">
                                                <!-- Carousel items -->
                                                <div class="carousel-inner">
                                                @if($item->images->count()>0)
                                                    <?php $i=0;?>
                                                    @foreach($item->images as $image)
                                                        <div class="{!! $i == 0 ? 'active':'' !!} item" data-slide-number="{{$i}}">
                                                            {!! Html::image(asset('img/upload/'.$image->path),null,['class'=>'img img-responsive','id'=>$i,'alt'=>$item->title,'height'=>'200px']) !!}
                                                        </div>
                                                        <?php $i++;?>
                                                    @endforeach
                                                @else
                                                    <div class="active item" data-slide-number="0">
                                                        {!! Html::image(asset('img/default/thumb.jpg'),null,['class'=>'img img-responsive','id'=>$i,'alt'=>'none','width'=>'100%']) !!}
                                                    </div>
                                                @endif
                                                    
                                                </div>
                                            </div>
                                            {{--  capiton  --}}
                                            <div class="caption">
                                                <h4><b>{{$item->name}}</b></h4>
                                                <p> Images post, &emsp;{{$item->images->count()}}</p>
                                                <a href="{{route('album.user',$item->id)}}" class="btn btn-default" role="button">
                                                    <span class="glyphicon glyphicon-th">&nbsp;More</span>
                                                </a> 
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                        @else
                            <blockquote>Join to Laragram now !</blockquote>                    
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
{{--  Custom CSS & JS  --}}
@section('embedCSS')
    <link href="{{ asset('default/css/custom.css') }}" rel="stylesheet">
@endsection
@section('embedJS')
    <script src="{{ asset('default/js/custom.js') }}"></script>
@endsection