<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>
<div class="card">
    <div class="content mt-2 mb-5">
        <div>
            <div class="d-flex mb-4">
                <div class="align-self-center">
                    <img src="/uploads/images/<?= $gudang['gambar']; ?>" class="rounded-s mr-3 thumb1">
                </div>
                <div class="align-self-center">
                    <h2 class="font-16 line-height-s mt-1 mb-n1"><?= $gudang['nama_gudang']; ?></h2>
                    <p class="mb-0 font-11 mt-2"><?= $gudang['alamat']; ?></p>
                </div>
            </div>
        </div>
        <div class="divider mb-2"></div>
        <div class="text-center mb-3"><small>Masukkan kuantiti barang barang kamu</small></div>
        <div id="kumpulan-barang">

            <?php foreach ($transaksi['detail'] as $k => $v) {
                $luas_digunakan = $v['panjang'] * $v['lebar'] * $v['tinggi'] * $v['qty'];
            ?>
                <a href="javascript:void(0)">
                    <div class="d-flex mb-4">
                        <div class="align-self-center">
                            <img src="/uploads/images/<?= $v['gambar']; ?>" class="rounded-circle mr-3 thumb1">
                        </div>
                        <div class="align-self-center">
                            <h2 class="font-16 line-height-s mt-1 mb-n1"><?= $v['nama_barang'] ?></h2>
                            <p class="mb-0 font-11 mt-2"><?= toUang($luas_digunakan); ?></p>
                        </div>
                        <div class="ml-auto pl-3 align-self-center row">
                            <div class="rounded-s switch-s mr-2">
                                <input type="number" name="qty" min="1" value="<?= $v['qty']; ?>" class="input-qty color-blue-dark" data-id="<?= $v['id_transaksi_detail']; ?>" data-luas="<?= $luas_digunakan; ?>">
                                <span class="font-17 font-600 color-blue-dark">| <?= $v['satuan']; ?></span>
                            </div>
                        </div>
                    </div>
                </a>
            <?php } ?>

        </div>
        <div class="divider mt-5"></div>
        <div class="text-center">
            <p class="mb-2">Total Size (cm3):<br>
                <b total-size><?= toUang($transaksi['ukuran']); ?></b>
            </p>
            <a href="/simpan/transaksi-step3/<?= $transaksi['id_transaksi'] . (!empty($kirim) ? "?kirim=$kirim" : '') ?> " class="btn btn-l font-13 font-600 rounded-s shadow-l mb-4 gradient-highlight">Lanjut</a>
        </div>
    </div>
</div>

<!-- clickerrr -->
<a href="javascript:void(0)" id="clicker-detail" data-menu="menu-detail-item"></a>
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
<script>
    const defaultImg = '/assets/images/upload.png';
    let total_size = <?= $transaksi['ukuran']; ?>;
    $(document).ready(function() {
        $("[name='qty']").on('keyup', function(e) {
            // hitung($(this).closest('form'));
            let input = $(this);
            let total_size = hitung(input);

            if (total_size != '') {
                id = input.data('id');
                $.ajax({
                    type: "post",
                    url: "/simpan/transaksi-step2-save/" + id,
                    data: {
                        qty: input.val(),
                        ukuran: total_size
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success === false) {
                            notification('Opps..', response.message);
                        }
                    }
                });
            }
        });
    });


    function hitung(input) {
        if (input.val() < 1) {
            return '';
        }
        total_size = 0;
        $("[name='qty']").each(function(e) {
            total_size += $(this).data('luas') * $(this).val();
        })

        $("[total-size]").text(total_size.toLocaleString('de-DE'));

        return total_size;
    }
</script>
<?= $this->endSection(); ?>