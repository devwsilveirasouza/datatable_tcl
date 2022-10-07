@extends('users.layout')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <h2>Laravel 8 CRUD Example</h2>
        </div>
        <div class="pull-right">
            <a href="{{ route('users.create') }}" class="btn btn-success">Salve</a>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th width="280px;">Action</th>
        </tr>

        @foreach ($users as $user)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <form action="{{ route('users.destroy', $user->id ) }}" method="POST">

                        <a href="{{ route('users.show', $user->id ) }}" class="btn btn-info">Show</a>

                        <a href="{{ route('users.edit', $user->id ) }}" class="btn btn-primary">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>

                </td>
            </tr>
        @endforeach

    </table>

    {{ $users->links() }}

@endsection
