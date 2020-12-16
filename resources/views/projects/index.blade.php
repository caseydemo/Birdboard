<!-- start using layout file - 12/15/20 -->
@extends('layouts.app')
@section('content')
<h1>Birdboard</h1>
    <ul>
        @forelse ($projects as $project)
            <li>
                <a href="{{ $project->path() }}">
                    {{ $project->title }}
                </a>
            </li>            
        @empty
            <li>No Projects Yet</li>
        @endforelse
    </ul>
@endsection