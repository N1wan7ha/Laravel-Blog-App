<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My1st_LaravelProject</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
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
            width: 100%;
        }

        button:hover {
            background-color: #2980b9;
        }

        .error-message {
            color: #c0392b;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Post</h1>
        <form action="{{ route('update-post', $post->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- This will tell Laravel to treat the request as a PUT request -->
            
            <label for="title">Title:</label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}" required>

            <label for="body">Body:</label>
            <textarea name="body" required>{{ old('body', $post->body) }}</textarea>

            <button type="submit">Edit Post</button>
        </form>
    </div>
</body>
</html>
