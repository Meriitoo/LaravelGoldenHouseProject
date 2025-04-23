<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    // public function index()
    // {

    //     $posts = Post::all();
    //     return view('index', compact('posts'));
    // }

    public function index(Request $request)
    {
        $query = Post::query();

        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        $posts = $query->latest()->get();

        return view('index', compact('posts'));
    }


    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'nullable|string',
            'price' => 'nullable|numeric',
            'image_url' => 'nullable|url',
        ]);

        $validated['user_id'] = auth()->id(); 

        Post::create($validated);
        return redirect()->route('posts.index')->with('success', 'Post created!');
    }

    public function show(Post $post)
    {
        return view('show', compact('post'));
    }


    public function edit(Post $post)
    {
        $this->authorizePostOwner($post);
        return view('edit', compact('post'));
    }


    public function update(Request $request, Post $post)
    {
        $this->authorizePostOwner($post);
        $validated = $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:5',
            'category' => 'nullable|string',
            'price' => 'nullable|numeric',
            'image_url' => 'nullable|url',
            'is_bought' => 'nullable|boolean',
        ]);


        $validated['is_bought'] = $request->has('is_bought');

        $post->update($validated);
        return redirect()->route('posts.show', $post)->with('success', 'Post updated!');
    }

    public function destroy(Post $post)
    {
        $this->authorizePostOwner($post);
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted!');
    }

    // public function buy(Post $post)
    // {

    //     $post->is_bought = !$post->is_bought;
    //     $post->save();

    //     $message = $post->is_bought ? 'Успешна покупка!' : 'Покупката е отменена.';
    //     return redirect()->back()->with('success', $message);


    // }

    public function buy(Post $post)
    {
        if ($post->is_bought) {
            return redirect()->back()->with('error', 'Този пост вече е закупен.');
        }

        $post->is_bought = true;
        $post->buyer_id = Auth::id(); 
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Успешно закупихте продуктa!');
    }


    public function cancelPurchase(Post $post)
    {
        $user = Auth::user();

        if ($post->buyer_id !== $user->id) {
            return redirect()->route('posts.index')->with('error', 'Не сте закупили този продукт!');
        }

        $post->is_bought = false;
        $post->buyer_id = null;
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Покупката е отменена!');
    }


    private function authorizePostOwner(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
    }

}
