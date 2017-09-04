@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                <span style="font-size:22px">User Album</span>
                <a href="{{route('images.index')}}" class="btn btn-primary pull-right">My Album</a>
                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif  
                    <div id="imageContent">
                        @include('images.gridContent')
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
    <style>
        * { box-sizing: border-box; }

        /* force scrollbar */
        html { overflow-y: scroll; }

        body { font-family: sans-serif; }

        /* ---- grid ---- */

        .grid {
        background: #DDD;
        padding:2px
        }

        /* clear fix */
        .grid:after {
        content: '';
        display: block;
        clear: both;
        }

        /* ---- .grid-item ---- */

        .grid-sizer,
        .grid-item {
        width: 19.65%;
        margin:2px;
        }

        .grid-item {
        float: left;
        }

        .grid-item img {
        display: block;
        max-width: 100%;
        }
    </style>
@endsection
@section('embedJS')
    <script src="{{ asset('default/js/custom.js') }}"></script>
    <script type="text/javascript">
        // init Masonry
        var grid = document.querySelector('.grid');
        var msnry = new Masonry( grid, {
            itemSelector: '.grid-item',
            columnWidth: '.grid-sizer',
            percentPosition: true
        });
        imagesLoaded( grid ).on( 'progress', function() {
            // layout Masonry after each image loads
            msnry.layout();
        });
    </script>
@endsection