<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My1st_LaravelProject</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .post, .form-section {
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 20px 0;
            padding: 15px;
            background-color: #fff;
        }

        .post {
            background-color: #f9f9f9;
        }

        .post h3 {
            margin: 0;
            color: #2c3e50;
        }

        .post p {
            color: #555;
        }

        .form-section h2 {
            margin-top: 0;
        }

        input[type="text"],
        input[type="password"],
        textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            background-color: #3498db;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2980b9;
        }

        .logout-section {
            text-align: right;
        }

        .alert {
            color: #c0392b;
            background-color: #f9d6d5;
            padding: 10px;
            border-radius: 5px;
        }

        .hidden {
            display: none;
        }
    </style>
    <script>
        function toggleForms() {
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            loginForm.classList.toggle('hidden');
            registerForm.classList.toggle('hidden');
        }
    </script>
</head>
<body>
    <div class="container">
        @auth
        <div class="logout-section">
            <p>Hello, Welcome</p>
            <form action="/logout" method="POST">
                @csrf
                <button>Logout</button>
            </form>
        </div>

        <div class="form-section">
            <h2>Create a New Post</h2>
            <form action="/create-post" method="POST">
                @csrf
                <input type="text" name="title" placeholder="Title" required>
                <textarea name="body" placeholder="Body content...." required></textarea>
                <button>Save Post</button>
            </form>
        </div>

        <div class="post">
            <h2>All Posts</h2>
            @foreach ($posts as $post)
            <div class="post">
                <h3>{{$post['title']}} by {{$post->user->name}}</h3>
                <p>{{$post['body']}}</p>
                <form action="/edit-post/{{$post->id}}" method="GET" style="display:inline;">
                    @csrf 
                    <button type="submit">Edit</button>
                </form>
                <form action="/delete-post/{{$post->id}}" method="POST" style="display:inline;">
                    @csrf 
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </div>
            @endforeach
        </div>

        @else
        <div class="form-section" id="loginForm">
            <h2>Login</h2>
            <form action="/login" method="post">
                @csrf
                <input type="text" name="loginname" placeholder="Name" required>
                <input type="password" name="loginpassword" placeholder="Password" required>
                <button>Login</button>
            </form>
            <p>Don't have an account? <a href="javascript:void(0);" onclick="toggleForms()">Register here</a>.</p>
        </div>  

        <div class="form-section hidden" id="registerForm">
            <h2>Register</h2>
            <form action="/register" method="post">
                @csrf
                <input type="text" name="name" placeholder="Name" required>
                <input type="text" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button>Register</button>
            </form>
            <p>Already have an account? <a href="javascript:void(0);" onclick="toggleForms()">Login here</a>.</p>
        </div>    
        @endauth
    </div>
</body>
</html>
