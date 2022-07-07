<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>

<div class="card">
    <div class="content mt-2">
        <div class="text-center">
            <img src="/uploads/images/<?= $data['gambar']; ?>" alt="img" class="img-fluid rounded-s shadow-xl" style="max-width: 120px;">
            <h6 class="mt-2 mb-0"><?= $data['nama_gudang']; ?></h6>
            <small><?= $data['alamat']; ?></small>
        </div>
        <?php $fasilitas = json_decode($data['fasilitas'], true); ?>
        <div class="selectgroup w-100 mb-0">
            <?php
            if (in_array('Rutin Dibersihkan', $fasilitas)) {
                echo '<label class="selectgroup-item">
                        <input type="checkbox" id="checkbox1" class="selectgroup-input" readonly disabled>
                        <label class="selectgroup-button selectgroup-button-icon" for="checkbox1"><i class="fa fa-broom"></i>
                            <small>Rutin Dibersihin</small>
                        </label>
                    </label>';
            }

            if (in_array('CCTV 24 Jam', $fasilitas)) {
                echo '<label class="selectgroup-item">
                        <input type="checkbox" id="checkbox2" class="selectgroup-input" readonly disabled>
                        <label class="selectgroup-button selectgroup-button-icon" for="checkbox2"><i class="fas fa-camera"></i>
                            <small>CCTV 24 Jam</small>
                        </label>
                    </label>';
            }

            if (in_array('Lokasi Strategis', $fasilitas)) {
                echo '<label class="selectgroup-item">
                        <input type="checkbox" id="checkbox" class="selectgroup-input" readonly disabled>
                        <span class="selectgroup-button selectgroup-button-icon" for="checkbox3"><i class="fa fa-map"></i>
                            <small>Lokasi Strategis</small>
                        </span>
                    </label>';
            }

            ?>



        </div>
        <div>
            <div class="d-flex mr-5 ml-5 mb-4">
                <div class="align-self-center mr-2">
                    <a href="/simpan/transaksi-step1/<?= $data['id_gudang']; ?>?kirim=<?= $data['id_transaksi']; ?>"><b>Tambah Barang</b></a>
                </div>
                <div class="ml-auto align-self-center">
                    <a href="/kirim/kirim/<?= $data['id_transaksi']; ?>"><b>Kirim Barang</b></a>
                </div>
            </div>

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
                                    <span class="font-17 font-600 color-blue-dark"><?= $v['qty']; ?> | <?= $v['satuan']; ?></span>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>


    </div>
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
        font-size: 17px;
        border: 0px;
        border-color: aliceblue;
    }
</style>
<?= $this->endSection(); ?>


<?= $this->section('script'); ?>
<?= $this->endSection(); ?>