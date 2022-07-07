<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>
<div class="card">
    <div class="content">
        <?php if (empty($data)) {
            echo pesan('Info|Anda belum memiliki gudang silahkan tambahkan terlebih dahulu', 'warning');
        } else {

            foreach ($data as $key => $value) { ?>
                <a href="/kirim/detail/<?= $value['id_transaksi']; ?>" class="d-flex <?= !empty($value['jumlah_kirim']) ? '' : 'mb-3'; ?>">
                    <div class="align-self-center">
                        <img src="/uploads/images/<?= $value['gambar']; ?>" class="rounded-s mr-3 thumb1">
                    </div>
                    <div class="align-self-center">
                        <h2 class="font-15 line-height-s mt-0 mb-0 "><?= $value['nama_gudang']; ?></h2>
                        <p class='mb-0 font-9 line-height-s'><?= $value['alamat']; ?></p>
                    </div>
                    <div class="ml-auto align-self-center">
                        <p class='mb-0 font-9'><?= $value['jumlah_barang']; ?> Barang</p>
                    </div>
                </a>
                <?php
                if ($value['jumlah_kirim'] > 0) {
                    echo "<a href='/kirim/pengiriman/$value[id_transaksi]'><small>" . toUang($value['jumlah_kirim']) . " barang sedang dikirim</small></a>";
                }
                ?>

                <div class="divider"></div>
        <?php }
        }  ?>
    </div>
</div>

<style>
    .thumb1 {
        object-fit: cover;
        width: 70px;
        height: 40px;
    }
</style>
<?= $this->endSection(); ?>