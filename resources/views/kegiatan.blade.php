@php
    use Carbon\Carbon;
@endphp

<x-layout>
    <x-slot:title>Halaman Kegiatan</x-slot:title>

    <section class="flex flex-col pt-28 items-center gap-5 max-[520px]:px-4">
        <div>
            <h1 class="font-bold text-2xl text-center mb-1"><span class="text-cyan-700">Memberikan</span><br> Kebahagiaan Mereka</h1>
            <div class="bg-cyan-700 w-80 h-[0.1rem]"></div>
        </div>
        <h1 class="font-bold text-xl">Kegiatan yang Berlangsung</h1>
        <div class="grid grid-cols-3 gap-6 max-[520px]:grid-cols-1">
            @foreach ($campaigns as $item)
                @php
                    $sisaHari = Carbon::now()->startOfDay()->diffInDays(Carbon::parse($item->deadline)->startOfDay(), false);
                @endphp
        
                <div class="flex flex-col justify-between shadow-lg rounded-md w-[20rem] h-full max-[520px]:w-full">
                    <a href="/kegiatan/{{$item->slug}}" class="flex flex-col gap-4 justify-between flex-1">
                        <img src="{{ asset('/storage/'. $item->gambar) }}" alt="" class="rounded-t-md">
                        <div class="flex flex-col gap-2 px-5 flex-1">
                            <h2 class="font-bold text-lg">{{ $item->judul }}</h2>
                            <p class="text-zinc-400 text-sm">{{ $item->deskripsi }}</p>
                        </div>
                        <div class="flex justify-between px-5 pb-4">
                            <div class="flex flex-col">
                                <p>Target</p>
                                <p class="font-semibold text-cyan-700">Rp {{ number_format($item->target_donasi, 0, ',', '.') }}</p>
                            </div>
                            <div class="flex flex-col items-end">
                                <p>Deadline</p>
                                <p class="font-semibold">
                                    {{ $sisaHari > 0 ? $sisaHari . ' hari lagi' : ($sisaHari === 0 ? 'Hari ini' : 'Sudah lewat') }}
                                </p>
                            </div>
                        </div>
                    </a>
                    <button class="btnDonate font-semibold text-white bg-orange-500 rounded-b-md py-4 w-full mt-auto">
                        DONASI SEKARANG
                    </button>
                </div>
            @endforeach
        </div>  
    </section>
</x-layout>

<div class="fixed inset-0 hidden items-center justify-center bg-black bg-opacity-50 z-20 formModal">
    <x-form :campaign="$campaign ?? null" :campaigns="$campaigns"></x-form>
</div>