<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/app.css">
    <script src="js/app.js"></script>
    <title>Create a Project</title>
</head>
<body>
    <h1>Create a Project</h1>
    <form action="/projects" method="POST" class="container">
        @csrf
        <div class="field">
            <label for="title">Title</label>
            <div class="control">
                <input type="text" class="input" name="title" placeholder="title">  
            </div>
        </div>

        <div class="field">
            <label for="description">Description</label>
            <div class="control">
                <input type="text" class="input" name="description" placeholder="description">  
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="btn btn-outline-success">Create Project</button>
            </div>
        
        </div>
    
    </form>
</body>
</html>