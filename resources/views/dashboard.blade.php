@extends('layouts.app')
@section("title", 'Dashboard')
@section('content')

<x-slot name="header">
  <h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Dashboard') }}
  </h2>
</x-slot>
 

    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <table class="min-w-full text-left text-sm font-light">
                    <thead class="border-b font-medium dark:border-neutral-500">
                    <tr>
                      <th scope="col" class="px-6 py-4">Sto.</th>
                      <th scope="col" class="px-6 py-4">Nom</th>
                      <th scope="col" class="px-6 py-4">Par</th>
                      <th scope="col" class="px-6 py-4"><i class="fa-solid fa-file-pen fa-2xl" style="color: #2eba12;"></i></th>
                      <th scope="col" class="px-6 py-4"><i class="fa-solid fa-trash fa-2xl" style="color: #c60c0c;"></i></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($posts as $post)
                        <tr class="border-b dark:border-neutral-500">
                            <td class="whitespace-nowrap px-6 py-4">{{ $post->id}}</td>
                            <td class="whitespace-nowrap px-6 py-4">{{ $post->title}}</td>
                            <td class="whitespace-nowrap px-6 py-4">{{ $post->user->name}}</td>
                            <td class="whitespace-nowrap px-6 py-4"><a href="{{ route('posts.edit', $post) }}" class="inline-block rounded-md border border-transparent bg-indigo-600 text-center text-white hover:bg-indigo-700">Modifier</a></td>
                            <td>
                                <form method="POST" action="{{ route('posts.destroy', $post) }}" >
                                    @csrf
                                    @method("DELETE")
                                    <input type="submit" value="x Supprimer" >
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
@endsection

