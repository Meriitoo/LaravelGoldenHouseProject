@extends('layouts.app')

@section('navigation')
    @include('navigation')
@endsection

@section('maincontent')

<form action="{{ route('posts.store') }}" method="POST" class="form-box">
    @csrf
    <div class="container">
        <h1>Създаване на ново бижу</h1>
        <p>Моля, попълнете формата, за да добавите бижу в каталога.</p>

        <label for="title"><b>Име на бижу</b></label>
        <input type="text" placeholder="Например: Златен пръстен с диамант" name="title" id="title" value="{{ old('title') }}" required>
        @error('title') <p class="alert-danger">{{ $message }}</p> @enderror

        <label for="content"><b>Описание</b></label>
        <textarea name="content" id="content" placeholder="Въведете описание на бижуто..." required>{{ old('content') }}</textarea>
        @error('content') <p class="alert-danger">{{ $message }}</p> @enderror
        

        <label for="category"><b>Категория</b></label>
        <select name="category" id="category" required>
            <option value="">-- Избери категория --</option>
            <option value="Обеци">Обеци</option>
            <option value="Пръстени">Пръстени</option>
            <option value="Гривни">Гривни</option>
            <option value="Колиета">Колиета</option>
            <option value="Часовници">Часовници</option>
            <option value="Комплекти">Комплекти</option>
        </select>
        @error('category') <p class="alert-danger">{{ $message }}</p> @enderror

        <label for="price"><b>Цена (лв)</b></label>
        <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}" required>
        @error('price') <p class="alert-danger">{{ $message }}</p> @enderror

        <label for="image_url"><b>URL на изображение</b></label>
        <input type="text" name="image_url" id="image_url" placeholder="https://..." value="{{ old('image_url') }}" required>
        @error('image_url') <p class="alert-danger">{{ $message }}</p> @enderror

        <button type="submit" class="registerbtn">Създай</button>
    </div>
</form>
@endsection
