<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{asset('img/exercito-logo.png')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{  $title ?? 'Escala de Permanência' }}</title>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/material-dashboard.min.css?v=2.1.2')}}">
    <style>
      .card-header-primary {
          background: #13560A !important;
      }

      .btn-primary {
          background-color: #274426 !important;
      }

      .sidebar, .sidebar-wrapper {
        width: 285px;
      }

      .nav {
        width: 280px;
      }

      .sidebar[data-color=purple] li.active>a {
        background-color: #13560A;
        box-shadow: 0 4px 20px 0 rgb(0 0 0 / 14%), 0 7px 10px -5px rgb(18 123 68 / 40%);
      }

      .dropdown-menu.inner  li a.dropdown-item:hover {
        background-color: #13560A !important;
      }

    </style>
    @yield('css')
</head>
<body>
  <div class="wrapper main-nav" id="main-nav">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
      <a href="javascript:void(0)" style="color: black;" id="change-sidebar">
        <i class="material-icons">push_pin</i>
      </a>
      <div class="logo text-center" style="z-index: -1;">
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
          <img src="{{asset('img/exercito-logo.png')}}" with="100px" height="100px"/>
        </a>

        <small class="text-dark">{{ Auth::user()->name }}</small><br>
        <a class="btn btn-sm" href="{{ route('logout') }}" title="Sair"
              onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
              <i class="material-icons">logout</i>
        </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
      </div>
      <div class="sidebar-wrapper" >
        <ul class="nav  overflow-auto vh-100">
          <li class="nav-item">
            <a class="nav-link" href="{{url('/escala')}}">
              <i class="material-icons">today</i>
              <p>Escala</p>
            </a>
          </li>
          <li class="nav-item">
                            
              @if (auth()->check())
                  @if(!auth()->user()->isAdmin)
                      <a class="nav-link" href="{{route('update-militar',['id'=> auth()->user()->id])}}">
                          <i class="material-icons">edit</i>
                          <p>Militar</p>
                      </a>
                  @else
                    <a class="nav-link" href="{{url('/militar')}}">
                      <i class="material-icons">people_alt</i>
                      <p>Militar</p>
                    </a>
                  @endif
              @endif
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/secao')}}">
              <i class="material-icons">badge</i>
              <p>Seção</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/posto-graduacao')}}">
              <i class="material-icons">military_tech</i>
              <p>Posto de Graduação</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/posto-servico')}}">
              <i class="material-icons">business_center</i>
              <p>Posto de Serviço</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="{{route('graduacao-servico')}}">
              <i class="material-icons">compare_arrows</i>
              <p>Indicar Posto de Graduação</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="{{url('/organizacao-militar')}}">
              <i class="material-icons">corporate_fare</i>
              <p>Organização Militar</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="{{route('tipo-impedimento')}}">
              <i class="material-icons">block</i>
              <p>Tipo de Impedimento</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="{{route('militar-impedimento')}}">
              <i class="material-icons">block</i>
              <p>Impedimento</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel" style="width: 1050px;">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
            @yield('content')
        </div>
      </div>
      <footer class="footer">
       
      </footer>
    </div>
  </div>
  <script src="{{asset('js/app.js')}}"></script>
  <script src="{{asset('js/perfect-scrollbar.js')}}"></script>
  <script src="{{asset('js/bootstrap-selectpicker.js')}}"></script>
  <!-- <script src="{{asset('js/material-dashboard.min.js')}}"></script> -->
  <script src="{{asset('js/dashboard.js?v=2.1.2')}}"></script>
  <script>

      $('#change-sidebar').on('click', function (){
        let check = $('#main-nav').hasClass('main-nav');
        if(check){
          $('#main-nav').removeClass('main-nav');
          $('#main-nav > .sidebar').css({width: '75px'})
          $('#main-nav > .sidebar > .sidebar-wrapper').css({width: '75px'})
          $('#main-panel').css({width: '1250px'});
          // $('#main-nav > .sidebar > .sidebar-wrapper > .nav').css({width: '80px'})
          return;
        }
        $('#main-nav').addClass('main-nav');
        $('#main-nav > .sidebar').css({width: '285px'})
        $('#main-nav > .sidebar > .sidebar-wrapper').css({width: '285px'})
        $('#main-panel').css({width: '1050px'});

        // $('#main-nav > .sidebar-wrapper > .nav').css({width: '300px'})
      });




      $('ul.nav li').each(function(){
        $(this).removeClass('active');

        var link = $(this).children('a');
        var href = $(link).attr('href')
        var currentUrl = window.location.href

        if(currentUrl.includes(href)){
          $(this).addClass('active');
        }
      })
  </script>
    @yield('scripts')
</body>
</html>