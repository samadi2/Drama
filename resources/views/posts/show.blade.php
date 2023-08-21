@extends("layouts.app")
@section("title", 'Blog')
@section("content")

<section class="w-full md:w-2/3 flex flex-col  px-3">

    <article class="flex flex-col mx- shadow my-2">
        <!-- Article Image -->
        <img src="{{ asset('storage/'.$post->picture) }}">
        <div class="bg-white flex flex-col justify-start p-6">
            <p class="text-3xl font-bold hover:text-gray-700 pb-4">{{$post->title}}</p>
            <p  class="text-sm pb-8">{{ $post->content }}</p>
        </div>
    
    </article>
    <h5 class="text-2xl text-center font-bold pb-3">Commentaires</h5>
    <div class="relative grid grid-cols-1 gap-4 p-4 mb-8 border rounded-lg bg-white shadow-lg">
    @foreach ($post->comments as $comment)
    <div class="relative flex gap-4">
        <img src="https://icons.iconarchive.com/icons/diversity-avatars/avatars/256/charlie-chaplin-icon.png" class="relative rounded-lg -top-8 -mb-4 bg-white border h-20 w-20" alt="" loading="lazy">
        <div class="flex flex-col w-full">
            <div class="flex flex-row justify-between">
                <p class="relative text-xl whitespace-nowrap truncate overflow-hidden"></p>
                <a class="text-gray-500 text-xl" href="#"><i class="fa-solid fa-trash"></i></a>
            </div>
        <p class="font-semibold text-2xl">{{ $comment->user->name }}</p>
        <p class="text-gray-400 text-sm">{{ $comment->created_at->format('j M Y, g:i a') }}</p>
        </div>
    </div>
    <p class="-mt-4 text-gray-500">{{ $comment->content}}</p>
</div>
    @endforeach
    <div class="alert alert-info">Aucun commentaire pour cet article</div>
    <form action="{{ route('comments.store', $post->id) }}" method="POST" class="flex flex-col  rounded-lg p-4">
    @csrf
        <div class="form-group mb-3">
            <label for="content">Votre commentaire</label>
            <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Soumettre mon commentaire</button>
    </form> 
    @auth
    <div class="buttons mt-3 btn">
        <a href="{{ route('posts.edit', $post) }}" class="btn btn-info">Modifier</a>
        <form action="{{ url('posts/'. $post->id) }}" method="POST" style="display: inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>
        <p><a href="{{ route('posts.index') }}" title="Retourner aux articles"  class="btn btn-info mt-2">Retourner aux posts</a></p>
    </div>
    @endauth

</section>


	

@endsection
