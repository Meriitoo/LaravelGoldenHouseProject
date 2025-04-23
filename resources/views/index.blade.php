@extends('layouts.app')

@section('navigation')
  @include('navigation')
@endsection

@section('maincontent')

  <div class="post-wrapper">

    @if(session('success'))
      <p class="message success">{{ session('success') }}</p>
    @endif

    @if(session('error'))
      <p class="message error">{{ session('error') }}</p>
    @endif

    <form method="GET" action="{{ route('posts.index') }}" class="filter-form">
      <label for="category" style="margin-bottom: 20px;">Филтрирай по категория:</label>
      <select name="category" id="category" onchange="this.form.submit()">
        <option value="">-- Всички категории --</option>
        
        @php
          $categories = ['Обеци', 'Пръстени', 'Гривни', 'Колиета', 'Часовници', 'Комплекти'];
        @endphp
        
        @foreach ($categories as $cat)
          <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
        @endforeach
      </select>
    </form>

    <div class="create-link">
      <a href="{{ route('posts.create') }}">Създай нов пост</a>
    </div>

    @if($posts->isEmpty())
      <p>Няма постове за избраната категория.</p>
    @else
      <div class="post-grid">
        @foreach ($posts as $post)
          <div class="post-card">
            <h2>
              <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
            </h2>

            <p><strong>Категория:</strong> {{ $post->category }}</p>
            <p><strong>Цена:</strong> {{ number_format($post->price, 2) }} лв</p>

            @if($post->image_url)
              <img src="{{ $post->image_url }}" alt="Product Image">
            @endif

            <p>{{ Str::limit($post->content, 100) }}</p>

            @auth
              @if(Auth::id() !== $post->user_id)
                @if($post->is_bought && $post->buyer_id == Auth::id())
                  <form action="{{ route('posts.cancelPurchase', $post) }}" method="POST" class="buyer-form">
                    @csrf
                    <button type="submit" class="gray-btn">Откажи</button>
                  </form>
                @elseif(!$post->is_bought)
                  <form action="{{ route('posts.buy', $post) }}" method="POST" class="buyer-form">
                    @csrf
                    <button type="submit" class="green-btn">Купи</button>
                  </form>
                @else
                  <button class="red-btn" disabled>Изчерпан</button>
                @endif
              @else
                <button class="gray-btn" disabled>
                  {{ $post->is_bought ? 'Купено' : "Не можеш да купиш собствен артикул" }}
                </button>
              @endif
            @else
              <button class="gray-btn" disabled>Влез, за да купиш</button>
            @endauth

          </div>
        @endforeach
      </div>
    @endif

  </div>

@endsection
