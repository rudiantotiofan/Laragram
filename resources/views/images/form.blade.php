<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Images Form</h4>
        </div>
        {{--  open form  --}}
        {!! Form::open([
                        'url'   =>  route('images.store'),
                        'mehtod'=>  'POST',
                        'files' =>  'true',
                        'class' =>  'form-horizontal',
                        'id'    =>  'imagesForm'
                    ]) !!}
                    
        <div class="modal-body">

            <div class="row" style="padding:0 25px 0 20px">
                <div class="col-sm-8">    
                        {!! Form::hidden('user_id', Auth::user()->id, ['class'=>'form-control','id'=>'user_id']) !!}                         

                        <div class="form-group{{ $errors->has('title') ? ' has-error':'' }}">
                            {!! Form::label('title', 'Title', ['class'=>'col-md-2 control-label']) !!}
                            <div class="col-md-10">
                                {!! Form::text('title', null, ['class'=>'form-control','id'=>'title']) !!}
                                <span class="text-danger"><strong id="title-error"></strong></span>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('cover') ? ' has-error':'' }}">
                            {!! Form::label('path','Image',['class'=>'col-md-2 control-label']) !!}
                            <div class="col-md-10">
                                {!! Form::file('path',['id'=>'imgPath'])!!}
                                <span class="text-danger"><strong id="path-error"></strong></span>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('caption') ? ' has-error':'' }}">
                            {!! Form::label('caption', 'Caption', ['class'=>'col-md-2 control-label']) !!}
                            <div class="col-md-10">
                                {!! Form::textarea('caption', null, ['class'=>'form-control','size'=>'10x4','id'=>'caption']) !!}
                                <span class="text-danger"><strong id="caption-error"></strong></span>
                            </div>
                        </div>                            
                </div>
                <div class="col-sm-4">
                    {!! Form::label('priview','Priview :',['class'=>'control-label']) !!}
                    {!! Html::image(asset('img/default/thumb.jpg'),null,['class'=>'img img-rounded img-responsive img-thumbnail','id'=>'imgPriview']) !!}
                </div>
            </div>        
        </div>
        <div class="modal-footer">
            {{--  {!! Form::submit('Post',['class'=>'btn btn-success','id'=>'submitForm']); !!}  --}}
            <button type="button" class="btn btn-success" id="submitForm">Post</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
        {!! Form::close() !!}                       
    </div>
  </div>
</div>
