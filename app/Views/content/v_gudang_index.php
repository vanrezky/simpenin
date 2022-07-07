<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>
<div class="card card-style">
    <div class="content">
        <p class="mb-n1 color-highlight font-600"></p>
        <h1 class="font-24 font-800 mb-0">Gudang</h1>
        <p>
            Daftar gudang yang kamu punya
        </p>

        <form class="form-inline">
            <input class="form-control mr-2" style="max-width:150px" type="search" name="q" value="<?= $q; ?>" placeholder="Search" aria-label="Search">
            <button class="btn btn-m btn-success my-2 my-0 mr-1" type="submit"><i class="fa fa-search"></i></button>
            <a href="/gudang/add" class="btn btn-m bg-blue-dark"><i class="fa fa-plus"></i></a>
        </form>

        <?php if (empty($data)) {
            echo pesan('Info|Anda belum memiliki gudang silahkan tambahkan terlebih dahulu', 'warning');
        } else {

            foreach ($data as $key => $value) { ?>
                <div class="d-flex mb-4">
                    <div class="align-self-center">
                        <img src="/uploads/images/<?= $value['gambar']; ?>" class="rounded-s mr-3" width="100">
                    </div>
                    <div class="align-self-center">
                        <h2 class="font-15 line-height-s mt-1 mb-2 "><?= $value['nama_gudang']; ?></h2>
                        <?php
                        $fasilitas = json_decode($value['fasilitas'], true);
                        echo "<p class='mb-0 font-11 line-height-s'><i class='fa fa-map color-info-dark pr-2'></i> Luas $value[luas] cm3</p>";
                        foreach ($fasilitas as $k => $v) {
                            if ($v == 'Rutin Dibersihkan') {
                                echo "<p class='mb-0 font-11 line-height-s'><i class='fa fa-broom color-green-dark pr-2'></i> $v</p>";
                            }

                            if ($v == 'CCTV 24 Jam') {
                                echo "<p class='mb-0 font-11 line-height-s'><i class='fa fa-camera color-brown-dark pr-2'></i> $v</p>";
                            }

                            if ($v == 'Lokasi Strategis') {
                                echo "<p class='mb-0 font-11 line-height-s'><i class='fa fa-map color-blue-dark pr-2'></i> $v</p>";
                            }
                        }

                        ?>
                    </div>
                    <div class="ml-auto pl-3 align-self-center text-center">
                        <a href="/gudang/edit/<?= $value['id_gudang']; ?>"><i class="fa fa-edit"></i> Edit</a>
                    </div>
                </div>
        <?php }
        }  ?>
    </div>
</div>
<?= $this->endSection(); ?>