    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('interior/assets/vendor/libs/masonry/masonry.js') }}"></script>
    <script src="{{ asset('interior/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('interior/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('interior/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('interior/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('interior/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->
    <!-- Vendors JS -->
    <script src="{{ asset('interior/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('interior/assets/js/main.js') }}"></script>
    <script src="{{ asset('interior\assets\vendor\js\menu.js') }}"></script>
    <!-- Page JS -->
    <script src="{{ asset('interior/assets/js/dashboards-analytics.js') }}"></script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session()->has('success'))
      <script>
        swal({
              title: "Thành công",
              text: "{{session()->get('success')}}",
              icon: "success",
              button: "OK",
              timer: 2000,
            });
      </script>
    @endif
    @if (session()->has('error'))
      <script>
        swal({
              title: "Không thành công",
              text: "{{session()->get('error')}}",
              icon: "error",
              button: "OK",
              timer: 2000,
            });
      </script>
    @endif
    @if (session()->has('warning'))
      <script>
        swal({
              title: "Opps !!",
              text: "{{session()->get('warning')}}",
              icon: "warning",
              button: "OK",
              timer: 2000,
            });
      </script>
    @endif