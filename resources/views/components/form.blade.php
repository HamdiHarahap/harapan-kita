<form action="{{route('donate')}}" enctype="multipart/form-data" method="POST" class="z-20 bg-white w-[40rem] max-[520px]:px-3 max-[520px]:mx-2 px-12 py-5 flex flex-col gap-5 rounded-md overflow-y-scroll h-[90vh] scrollbar-hide">
    @csrf
    <p class="font-bold text-right closeBtn cursor-pointer">X</p>
    <div class="w-full flex flex-col gap-2">
        <h2 class="font-semibold text-lg">Donasi Untuk</h2>
        <select name="tujuan" id="tujuan" class="bg-transparent outline-none border-2 rounded-md px-3 py-2 w-full">
            <option value="">Pilih tujuan</option>
            @if ($campaign)
                <option value="{{$campaign->judul}}" selected>{{$campaign->judul}}</option>
            @else 
                @foreach ($campaigns as $item)
                    <option value="{{$item->judul}}">{{$item->judul}}</option>
                @endforeach
            @endif
        </select>
    </div>
    <div class="w-full flex flex-col gap-2">
        <h2 class="font-semibold text-lg">Informasi Donatur</h2>
        <div class="flex flex-col">
            <label for="nama">Nama Lengkap</label>
            <input required type="text" name="nama" id="nama" class="px-3 py-2 rounded-md border-2 outline-none bg-transparent" placeholder="Nama Lengkap">
        </div>
        <div class="flex flex-col">
            <label for="email">Email</label>
            <input required type="email" name="email" id="email" class="px-3 py-2 rounded-md border-2 outline-none bg-transparent" placeholder="example@mail.com">
        </div>
        <div class="flex flex-col">
            <label for="phone">Nomor Telepon</label>
            <div class="flex w-full">
                <p class="bg-zinc-200 px-4 py-2 rounded-s-md font-bold">+62</p>
                <input type="text" required name="phone" id="phone" class="px-3 py-2 rounded-e-md border-2 outline-none bg-transparent w-full" placeholder="81234567890">
            </div>
        </div>
        <div class="flex flex-col">
            <label for="pesan">Doa atau pesan</label>
            <textarea name="pesan" id="pesan" class="px-3 py-2 rounded-md border-2 outline-none bg-transparent" placeholder="Doa atau pesan (opsional)"></textarea>
        </div>
    </div>
    <div class="flex flex-col gap-2">
        <h2 class="font-semibold text-lg">Pembayaran</h2>
        <div>
            <label for="metode">Metode Pembayaran</label>
            <select id="metode" class="bg-transparent outline-none border-2 rounded-md px-3 py-2 w-full">
                <option value="">Pilih Metode Pembayaran</option>
                <option value="bni">BNI</option>
                <option value="gopay">Gopay</option>
                <option value="qris">Qris</option>
                <option value="mandiri">Mandiri</option>
                <option value="bca">BCA</option>
                <option value="bri">BRI</option>
                <option value="cimb">Cimb Niaga</option>
            </select>
        </div>
        
        <div id="detailPembayaran" class="hidden mt-2"></div>
    
        <div class="flex flex-col">
            <label for="jumlah">Jumlah Bayar</label>
            <div class="flex w-full">
                <p class="bg-zinc-200 px-4 py-2 rounded-s-md font-bold">Rp</p>
                <input type="number" name="jumlah" id="jumlah" class="px-3 py-2 rounded-e-md border-2 outline-none bg-transparent w-full" placeholder="100000">
            </div>
        </div>
        <div class="flex flex-col">
            <label for="bukti">Bukti Pembayaran</label>
            <input type="file" id="bukti" name="bukti" accept="image/*">
            <img id="previewBukti" class="mt-2 w-56 object-contain hidden" alt="Preview Bukti Pembayaran">
        </div>
    </div>

    <button class="bg-cyan-700 font-semibold text-lg py-2 text-white rounded-md">Kirim</button>
</form>