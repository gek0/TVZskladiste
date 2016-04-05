@include('adminLayout.header')

<h1 class="content-header space">Uređivanje proizvoda<br>
    <span class="small"><b>{{ $item->item_name }}</b></span></h1>

<div class="container-fluid">
    <div class="row text-center">
        {{ Form::open(['route' => 'items-edit-post', 'role' => 'form', 'id' => 'editItem']) }}
        <div class="form-group col-md-10">
            {{ Form::label('item_name', 'Ime proizvoda:') }}
            {{ Form::text('item_name', $item->item_name, ['class' => 'form-control', 'placeholder' => 'Ime proizvoda', 'id' => 'item_name', 'required']) }}
        </div>
        <div class="form-group col-md-2">
            {{ Form::label('item_price', 'Cijena proizvoda:') }}
            {{ Form::text('item_price', $item->item_price, ['class' => 'form-control', 'placeholder' => 'Cijena proizvoda', 'id' => 'item_price', 'required']) }}
        </div>
        <div class="form-group col-md-4">
            {{ Form::label('item_availability', 'Dostupnost proizvoda:') }}<br>
            {{ Form::radio('item_availability', '1', $item->item_availability == 1? true : false, ['id'=> 'item_availability']) }} Dostupan
            <br>
            {{ Form::radio('item_availability', '0', $item->item_availability == 0? true : false, ['id'=> 'item_availability']) }} Nedostupan
        </div>
        <div class="form-group col-md-4">
            {{ Form::label('item_quantity', 'Dostupna količina:') }}
            {{ Form::text('item_quantity', $item->item_quantity, ['class' => 'form-control', 'placeholder' => 'Dostupna količina', 'id' => 'item_quantity', 'required']) }}
        </div>
        <div class="form-group col-md-4">
            {{ Form::label('category_id', 'Kategorija proizvoda:') }}<br>
            {{ Form::select('category_id', ['Izaberi kategoriju proizvoda...' => $item_categories],
                                      $item->category_id, ['class' => 'form-control'])
            }}
        </div>

        <div class="form-group col-md-12">
            <button type="submit" class="btn btn-success">Uredi proizvod <i class="fa fa-pencil"></i></button>
        </div>
        {{ Form::hidden('item_id', $item->id) }}
        {{ Form::close() }}
    </div>
</div>

@include('adminLayout.footer')