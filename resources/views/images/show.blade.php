@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="height:55px">
                <span style="font-size:25px">Detail Images</span>
                <a href="{{route('images.index')}}" class="btn btn-primary pull-right">My Album</a>
                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif  
                    <div id="imageContent">
                        <div class="col-md-5 col-xs-12">
                            {!! Html::image(asset('img/upload/'.$images->path),null,['class'=>'img img-responsive','alt'=>$images->title,'width'=>'100%']) !!}    
                        </div>
                        <div class="col-md-7 col-xs-12">
                            <h2><b>{{$images->title}}</b></h2>
                            <p><b>Post at, {{$images->created_at}}</b></p>
                            <p>&emsp;{{$images->caption}}</p>

                            <div id="commentContent" style="margin-top:30px">
                                @include('images.comments')
                            </div>
                            <div class="panel panel-info pb-cmnt-container" style="margin-top:15px">
                                <div class="panel-body">
                                    <form class="form-inline">
                                        <textarea id="commentText" placeholder="Write your comment here!" class="pb-cmnt-textarea"></textarea>
                                        <span class="text-danger"><strong id="text-error"></strong></span>
                                        <button class="btn btn-primary pull-right" type="button" onclick="sendComment({{$images->id}})" style="margin-top:10px">Send</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .pb-cmnt-textarea {
        resize: none;
        padding: 20px;
        height: 100px;
        width: 100%;
        border: 1px solid #F2F2F2;
    }
</style>
<style>
    #myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
        
    }

    #myImg:hover {opacity: 0.7;}

    /* The Modal (background) */
    .modal-img {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1500; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
    }

    /* Modal Content (Image) */
    .content-img {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    /* Caption of Modal Image (Image Text) - Same Width as the Image */
    #img-caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    /* Add Animation - Zoom in the Modal */
    .content-img, #img-caption {
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
        from {-webkit-transform:scale(0)}
        to {-webkit-transform:scale(1)}
    }

    @keyframes zoom {
        from {transform:scale(0)}
        to {transform:scale(1)}
    }

    /* The Close Button */
    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px){
        .content-img {
            width: 100%;
        }
    }
    .thumbnail {
        padding:0px;
    }
    .panel {
        position:relative;
    }
    .panel>.panel-heading:after,.panel>.panel-heading:before{
        position:absolute;
        top:11px;left:-16px;
        right:100%;
        width:0;
        height:0;
        display:block;
        content:" ";
        border-color:transparent;
        border-style:solid solid outset;
        pointer-events:none;
    }
    .panel>.panel-heading:after{
        border-width:7px;
        border-right-color:#f7f7f7;
        margin-top:1px;
        margin-left:2px;
    }
    .panel>.panel-heading:before{
        border-right-color:#ddd;
        border-width:8px;
    }
</style>
<!-- The Modal -->
<div id="showImage" class="modal modal-img">
  <!-- The Close Button -->
  <span class="close" onclick="document.getElementById('showImage').style.display='none'">&times;</span>
  <!-- Modal Content (The Image) -->
  <img class="modal-content content-img" id="img01">
  <!-- Modal Caption (Image Text) -->
  <div id="img-caption"></div>
</div>

<script>
    // Get the modal
    var modal = document.getElementById('showImage');
    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById('myImg');
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    
    $(document).ready(function () {
        $('img').on('click', function () {
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        });
    });

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    } 

    //comment ajax
    function sendComment(id){
        var text = $('#commentText').val();
        $.ajax({
            url:"{{route('comments.store')}}",
            type:'POST',
            data:{'image_id':id,'text':text},
            success:function(data){
                console.log(data);
                console.log(data);
                    if(data.errors) {
                        if(data.errors.text){
                            $( '#text-error' ).html( data.errors.text[0] );
                        }
                    }else{
                        $( '#title-error' ).html("");
                        $('#commentText').val("");
                        $('#commentContent').html(data);
                    }
            }
        });
    }
</script>
@endsection
