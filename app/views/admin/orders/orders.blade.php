@include('adminLayout.header')

<h1 class="content-header space">Lista svih narudžbi korisnika ({{ number_format(count($orders_data), 0 , ',', '.') }})</h1>

@if(count($orders_data) > 0)
    <div class="well list-group">
        @foreach($orders_data as $archive)
            <a href="{{ route('order-admin-view', $archive->id) }}" class="list-group-item">
                <span class="pull-right label label-primary btn-padded-smaller">
                    {{ number_format($archive->order_price, 0 , ',', '.') }} KN
                </span>

                <b>Narudžba ID - {{ $archive->id }}</b> ({{ date('d.m.Y. \u H:i\h', strtotime($archive->order_date)) }}) --- {{ $archive->user_full_name }}
            </a>
        @endforeach
    </div>
@else
    <h3 class="text-center">Trenutno nema narudžbi u arhivi.</h3>
@endif

@include('adminLayout.footer')