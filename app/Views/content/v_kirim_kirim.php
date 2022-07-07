<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>
<form class="card" id="form-kirim">
    <input type="hidden" name="id_transaksi" value="<?= $data['id_transaksi']; ?>">
    <input type="hidden" name="total" value="">
    <input type="hidden" name="ukuran" value="">
    <input type="hidden" name="metode_bayar" value="">

    <div class="content mt-2 mb-5 step1">
        <div>
            <div class="d-flex mb-4">
                <div class="align-self-center">
                    <img src="/uploads/images/<?= $data['gambar']; ?>" class="rounded-s mr-3 thumb1">
                </div>
                <div class="align-self-center">
                    <h2 class="font-16 line-height-s mt-1 mb-n1"><?= $data['nama_gudang']; ?></h2>
                    <p class="mb-0 font-11 mt-2"><?= $data['alamat']; ?></p>
                </div>
            </div>
        </div>
        <div class="divider mb-2"></div>
        <div class="text-center mb-3"><small>Pilih barang mana yang mau kamu kirim</small></div>
        <div id="kumpulan-barang">
            <?php foreach ($data['detail'] as $k => $v) { ?>
                <a href="javascript:void(0)">
                    <div class="d-flex mb-4">
                        <div class="align-self-center">
                            <img src="/uploads/images/<?= $v['gambar']; ?>" class="rounded-circle mr-3 thumb1">
                        </div>
                        <div class="align-self-center">
                            <h2 class="font-16 line-height-s mt-1 mb-n1"><?= $v['nama_barang'] ?></h2>
                            <p class="mb-0 font-11 mt-2"><?= toUang($v['panjang'] * $v['lebar'] * $v['qty']); ?></p>
                        </div>
                        <div class="ml-auto pl-3 align-self-center row">
                            <div class="rounded-s switch-s mr-2">
                                <input type="hidden" value="<?= $v['id_transaksi_detail']; ?>" name="barang[]">
                                <input type="number" name="qty[]" min="1" value="0" class="input-qty color-blue-dark" data-id="<?= $v['id_transaksi_detail']; ?>" data-luas="<?= $v['panjang'] * $v['lebar'] * $v['qty']; ?>" data-qty="<?= $v['qty']; ?>">
                                <span class="font-19 font-600 color-blue-dark">/ <?= $v['qty']; ?></span>
                            </div>
                        </div>
                    </div>
                </a>
            <?php } ?>
        </div>
        <div class="divider mt-5"></div>
        <div class="text-center">
            <p class="mb-2">Total Size (cm3):<br>
                <b total-size>0</b>
            </p>
            <a href="#" bNext="step2" class="btn btn-l font-13 font-600 rounded-s shadow-l mb-4 gradient-highlight">Bayar</a>
        </div>
    </div>

    <div class="content mt-2 mb-5 step2 d-none">
        <div class="p-2 pl-4 pr-4">
            <p class="font-15 mb-3">Lokasi pengiriman</p>
            <span class="font-10 color-blue-light">Dikirim dari</span>
            <div class="d-flex mb-2">
                <div class="align-self-center">
                    <img src="/uploads/images/<?= $data['gambar']; ?>" class="rounded-s mr-3 thumb1">
                </div>
                <div class="align-self-center">
                    <h2 class="font-12 line-height-s mt-1 mb-n1"><?= $data['nama_gudang']; ?></h2>
                    <span class="mb-0 font-11 mt-1"><?= $data['alamat']; ?></span>
                </div>
            </div>
            <div class="divider mb-2"></div>
            <span class="font-10 color-blue-light">Diterima di</span>
            <div class="d-flex mb-2">
                <div class="align-self-center color-black mr-1" style="font-size: 30px;">
                    <span><i class="fa fa-box"></i></span>
                </div>
                <div class="align-self-center">
                    <h2 class="font-12 line-height-s mt-1 mb-n1">Rumah <span penerima><?= $user['penerima'] ?></span></h2>
                    <span class="mb-0 font-11 mt-0" alamat-penerima><?= $user['alamat_penerima']; ?></span>
                </div>
                <div class="ml-auto align-self-center" style="font-size: 20px;">
                    <a href="javascript:void(0)" data-menu="menu-alamat-item"><i class="fa fa-edit"></i></a>
                </div>
            </div>
            <p class="font-15 mb-3 mt-4">Details</p>
            <div class="color-black">
                <span><i class="fa fa-box" style="font-size:15px"></i> <span total-size>0</span> <small>cm3</small></span><br />
                <span><i class="fa fa-bus" style="font-size:15px"></i> JNE YES</span>
            </div>
            <div class="mb-5">
                <p class="font-20 mb-1 color-blue-light">Rp <span total-harga>45.000</span></p>
            </div>
            <div class="text-center">
                <a href="javascript:void(0)" bNext="step3" class="btn btn-l mt-2 font-13 font-600 rounded-s shadow-l mb-4 gradient-highlight">Bayar</a>
            </div>

        </div>
    </div>

    <div class="content mb-5 mt-0 step3 d-none">
        <div class="p-2 pl-4 pr-4" style="height: 500px;">
            <h6>Metode Pembayaran</h6>
            <div class="mb-4">
                <a href="javascript:void(0)" bBayar="bca" class="btn btn-full rounded-sm shadow-s color-black font-12"><img src="/assets/images/bca.png" alt="" class="thumb3"> Virtual Account / Transfer Bank</a>
                <a href="javascript:void(0)" bBayar="bni" class="btn btn-full rounded-sm shadow-s color-black font-12"><img src="/assets/images/bni.png" alt="" class="thumb3"> Virtual Account / Transfer Bank</a>
                <a href="javascript:void(0)" bBayar="bri" class="btn btn-full rounded-sm shadow-s color-black font-12"><img src="/assets/images/bri.png" alt="" class="thumb3"> Virtual Account / Transfer Bank</a>
                <a href="javascript:void(0)" bBayar="gopay" class="btn btn-full rounded-sm shadow-s color-black font-12"><img src="/assets/images/gopay.png" alt="" style="width: 50px;"></a>
            </div>
        </div>
    </div>
    <div class="content mb-5 mt-0 step4 d-none">
        <div class="p-2 pl-4 pr-4 text-center" style="height: 500px;">
            <h1 class="color-blue-light mb-0">Berhasil!</h1>
            <span class="color-green-light">Pembayaran kamu sudah diterima</span>
            <img src="/assets/images/sukses.png" alt="" width="300px">
            <p class="color-black">Tunggu ya! barang kamu sedang dikirim dalam waktu 1x24 jam</p>
            <div class="mb-4">
                <a href="/kirim" class="btn btn-l bg-blue-dark rounded-sm shadow-s color-white font-12">OK!</a>
            </div>
        </div>
    </div>
</form>


<!-- detail barang -->
<div id="menu-alamat-item" class="menu menu-box-modal rounded-m bg-theme" data-menu-width="350" data-menu-height="300">
    <div class="menu-title">
        <h1 class="font-800">Penerima</h1>
        <a href="#" class="close-menu"><i class="fa fa-times-circle"></i></a>
    </div>
    <form class="content" id="form-penerima">
        <div class="input-style input-style-1">
            <input type="text" value="<?= $user['penerima']; ?>" placeholder="Nama penerima.." name="penerima" required>
        </div>
        <div class="input-style input-style-1">
            <input type="text" value="<?= $user['alamat_penerima']; ?>" placeholder="Alamat penerima.." name="alamat_penerima" required>
        </div>
        <div class="text-center">
            <button type="submit" class="btn gradient-blue font-13 btn-m font-600 mt-3 rounded-s">Perbarui</button>
        </div>
    </form>
</div>

<style>
    .thumb1 {
        object-fit: cover;
        width: 50px;
        height: 50px;
    }

    .input-qty {
        width: 30px !important;
        font-weight: 600;
        font-size: 19px !important;
        border: 0px;
        border-color: aliceblue;
    }


    .thumb3 {
        /* object-fit: cover; */
        width: 30px;
    }
</style>
<?= $this->endSection(); ?>


<?= $this->section('script'); ?>
<script>
    let total_size = 0;
    let penerima = '<?= $user['penerima']; ?>';
    let alamat_penerima = '<?= $user['alamat_penerima']; ?>';
    $(document).ready(function() {
        $("[name='qty[]']").on('keyup', function(e) {
            // hitung($(this).closest('form'));
            let input = $(this);
            let qty = $(this).data('qty');

            if (input.val() > qty) {
                input.val(qty);
            }
            let total_size = hitung(input);


            if (total_size != '') {
                id = input.data('id');
            }
        });

        $("[bNext]").click(function(e) {
            e.preventDefault();
            let next = $(this).attr('bNext');

            if (total_size == 0) {
                notification('Opps..', 'Masukkan kuantiti barang terlebih dahulu');
                return false;
            }

            if (next == 'step2') {
                $(".step1, .step3, .step4").addClass('d-none');
                $(".step2").removeClass('d-none');
            }

            if (next == 'step3') {

                if (penerima == '' || alamat_penerima == '') {
                    notification('Opps..', 'Mohon isi penerima dan alamat');
                    return false;
                }
                $(".step1, .step2, .step4").addClass('d-none');
                $(".step3").removeClass('d-none');
            }

        });

        $("[bBayar]").click(function(e) {
            e.preventDefault();
            let bayar = $(this).attr('bBayar');
            $(".step1, .step2, .step3").addClass('d-none');
            $(".step4").removeClass('d-none');
            $(".header-fixed").addClass('d-none');
            $("[name='metode_bayar']").val(bayar);

            $.ajax({
                type: "post",
                url: "/kirim/save",
                data: $("#form-kirim").serialize(),
                dataType: "json",
                success: function(response) {
                    if (!response.success) {
                        notification('Opps..', response.message);
                    }
                }
            });
        });


        $("[bSimpan]").click(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "/",
                data: "data",
                dataType: "dataType",
                success: function(response) {

                }
            });
        });


        $("#form-penerima").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "/akun/penerima",
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        notification('Sukses..', response.message);
                        penerima = $("[name='penerima']").val();
                        alamat_penerima = $("[name='alamat_penerima']").val();
                        $("[penerima]").text(penerima);
                        $("[alamat-penerima]").text(alamat_penerima);
                        $(".close-menu").click();
                    } else {
                        notification('Opps..', response.message, response.info_lanjut);
                    }
                    return
                }
            });
        });
    });


    function hitung(input) {

        total_size = 0;
        $("[name='qty[]']").each(function(e) {
            total_size += $(this).data('luas') * $(this).val();
        })

        $("[total-size]").text(total_size.toLocaleString('de-DE'));
        // hitungTotal(total_size);
        $("[name='ukuran']").val(total_size);
        return total_size;
    }

    function hitungTotal(ukuran) {
        let total = ukuran * 20;
        $("[total-harga]").text(total.toLocaleString('de-DE'));
        $("[name='total']").val(total);
    }
</script>
<?= $this->endSection(); ?>