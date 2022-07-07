<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>
<?= session('message'); ?>
<div class="card">

    <div class="content mt-2 mb-5">
        <div class="text-center">
            <img src="/uploads/images/<?= $gudang['gambar']; ?>" alt="img" class="img-fluid rounded-s shadow-xl" style="max-width: 150px;">
            <h4 class="mb-0"><?= $gudang['nama_gudang']; ?></h4>
            <small><?= $gudang['alamat']; ?></small>
        </div>
        <div class="divider mb-2"></div>
        <div class="text-center mb-3"><small>Masukkan barang barang yang mau kamu simpen</small></div>
        <div class="row" id="kumpulan-barang">
            <?php
            $total_sub_transaksi = 0;
            if (!empty($transaksi)) {
                foreach ($transaksi['detail'] as $k => $v) {
                    $total_sub_transaksi += $v['panjang'] * $v['lebar'] * $v['tinggi'];
                    echo '<a href="javascript:void(0)" class="col-4 mb-4 text-center" detailBarang="' . $v['id_transaksi_detail'] . '">
                    <img src="/uploads/images/' . $v['gambar'] . '" alt="" class="img-fluid thumb1 rounded-circle shadow-xl">
                    <small class="color-black">' . $v['nama_barang'] . '</small>
                </a>';
                }
            }
            ?>
        </div>
        <div class="divider mt-5"></div>
        <div class="text-center">
            <p class="mb-2">Total Size (cm3):<br>
                <b total-size><?= toUang(round($total_sub_transaksi, 2)); ?></b>
            </p>
            <a href="/simpan/transaksi-step2/<?= $transaksi['id_transaksi'] . (!empty($kirim) ? "?kirim=$kirim" : '') ?>" class="btn btn-l font-13 font-600 rounded-s shadow-l mb-4 gradient-highlight">Lanjut</a>
        </div>
    </div>
</div>

<!-- tambah barang -->
<div id="menu-add-item" class="menu menu-box-modal rounded-m bg-theme" data-menu-width="350" data-menu-height="480">
    <div class="menu-title">
        <h1 class="font-800" modal-title>Tambah Barang</h1>
        <a href="#" class="close-menu"><i class="fa fa-times-circle"></i></a>
    </div>
    <form class="content" id="form-barang">
        <?= form_hidden('id_transaksi', $transaksi['id_transaksi']); ?>
        <div class="text-center">
            <a href="javascript:void(0)" btnImgUpload=""><img src="/assets/images/upload.png" imgUpload id="img-preview-1" class="thumb1 rounded-circle" alt=""></a>
            <div class="d-none">
                <input type="file" name="gambar" class="custom-file-input" id="gambar" onchange="previewImg('#gambar', '.label-preview-1', '#img-preview-1')">
            </div>
        </div>
        <div class="divider"></div>
        <div class="input-style input-style-2">
            <span class="input-style-1-active">Nama Barang</span>
            <input type="text" value="" name="nama_barang" required>
        </div>
        <div class="row mb-0">
            <div class="col-4">
                <div class="input-style input-style-2">
                    <span class="input-style-1-active color-highlight">panjang</span>
                    <input class="form-control" type="number" name="panjang" required>
                </div>
            </div>
            <div class="col-4">
                <div class="input-style input-style-2">
                    <span class="input-style-1-active color-highlight">Lebar</span>
                    <input class="form-control" type="number" name="lebar" required>
                </div>
            </div>
            <div class="col-4">
                <div class="input-style input-style-2">
                    <span class="input-style-1-active color-highlight">Tinggi</span>
                    <input class="form-control" type="number" name="tinggi" required>
                </div>
            </div>
        </div>
        <div class="input-style input-style-2">
            <span class="input-style-1-active">Catatan</span>
            <input type="text" value="" name="catatan">
        </div>
        <div class="text-center">
            <span style="font-weight: thin;">Size (cm3)</span>
            <h3 total></h3>
        </div>
        <div class="text-center">
            <button type="submit" class="btn gradient-blue font-13 btn-m font-600 mt-3 rounded-s">Simpan</button>
        </div>
    </form>
</div>

<!-- detail barang -->
<div id="menu-detail-item" class="menu menu-box-modal rounded-m bg-theme" data-menu-width="350" data-menu-height="480">
    <div class="menu-title">
        <h1 class="font-800">Detail Barang</h1>
        <a href="#" class="close-menu"><i class="fa fa-times-circle"></i></a>
    </div>
    <form class="content" id="form-detail">
        <?= form_hidden('id_transaksi', $transaksi['id_transaksi']); ?>
        <?= form_hidden('id_transaksi_detail', ''); ?>
        <div class="text-center">
            <a href="javascript:void(0)" btnImgUpload="1"><img src="/assets/images/upload.png" imgUpload id="img-preview-2" class="thumb1 rounded-circle" alt=""></a>
            <div class="d-none">
                <input type="file" name="gambar" class="custom-file-input" id="gambar1" onchange="previewImg('#gambar1', '.label-preview-2', '#img-preview-2')">
            </div>
        </div>
        <div class="divider"></div>
        <div class="input-style input-style-2">
            <span class="input-style-1-active">Nama Barang</span>
            <input type="text" value="" name="nama_barang" required>
        </div>
        <div class="row mb-0">
            <div class="col-4">
                <div class="input-style input-style-2">
                    <span class="input-style-1-active color-highlight">panjang</span>
                    <input class="form-control" type="number" name="panjang" required>
                </div>
            </div>
            <div class="col-4">
                <div class="input-style input-style-2">
                    <span class="input-style-1-active color-highlight">Lebar</span>
                    <input class="form-control" type="number" name="lebar" required>
                </div>
            </div>
            <div class="col-4">
                <div class="input-style input-style-2">
                    <span class="input-style-1-active color-highlight">Tinggi</span>
                    <input class="form-control" type="number" name="tinggi" required>
                </div>
            </div>
        </div>
        <div class="input-style input-style-2">
            <span class="input-style-1-active">Catatan</span>
            <input type="text" value="" name="catatan">
        </div>
        <div class="text-center">
            <span style="font-weight: thin;">Size (cm3)</span>
            <h3 total></h3>
        </div>
        <div class="text-center">
            <button type="submit" class="btn gradient-blue font-13 btn-m font-600 mt-3 rounded-s">Perbarui</button>
            <button type="button" onclick="hapusBarang(this)" class="btn gradient-yellow font-13 btn-m font-600 mt-3 rounded-s">Hapus</button>
        </div>
    </form>
</div>

<!-- clickerrr -->
<a href="javascript:void(0)" id="clicker-detail" data-menu="menu-detail-item"></a>
<style>
    .thumb1 {
        object-fit: cover;
        width: 80px;
        height: 80px;
    }
</style>
<?= $this->endSection(); ?>


<?= $this->section('script'); ?>
<script>
    const defaultImg = '/assets/images/upload.png';
    $(document).ready(function() {

        setInputan(); //init untuk pertama kali..

        $(document).on('click', "[tambahBarang]", function(e) {
            e.preventDefault();
            setToDefault();
        });

        $("[name='tinggi'],[name='panjang'],[name='lebar']").on('keyup', function(e) {
            hitung($(this).closest('form'));
        });

        $("[btnImgUpload]").click(function(e) {
            let id = $(this).attr('btnImgUpload');
            $("#gambar" + id).click();
        });


        $("#form-barang").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "/simpan/transaksi-save",
                data: new FormData(this),
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false,
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        notification('Sukses..', response.message);
                        const tambahBarang = $("[tambahBarang]");
                        tambahBarang.removeAttr('data-menu');

                        tambahBarang.find('img').attr('src', response.data.gambar);
                        tambahBarang.find('small').append(response.data.nama);
                        tambahBarang.removeAttr('tambahBarang');
                        tambahBarang.attr('detailBarang', response.data.id);
                        $("[total-size]").text(response.data.ukuran.toLocaleString('de-DE'));
                        $(".close-menu").click();
                        setInputan();
                    } else {
                        notification('Opps..', response.message, response.info_lanjut);
                    }
                    return
                }
            });
        });


        $("#form-detail").submit(function(e) {
            let id = $(this).find('[name="id_transaksi_detail"]').val();

            e.preventDefault();
            $.ajax({
                type: "post",
                url: "/simpan/transaksi-save",
                data: new FormData(this),
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false,
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        notification('Sukses..', response.message);
                        const detailBarang = $("[detailBarang='" + id + "']");
                        detailBarang.find('img').attr('src', response.data.gambar);
                        detailBarang.find('small').text(response.data.nama);
                        $("[total-size]").text(response.data.ukuran.toLocaleString('de-DE'));
                        $(".close-menu").click();
                    } else {
                        notification('Opps..', response.message, response.info_lanjut);
                    }
                    return
                }
            });
        });


        $(document).on('click', '[detailBarang]', function() {
            let id = $(this).attr('detailBarang');
            let form = $("#form-detail");

            $.ajax({
                type: "get",
                url: "/simpan/barang-detail/" + id,
                dataType: "json",
                success: function(response) {
                    form.find('[imgUpload]').attr('src', response.gambar);
                    form.find('[name="id_transaksi_detail"]').val(response.id_transaksi_detail);
                    form.find('[name="nama_barang"]').val(response.nama_barang);
                    form.find('[name="catatan"]').val(response.catatan);
                    form.find('[name="panjang"]').val(response.panjang);
                    form.find('[name="lebar"]').val(response.lebar);
                    form.find('[name="tinggi"]').val(response.tinggi);
                    form.find('[total]').text(response.total.toLocaleString('de-DE'));
                    $("#clicker-detail").click();
                }
            });
        });
    });

    function setToDefault() {
        $("[imgUpload]").attr('src', defaultImg);
        $("[name='nama_barang']").val('');
        $("[name='catatan']").val('');
        $("[name='panjang']").val('');
        $("[name='lebar']").val('');
        $("[name='tinggi']").val('');
        $("#gambar").val('');
        $("[total]").text('');
    }

    function hitung(form) {

        let panjang = form.find("[name='panjang']").val(),
            lebar = form.find("[name='lebar']").val();
        tinggi = form.find("[name='tinggi']").val();
        // if (panjang == '') return
        // if (lebar == '') return
        // if (tinggi == '') return

        let total = panjang * lebar * tinggi;

        console.log(total);
        form.find("[total]").text(total.toLocaleString('de-DE'));
    }

    function setInputan() {
        let html = `<a href="javascript:void(0)" class="col-4 mb-4" data-menu="menu-add-item" tambahBarang>
                    <img src="/assets/images/upload.png" alt="" class="thumb1 img-fluid rounded-circle shadow-xl">
                    <small class="color-black"></small>
                </a>`;

        $("#kumpulan-barang").append(html);
        return;
    }

    function hapusBarang(btn) {
        if (confirm('Yakin hapus barang ini?')) {
            let id = $(btn).closest('#form-detail').find('[name="id_transaksi_detail"]').val();
            $.ajax({
                type: "post",
                url: "/simpan/barang-hapus/" + id,
                dataType: "json",
                success: function(response) {
                    notification('Sukses..', response.message);
                }
            });
            $(`[detailBarang="${id}"]`).remove();
            $(".close-menu").click();
        }
    }
</script>
<?= $this->endSection(); ?>