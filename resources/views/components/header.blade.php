<header class="bg-white shadow-lg fixed w-full z-10">
    <nav class="flex max-[520px]:flex-col justify-between px-44 py-4 items-center max-[520px]:items-start max-[520px]:px-4">
        <div class="flex justify-between items-center max-[520px]:w-full">
            <h2 class="font-bold text-2xl">HarapanKita</h2>
            <div class="hidden max-[520px]:flex">
                <img src="{{asset('/assets/icons/menu.svg')}}" alt=""  class="w-6 btnMenu">
                <img src="{{asset('/assets/icons/close.svg')}}" alt="" class="w-6 hidden btnClose">
            </div>
        </div>
        <div class="hidden min-[520px]:flex justify-between gap-20 items-center max-[520px]:flex-col max-[520px]:items-start max-[520px]:pt-10 menu">
            <ul class="flex gap-5 font-semibold text-gray-500 max-[520px]:flex-col">
                <li><a href="/" class="hover:text-black">Beranda</a></li>
                <li><a href="/kegiatan"  class="hover:text-black">Kegiatan</a></li>
                <li><a href=""  class="hover:text-black">Berita</a></li>
                <li><a href=""  class="hover:text-black">Tentang Kami</a></li>
            </ul>
            <button class="btnDonate font-semibold text-white bg-orange-500 rounded-md py-2 w-fit px-5 max-[520px]:mt-6">
                DONASI SEKARANG
            </button>
        </div>
    </nav>
</header>