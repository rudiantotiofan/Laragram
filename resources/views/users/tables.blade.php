<div id="ajax-tables" >
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>

        @if($users->count()==0)
            <tr>
                <td colspan="5" class="text-center">Data not found.</td>
            </tr>
        @else
            @foreach($users as $temp)
                <tr>
                    <td>{{ $temp->id }}</td>
                    <td>{{ $temp->name }}</td>
                    <td>{{ $temp->email }}</td>
                    @foreach($temp->roles as $role)
                    <td>{{ $role->display_name }}</td>
                    @endforeach
                    <td class="text-center">
                        <button class="btn btn-default" onclick="showFormEdit({{$temp->id}})">Edit</button>
                        <button class="btn btn-danger" onclick="deleteUser({{$temp->id}})">Delete</button>        
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
