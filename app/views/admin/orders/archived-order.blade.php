@include('adminLayout.header')

<div id="fakeloader"></div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h1>Narudžba ID - {{ $order_data->id }}</h1>
    </div>
    <div class="panel-body" id="archived-order">
        <table class="table table-bordered table-striped table-hover text-center">
            <thead>
                <tr style="font-weight: bold;">
                    <td>Ime proizvoda</td>
                    <td>Kategorija</td>
                    <td>Cijena</td>
                    <td>Količina</td>
                </tr>
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
                        {{ number_format($item->item['item_price'], 0 , ',', '.') }} KN
                    </td>
                    <td>
                        {{ number_format($item->quantity, 0 , ',', '.') }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="well">
            <h4>
                Naručitelj: <b>{{ Auth::user()->full_name }}</b>
            </h4>
            <h4>
                Datum narudžbe: <b>{{ date('d.m.Y. \u H:i\h', strtotime($order_data->order_date)) }}</b>
            </h4>
            <h4>
                Ukupni trošak: <b>{{ number_format($order_data->order_price, 0 , ',', '.') }} KN</b>
            </h4>
        </div>
    </div>
</div>

<div class="text-center space">
    <a href="{{ route('order-print', $order_data->id) }}" target="_blank">
        <button class="btn btn-success btn-padded">Ispiši narudžbu <i class="fa fa-print"></i></button>
    </a>
</div>
<div>
    <a href="{{ URL::previous() }}">
        <button class="btn btn-primary"><i class="fa fa-chevron-left"></i> Povratak</button>
    </a>
</div>

@include('adminLayout.footer')