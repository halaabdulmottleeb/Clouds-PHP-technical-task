@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Users</div>

                    <div class="card-body">
                        <form action="{{ route('users.search') }}" method="get" class="mb-4">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search by Name or Email">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </form>
                        
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                                            @if($user->is_active == 0)
                                                <form action="{{ route('users.update', $user->id) }}" method="post">
                                                    @csrf
                                                    @method('put')                                                
                                                    <input type="hidden" name="action" value="reactivate">
                                                    <button type="submit" class="btn btn-success">Reactivate</button>
                                                </form>
                                            @else
                                                <form action="{{ route('users.update', $user->id) }}" method="post">
                                                    @csrf
                                                    @method('put')                                                                                        
                                                    <input type="hidden" name="action" value="deactivate">
                                                    <button type="submit" class="btn btn-warning">Deactivate</button>
                                                </form>
                                            @endif
                                            <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                                @csrf
                                                @method('delete')                                                                                        
                                                <button type="submit" class="btn btn-warning">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
