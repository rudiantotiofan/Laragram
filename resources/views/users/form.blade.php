<!-- Modal -->
<div id="UserFormModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">User Admin Form</h4>
        </div>
        {{--  open form  --}}
        {!! Form::open([
                        'url'   =>  route('users.store'),
                        'mehtod'=>  'POST',
                        'class' =>  'form-horizontal',
                        'id'    =>  'usersForm'
                    ]) !!}
                    
        <div class="modal-body">

            <div class="row" style="padding:0 25px 0 20px">
                <div class="col-sm-10">    

                        <div class="form-group{{ $errors->has('title') ? ' has-error':'' }}">
                            {!! Form::label('name', 'Name', ['class'=>'col-md-4 control-label pull-left']) !!}
                            <div class="col-md-8">
                                {!! Form::text('name', null, ['class'=>'form-control','id'=>'name']) !!}
                                <span class="text-danger"><strong id="name-error"></strong></span>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error':'' }}">
                            {!! Form::label('email', 'Email', ['class'=>'col-md-4 control-label']) !!}
                            <div class="col-md-8">
                                {!! Form::email('email', null, ['class'=>'form-control','id'=>'email']) !!}
                                <span class="text-danger"><strong id="email-error"></strong></span>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error':'' }}">
                            {!! Form::label('password', 'Password', ['class'=>'col-md-4 control-label']) !!}
                            <div class="col-md-8">
                                {!! Form::password('password', ['class'=>'form-control']) !!}
                                <span class="text-danger"><strong id="password-error"></strong></span>
                            </div>  
                        </div>

                        <div class="form-group{{ $errors->has('repassword') ? ' has-error':'' }}">
                            {!! Form::label('repassword', 'Retype Password', ['class'=>'col-md-4 control-label']) !!}
                            <div class="col-md-8">
                                {!! Form::password('password_confirmation', ['class'=>'form-control','id'=>'password-confirm','onkeyup'=>'checkRePassword()']) !!}
                                <strong id="repassword-error"></strong>
                            </div>
                        </div>
                </div>                
            </div>        
        </div>
        <div class="modal-footer">
            {{--  {!! Form::submit('Post',['class'=>'btn btn-success','id'=>'submitForm']); !!}  --}}
            <button type="button" class="btn btn-success" id="submitForm">Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
        {!! Form::close() !!}                       
    </div>
  </div>
</div>
