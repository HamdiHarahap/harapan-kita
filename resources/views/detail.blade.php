@php
    use Carbon\Carbon;
    $sisaHari = Carbon::now()->startOfDay()->diffInDays(Carbon::parse($campaign->deadline)->startOfDay(), false);
@endphp

<x-layout>
    <x-slot:title>Halaman Detail</x-slot:title>

    <section class="pt-20 flex flex-col items-center gap-12">
        <div class="flex flex-col items-center">
            <h1 class="font-bold text-2xl text-center mb-1">{{$campaign->judul}}</h1>
            <div class="bg-cyan-700 w-80 h-[0.1rem]"></div>
        </div>
        <div class="w-full flex justify-between px-44 items-stretch gap-6">
            <div class="w-[60rem]">
                <img src="/storage/{{$campaign->gambar}}" alt="" class="w-full rounded-md">
            </div>
            <div class="bg-zinc-200 w-[30rem] rounded-md p-5 flex flex-col items-center justify-between">
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
</x-layout>

<div class="fixed inset-0 hidden items-center justify-center bg-black bg-opacity-50 formModal">
    <x-form :campaign="$campaign"></x-form>
</div>