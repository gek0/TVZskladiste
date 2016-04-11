@include('adminLayout.header')

<div id="fakeloader"></div>

<h1 class="content-header space">Stanje sustava</h1>

<div class="content_narrow">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Informacije o stanju sustava</h3>
        </div>
        <div class="panel-body" id="status-content">
            <ul class="list-group">
                <li class="list-group-item">
                    <span class="pull-right label label-primary btn-padded-smaller">{{ number_format($all_users, 0 , ',', '.') }}</span>
                    Ukupan broj korisnika registiranih u sustavu
                </li>
                <li class="list-group-item">
                    <span class="pull-right label label-primary btn-padded-smaller">{{ number_format($regular_users, 0 , ',', '.') }}</span>
                    Broj običnih korisnika
                </li>
                <li class="list-group-item">
                    <span class="pull-right label label-primary btn-padded-smaller">{{ number_format($categories, 0 , ',', '.') }}</span>
                    Broj kategorija proizvoda
                </li>
                <li class="list-group-item">
                    <span class="pull-right label label-primary btn-padded-smaller">{{ number_format($unique_items, 0 , ',', '.') }}</span>
                    Broj jedinstvenih proizvoda
                </li>
                <li class="list-group-item">
                    <span class="pull-right label label-primary btn-padded-smaller">{{ number_format($total_num_of_items, 0 , ',', '.') }}</span>
                    Ukupan broj svih proizvoda
                </li>
                <li class="list-group-item">
                    <span class="pull-right label label-primary btn-padded-smaller">{{ number_format($orders_count, 0 , ',', '.') }}</span>
                    Broj narudžbi zaprimljeno
                </li>
                <li class="list-group-item">
                    <span class="pull-right label label-primary btn-padded-smaller">{{ number_format($orders_price, 0 , ',', '.') }} KN</span>
                    Ukupan prihod od zaprimljenih narudžbi
                </li>
                <li class="list-group-item">
                    <span class="pull-right label label-primary btn-padded-smaller">{{ number_format($unique_items_cart, 0 , ',', '.') }}</span>
                    Broj jedinstvenih proizvoda prodano
                </li>
                <li class="list-group-item">
                    <span class="pull-right label label-primary btn-padded-smaller">{{ number_format($total_num_of_items_cart, 0 , ',', '.') }}</span>
                    Ukupan broj proizvoda prodano
                </li>
            </ul>
        </div>
    </div>
</div>

@include('adminLayout.footer')