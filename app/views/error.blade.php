@include('publicLayout.header')

<section class="section main-content img-center text-center" id="main">
    <h1 class="section-header">Greška</h1>

    <section class="section section-inner">
        <div class="text-center space">
            <h3>{{{ $exception }}}</h3>

            <div class="space"></div>
            <a href="{{ URL::previous() }}"><button class="btn btn-primary "><i class="fa fa-chevron-left"></i> Povratak na prethodnu stranicu</button></a>
        </div>
    </section> <!-- end section-inner -->

</section> <!-- end #main -->

@include('publicLayout.footer')