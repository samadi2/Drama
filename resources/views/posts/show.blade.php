@extends("layouts.app")
@section("title", 'Blog')
@section("content")

<section class="w-full  px-3">

    <div class="flex justify-around voir ">
        <div class=" w-1/2 mt-5 imag mb-16 ">
            <!-- Article Image -->
            <img src="{{ asset('storage/'.$post->picture) }}" alt="l'affiche du drama {{$post->title}}"  width="100%">
            <div class="bg-white flex flex-col  p-12">
                <p class="text-3xl font-bold hover:text-gray-700 pb-4">Titre : {{$post->title}}</p>
                <p  class="text-xl pb-8">Description : {{ $post->content }}</p>
                <div class="flex gap-x-5 justify-end">
                    <form action="{{ route('posts.like') }}" id="form-js">
                        <div id="count-js">{{ $post->likes->count() }} </div>
                        <div class="flex items-center">
                            <input type="hidden" id="post-id-js" value="{{ $post->id }}"> 
                            <button  type="submit"><i class="fa-solid fa-thumbs-up fa-2xl" style="color: #271f51;"></i></button>
                        </div>
                    </form>  
                    <form action="{{ route('posts.dislike') }}" id="form-1-js">
                        <div id="count-1-js">{{ $post->dislikes->count() }} </div>
                        <div class="flex items-center">
                            <input type="hidden" id="post-id-1-js" value="{{ $post->id }}"> 
                            <button id="dislike" type="submit"><i class="fa-solid fa-thumbs-down fa-2xl" style="color: #271f51;"></i></button>
                        </div>
                    </form>  
                </div>
            </div>
            @auth
            <div class="flex justify-around bouton  flex-row mt-5 ">
                <a href="{{ route('posts.edit', $post) }}" aria-label="Modifier l'article" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Modifier</a>
                <form action="{{ url('posts/'. $post->id) }}" method="POST" style="display: inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" aria-label="Supprimer l'article"  class="bg-blue-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full">Supprimer</button>
                </form>
                <a href="{{ route('posts.index') }}" title="Retourner aux articles" aria-label="retour à la page des articles"  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Retourner aux posts</a>
            </div>
            @endauth
        </div>
        <div class="relative comm w-1/2 gap-4 p-4 mb-8 border mt-5 h-1/2  bg-white shadow-lg">
            <h5 class="text-2xl text-center  font-bold pb-3"  >Commentaires</h5>
            <hr>
            @foreach ($post->comments as $comment)
            <div class="relative  gap-4">            
                <p class="font-semibold text-2xl">{{ $comment->user->name }}</p> 
                <p class="text-gray-400 text-sm">{{ $comment->created_at->format('j M Y, g:i a') }}</p> <br>
                <p class="-mt-4 text-gray-500">{{ $comment->content}}</p><hr><br>
            </div >
            @endforeach
        </div>
    </div>
    
    @auth
    <form action="{{ route('comments.store', $post->id) }}" method="POST" class="flex flex-col  rounded-lg p-4">
    @csrf
        <div class="form-group mb-3">
            <label for="content" class="text-2xl mt-15 font-bold  ">Votre commentaire</label>
            <textarea aria-label="mettre un commentaire" class="peer block min-h-[auto] w-full rounded border-2 bg-white px-3 py-[0.32rem] leading-[1.6] outline-none transition-all mt-5 duration-200 ease-linear motion-reduce:transition-none dark:text-neutral-200 "
    			id="content"
                name="content"
    			rows="3" placeholder="Commentaire..." ></textarea>
        </div>
        <button type="submit" aria-label="soumettre le commentaire" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">Soumettre mon commentaire</button>
    </form> 
    @endauth    

</section>


	

@endsection
