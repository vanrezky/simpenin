<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>
<div class="card" id="form-kirim">
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
        <div class="text-center mb-3"><small>Detail barang yang dikirim</small></div>
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
                                <span class="font-19 font-600 color-blue-dark"><?= $v['qty']; ?> | Pack</span>
                            </div>
                        </div>
                    </div>
                </a>
            <?php } ?>
        </div>
        <div class="divider mt-2"></div>
        <div>
            <div class="color-black ml-3 mb-5">
                <span><i class="fa fa-box" style="font-size:15px"></i> <span total-size><?= toUang($data['ukuran']); ?></span> <small>cm3</small></span><br />
                <span><i class="fa fa-bus" style="font-size:15px"></i> JNE YES</span>
                <p class="font-20 mb-1 color-blue-light">Rp <span total-harga><?= toUang($data['harga']); ?></span></p>
            </div>
        </div>
    </div>
    <div class="text-center">

        <a href="/kirim/lacak/<?= $data['id_kirim']; ?>" class="btn btn-l font-13 font-600 rounded-s shadow-l mb-4 gradient-highlight">Lacak</a>
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