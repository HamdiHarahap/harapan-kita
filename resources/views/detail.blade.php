@php
    use Carbon\Carbon;
    $sisaHari = Carbon::now()->startOfDay()->diffInDays(Carbon::parse($campaign->deadline)->startOfDay(), false);
@endphp

<x-layout>
    <x-slot:title>Halaman Detail</x-slot:title>

    <section class="pt-28 flex flex-col items-start gap-12 px-44 max-[520px]:px-4">
        <div class="flex flex-col items-center w-full">
            <h1 class="font-bold text-2xl text-center mb-1">{{$campaign->judul}}</h1>
            <div class="bg-cyan-700 w-80 h-[0.1rem]"></div>
        </div>
        <div class="w-full flex justify-between items-stretch gap-6 max-[520px]:flex-col =">
            <div class="w-[60rem] max-[520px]:w-full">
                <img src="/storage/{{$campaign->gambar}}" alt="" class="w-full rounded-md">
            </div>
            <div class="bg-zinc-200 w-[30rem] rounded-md p-5 flex flex-col items-center justify-between max-[520px]:w-full max-[520px]:gap-12">
                <h1 class="font-bold text-xl">HarapanKita</h1>
                <div class="flex flex-col items-center mt-auto gap-3">
                    <div class="flex flex-col items-center gap-1">
                        <h2 class="font-bold text-4xl text-cyan-700">Rp {{number_format($campaign->dana_terkumpul, 0, ',', '.')}}</h2>
                        <p class="text-gray-500">terkumpul dari IDR {{number_format($campaign->target_donasi, 0, ',', '.')}}</p>
                    </div>
                    <div>
                        <p class="font-bold">
                            {{ $sisaHari > 0 ? $sisaHari . ' hari lagi' : ($sisaHari === 0 ? 'Hari ini' : 'Sudah lewat') }}
                        </p>
                    </div>
                </div>
                <button class="btnDonate font-semibold text-white bg-orange-500 rounded-md py-4 w-full mt-auto">
                    DONASI SEKARANG
                </button>
            </div>
        </div>
    </section>
    <section class="pt-8 ps-44 max-w-[58.3rem] py-20 flex max-[520px]:w-full max-[520px]:px-4">
        <div class="w-full flex flex-col gap-4">
            <h4 class="text-cyan-700 font-semibold text-xl">Daftar Donatur</h4>
            <div class="flex flex-col gap-2 w-full">
                @foreach ($donations as $item)  
                    @php
                        $tanggalDonasi = Carbon::parse($item->created_at)->translatedFormat('F d, Y');
                    @endphp
                    <div class="border rounded-md p-3 flex gap-4 items-start justify-between w-full hover:bg-zinc-100">
                        <div class="bg-zinc-200 rounded-full p-4 w-[3.5rem]">
                            <img src="{{asset('/assets/icons/user.svg')}}" alt="" class="w-4">
                        </div>
                        <div class="flex flex-col w-full">
                            <h3 class="text-lg">{{$item->donator->name}}</h3>
                            <p class="font-semibold text-cyan-700">Rp {{ number_format($item->jumlah_donasi, 0, ',', '.')}}</p>
                            <p class="text-zinc-400">{{$item->pesan}}</p>
                        </div>
                        <p class="w-56">{{ $tanggalDonasi }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-layout>

<div class="fixed inset-0 hidden items-center justify-center bg-black bg-opacity-50 z-20 formModal">
    <x-form :campaign="$campaign"></x-form>
</div>