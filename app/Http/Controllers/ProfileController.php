<?php

namespace App\Http\Controllers;



use App\Models\Post;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    
    public function dashboard()
    {
        $posts = Post::where('user_id', auth()->id())->get();
        return view('dashboard', ['posts' => $posts]);
    }
      //end
    public function createPost(Request $request)
    {
        $request->validate([
            'content' => 'required|max:255',
        ]);

        Post::create([
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
        ]);

        return redirect('/dashboard')->with('status', 'Post created successfully!');
    }
    //end

    public function updatePost(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|max:255',
        ]);

        $post = Post::findOrFail($postId);
        $post->update([
            'content' => $request->input('content'),
        ]);

        return redirect('/dashboard')->with('status', 'Post updated successfully!');
    }
    //end

    public function deletePost($postId)
    {
        $post = Post::findOrFail($postId);
        $post->delete();

        return redirect('/dashboard')->with('status', 'Post deleted successfully!');
    }

}
