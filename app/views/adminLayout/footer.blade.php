    </section> <!-- end content section -->

    <footer>
        <b>TVZSkladište</b> &copy; {{ date('Y') }} - <i>Denis Fodor, Matija Buriša</i>
    </footer>

    @include('admin.notification')

            <!-- scripts -->
    {{ HTML::script('js/main.js', ['charset' => 'utf-8']) }}
</body>
</html>