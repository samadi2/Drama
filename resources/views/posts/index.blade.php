@extends('layouts.app')
@section("title", 'Blog')
@section('content')

    <div class="flex justify-end " >
        @auth
            <a href="{{ url('posts/create') }}"><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" >Ajouter un posts</button></a>
        @endauth
    </div>    

        <!-- Posts Section -->

        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        
        
           
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach ($posts as $index => $post)
        <div class="bg-white items-center mt-3 mx-auto mt-3 px-4 ">
            <a class="px-3" href="{{ url('posts/'. $post->id) }}" class="hover:opacity-75">
                <img src="{{ asset('storage/'.$post->picture) }}" alt="L'affiche du drama {{$post->title}}">
            </a>
            <a href="{{ url('posts/'. $post->id) }}">
                <p class="text-blue-700 text-sm font-bold uppercase pb-4">Ecrit par: {{ $post->user->name }}| date: {{ $post->created_at }}</p>
                <p class="pb-6">{{ $post->title }}</p>
            </a>
            <a href="{{ url('posts/'. $post->id) }}" class="uppercase text-gray-800 hover:text-black"><button type="button" class="py-2.5 px-5 mr-2 mb-2  font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">En savoir plus</button></a>
        </div>
    @endforeach
</section>
        <div class="page">
            {{ $posts->links() }}
        </div>
        





@endsection











