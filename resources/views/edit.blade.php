@extends('layouts.app')

@section('navigation')
    @include('navigation')
@endsection

@section('maincontent')
    <div class="container">


        <form action="{{ route('posts.update', $post) }}" method="POST">
            @csrf
            @method('PUT')
            <h1>Редактиране на пост</h1>

            <div class="form-group">
                <label for="title">Заглавие</label>
                <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" class="input-field">
                @error('title') 
                    <p class="alert-danger">{{ $message }}</p> 
                @enderror
            </div>

            <div class="form-group">
                <label for="content">Съдържание</label>
                <textarea name="content" id="content" class="input-field">{{ old('content', $post->content) }}</textarea>
                @error('content') 
                    <p class="alert-danger">{{ $message }}</p> 
                @enderror
            </div>

            <div class="form-group">
                <label for="category">Категория</label>
                <select name="category" id="category" class="input-field">
                    @php
                        $categories = ['Обеци', 'Пръстени', 'Гривни', 'Колиета', 'Часовници', 'Комплекти'];
                    @endphp
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ old('category', $post->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
                @error('category') 
                    <p class="alert-danger">{{ $message }}</p> 
                @enderror
            </div>

            <div class="form-group">
                <label for="price">Цена</label>
                <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $post->price) }}" class="input-field">
                @error('price') 
                    <p class="alert-danger">{{ $message }}</p> 
                @enderror
            </div>

            <div class="form-group">
                <label for="image_url">URL на изображението</label>
                <input type="text" name="image_url" id="image_url" value="{{ old('image_url', $post->image_url) }}" class="input-field">
                @error('image_url') 
                    <p class="alert-danger">{{ $message }}</p> 
                @enderror
            </div>

            <button type="submit" class="submit-btn">Актуализирай</button>
        </form>
    </div>
@endsection
