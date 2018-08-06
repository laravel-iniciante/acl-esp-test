
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

    <style>
      .hidden{
        display: none;
      }
      table .thead-light th {
          color: #495057;
          background-color: #f5f5f5 !important;
          border-bottom-color: #007bff !important;
          border-top-width: 0;
          border-bottom-width: 1px;
      }

    </style>

  </head>

  <body>

        <nav class="navbar sticky-top navbar-expand-md navbar-light navbar-laravel">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>

        </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">


          <div class="sidebar-sticky">
            <ul class="nav flex-column">

              <li class="nav-item">
                <a class="nav-link active" href="{{route('dashboard')}}">
                  <span data-feather="home"></span>
                  Início <span class="sr-only">(current)</span>
                </a>
              </li>

              @can('view_post')
              <li class="nav-item">
                <a class="nav-link" href="{{route('post.index')}}">
                  <span data-feather="file"></span>
                  Publicações
                </a>
              </li>
              @endcan

              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="shopping-cart"></span>
                  Products
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{route('user.index')}}">
                  <span data-feather="users"></span>
                  Usuários
                </a>
              </li>


            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Segurança</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>

            <ul class="nav flex-column">

              <li class="nav-item">
                <a class="nav-link" href="{{route('role.index')}}">
                  <span data-feather="shield"></span>
                  Papeis
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('permission.index')}}">
                  <span data-feather="shield"></span>
                  Permissões
                </a>
              </li>
              
            </ul>

          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10  px-4">
          @if (trim($__env->yieldContent('breadcrumbs')))
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent">
              @yield('breadcrumbs')
            </ol>
          </nav>
          @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
          
            
            @yield('content')
        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<!--     <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script> -->

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

    <script type="text/javascript">

        function init(){
            $("#js-check-all").change(checkAll);
            $(document).on('click','.js-delete-button', deleteItem);
            $(document).on('click','.js-btn-toggle-filter', toggleFilter);
            $('.js-send-form-delete').on('click',deleteVarious)
        }

        function checkAll(){
            $("input:checkbox").prop('checked', $(this).prop("checked"));
        }

        function getAllCheckBoxDelete(){
            var checkbox = [];
            $(".js-delete-checkbox:checked").each(function(){
                checkbox.push($(this).val());
            });

            return checkbox;
        }

        function groupCheckboxId(){
            var checkbox = getAllCheckBoxDelete();
            return checkbox = checkbox.join('-');
        }
        
        function deleteItem(e){
            e.preventDefault();
            var url = $(this).attr('href');
            sendForm(url)
        }

        function deleteVarious(e){
            e.preventDefault();

            var stringIds = groupCheckboxId();

            if( stringIds == '' ){
                return false;
            }

            var actionUrl = $('.js-form-delete').attr('action');

            actionUrl += '/' + stringIds;
            sendForm(actionUrl)
        }

        function sendForm(url){
            console.log(url)
            $('.js-form-delete').attr('action', url).submit();
        }


        function toggleFilter(){

          $('.js-btn-toggle-filter').toggleClass('btn-outline-primary');
          $('.js-btn-toggle-filter').toggleClass('btn-primary');

          $('.js-box-filter').slideToggle();

        }


        $(document).ready(init);

    </script>


  </body>
</html>
