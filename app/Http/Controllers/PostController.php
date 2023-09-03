<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use App\Models\Dislike;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use App\Policies\PostPolicy;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //On récupère tous les Post
        $posts = Post::with('user')->latest()->get();

        $posts = Post::paginate(3);
        // On transmet les Post à la vue
        return view("posts.index", compact("posts"));

    }

    public function like(): JsonResponse
    {
        $post = Post::find(request()->id);

        if ($post->isLikedByLoggedInUser()) {
            $res = Like::where([
                'user_id' => auth()->user()->id,
                'post_id' => request()->id
            ])->delete();

            if ($res) {
                return response()->json([
                    'count' => Post::find(request()->id)->likes->count()
                ]);
            }

        } else {
            $like = new Like();

            $like->user_id = auth()->user()->id;
            $like->post_id = request()->id;

            $like->save();

            return response()->json([
                'count' => Post::find(request()->id)->likes->count()
            ]);
        }
    }    
    public function dislike(): JsonResponse
    {
        $post = Post::find(request()->id);

        if ($post->isDislikedByLoggedInUser()) {
            $res = Dislike::where([
                'user_id' => auth()->user()->id,
                'post_id' => request()->id
            ])->delete();

            if ($res) {
                return response()->json([
                    'count' => Post::find(request()->id)->dislikes->count()
                ]);
            }

        } else {
            $dislike = new Dislike();

            $dislike->user_id = auth()->user()->id;
            $dislike->post_id = request()->id;

            $dislike->save();

            return response()->json([
                'count' => Post::find(request()->id)->dislikes->count()
            ]);
        }
    }    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ("posts.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. La validation
    $this->validate($request, [
        'title' => 'bail|required|string|max:255',
        "picture" => 'bail|required|image|max:1024',
        "content" => 'bail|required',
    ]);

    // 2. On upload l'image dans "/storage/app/public/posts"
    $chemin_image = $request->picture->store("posts");

    // 3. On enregistre les informations du Post
    Post::create([
        "title" => $request->title,
        "picture" => $chemin_image,
        "content" => $request->content,
    ]);

    // 4. On retourne vers tous les posts : route("posts.index")
    return redirect(route("posts.index"));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view("posts.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view("posts.edit", compact("post"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        // 1. La validation

    // Les règles de validation pour "title" et "content"
    $rules = [
        'title' => 'bail|required|string|max:255',
        "content" => 'bail|required',
    ];

    // Si une nouvelle image est envoyée
    if ($request->has("picture")) {
        // On ajoute la règle de validation pour "picture"
        $rules["picture"] = 'bail|required|image|max:1024';
    }

    $this->validate($request, $rules);

    // 2. On upload l'image dans "/storage/app/public/posts"
    if ($request->has("picture")) {

        //On supprime l'ancienne image
        Storage::delete($post->picture);

        $chemin_image = $request->picture->store("posts");
    }

    // 3. On met à jour les informations du Post
    $post->update([
        "title" => $request->title,
        "picture" => isset($chemin_image) ? $chemin_image : $post->picture,
        "content" => $request->content
    ]);

    // 4. On affiche le Post modifié : route("posts.show")
    return redirect(route("posts.show", $post));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        // On supprime l'image existant
        Storage::delete($post->picture);


        // On récupère tous les likes du post
        $likes = Like::where('post_id', $post->id)->get();
        // On supprime tous les likes
        foreach ($likes as $like) {
            $like->delete();
        }
        // On récupère tous les dislikes du post
        $dislikes = Dislike::where('post_id', $post->id)->get();
        // On supprime tous les dislikes
        foreach ($dislikes as $dislike) {
            $dislike->delete();
        }
    
        // On les informations du $post de la table "posts"
        $post->delete();
    
        // Redirection route "posts.index"
        return redirect(route('posts.index'));
    }
}
