<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>
<div class="card card-fixed" style="background-image:url(/uploads/images/<?= $data['gambar']; ?>); margin-top:-40px;" data-card-height="350">
</div>
<div class="card card-clear" data-card-height="350"></div>
<div class="card card-full rounded-l pb-4">
    <div class="content mt-3">
        <div class="d-flex mb-3">
            <div class="align-self-center">
                <img src="/uploads/images/<?= $data['gambar']; ?>" width="45" class="rounded-sm shadow-xl mr-2">
            </div>
            <div class="align-self-center">
                <h1 class="font-15 mb-0"><?= $data['nama_gudang']; ?></h1>
                <p class="mb-0 mt-n2 font-10 opacity-50"><i class="fa fa-map-marker pr-1"></i> <?= $data['alamat']; ?></p>
            </div>
        </div>
        <?php $fasilitas = json_decode($data['fasilitas'], true); ?>

        <div class="selectgroup w-100">
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
        <div class="divider mb-2"></div>
        <div class="progress rounded-l" style="height:28px">
            <?php
            $persentase = round(($total / $data['luas']) * 100, 2);
            $sisa_persentase = 100 - $persentase;
            ?>
            <div class="progress-bar <?= $persentase > 0 ? 'progress-bar-striped bg-highlight text-left pl-3 color-white' : ''; ?>" role="progressbar" style="width:<?= $persentase ?>%" aria-valuenow="<?= $sisa_persentase ?>" aria-valuemin="0" aria-valuemax="100">
                <?= $persentase ?>%
            </div>

        </div>
        <p class="mb-4 font-11 text-center"><?= $sisa_persentase ?>% Tersisa</p>
        <h4>Deskripsi</h4>
        <p><?= $data['deskripsi']; ?></p>
    </div>

    <div class="text-center">
        <a href="/simpan/transaksi-step1/<?= $data['id_gudang']; ?>" class="btn mr-3 ml-3 btn-l font-13 font-600 rounded-s shadow-l mb-4 gradient-highlight">Pilih Gudang</a>
    </div>

    <div class="divider divider-margins"></div>
</div>
<?= $this->endSection(); ?>