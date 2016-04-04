@include('adminLayout.header')

<h1 class="content-header space">Lista kategorija</h1>

<div class="well text-center">
    <button class="btn btn-primary btn-padded" id="show-add">Nova kategorija</button>

    <div id="add-category" class="none space">
        <div class="container-fluid">
            <div class="row text-center">
                {{ Form::open(['route' => 'category-add-post', 'role' => 'form', 'id' => 'addCategory']) }}
                    <div class="form-group">
                        {{ Form::label('category_name', 'Ime kategorije:') }}
                        {{ Form::text('category_name', null, ['class' => 'form-control', 'placeholder' => 'Ime kategorije', 'id' => 'category_name', 'required']) }}
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Dodaj kategoriju <i class="fa fa-plus"></i></button>
                    </div>
                 {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

@if(count($categories_data) > 0)
    <div class="space text-center">
        <span class="label label-danger">NAPOMENA</span><br>
        <p><b>Brisanjem kategorije se brišu svi proizvodi u istoj!</b></p>
    </div>

    <table class="table table-bordered table-striped table-hover text-center">
        <thead>
        <tr>
            <td>Ime kategorije</td>
            <td>Opcije <i class="fa fa-cog"></i></td>
        </tr>
        </thead>
        <tbody>
        @foreach($categories_data as $cat)
            <tr>
                <td>
                    {{ $cat['category_name'] }}
                </td>
                <td>
                    <a href="{{ route('category-edit', $cat->id) }}">
                        <button class="btn btn-success" id="show-edit">Uredi <i class="fa fa-pencil"></i></button>
                    </a>
                    <a href="{{ route('category-delete', $cat->id) }}">
                        <button class="btn btn-danger" id="show-edit">Obriši <i class="fa fa-trash"></i></button>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <h3 class="text-center">Trenutno nema kategorija.</h3>
@endif

@include('adminLayout.footer')