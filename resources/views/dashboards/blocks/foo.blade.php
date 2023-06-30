    {{-- fake  load--}}
    <script src="{{ asset('interior/fakeloader/jquery-3.3.1.min.js') }}" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>
    <script src="{{ asset('interior/fakeloader/dist/fakeloader.min.js') }}"></script>
    <script>

            $(document).ready(
                function() {
                    window.FakeLoader.init( { auto_hide: true } );
                }
            );

    </script>