@extends("layouts.app")
@section("content")

<section class="sec">
	<h1 class="tit">Créer un post</h1>

	<!-- Le formulaire est géré par la route "posts.store" -->
	<form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" >
	
		<!-- Le token CSRF -->
		@csrf
		
		<p>
			<label for="title" >Titre</label><br/>
			<input type="text" name="title" value="{{ old('title') }}"  id="title" placeholder="Le titre du post" >

			<!-- Le message d'erreur pour "title" -->
			@error("title")
			<div>{{ $message }}</div>
			@enderror
		</p>
		<p>
			<label class="ima" for="picture" >Image</label><br/>
			<input type="file" name="picture" id="picture" >

			<!-- Le message d'erreur pour "picture" -->
			@error("picture")
			<div>{{ $message }}</div>
			@enderror
		</p>
		<p>
			<label class="cont" for="content" >Contenu</label><br/>
			<textarea name="content" id="content" lang="fr" rows="10" placeholder="Le contenu du post" >{{ old('content') }}</textarea>

			<!-- Le message d'erreur pour "content" -->
			@error("content")
			<div>{{ $message }}</div>
			@enderror
		</p>

		<input class="inp" type="submit" name="valider" value="Valider" >

	</form>
</section>


@endsection