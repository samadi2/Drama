@extends("layouts.app")
@section("title", 'Modifier' )
@section("content")

	<section class="w-full flex justify-center flex-col items-center"	>
		<h1 class="text-4xl mb-10 mt-4">Modifier le post</h1>

		<!-- Si nous avons un Post $post -->
		@if (isset($post))

		<!-- Le formulaire est géré par la route "posts.update" -->
		<form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" >

			<!-- <input type="hidden" name="_method" value="PUT"> -->
			@method('PUT')

			@else

			<!-- Le formulaire est géré par la route "posts.store" -->
			<form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" >

			@endif

			<!-- Le token CSRF -->
			@csrf
		
			<div class="mb-4">
				<label for="title" class="block text-gray-700 text-lg font-bold mb-2" >Titre</label><br/>

				<!-- S'il y a un $post->title, on complète la valeur de l'input -->
				<input type="text" name="title" value="{{ isset($post->title) ? $post->title : old('title') }}"  id="title" placeholder="Le titre du post" class="shadow appearance-none border border-black-500 rounded w-full py-2 px-3 text-black-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" >

				<!-- Le message d'erreur pour "title" -->
				@error("title")
				<div>{{ $message }}</div>
				@enderror
			</div>

			<!-- S'il y a une image $post->picture, on l'affiche -->
			@if(isset($post->picture))
			<div class="mb-4">
				<span>Couverture actuelle</span><br/>
				<img src="{{ asset('storage/'.$post->picture) }}" alt="image de couverture actuelle" style="max-height: 200px;" >
			</div>
			@endif

			<div class="mb-6">
				<label class="block text-gray-700 text-lg font-bold mb-2" for="picture" >Image</label><br/>
				<input type="file" name="picture" id="picture" class="shadow appearance-none border border-blue-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" >

				<!-- Le message d'erreur pour "picture" -->
				@error("picture")
				<div>{{ $message }}</div>
				@enderror
			</div>
			<div class="mb-4">
				<label for="content" class="block text-gray-700 text-lg font-bold mb-2" >Contenu</label><br/>

				<!-- S'il y a un $post->content, on complète la valeur du textarea -->
				<textarea class="peer block min-h-[auto] w-full rounded border-2 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
    			id="content"
				name="content"
    			rows="3" >{{ isset($post->content) ? $post->content : old('content') }}</textarea>

				<!-- Le message d'erreur pour "content" -->
				@error("content")
				<div>{{ $message }}</div>
				@enderror
			</div>

			<button class="bg-blue-500 hover:bg-blue-700 text-white font-bold  py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
				Valider
      		</button>

		</form>
	</section>


@endsection