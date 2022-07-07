<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>
<form class="card" id="form-input">
    <div class="content mb-5 mt-0 step3-1">

        <table class="table table-borderless bg-blue-dark text-center rounded-s shadow-xl" style="overflow: hidden;" cellpadding="0" celspacing="0">
            <thead>
                <tr>
                    <th colspan="3" class="text-left">
                        <h1 class="color-white">Tentukan waktu penyimpanan kamu!</h1>
                    </th>
                </tr>
                <tr class="">
                    <th scope="col" class="color-white"><input type="date" value="<?= $tanggal['mulai']; ?>" name="mulai" min="<?= $tanggal['mulai']; ?>"></th>
                    <th scope="col" class="color-white"><i class="fa fa-arrow-right"></i></th>
                    <th scope="col" class="color-white"><input type="date" value="<?= $tanggal['selesai'] ?>" name="selesai" min="<?= $tanggal['mulai']; ?>"></th>
                </tr>
                <tr>
                    <th colspan="3" class="text-center font-12"><span tanggal-mulai><?= tanggal($tanggal['mulai']); ?></span> - <span tanggal-selesai><?= tanggal($tanggal['selesai']); ?></span><br><span tanggal-info>(<?= $tanggal['info']; ?>)</span></th>
                </tr>
            </thead>
        </table>
        <div class="shadow-xl rounded-sm p-2">
            <div class="text-center mt-2">
                <span class="border"><img src="/uploads/images/<?= $gudang['gambar']; ?>" alt="" class="rounded-sm thumb2"> <b class="font-12"><?= $gudang['nama_gudang']; ?></b></span>
            </div>
            <div class="color-black font-14 mt-5 mb-4 ml-5 mr-5 d-flex">
                <div class="align-self-center">
                    <span><b><i class="fa fa-box"></i> <?= toUang($transaksi['ukuran']); ?></b> <small>cm3</small></span>
                </div>
                <div class="ml-auto align-self-center">
                    <i class="fa fa-clock"></i>
                    <span tanggal-info><?= $tanggal['info']; ?></span>
                </div>
            </div>
            <div class="text-center">
                <p class="font-12 mb-1">Total Price:</p>
                <?php
                $detailbayar = totalBayar($transaksi['ukuran'], $tanggal['jumlah_hari']);
                ?>
                <p class="font-20 mb-1 <?= $detailbayar['diskon'] > 0 ? 'coret' : ''; ?> color-blue-light sebelum-diskon">Rp<?= toUang($detailbayar['bayar']); ?></p>
                <?php if ($detailbayar['diskon'] > 0) : ?>
                    <p class="font-20 mb-1 color-blue-light sesudah-diskon" style="font-weight: 600;">Rp<?= toUang($detailbayar['total_bayar']); ?></p>
                <?php endif; ?>
                <a href="javascript:void(0)" bLanjut="step3-1" class="btn btn-l mt-2 font-13 font-600 rounded-s shadow-l mb-4 gradient-highlight">Lanjut</a>
            </div>
        </div>
    </div>

    <div class="content mb-5 mt-0 step3-2 d-none">
        <div class="p-2 pl-4 pr-4">
            <p class="font-15 mb-3">Lokasi penyimpanan</p>
            <span class="font-10 color-blue-light">Disimpan di</span>
            <div class="d-flex mb-2">
                <div class="align-self-center">
                    <img src="/uploads/images/<?= $gudang['gambar']; ?>" class="rounded-s mr-3 thumb1">
                </div>
                <div class="align-self-center">
                    <h2 class="font-12 line-height-s mt-1 mb-n1"><?= $gudang['nama_gudang']; ?></h2>
                    <span class="mb-0 font-11 mt-1"><?= $gudang['alamat']; ?></span>
                </div>
            </div>
            <div class="divider mb-2"></div>
            <span class="font-10 color-blue-light">Dijemput di</span>
            <div class="d-flex mb-2">
                <div class="align-self-center color-black mr-1" style="font-size: 30px;">
                    <span><i class="fa fa-box"></i></span>
                </div>
                <div class="align-self-center">
                    <h2 class="font-12 line-height-s mt-1 mb-n1">Rumah</h2>
                    <span class="mb-0 font-11 mt-0 alamat"><?= $user['alamat']; ?></span>
                </div>
                <div class="ml-auto align-self-center" style="font-size: 20px;">
                    <a href="javascript:void" data-menu="menu-edit-alamat"><i class="fa fa-edit"></i></a>
                </div>
            </div>
            <p class="font-15 mb-3 mt-4">Details</p>
            <div class="color-black">
                <span><i class="fa fa-box" style="font-size:15px"></i> <?= toUang($transaksi['ukuran']); ?> <small>cm3</small></span><br />
                <span><i class="fa fa-clock" style="font-size:15px"></i></span> <span tanggal-info><?= $tanggal['info']; ?></span> (<span tanggal-mulai class="font-8"><?= tanggal($tanggal['mulai']); ?></span> - <span tanggal-selesai class="font-8"><?= tanggal($tanggal['selesai']); ?></span>)
            </div>
            <div class="mb-5">
                <p class="font-20 mb-1 <?= $detailbayar['diskon'] > 0 ? 'coret' : ''; ?> color-blue-light sebelum-diskon">Rp<?= toUang($detailbayar['bayar']); ?></p>
                <?php if ($detailbayar['diskon'] > 0) : ?>
                    <p class="font-20 mb-1 color-blue-light sesudah-diskon" style="font-weight: 600;">Rp<?= toUang($detailbayar['total_bayar']); ?></p>
                <?php endif; ?>
            </div>
            <div class="text-center">
                <a href="javascript:void(0)" bLanjut="step3-2" class="btn btn-l mt-2 font-13 font-600 rounded-s shadow-l mb-4 gradient-highlight">Bayar</a>
            </div>

        </div>
    </div>
    <div class="content mb-5 mt-0 step3-3 d-none">
        <div class="p-2 pl-4 pr-4" style="height: 500px;">
            <h6>Metode Pembayaran</h6>
            <div class="mb-4">
                <a href="javascript:void(0)" bMetodeBayar="bca" class="btn btn-full rounded-sm shadow-s color-black font-12"><img src="/assets/images/bca.png" alt="" class="thumb3"> Virtual Account / Transfer Bank</a>
                <a href="javascript:void(0)" bMetodeBayar="bni" class="btn btn-full rounded-sm shadow-s color-black font-12"><img src="/assets/images/bni.png" alt="" class="thumb3"> Virtual Account / Transfer Bank</a>
                <a href="javascript:void(0)" bMetodeBayar="bri" class="btn btn-full rounded-sm shadow-s color-black font-12"><img src="/assets/images/bri.png" alt="" class="thumb3"> Virtual Account / Transfer Bank</a>
                <a href="javascript:void(0)" bMetodeBayar="gopay" class="btn btn-full rounded-sm shadow-s color-black font-12"><img src="/assets/images/gopay.png" alt="" style="width: 50px;"></a>
            </div>
        </div>
    </div>
    <div class="content mb-5 mt-0 step3-4 d-none">
        <div class="p-2 pl-4 pr-4 text-center" style="height: 500px;">
            <h1 class="color-blue-light mb-0">Berhasil!</h1>
            <span class="color-green-light">Pembayaran kamu sudah diterima</span>
            <img src="/assets/images/sukses.png" alt="" width="300px">
            <p class="color-black">Tunggu ya! barang kamu sedang dijemput dalam waktu 2x24 jam</p>
            <div class="mb-4">
                <a href="/" class="btn btn-l bg-blue-dark rounded-sm shadow-s color-white font-12">OK!</a>
            </div>
        </div>
    </div>
    <?= form_hidden('ukuran', $transaksi['ukuran']); ?>
    <?= form_hidden('jumlah_hari', $tanggal['jumlah_hari']); ?>
    <?= form_hidden('diskon', $detailbayar['diskon']); ?>
    <?= form_hidden('bayar', $detailbayar['bayar']); ?>
    <?= form_hidden('total_bayar', $detailbayar['total_bayar']); ?>
</form>
<!-- tambah barang -->
<div id="menu-edit-alamat" class="menu menu-box-modal rounded-m bg-theme" data-menu-width="350" data-menu-height="250">
    <div class="menu-title">
        <h1 class="font-800" modal-title>Alamat</h1>
        <a href="#" class="close-menu"><i class="fa fa-times-circle"></i></a>
    </div>
    <div class="content" id="form-barang">
        <div class="input-style input-style-1">
            <input type="text" value="<?= $user['alamat']; ?>" placeholder="Tulis alamat kamu.." name="alamat" required>
        </div>
        <div class="text-center">
            <button type="button" id="btn-alamat" class="btn gradient-blue font-13 btn-m font-600 mt-3 rounded-s">Simpan</button>
        </div>
    </div>
</div>


<style>
    .thumb1 {
        object-fit: cover;
        width: 50px;
        height: 50px;
    }

    .thumb2 {
        object-fit: cover;
        width: 25px;
        height: 25px;
    }

    .thumb3 {
        /* object-fit: cover; */
        width: 30px;
    }

    .table>thead>tr>* {
        vertical-align: middle !important;
    }

    .border {
        border: 1px solid #2061C3 !important;
        padding: 8px;
        border-radius: 5px;
        width: 50%;
    }

    .coret {
        text-decoration: line-through;
    }
</style>
<?= $this->endSection(); ?>


<?= $this->section('script'); ?>
<script>
    let alamat_penerima = '<?= $user['alamat']; ?>';
    $(document).ready(function() {

        $("[name='mulai'], [name='selesai']").change(function(e) {
            e.preventDefault();
            let mulai = $("[name='mulai']").val();
            let selesai = $("[name='selesai']").val();
            let ukuran = $("[name='ukuran']").val();


            $.ajax({
                type: "get",
                url: "/simpan/transaksi-step3/" + <?= $transaksi['id_transaksi']; ?>,
                data: {
                    mulai: mulai,
                    selesai: selesai,
                    ukuran: ukuran
                },
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    $('[tanggal-mulai]').text(response.mulai);
                    $('[tanggal-selesai]').text(response.selesai);
                    $('[tanggal-info]').text(response.info);
                    $(".sebelum-diskon").removeClass('coret');
                    if (response.pembayaran.diskon > 0) {
                        $(".sebelum-diskon").addClass('coret').text('Rp' + response.pembayaran.bayar.toLocaleString('de-DE'));
                        $(".sesudah-diskon").show().text('Rp' + response.pembayaran.total_bayar.toLocaleString('de-DE'));
                    } else {
                        $(".sebelum-diskon").removeClass('coret').text('Rp' + response.pembayaran.total_bayar.toLocaleString('de-DE'));
                        $(".sesudah-diskon").hide().text('');
                    }
                }
            });
        });

        $("[bLanjut]").click(function(e) {
            e.preventDefault();
            let divClass = $(this).attr('bLanjut');
            if (divClass == 'step3-1') {
                $(".step3-1, .step3-3, .step3-4").addClass('d-none');
                $(".step3-2").removeClass('d-none');
            }

            if (divClass == 'step3-2') {
                if (alamat_penerima == '') {
                    notification('Opps..', 'Alamat tidak boleh kosong!')
                    return false;
                }
                $(".step3-1, .step3-2, .step3-4").addClass('d-none');
                $(".step3-3").removeClass('d-none');
            }
        });

        $("[bMetodeBayar]").click(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "/simpan/transaksi-step3-save/" + '<?= $transaksi['id_transaksi'] ?>',
                data: $("#form-input").serialize() + "&metode=" + $(this).attr('bMetodeBayar'),
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    $(".step3-1, .step3-2, .step3-3").addClass('d-none');
                    $(".step3-4").removeClass('d-none');
                    $(".header-fixed").addClass('d-none');
                }
            });
        });

        $('#btn-alamat').click(function(e) {
            e.preventDefault();
            alamat_penerima = $("[name='alamat']").val();
            if (alamat_penerima == '') {
                notification('Opps..', 'Alamat tidak boleh kosong!');
                return false;
            }

            $.ajax({
                type: "post",
                url: "/akun/alamat",
                data: {
                    alamat: alamat_penerima
                },
                dataType: "json",
                success: function(response) {
                    $(".alamat").text(alamat_penerima);
                    $(".close-menu").click();
                }
            });
        });
    });
</script>
<?= $this->endSection(); ?>