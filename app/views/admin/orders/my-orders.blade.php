@include('adminLayout.header')

<h1 class="content-header space">Moje narudžbe</h1>


<h2 class="content-header space">Arhiva narudžbi</h2>
@if(count($archived_orders) > 0)
    <div class="well list-group">
        @foreach($archived_orders as $archive)
            <a href="{{ route('order-view', $archive->id) }}" class="list-group-item">
                <span class="badge">{{ $archive->order_price }} KN</span>
                <b>Narudžba ID - {{ $archive->id }}</b> ({{ date('d.m.Y. \u H:i\h', strtotime($archive->order_date)) }})
            </a>
        @endforeach
    </div>
@else
    <h3 class="text-center">Trenutno nema narudžbi u arhivi.</h3>
@endif

<h2 class="content-header space">Aktivna narudžba</h2>

@if(count($items_data) > 0)
    <table class="table table-bordered table-striped table-hover text-center">
        <thead>
        <tr style="font-weight: bold;">
            <td>Ime proizvoda</td>
            <td>Kategorija</td>
            <td>Cijena</td>
            <td>Količina</td>
            @if(Auth::user()->group->id >= 2)
                <td>Opcije <i class="fa fa-cog"></i></td>
            @endif
        </thead>
        <tbody>
        @foreach($items_data as $item)
            <tr>
                <td class="text-left">
                    {{ $item->item['item_name'] }}
                </td>
                <td>
                    {{ $item->item['category']['category_name'] }}
                </td>
                <td>
                    {{ $item->item['item_price'] }} KN
                </td>
                <td>
                    {{ $item->quantity }}
                </td>
                <td>
                    <a href="{{ route('cart-item-delete', $item->id) }}">
                        <button class="btn btn-danger" id="show-edit">Obriši <i class="fa fa-trash"></i></button>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="well text-center">
        <h4>
            Ukupni trošak: <b>{{ $order_total_price }} KN</b>
        </h4>

        {{ Form::open(['route' => 'cart-accept-post', 'role' => 'form', 'id' => 'addToOrder']) }}
            <div class="form-group">
                {{ Form::hidden('order_price', $order_total_price) }}
                {{ Form::hidden('order_id', $last_order_id) }}
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-padded">Potvrdi narudžbu <i class="fa fa-check"></i></button>
            </div>
        {{ Form::close() }}
    </div>
@else
    <h3 class="text-center">Trenutno nema proizvoda u košarici.</h3>
@endif

@include('adminLayout.footer')