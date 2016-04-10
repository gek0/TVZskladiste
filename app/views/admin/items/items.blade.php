@include('adminLayout.header')

<h1 class="content-header space">Lista proizvoda</h1>

@if(Auth::user()->group->id >= 2)
    <div class="well text-center">
        <button class="btn btn-primary btn-padded" id="show-add">Novi proizvod</button>

        <div id="add-content" class="none space">
            <div class="container-fluid">
                <div class="row text-center">
                    {{ Form::open(['route' => 'items-add-post', 'role' => 'form', 'id' => 'addItem']) }}
                    <div class="form-group col-md-10">
                        {{ Form::label('item_name', 'Ime proizvoda:') }}
                        {{ Form::text('item_name', null, ['class' => 'form-control', 'placeholder' => 'Ime proizvoda', 'id' => 'item_name', 'required']) }}
                    </div>
                    <div class="form-group col-md-2">
                        {{ Form::label('item_price', 'Cijena proizvoda:') }}
                        {{ Form::text('item_price', null, ['class' => 'form-control', 'placeholder' => 'Cijena proizvoda', 'id' => 'item_price', 'required']) }}
                    </div>
                    <div class="form-group col-md-4">
                        {{ Form::label('item_availability', 'Dostupnost proizvoda:') }}<br>
                        {{ Form::radio('item_availability', '1', true, ['id'=> 'item_availability']) }} Dostupan
                        <br>
                        {{ Form::radio('item_availability', '0', false, ['id'=> 'item_availability']) }} Nedostupan
                    </div>
                    <div class="form-group col-md-4">
                        {{ Form::label('item_quantity', 'Dostupna količina:') }}
                        {{ Form::text('item_quantity', null, ['class' => 'form-control', 'placeholder' => 'Dostupna količina', 'id' => 'item_quantity', 'required']) }}
                    </div>
                    <div class="form-group col-md-4">
                        {{ Form::label('category_id', 'Kategorija proizvoda:') }}<br>
                        {{ Form::select('category_id', ['Izaberi kategoriju proizvoda...' => $item_categories],
                                                  null, ['class' => 'form-control'])
                        }}
                    </div>

                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-success">Dodaj proizvod <i class="fa fa-plus"></i></button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endif

@if(count($items_data->all()) > 0)
    <table class="table table-bordered table-striped table-hover text-center">
        <thead>
        <tr style="font-weight: bold;">
            <td>Ime proizvoda</td>
            <td>Kategorija</td>
            <td>Cijena</td>
            <td>Dostupno količina</td>
            <td>Status</td>
            @if(Auth::user()->group->id >= 2)
                <td>Opcije <i class="fa fa-cog"></i></td>
            @endif
            <td>Košarica <i class="fa fa-shopping-cart"></i></td>
        </thead>
        <tbody>
        @foreach($items_data as $item)
            <tr>
                <td>
                    {{ $item->item_name }}
                </td>
                <td>
                    {{ $item->category->category_name }}
                </td>
                <td>
                    {{ number_format($item->item_price, 0 , ',', '.') }} KN
                </td>
                <td>
                    {{ number_format($item->item_quantity, 0 , ',', '.') }}
                </td>
                <td>
                    @if($item->item_availability == 1)
                        <span class="label label-success">Dostupan</span>
                    @else
                        <span class="label label-danger">Nedostupan</span>
                    @endif
                </td>
                @if(Auth::user()->group->id >= 2)
                    <td>
                        <a href="{{ route('items-edit', $item->id) }}">
                            <button class="btn btn-success" id="show-edit">Uredi <i class="fa fa-pencil"></i></button>
                        </a>
                        <a href="{{ route('items-delete', $item->id) }}">
                            <button class="btn btn-danger" id="show-edit">Obriši <i class="fa fa-trash"></i></button>
                        </a>
                    </td>
                @endif
                <td style="width: 8%;">
                    @if($item->item_availability == 1)
                        {{ Form::open(['url' => route('cart-add', $item->id), 'method' => 'get', 'role' => 'form', 'id' => 'addToOrder']) }}
                            <div class="form-group">
                                {{ Form::number('quantity', 1, ['class' => 'form-control', 'placeholder' => 'Količina', 'id' => 'quantity', 'required']) }}
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info"><i class="fa fa-check"></i></button>
                            </div>
                        {{ Form::close() }}
                    @else
                        <button class="btn btn-disabled" disabled><i class="fa fa-minus"></i></button>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="pagination-layout pagination-centered">
        {{ $items_data->appends(Request::except('stranica'))->links() }}
    </div> <!-- end pagination -->
@else
    <h3 class="text-center">Trenutno nema proizvoda.</h3>
@endif

@include('adminLayout.footer')