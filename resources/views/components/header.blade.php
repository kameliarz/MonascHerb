<header
    class="relative bg-cover bg-center"
    style="background-image: url('{{ asset('img/Breadcrumbs.png') }}');"
>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="font-bold tracking-tight text-white">
            {{ $slot }}
        </h1>
    </div>
</header>
