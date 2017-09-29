<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    </head>
    <body>
        
        <div id="app">
            <nav class="navbar is-info">
              <div class="navbar-brand">
                <a class="navbar-item" href="{{ url('/') }}">
                  
                </a>
                
                <a class="navbar-item is-hidden-desktop" exact>
                  <span class="icon" style="color: #333;">
                    <i class="fa fa-home"></i>
                  </span>
                </a>

                <a class="navbar-item is-hidden-desktop">
                  <span class="icon" style="color: #55acee;">
                    <i class="fa fa-cog"></i>
                  </span>
                </a>

                <div class="navbar-burger burger" data-target="navMenu">
                  <span></span>
                  <span></span>
                  <span></span>
                </div>
              </div>

              <div id="navMenu" class="navbar-menu">
                <div class="navbar-start">
                  <a href="{{ route('home') }}" class="navbar-item">
                      Accueil
                  </a>
                  <a href="{{ route('projets.index') }}" class="navbar-item">
                      Espace administration
                  </a>
                </div>

                <div class="navbar-end">
                  <div class="navbar-item">
                    <div :class="{'navbar-item': true, 'has-dropdown': true, 'is-active': dropdownUser}"
                     @mouseover.prevent="dropdownUser = true" @mouseleave.prevent="dropdownUser= false">
                    <a class="navbar-link">
                      {{ Auth::user()->name }}
                    </a>

                    <div v-if="dropdownUser" class="navbar-dropdown">
                      <a class="navbar-item" href="{{ route('logout') }}"
                                                        onclick="event.preventDefault();
                                                          document.getElementById('logout-form').submit();">
                        Déconnexion
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                              </form>
                    </div>
                  </div>
                  </div>
                </div>
              </div>
            </nav>

            <section class="hero is-light">
              <div class="hero-body container">
                <p class="title">
                  {{ config('app.name', 'Laravel') }}
                </p>
                <p class="subtitle">
                  Application de  <strong style="color: hsl(348, 100%, 61%)">gestion du processus</strong> d'indexation
                </p>
              </div>
              <!-- Hero footer: will stick at the bottom -->
              <div class="hero-foot">
                @yield('nav')
              </div>
            </section>

            <!-- PAGE CONTENT -->
            <section>
              <div class="container" style="margin-top: 27px; margin-bottom: 27px">
                @yield('content')
              </div>
            </section>
        </div>
        
        <script src="{{ asset('js/app.js' )}}"></script>

        @if (Session::has('success'))
          <script>
            success('<?php echo Session::get('success') ?>')
          </script>
        @endif

        @if (Session::has('error'))
          <script>
            error('<?php echo Session::get('error') ?>')
          </script>
        @endif

        @if (Session::has('warning'))
          <script>
            warning('<?php echo Session::get('warning') ?>')
          </script>
        @endif
    </body>
</html>
