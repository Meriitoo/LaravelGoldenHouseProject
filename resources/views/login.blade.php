@extends('layouts.app')

@section('navigation')
    @include('navigation')
@endsection

@section('maincontent')

    <form action="{{ route('login.submit') }}" method="POST">
        @csrf
        <div class="container">
            <h1>Вход</h1>
            <p>Моля, въведете своите данни за вход.</p>

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

            <label for="email"><b>Имейл</b></label>
            <input type="email" placeholder="Въведете имейл" name="email" id="email" required>

            @error('email')
                <p class="alert-danger">{{ $errors->first('email') }}</p>
            @enderror

            <label for="password"><b>Парола</b></label>
            <input type="password" placeholder="Въведете парола" name="password" id="password" required>

            @error('password')
                <p class="alert-danger">{{ $errors->first('password') }}</p>
            @enderror

            <button type="submit" class="loginbtn">Вход</button>
        </div>

        <div class="container signin">
            <p>Нямате акаунт? <a href="{{ route('register') }}">Регистрирайте се</a>.</p>
        </div>
    </form>

@endsection