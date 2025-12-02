<nav class="bg-gray-800" x-data="{ mobileOpen: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex items-center">
          <div class="shrink-0">
            <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company" class="size-8" />
          </div>
          <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-my-4">
              <x-my-nav-link href="/" :current="request()->is('/')">Home</x-my-nav-link>
              <x-my-nav-link href="/posts" :current="request()->is('posts')">Blog</x-my-nav-link>
              <x-my-nav-link href="/tentang" :current="request()->is('tentang')">Tentang Kami</x-my-nav-link>
              <x-my-nav-link href="/kontak" :current="request()->is('kontak')">Kontak</x-my-nav-link>
            </div>
          </div>
        </div>
        <div class="hidden md:block">
          <div class="ml-4 flex items-center md:ml-6">
            <!-- Profile dropdown -->
            
              <div class="relative ml-3" x-data="{ isOpen: false }" @keydown.escape="isOpen = false">
                @if(Auth::check())
                <button type="button" @click="isOpen = !isOpen" :aria-expanded="isOpen" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden cursor-pointer" id="user-menu-button" aria-haspopup="true">
                  <span class="absolute -inset-1.5"></span>
                  <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="{{ Auth::user()->name }}" class="size-8 rounded-full outline -outline-offset-1 outline-white/10" />
                  <div>
                    <span class="ml-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded-md py-2 text-sm font-medium">
                      Hi, {{ Auth::user()->name }}
                    </span>
                  </div>
                  <div class="ms-1 text-white">
                      <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                      </svg>
                  </div>
                </button>
                @else
                <a href="/login" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md py-2 text-sm font-medium">Login</a>
                <span class="items-center ml-4 text-white py-2 text-sm"> | </span>
                <a href="/register" class="ml-4 text-gray-300 hover:bg-gray-700 hover:text-white rounded-md py-2 text-sm font-medium">Register</a>
                @endif

                <div x-show="isOpen" x-cloak @click.outside="isOpen = false"
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                class="absolute right-0 z-50 mt-2 w-48 origin-top-right rounded-md bg-white py-1 outline-1 -outline-offset-1 outline-white/10" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="1">
                  <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-300" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                  <a href="/dashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-300" role="menuitem" tabindex="-1" id="user-menu-item-1">Dashboard</a>
                  <form method="POST" action="/logout">
                    @csrf
                  <button type="submit" class="block w-full text-start px-4 py-2 text-sm text-gray-700 hover:bg-gray-300 cursor-pointer" role="menuitem" tabindex="-1" id="user-menu-item-2" >Log Out</button>
                  </form>
                </div>
              </div>
          </div>
        </div>
        <div class="-mr-2 flex md:hidden">

          <!-- Mobile menu button -->
          <button type="button" @click="mobileOpen = !mobileOpen" class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden" aria-controls="mobile-menu" :aria-expanded="mobileOpen">
            <span class="absolute -inset-0.5"></span>
            <span class="sr-only">Open main menu</span>
            {{-- Menu Open: "hidden", Menu closed: "block" --}}
            <svg :class="{ 'hidden': mobileOpen, 'block': !mobileOpen}" class="size-6"  fill="none" viewBox="0 0 24 24" 
              stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"  />
            </svg>
            {{-- Menu Open: "block", Menu closed: "hidden" --}}
            <svg :class="{ 'block': mobileOpen, 'hidden': !mobileOpen}" class="size-6"  fill="none" viewBox="0 0 24 24" 
              stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"  />
            </svg>
          </button>
        </div>
      </div>
    </div>

    {{-- Mobile menu, show/hidden based on menu state --}}
    <div x-show="mobileOpen" x-cloak class="md:hidden" id="mobile-menu">
      <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
        <x-my-nav-link class="block" href="/" :current="request()->is('/')">Home</x-my-nav-link>
        <x-my-nav-link class="block" href="/posts" :current="request()->is('posts')">Blog</x-my-nav-link>
        <x-my-nav-link class="block" href="/tentang" :current="request()->is('tentang')">Tentang Kami</x-my-nav-link>
        <x-my-nav-link class="block" href="/kontak" :current="request()->is('kontak')">Kontak</x-my-nav-link>
      </div>
      <div class="border-t border-gray-700 pt-4 pb-3">
        @if(Auth::check())
          <div class="flex items-center px-5">
            <div class="shrink-0">
              <img class="size-10 rounded-full" 
                src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="{{ Auth::user()->name }}" />
            </div>
            <div class="ml-3">
              <div class="text-base/5 font-medium text-white">Hi, {{ Auth::user()->name }}</div>
            </div>
          </div>
          <div class="mt-3 space-y-1 px-2">
            <a href="/profile" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700">Your Profile</a>
            <a href="/dashboard" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700">Dashboard</a>
            <form method="POST" action="/logout">
              @csrf
              <button type="submit" class="block w-full text-start px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 cursor-pointer"
              role="menuitem" tabindex="-1" id-menu-item-2>Log Out</button>
            </form>
          </div>
        @else
          <div class="mt-3 space-y-1 px-2">
            <a href="/login" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">Login</a>
            <a href="/register" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">Register</a>
          </div>
        @endif
      </div>
    </div>
  </nav>