@extends('layouts.app')
@section("title", 'Blog')
@section('content')

    
   
<div class="container mx-auto flex flex-wrap py-6">

        <!-- Posts Section -->
        @auth
        <div class=" col-lg-2 mt-3">
            <a class=" flex justify-end btn btn-success" href="{{ url('posts/create') }}">Ajouter un posts</a>
        </div>
        @endauth
         <section class="w-full md:w-2/3 flex flex-col grid-rows-2 items-center px-3">
             
             @if ($message = Session::get('success'))
             
             <div class="alert alert-success">
                 <p>{{ $message }}</p>
                </div>
                
                @endif
                
                <article class="flex flex-col shadow my-4"> 
                    <!-- Article Image -->
                    @foreach ($posts as $index => $post)
                    <div class="bg-white flex flex-col justify-start p-6">
                     <a href="#" class="hover:opacity-75">
                         <img  src="{{ asset('storage/'.$post->picture) }}">
                     </a>
                   
                   
                 <a href="{{ url('posts/') . $post->id }}">
                    <p class="text-blue-700 text-sm font-bold uppercase pb-4">Ecrit par: {{ $post->user->name }}| date: {{ $post->created_at }}</p>
                    
                    <p class="pb-6">{{ $post->title }}</p> 
                     <a href="{{ url('posts/'. $post->id) }}" class="uppercase text-gray-800 hover:text-black">En savoir plus <i class="fas fa-arrow-right"></i></a>
                </div>
                <br>
                 @endforeach
            </article> 

            
            

        </section> 



@endsection











