<div id="ajax-tables" >
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>

        @if($users->count()==0)
            <tr>
                <td colspan="4" class="text-center">Tidak ada data ditemukan.</td>
            </tr>
        @else
            @foreach($users as $temp)
                <tr>
                    <td>{{ $temp->id }}</td>
                    <td>{{ $temp->name }}</td>
                    <td>{{ $temp->email }}</td>
                    <td class="text-center">
                        <button class="btn btn-default" onclick="showFormEdit({{$temp->id}})">Edit</button>
                        <button class="btn btn-danger" onclick="deleteUser({{$temp->id}})">Delete</button>
                        
                        {{--  {!! Form::open([
                            'url' => route('users.destroy',$temp->id),
                            'method' => 'delete',
                            'class' => 'form-inline js-confirm',
                            'data-confirm' => 'Yakin akan menghapus '.$temp->name

                        ]) !!}
                            <a href="{{ route('users.edit',$temp->id) }}" class="btn btn-default">Update</a>
                            {!! Form::submit('Hapus', ['class'=>'btn btn-danger']) !!}
                        {!! Form::close() !!}  --}}
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>    
    <div class="col-md-2 col-md-offset-5" id="paginate">
        {{--  {{ $users->links() }}  --}}
    </div>
</div>
