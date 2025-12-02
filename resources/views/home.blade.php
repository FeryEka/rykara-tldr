<x-layout :title="$title">
  <p>Selamat datang di halaman {{ $title }}</p>
    <div class="flex mt-3">
      @for ($i = 1; $i <= 10; $i++)
        <div class="w-15 h-15 bg-gray-400 rounded-lg text-gray-900 p-0 me-1 text-xs grid place-items-center">{{ $i; }}</div>
      @endfor
    </div>
</x-layout>