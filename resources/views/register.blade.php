@extends('layouts.app')

@section('navigation')
  @include('navigation')
@endsection

@section('maincontent')

  <form action="{{route('users.store') }}" method="POST">
    @csrf
    <div class="container">
    <h1>Регистрация</h1>
    <p>Моля, попълнете тази форма, за да създадете акаунт.</p>

    @if (Session::has('error'))
    <div class="alert alert-danger">
      <ul>
      <li>{{ Session::get('error') }}</li>
      </ul>
    </div>
  @endif

    @if (Session::has('success'))
    <div class="alert alert-success">
      <ul>
      <li>{{Session::get('success') }}</li>
      </ul>
    </div>
  @endif

    @error('name')
    <p class="alert-danger">{{ $errors->first('name') }} </p>
  @enderror
    <label for="name"><b>Потребителско име</b></label>
    <input type="text" value="{{ old('name') }}" placeholder="Въведете потребителско име" name="name" id="name"
      required>

    @error('email')
    <p class="alert-danger">{{ $errors->first('email') }} </p>
  @enderror
    <label for="email"><b>Имейл</b></label>
    <input type="email" value="{{ old('email') }}" placeholder="Въведете имейл" name="email" id="email" required>

    @error('password')
    <p class="alert-danger">{{ $errors->first('password') }} </p>
  @enderror
    <label for="password"><b>Парола</b></label>
    <input type="password" placeholder="Въведете парола" name="password" id="password" required>

    @error('psw-repeat')
    <p class="alert-danger">{{ $errors->first('psw-repeat') }} </p>
  @enderror
    <label for="psw-repeat"><b>Повторете паролата</b></label>
    <input type="password" placeholder="Повторете паролата" name="psw-repeat" id="psw-repeat" required>

    <p>Съгласявайки се с регистрацията, Вие се съгласявате с нашите <a href="#">Условия и Поверителност</a>.</p>
    <button type="submit" class="registerbtn">Регистрация</button>
    </div>

    <div class="container signin">
    <p>Вече имате акаунт? <a href="{{ route('login') }}">Влезте тук</a>.</p>
    </div>
  </form>

@endsection('maincontent')