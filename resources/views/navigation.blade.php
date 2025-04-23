<nav class="navbar navbar-fixed-top navbar-inverse">
  <div class="container">
    <div id="navbar" class="collapse navbar-collapse navbar-flex">
      
      <div class="nav-center">
        <ul class="nav navbar-nav">
          <li class="nav-item {{ Route::currentRouteName() == 'home' ? 'active' : '' }}">
            <a href="{{ route('home')}}">Начало</a>
          </li>
          <li class="nav-item {{ Route::currentRouteName() == 'posts.index' ? 'active' : '' }}">
            <a href="{{ route('posts.index') }}">Всички постове</a>
          </li>
          @if (Auth::guest())
            <li class="nav-item {{ Route::currentRouteName() == 'login' ? 'active' : '' }}">
              <a href="{{ route('login') }}">Вход</a>
            </li>
            <li class="nav-item  {{ Route::currentRouteName() == 'register' ? 'active' : '' }}">
              <a profile-text href="{{ route('register')}}">Регистрация</a>
            </li>
          @endif
          @if (Auth::check())
            <li class="nav-item {{ Route::currentRouteName() == 'posts.create' ? 'active' : '' }}">
              <a href="{{ route('posts.create') }}">Добави пост</a>
            </li>
          @endif
          @if (Auth::check())
          <div class="nav-profile-group">
            <span class="profile-text">
              Профил – {{ Auth::user()->name ?? Auth::user()->email }}
            </span>
            <a class="logout-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Изход</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
          @endif
        </ul>
      </div>


    </div>
  </div>
</nav>
