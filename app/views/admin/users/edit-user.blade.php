@include('adminLayout.header')

<h1 class="content-header space">Uređivanje korisnika <b>{{ $user->username }}</b></h1>

<div class="container" id="login-block">
    <div class="row text-center">
        <div class="loginMainBox">
            <div class="login-box clearfix">
                <hr>
                <div class="login-form">
                    {{ Form::open(['route' => 'users-edit-post', 'role' => 'form', 'id' => 'editUser']) }}
                    <div class="form-group">
                        {{ Form::label('full_name', 'Ime i prezime:') }}
                        {{ Form::text('full_name', $user->full_name, ['class' => 'form-control', 'placeholder' => 'Ime i prezime', 'id' => 'full_name', 'required']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('email', 'E-mail:') }}
                        {{ Form::email('email', $user->email, ['class' => 'form-control', 'placeholder' => 'E-mail', 'id' => 'email', 'required']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('username', 'Korisničko ime:') }}
                        {{ Form::text('username', $user->username, ['class' => 'form-control', 'placeholder' => 'Korisničko ime', 'id' => 'username', 'required']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('user_groups', 'Korisnička grupa:') }}<br>
                        {{ Form::select('user_groups', ['Izaberi grupu korisnika...' => $user_groups],
                                                  $user->group->id, ['class' => 'form-control'])
                        }}
                    </div>

                    <div class="space"></div>

                    <div class="form-group">
                        {{ Form::label('password', 'Nova lozinka:') }}
                        {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Nova lozinka', 'id' => 'password']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('password_again', 'Ponovite lozinku:') }}
                        {{ Form::password('password_again', ['class' => 'form-control', 'placeholder' => 'Ponovite lozinku', 'id' => 'password_again']) }}
                    </div>

                    <div class="space"></div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-padded" id="editSubmit">Izmjeni podatke <i class="fa fa-pencil"></i></button>
                    </div>
                    {{ Form::hidden('user_id', $user->id) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <div class="space"></div>

    <a href="{{ URL::previous() }}">
        <button class="btn btn-primary"><i class="fa fa-chevron-left"></i> Povratak</button>
    </a>
</div> <!-- end login container -->

@include('adminLayout.footer')