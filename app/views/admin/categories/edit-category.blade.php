@include('adminLayout.header')

<h1 class="content-header space">Uređivanje kategorije <b>{{ $category->category_name }}</b></h1>

<div class="container" id="login-block">
    <div class="row text-center">
        <div class="loginMainBox">
            <div class="login-box clearfix">
                <hr>
                <div class="login-form">
                    {{ Form::open(['route' => 'category-edit-post', 'role' => 'form', 'id' => 'editCategory']) }}
                    <div class="form-group">
                        {{ Form::label('category_name', 'Ime kategorije:') }}
                        {{ Form::text('category_name', $category->category_name, ['class' => 'form-control', 'placeholder' => 'Ime kategorije', 'id' => 'category_name', 'required']) }}
                    </div>

                    <div class="space"></div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-padded" id="editSubmit">Izmjeni podatke <i class="fa fa-pencil"></i></button>
                    </div>
                    {{ Form::hidden('category_id', $category->id) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <div class="space"></div>

    <a href="{{ URL::previous() }}">
        <button class="btn btn-primary"><i class="fa fa-chevron-left"></i> Povratak</button>
    </a>
</div>

@include('adminLayout.footer')