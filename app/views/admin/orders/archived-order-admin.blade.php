@include('adminLayout.header')

<div id="fakeloader"></div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h1>Narudžba ID - {{ $data['order_data']['id'] }}</h1>
    </div>
    <div class="panel-body" id="archived-order">
        <table class="table table-bordered table-striped table-hover text-center">
            <thead>
            <tr style="font-weight: bold;">
                <td>Ime proizvoda</td>
                <td>Kategorija</td>
                <td>Cijena</td>
                <td>Količina</td>
                <td>Opcije <i class="fa fa-cog"></i></td>
            </tr>
            </thead>
            <tbody>
            @foreach($data['items_data'] as $item)
                <tr>
                    <td class="text-left">
                        {{ $item['item_name'] }}
                    </td>
                    <td>
                        {{ $item['category_name'] }}
                    </td>
                    <td>
                        {{ number_format($item['item_price'], 0 , ',', '.') }} KN
                    </td>
                    <td>
                        {{ $item['item_quantity'] }}
                    </td>
                    <td>
                        <a href="{{ route('cart-item-delete-admin', $item['item_cart_id']) }}">
                            <button class="btn btn-danger" id="show-edit">Obriši <i class="fa fa-trash"></i></button>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="well">
            <h4>
                Naručitelj: <b>{{ $data['order_data']['user_full_name'] }}</b>
            </h4>
            <h4>
                Datum narudžbe: <b>{{ date('d.m.Y. \u H:i\h', strtotime($data['order_data']['order_date'])) }}</b>
            </h4>
            <h4>
                Ukupni trošak: <b>{{ number_format($data['order_data']['order_price'], 0 , ',', '.') }} KN</b>
            </h4>
        </div>
    </div>
</div>

<div class="text-center space">
    <a href="{{ route('order-delete', $data['order_data']['id']) }}">
        <button class="btn btn-danger btn-padded">Obriši narudžbu <i class="fa fa-trash"></i></button>
    </a>
</div>
<div>
    <a href="{{ route('orders') }}">
        <button class="btn btn-primary"><i class="fa fa-chevron-left"></i> Povratak</button>
    </a>
</div>

@include('adminLayout.footer')