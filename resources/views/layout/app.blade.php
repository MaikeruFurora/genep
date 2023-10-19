<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="prinVoucher" content="{{ route("authenticated.voucher.print",":cv") }}">
    <meta name="printCheque" content="{{ route("authenticated.cheque.print",":cv") }}">
    <title>Bootstrap v4.6</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/starter-template/">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/alertify/css/alertify.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/fontawesome/css/fontawesome-all.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.css">

    <link href="{{ asset('assets/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/datatables/searchBuilder.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/datatables/dataTables.dateTime.min.css') }}" rel="stylesheet" type="text/css" />

    {{-- select --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    @yield('moreCSS')

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .dropdown-item{
        font-size: 13px
      }

      .adjust tr td{
          padding: 7px !important;
          margin: 0 !important;
          vertical-align: middle;
      }

      .select2-container--default .select2-selection--single,
        .select2-selection .select2-selection--single {
            border: 1px solid #d2d6de;
            border-radius: 0;
            padding: 6px 12px;
            height: 34px
        }

        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #aaa;
            border-radius: 4px
        }

        .select2-container .select2-selection--single {
            box-sizing: border-box;
            cursor: pointer;
            display: block;
            height: 28px;
            user-select: none;
            -webkit-user-select: none
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            padding-right: 10px
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            padding-left: 0;
            padding-right: 0;
            height: auto;
            margin-top: -3px
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #444;
            line-height: 28px
        }

        .select2-container--default .select2-selection--single,
        .select2-selection .select2-selection--single {
            border: 1px solid #d2d6de;
            border-radius: 0 !important;
            padding: 6px 12px;
            height: 40px !important
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 26px;
            position: absolute;
            top: 6px !important;
            right: 1px;
            width: 20px
        }
        .select2-results__options{
          font-size:11px !important;
        }
        
    </style>

    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/css/starter-template.css') }}" rel="stylesheet">
  </head>
  <body>
    
  <nav class="navbar navbar-expand-md p-1 navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">&nbsp;</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault" style="font-size: 13px">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="{{ route('authenticated.home') }}">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('authenticated.bp_master') }}">BPMD</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">Settings</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('authenticated.chartAccount') }}">Chart of Accounts</a>
            <a class="dropdown-item" href="{{ route('authenticated.company') }}">Company</a>
            <a class="dropdown-item" href="#">Generate</a>
            <a class="dropdown-item text-danger" style="cursor:pointer"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="dripicons-exit"></i>Sign Out</a>
            <form id="logout-form" action="{{ route('authenticated.signout') }}" method="POST" class="d-none">@csrf</form>
          </div>
        </li>
      </ul>
      {{-- <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
      </form> --}}
    </div>
  </nav>

    <main role="main" class="container-fluid">
      @yield('content')
    </main><!-- /.container -->

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.js') }}"></script>
    <script src="{{ asset('assets/global.js') }}"></script>
    <script src="{{ asset('assets/alertify/js/alertify.js') }}"></script>
    
    
    <script src="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>
    <!-- Required datatable js -->
    <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('assets/datatables/jszip.min.js') }} "></script>
    <script src="{{ asset('assets/datatables/pdfmake.min.js') }} "></script>
    <script src="{{ asset('assets/datatables/vfs_fonts.js') }} "></script>
    <script src="{{ asset('assets/datatables/buttons.html5.min.js') }} "></script>
    <script src="{{ asset('assets/datatables/buttons.print.min.js') }} "></script>
    <script src="{{ asset('assets/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/dataTables.searchBuilder.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/dataTables.dateTime.min.js') }}"></script>
    {{-- select --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    @yield('moreJS')
      
  </body>
</html>
