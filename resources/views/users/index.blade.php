@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li><a href="{{ url('/home') }}">Dashboard</a></li>
                    <li class="active">User</li>
                </ul>
                <div class="panel panel-default">
                    <div class="panel-heading" style="height:55px">
                        <span class="panel-title pull-left" style="font-size:22px">User</span>
                        {{--  <button data-toggle="modal" data-target="#UserFormModal" class="btn btn-primary pull-right">Add New</button>  --}}
                        <button id="btnAddUser" class="btn btn-primary pull-right" onclick="showFormAdd()">Add New</button>
                    </div>
                    <div class="panel-body">
                        <div class="col-sm-12" style="margin-bottom:15px;padding:0px">
                            {!! Form::label('show','Show : ',array('class'=>'col-sm-1 text-right')) !!}
                            {!! Form::select('show', array('5'=>'5','10'=>'10','20'=>'20','50'=>'50'),'5',array('class'=>'col-sm-1')) !!}
                            <div class="col-sm-8">&nbsp;</div>
                            {!! Form::text('search_key', '', array('class'=>'col-sm-2','id'=>'search_key', 'onkeyup'=>'ajaxSearch()','placeholder'=>'Search Keyword')) !!}
                        </div>
                        @include('users.tables')               
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{--  include modal form  --}}
@include('users.form')
@section('embedJS')
    <script>
        function clearErrorStatus(){
            $('#name-error').html("");
            $('#email-error').html("");
            $('#password-error').html("");
            $('#repassword-error').html("");
        }
        function ajaxSearch(){
            var keyword = $('#search_key').val();
            $.ajax({
                type: "GET",
                url: "{{route('admin-user')}}",
                data: {keyword:keyword},
                success: function(result){
                    $('#ajax-tables').html(result);
                }
            });
        }
        function checkRePassword(){
            var password = $('#password').val();
            var rePassword = $('#password-confirm').val();
            $('#repassword-error') .removeClass();
            if(password!=rePassword){
                $('#repassword-error').addClass('text-danger');
                $('#repassword-error').html("Password not match.");
                return false;
            }else{
                $('#repassword-error').addClass('text-success');
                $('#repassword-error').html("Password match.");
                return true;
            }
        }

        $('body').on('click','.add-user',function(){
            if(checkRePassword()){
                var data = new FormData($("#usersForm")[0]);
                $.ajax({
                    url:"{{ route('users.store') }}",
                    type:'POST',
                    data:data,
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data);
                        if(data.errors){
                            if(data.errors.name){ $('#name-error').html(data.errors.name[0]); }
                            if(data.errors.email){ $('#email-error').html(data.errors.email[0]); }
                            if(data.errors.password){ $('#password-error').html(data.errors.password[0]); }
                        }else{
                            $('#UserFormModal').modal('hide');
                            clearErrorStatus();
                            $('#usersForm')[0].reset();
                            $('#ajax-tables').html(data);
                        }
                    }
                });
            }else{
                alert('Password not match!');
            }
        });
        function updateUserAction(id){
                
            $.ajax({
                url:"users/"+id,
                type:'PUT',
                data:{
                    'name':$('#name').val(),
                    'email':$('#email').val(),
                    'password':$('#password').val(),
                    'password_confirmation':$('#password-confirm').val()
                },
                success:function(data){
                    console.log(data);
                    if(data.errors){
                        if(data.errors.name){ $('#name-error').html(data.errors.name[0]); }
                        if(data.errors.email){ $('#email-error').html(data.errors.email[0]); }
                        if($('#password').val()!=""){
                            if(data.errors.password){ $('#password-error').html(data.errors.password[0]); }
                        }
                    }else{
                        $('#UserFormModal').modal('hide');
                        clearErrorStatus();
                        $('#usersForm')[0].reset();
                        $('#ajax-tables').html(data);
                    }
                }
            });
        }

        $('body').on('click','.edit-user',function(){
            var password = $('#password').val();
            var id = $('#user-id').val();
            if(password!=""){ //jika textbox password tidak kosong
                if(checkRePassword()){
                    updateUserAction(id);
                }else{ alert('Password not match!'); }
            }else{
                updateUserAction(id);
            }
            
        });
        
        function showFormAdd(){
            clearErrorStatus();
            $('#UserFormModal').modal('show');
            $('#submitForm').removeClass('edit-user');
            $('#submitForm').removeClass('btn-primary');
            $('#submitForm').addClass('add-user');
            $('#submitForm').addClass('btn-success');
            $('#name').val("");
            $('#email').val("");
        }
        function showFormEdit(id){  
            $.ajax({
                url:"users/"+id+"/edit",
                type:"GET",
                data:{'id':id},
                success:function(data){
                    console.log(data);
                    clearErrorStatus();
                    $('#UserFormModal').modal('show');
                    $('#submitForm').removeClass('add-user');
                    $('#submitForm').removeClass('btn-success');
                    $('#submitForm').addClass('btn-primary');
                    $('#submitForm').addClass('edit-user');
                    $('#user-id').val(data.id);
                    $('#name').val(data.name);
                    $('#email'  ).val(data.email);
                }
            });
        }
        function deleteUser(id){
            $.ajax({
                url:"users/"+id,
                type:'DELETE',
                data:{'id':id},
                success:function(data){
                    console.log(data);                    
                    $('#ajax-tables').html(data);
                }
            });
        }
    </script>
@endsection