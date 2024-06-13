<html>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>SEBLAK BUNDA</title>
        {{-- <link rel="shortcut icon" href="{{ $app_logo }}" type="image/x-icon"> --}}
        <!-- General CSS Files -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

        <!-- CSS Libraries -->

        <!-- Template CSS -->
        {{-- <link rel="stylesheet" href="{{ asset('stisla') }}/modules/owlcarousel2/owl.carousel.min.css"> --}}
        {{-- <link rel="stylesheet" href="{{ asset('stisla') }}/modules/owlcarousel2/owl.theme.default.min.css"> --}}
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
        {{-- <link rel="stylesheet" href="{{ asset('stisla') }}/css/style.css"> --}}
        {{-- <link rel="stylesheet" href="{{ asset('stisla') }}/css/components.css"> --}}
        <link rel="stylesheet" type="text/css" href="{{ asset('datatables') }}/datatables.min.css"/>
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
        @stack('css')
    </head>
    <body>
        <div class="container-fluid mt-2">
            @yield('content')
        </div>

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script type="text/javascript" src="{{ asset('datatables') }}/datatables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
  <script src="/vendor/datatables/buttons.server-side.js"></script>
  {{-- <script src="{{ asset('stisla') }}/js/stisla.js"></script> --}}

  <!-- JS Libraies -->

  <!-- Template JS File -->
  {{-- <script src="{{ asset('stisla') }}/modules/owlcarousel2/owl.carousel.min.js"></script>
  <script src="{{ asset('stisla') }}/modules/summernote/summernote-bs4.js"></script>
  <script src="{{ asset('stisla') }}/js/scripts.js"></script>
  <script src="{{ asset('stisla') }}/js/custom.js"></script> --}}
  {{-- <script src="{{ asset('stisla') }}/js/page/modules-datatables.js"></script> --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


  <script>
    $(() => {
      $("#table-1").dataTable({
        responsive : true
      });
    })

    function hapus(url){
      swal({
        title: "{{ __('message.dialog_title') }}",
        text: "{{ __('message.dialog_delete') }}",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location.href = url;
        }
      });
    }

    $('.btn-delete').click(function(e) {
      e.preventDefault();
      var url = $(this).attr('href');
      swal({
        title: "{{ __('message.dialog_title') }}",
        text: "{{ __('message.dialog_delete') }}",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location.href = url;
        }
      });
    });
  </script>
  @stack('js')
    </body>
</html>
