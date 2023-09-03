

<header class="header">
    <nav>
        <div class="logo">
            <a href="/"><img src="{{ asset('img/logo-drama.png') }}" width="50px" alt=""></a>
        </div>
        <input type="checkbox" id="menu-toggle">
        <label for="menu-toggle" class="menu-icon">&#9776;</label>
        <ul class="menu">
            <li><a href="/">Accueil</a></li>


            @auth
            <li><a href="/posts">Blog</a></li>
            <li><a href="/histoire">Histoire</a></li>
            
            <x-nav-link :href="route('posts.create')" :active="request()->routeIs('posts.create')" style="color : white">
                {{ ('Créer un post') }}
            </x-nav-link>
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" style="color : white">
                {{ ('Dashboard') }}
            </x-nav-link>
            

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                    this.closest('form').submit();">
                    <i class="fa-solid fa-right-from-bracket fa-beat-fade fa-xl" style="color: #ce0303;"></i>
                </x-dropdown-link>
            </form>
            @endauth
        </ul>
    </nav>
</header>