@extends("layouts.app")
@section("title",'Create')
@section("content")

<section class="w-full flex justify-center flex-col items-center" >
	<h1 class="text-4xl mb-16 mt-4">Créer un post</h1>

	<!-- Le formulaire est géré par la route "posts.store" -->
	<form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" >
	
		<!-- Le token CSRF -->
		@csrf
		
		<div class="mb-4" >
			<label class="block text-gray-700 text-lg font-bold mb-2" for="title" >Titre</label><br/>
			<input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="title" value="{{ old('title') }}"  id="title" placeholder="Le titre du post" >

			<!-- Le message d'erreur pour "title" -->
			@error("title")
			<div>{{ $message }}</div>
			@enderror
		</div>
		<div class="mb-6">
			<label class="block  text-gray-700 text-xl font-bold mb-2" for="picture" >Image</label><br/>
			<input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" type="file" name="picture" id="picture" >

			<!-- Le message d'erreur pour "picture" -->
			@error("picture")
			<div>{{ $message }}</div>
			@enderror
		</div>
		<div>
			<label class="block  text-gray-700 text-xl font-bold mb-2" for="content" >Contenu</label><br/>
			<textarea class="peer block min-h-[auto] w-full rounded border-2 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transit"
    			id="content"
				name="content"
    			rows="3"
    		 placeholder="Le contenu du post" >{{ old('content') }}
			</textarea>

			<!-- Le message d'erreur pour "content" -->
			@error("content")
			<div>{{ $message }}</div>
			@enderror
		</div><br>

		<!-- <input class="inp" type="submit" name="valider" value="Valider" > -->
		<button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
			Valider
      </button>

	</form>
</section>


@endsection