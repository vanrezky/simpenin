<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>

<div class="page-content">
    <div class="card card-style">
        <div class="content">
            <h4><?= $title; ?></h4>
            <p>
                isi semua inputan yang diperlukan ya..
            </p>

            <div class="mt-5 mb-3">
                <form action="/gudang/save" id="form-data">
                    <?php
                    if (!empty($data)) {
                        echo form_hidden('id_gudang', $data['id_gudang']);
                    }
                    ?>
                    <div class="text-center mb-3">
                        <a href="javascript:void(0)" id="b-img"><img src="<?= empty($data['gambar']) ? '/assets/images/upload.png' : '/uploads/images/' . $data['gambar']; ?>" id="img-preview-1" alt="upload images" width="200" class="img-thumbnail"></a>
                        <div class="d-none">
                            <input type="file" name="gambar" class="custom-file-input" id="gambar" onchange="previewImg('#gambar', '.label-preview-1', '#img-preview-1')">
                        </div>
                    </div>
                    <div class="input-style input-style-2">
                        <span class="input-style-1-active">Nama Gudang</span>
                        <input type="text" placeholder="Nama Gudang" value="<?= isset($data['nama_gudang']) ? $data['nama_gudang'] : ''; ?>" name="nama_gudang">
                    </div>
                    <div class="input-style input-style-2">
                        <span class="input-style-1-active">Alamat</span>
                        <input type="text" placeholder="Alamat" value="<?= isset($data['alamat']) ? $data['alamat'] : ''; ?>" name="alamat">
                    </div>
                    <div class="divider mb-5"></div>
                    <h5>Fasilitas Gudang</h5>

                    <?php
                    $fasilitas = [];
                    if (isset($data['fasilitas'])) {
                        $fasilitas = json_decode($data['fasilitas'], true);
                    }

                    ?>
                    <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                            <input type="checkbox" name="fasilitas[]" value="Rutin Dibersihkan" id="checkbox1" <?= in_array('Rutin Dibersihkan', $fasilitas) ? 'checked' : ''; ?> class="selectgroup-input">
                            <label class="selectgroup-button selectgroup-button-icon" for="checkbox1"><i class="fa fa-broom"></i>
                                <small>Rutin Dibersihin</small>
                            </label>
                        </label>
                        <label class="selectgroup-item">
                            <input type="checkbox" name="fasilitas[]" value="CCTV 24 Jam" id="checkbox2" <?= in_array('CCTV 24 Jam', $fasilitas) ? 'checked' : ''; ?> class="selectgroup-input">
                            <label class="selectgroup-button selectgroup-button-icon" for="checkbox2"><i class="fas fa-camera"></i>
                                <small>CCTV 24 Jam</small>
                            </label>
                        </label>
                        <label class="selectgroup-item">
                            <input type="checkbox" name="fasilitas[]" value="Lokasi Strategis" id="checkbox" <?= in_array('Lokasi Strategis', $fasilitas) ? 'checked' : ''; ?> class="selectgroup-input">
                            <span class="selectgroup-button selectgroup-button-icon" for="checkbox3"><i class="fa fa-map"></i>
                                <small>Lokasi Strategis</small>
                            </span>
                        </label>
                    </div>
                    <h5>Luas Penyimpanan</h5>
                    <div class="row">
                        <div class="col-7">
                            <div class="input-style input-style-2 mt-2">
                                <span class="input-style-1-active">Luas Gudang</span>
                                <em class="color-red-light" style="font-size: 12px;">cm3</em>
                                <input type="text" placeholder="Luas Gudang" value="<?= isset($data['luas']) ? $data['luas'] : ''; ?>" name="luas">
                            </div>
                        </div>
                    </div>

                    <div class="input-style input-style-2">
                        <span class="input-style-1-active">Deskripsi Gudang</span>
                        <textarea name="deskripsi" id="" style="height: 100px;" placeholder="Deskripsi Gudang"><?= isset($data['deskripsi']) ? $data['deskripsi'] : ''; ?></textarea>
                    </div>

                </form>
            </div>

            <a href="javascript:void(0)" bSimpan class="btn btn-full btn-m gradient-highlight rounded-s font-13 font-600 mt-4">Simpan</a>
        </div>
    </div>
</div>
<?= $this->endsection(); ?>

<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {
        $("#b-img").click(function(e) {
            e.preventDefault();
            console.log('click upload');
            $("#gambar").click();
        });
        $("[bSimpan]").click(function(e) {
            e.preventDefault();
            $("#form-data").submit();
        });

        $("#form-data").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "/gudang/save",
                data: new FormData(this),
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false,
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        notification('Sukses..', response.message);
                        location.href = '/gudang';
                    } else {
                        notification('Opps..', response.message, response.info_lanjut);
                    }
                    return
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('ada error, ' + errorThrown);
                }
            });
        });
    });
</script>
<?= $this->endsection(); ?>