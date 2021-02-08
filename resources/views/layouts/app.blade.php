
@section('footerjs')
    <!-- ALL JS FILES -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="{{ asset('assets') }}/js/popper.min.js"></script>
    <script src="{{ asset('assets') }}/js/bootstrap.min.js"></script>
    <!-- ALL PLUGINS -->
    <script src="{{ asset('assets') }}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('assets') }}/js/jquery.pogo-slider.min.js"></script>
    <script src="{{ asset('assets') }}/js/slider-index.js"></script>
    <script src="{{ asset('assets') }}/js/smoothscroll.js"></script>
    <script src="{{ asset('assets') }}/js/form-validator.min.js"></script>
    <script src="{{ asset('assets') }}/js/contact-form-script.js"></script>
    <script src="{{ asset('assets') }}/js/isotope.min.js"></script>
    <script src="{{ asset('assets') }}/js/images-loded.min.js"></script>
    <script src="{{ asset('assets') }}/js/custom.js"></script>
    /* counter js */
@endsection

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

        @stack('modals')

        @livewireScripts
