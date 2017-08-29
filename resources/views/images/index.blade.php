@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="height:55px">
                <span style="font-size:25px">Album</span>
                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">Add New</button>
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
{{--  Load modal Form  --}}
@include('images.form')

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
        width: 19.60%;
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
    <script type="text/javascript">
        $('body').on('click', '#submitForm', function(){
        //$('imagesForm').submit(function(e){
            //var registerForm = $("#imagesForm");
            //var formData = registerForm.serialize();            
            var data = new FormData($("#imagesForm")[0]); // <-- 'this' is your form element
            $.ajax({
                url:"{{ route('images.store') }}",
                type:'POST',
                data: data,
                processData: false,
                contentType: false,
                success:function(data) {
                    console.log(data);
                    if(data.errors) {
                        if(data.errors.title){
                            $( '#title-error' ).html( data.errors.title[0] );
                            alert(data.errors.title[0]);
                        }
                        if(data.errors.path){
                            $( '#path-error' ).html( data.errors.path[0] );
                        }
                        if(data.errors.caption){
                            $( '#caption-error' ).html( data.errors.caption[0] );
                        }
                    }else{
                        $('#myModal').modal('hide');
                        $( '#title-error' ).html("");
                        $( '#path-error' ).html("");
                        $( '#caption-error' ).html("");
                        $("#imagesForm")[0].reset();
                        $('#imageContent').html(data);
                        imagesLoaded( grid ).on( 'progress', function() {
                            // layout Masonry after each image loads
                            msnry.layout();
                        });
                    }
                },
            });
        });
    </script>
@endsection