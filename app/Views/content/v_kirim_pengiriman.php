<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>
<div class="card" id="form-kirim">
    <div class="content mt-2 mb-5 step1 ml-4 mr-4">
        <div id="kumpulan-barang">
            <?php foreach ($data as $k => $v) { ?>
                <a class="d-flex mb-2" href="/kirim/pengiriman-detail/<?= $v['id_kirim']; ?>">
                    <div class="align-self-center color-black mr-1" style="font-size: 30px;">
                        <span><i class="fa fa-box"></i></span>
                    </div>
                    <div class="align-self-center">
                        <h2 class="font-12 line-height-s mt-1 mb-n1">Rumah <span><?= $v['penerima'] ?></span></h2>
                        <span class="mb-0 font-11 mt-0" alamat-penerima><?= $v['alamat']; ?></span>
                    </div>
                    <div class="ml-auto align-self-center" style="font-size: 20px;">
                        <a href="javascript:void(0)" data-menu="menu-alamat-item"><i class="fa fa-send"></i></a>
                    </div>
                </a>
                <div class="divider mb-2"></div>

            <?php } ?>
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