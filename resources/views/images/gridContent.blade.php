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
</style>
@if($images->count()>0)
    <div class="grid">
        <div class="grid-sizer"></div>
        <?php $i=0;?>
        @foreach($images as $item)
        <?php $i++?>
        <div class="grid-item">
            {!! Html::image(asset('img/upload/'.$item->path),null,['class'=>'img img-responsive','id'=>$i,'alt'=>$item->title]) !!}    
        </div>
        @endforeach
    </div>
    
@else
    <blockquote>Let's add a new picture !</blockquote>                    
@endif

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
</script>
