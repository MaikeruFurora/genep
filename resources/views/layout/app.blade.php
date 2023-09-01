<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bootstrap v4.6</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/starter-template/">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

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
        <li class="nav-item">
          <a class="nav-link">Generate</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">Settings</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
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
    <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    @yield('moreJS')
      
  </body>
</html>
