const btnDonates = document.querySelectorAll(".btnDonate");
const formModal = document.querySelector(".formModal");
btnDonates.forEach((btn) => {
    btn.addEventListener("click", () => {
        formModal.classList.remove("hidden");
        formModal.classList.add("flex");
        document.body.style.overflow = "hidden";
    });
});

const closeBtn = document.querySelector(".closeBtn");
closeBtn.addEventListener("click", () => {
    formModal.classList.remove("flex");
    formModal.classList.add("hidden");
    document.body.style.overflow = "";
});

const metodeSelect = document.getElementById("metode");
const detailPembayaran = document.getElementById("detailPembayaran");
const buktiInput = document.getElementById("bukti");
const previewBukti = document.getElementById("previewBukti");

metodeSelect.addEventListener("change", function () {
    const metode = this.value;
    detailPembayaran.innerHTML = "";

    if (metode === "qris") {
        detailPembayaran.innerHTML =
            '<img src="assets/images/qris.jpg" alt="QRIS" class="w-48 h-48 object-contain">';
    } else if (
        metode === "bni" ||
        metode === "mandiri" ||
        metode === "bca" ||
        metode === "bri" ||
        metode === "cimb"
    ) {
        const bankInfo = {
            bni: {
                rekening: "1234567890",
                nama: "Harapan Kita",
            },
            mandiri: {
                rekening: "2345678901",
                nama: "Harapan Kita",
            },
            bca: {
                rekening: "3456789012",
                nama: "Harahap Kita",
            },
            bri: {
                rekening: "4567890123",
                nama: "Harahap Kita",
            },
            cimb: {
                rekening: "5678901234",
                nama: "Harahap Kita",
            },
        };

        detailPembayaran.innerHTML = `
                <p>No. Rekening: <strong>${bankInfo[metode].rekening}</strong></p>
                <p>Atas Nama: <strong>${bankInfo[metode].nama}</strong></p>
            `;
    }

    detailPembayaran.classList.toggle("hidden", !metode);
});

buktiInput.addEventListener("change", function () {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            previewBukti.src = e.target.result;
            previewBukti.classList.remove("hidden");
        };
        reader.readAsDataURL(file);
    } else {
        previewBukti.classList.add("hidden");
        previewBukti.src = "";
    }
});

const btnMenu = document.querySelector(".btnMenu");
const btnClose = document.querySelector(".btnClose");
const menu = document.querySelector(".menu");

btnMenu.addEventListener("click", () => {
    menu.classList.remove("hidden");
    btnClose.classList.add("flex");
    btnClose.classList.remove("hidden");
    btnMenu.classList.add("hidden");
});

btnClose.addEventListener("click", () => {
    menu.classList.add("hidden");
    btnClose.classList.remove("flex");
    btnClose.classList.add("hidden");
    btnMenu.classList.remove("hidden");
});
