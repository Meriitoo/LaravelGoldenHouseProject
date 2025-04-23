@extends('layouts.app')

@section('navigation')
  @include('navigation')
@endsection

@section('maincontent')

<div class="centered-container">
    <a href="{{ route('posts.index') }}" class="back-link pink-back-btn">⬅ Назад към всички постове</a>
    <h1 class="post-title">{{ $post->title }}</h1>

    @if ($post->image_url)
      <div class="post-image">
        <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="post-img">
      </div>
    @endif

    <p class="post-content"><strong>Съдържание:</strong> {{ $post->content }}</p>
    <p class="post-category"><strong>Категория:</strong> {{ $post->category }}</p>
    <p class="post-price"><strong>Цена:</strong> {{ number_format($post->price, 2) }} лв</p>

    <p class="post-status">
      <strong>Статус:</strong>
      @if($post->is_bought)
        <span class="status-bought">Вече е купен</span>
      @else
        @auth
          @if (auth()->id() !== $post->user_id)
            <span class="status-available">Кликнете, за да го закупите</span>
            <form action="{{ route('posts.buy', $post) }}" method="POST" class="buyer-form">
                @csrf
                <button type="submit" class="green-btn">Купи сега</button>
            </form>
          @else
            <span class="status-self-product">Не можете да закупите собствен продукт.</span>
          @endif
        @else
          <p>Моля, <a href="{{ route('login') }}" class="login-link">влезте</a>, за да закупите продукта.</p>
        @endauth
      @endif
    </p>

    <!-- @auth
      @if (auth()->id() === $post->user_id)
        <a href="{{ route('posts.edit', $post) }}" class="edit-btn">Редактирай</a>
        <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;" class="buyer-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-btn">Изтрий</button>
        </form>
      @endif
    @endauth -->

    @auth
  @if (auth()->id() === $post->user_id)
    <a href="{{ route('posts.edit', $post) }}" class="edit-btn">Редактирай</a>
    <button type="button" class="delete-btn" onclick="openModal()">Изтрий</button>

    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p>Сигурни ли сте, че искате да изтриете този пост?</p>
            <form action="{{ route('posts.destroy', $post) }}" method="POST"  class="buyer-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="confirm-delete-btn">Потвърдете изтриването</button>
            </form>
            <button type="button" class="cancel-delete-btn" onclick="closeModal()">Отказ</button>
        </div>
    </div>
  @endif
@endauth



</div>

@endsection

<script>
    function openModal() {
        var modal = document.getElementById("deleteModal");
        modal.style.display = "block"; 
    }

    function closeModal() {
        var modal = document.getElementById("deleteModal");
        modal.style.display = "none"; 
    }

    window.onclick = function(event) {
        var modal = document.getElementById("deleteModal");
        if (event.target == modal) {
            modal.style.display = "none"; 
        }
    }
</script>
