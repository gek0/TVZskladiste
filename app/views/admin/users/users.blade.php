@include('adminLayout.header')

<h1 class="content-header space">Lista korisnika</h1>

@if(count($users) > 0)
    <table class="table table-hover table-striped table-bordered text-center">
        <thead>
            <tr>
                <td>ID</td>
                <td>Korisničko ime</td>
                <td>Ime i prezime</td>
                <td>E-mail</td>
                <td>Grupa</td>
                <td>Opcije <i class="fa fa-cog"></i></td>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td><b>{{ $user->username }}</b></td>
                    <td>{{ $user->full_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->group->group_name }}</td>
                    <td>
                        <a href="{{ route('users-edit', $user->id) }}">
                            <button class="btn btn-success">Uredi <i class="fa fa-pencil"></i></button>
                        </a>
                        <a href="{{ route('users-delete', $user->id) }}">
                            <button class="btn btn-danger">Obriši <i class="fa fa-trash"></i></button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <h3 class="text-center">Trenutno nema korisnika.</h3>
@endif

@include('adminLayout.footer')