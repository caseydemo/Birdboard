@extends ('layouts.app');

@section('content')
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
                <a href="/projects"><div class="btn btn-outline-danger">Cancel</div></a>
            </div>
        
        </div>
    
    </form>
@endsection;