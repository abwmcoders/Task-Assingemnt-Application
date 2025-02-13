<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env("APP_NAME") }}</title>
    @vite(["resources/css/app.css", "resources/js/app.js"])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body>
     <header class="bg-slate-800 shadow-lg">
        <nav>
            <a href="" class="nav-link">TheMade</a> 
             {{-- {{ route('posts.index') }} --}}
            @auth
                 <div @click.outside="open = false" class="relative grid place-items-center" x-data="{ open: false } ">
                    {{-- Drop down menu button --}}
                    <button @click=" open = !open" type="button" class="round-btn">
                        <img src="https://picsum.photos/200" alt="">
                    </button>
                    {{-- Drop down menu --}}
                    <div x-show='open' class="bg-white shadow-lg absolute top-10 round-0 rounded-lg overflow-hidden font-light">
                        <p class="username pl-4 pb-4 pt-4">{{ auth()->user()->username }}</p>
                        <hr>
                        <a href="{{ route('dashboard') }}" class="block hover:bg-slate-100 pl-4 pr-8 py-2 mb-1">Dashboard</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="block w-full text-left pl-4 pr-8 py-2 hover:bg-slate-100">Logout</button>
                        </form>
                    </div>
                 </div>
            @endauth

            @guest
                <div class="flex items-center gap-4">
                <a href="{{ route('login') }}" class="nav-link">Login</a>
                <a href="{{ route("register") }}" class="nav-link">Register</a>
            </div>
            @endguest

            
        </nav>
    </header>
   <main class="py-8 px-4 mx-auto max-w-screen-lg">
    {{ $slot }}
   </main>
</body>
</html>