<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .sidebar {
            width: 200px;
            background-color: #343a40;
            color: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: fixed;
            height: 100%;
        }

        .sidebar .welcome-box {
            background-color: #007bff;
            color: #ffffff;
            padding: 15px;
            border-radius: 0 8px 8px 0;
            text-align: center;
            width: 80%;
            margin-bottom: 20px;
        }

        .sidebar form {
            width: 100%;
            margin-top: auto;
        }

        .sidebar button {
            background-color: #dc3545;
            color: #ffffff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        .content {
            margin-left: 200px; /* Width of the sidebar */
            padding: 20px;
            flex-grow: 1;
        }

        .post-box {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        .post-box textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        .post-box button {
            background-color: #28a745;
            color: #ffffff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .post-box button:hover {
            background-color: #218838;
        }

        .post-list {
            margin-top: 20px;
        }

        .post {
            border: 1px solid #ced4da;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .post form {
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="welcome-box">
            <h2>Welcome, {{ auth()->user()->name }}!</h2>
        </div>
        <form  style="margin-top: auto;">
            <a href="{{ route('logout') }}" style="color: #dc3545; text-decoration: none; padding: 12px 20px; border-radius: 4px; cursor: pointer; font-size: 16px; width: 80%; text-align: center; background-color: #621713; border: 1px solid #efeef3; display: block; margin-top: 10px;">
                Logout
            </a>
        </form>
       
    </div>
    

<div class="content">
    <div class="post-box" id="postBox">
        <h3>Create a Post</h3>
        <form method="post" action="{{ url('/dashboard/create') }}">
            @csrf
            <label for="content">Content:</label>
            <textarea name="content" required></textarea>
            <button type="submit">Create Post</button>
        </form>
    </div>

    <div class="post-list">
        <h3>Your Posts</h3>
        @if(session('status'))
            <p style="color: green;">{{ session('status') }}</p>
        @endif

        @forelse($posts as $post)
            <div class="post">
                <p>{{ $post->content }}</p>
                <form method="post" action="{{ url('/dashboard/'.$post->id.'/update') }}">
                    @csrf
                    <label for="content">Edit Post:</label>
                    <textarea name="content" required>{{ $post->content }}</textarea>
                    <button type="submit">Update</button>
                </form>
                <form method="post" action="{{ url('/dashboard/'.$post->id.'/delete') }}">
                    @csrf
                    <button type="submit">Delete</button>
                </form>
            </div>
        @empty
            <p>No posts available.</p>
        @endforelse
    </div>
</div>



</body>
</html>
