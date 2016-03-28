@include('publicLayout.header')

    <section class="section main-content img-center text-center" id="main">
        {{ HTML::image('css/assets/images/logo.png', 'Logo', ['title' => 'TVZskladište', 'class' => 'img-responsive']) }}                        
        <h1 class="section-header">Dobrodošli u TVZskladište</h1>

        <a href="{{ URL::route('login') }}">
            <button class="btn btn-primary btn-padded">Prijava</button>
        </a>
        <a href="{{ URL::route('register') }}">
            <button class="btn btn-primary btn-padded">Registracija</button>
        </a>
    </section> <!-- end main-content -->

@include('publicLayout.footer')