<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100"
    style="background-image: url('/img/loginbackground.jpg'); background-repeat: no-repeat;background-size: cover;">
    <div>
        {{ $logo }}
    </div>

    {{-- <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"> --}}
    <div class="w-full px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
        style="max-width: 80%; margin-top:30%;">
        {{ $slot }}
    </div>
</div>
