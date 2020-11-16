@extends ('layouts.app');

@section('content')
    <h1>{{ $project->title }}</h1>
    <div>{{ $project->description }}</div>
    <a href="/projects"><div class="btn btn-outline-success">Go Back</div></a>
@endsection;