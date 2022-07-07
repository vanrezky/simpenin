<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>
<div class="page-content">

    <div class="content mt-0 mb-4">
        <div class="search-box search-dark shadow-xl border-0 bg-theme rounded-m bottom-0">
            <i class="fa fa-search"></i>
            <input type="text" class="border-0" placeholder="Cari gudang disini.." data-search>
        </div>
        <div class="search-results disabled">
            <?php

            foreach ($gudang as $key => $value) {
                $keyword = $value['nama_gudang'] . ' ' . $value['alamat'];
            ?>

                <a href="/simpan/detail/<?= $value['id_gudang']; ?>" data-filter-item data-filter-name="<?= implode(' ', array_unique(explode(' ', strtolower($keyword)))); ?>">
                    <div class="d-flex mt-4">
                        <div class="align-self-center">
                            <img src="/uploads/images/<?= $value['gambar']; ?>" class="rounded-m mr-3" width="80">
                        </div>
                        <div class="align-self-center">
                            <h2 class="font-15 line-height-s mt-1 mb-n1"><?= $value['nama_gudang']; ?></h2>
                            <p class="mb-0 font-11 mt-2 line-height-s">
                                <i class="fa fa-map color-brown-dark pr-2"></i><?= $value['alamat']; ?>
                            </p>
                        </div>
                    </div>
                </a>
            <?php } ?>

        </div>
        <div class="search-no-results disabled mt-4">
            <div class="card card-style mx-0">
                <div class="content">
                    <p class="mb-n1 font-600 color-highlight">Maaf..</p>
                    <h1>Tidak ditemukan</h1>
                    <p>
                        Maaf gudang yang anda cari tidak ada di database kami!
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Only required for Food Slider-->
    <style>
        .owl-carousel.visible-slider .owl-stage {
            overflow: hidden !important;
        }

        .owl-carousel.visible-slider .owl-stage-outer {
            overflow: visible !important;
        }

        .owl-carousel.visible-slider {
            padding-right: 80px !important;
        }
    </style>
    <div class="content mb-0">
        <div class="d-flex">
            <div class="align-self-center">
                <h1 class="mb-0 font-18">Rekomendasi</h1>
            </div>
        </div>
        <div class="row mb-0">

            <?php
            $html = '';
            $totalRekomendasi = count($rekomendasi);
            foreach ($rekomendasi as $key => $value) {

                $pr = 'padding-left: 7px;';
                if (($key + 1) % 2 != 0) {
                    $pr = 'padding-right: 7px;';
                }

                $html .= '<div class="col-6" style="' . $pr . '">
                            <div class="card card-style mx-0 mb-2 gudangClick" style="background-image:url(/uploads/images/' . $value['gambar'] . ');" data-card-height="170" data-link="/simpan/detail/' . $value['id_gudang'] . '">
                                <div class="card-bottom p-3">
                                <h2 class="color-white">' . character_limiter($value['nama_gudang'], 20) . '</h2>
                                    <p class="color-white opacity-60 line-height-s">
                                        ' . character_limiter($value['alamat'], 20) . '
                                    </p>
                                </div>
                                <div class="card-overlay bg-gradient opacity-20"></div>
                                <div class="card-overlay bg-gradient"></div>
                            </div>
                        </div>';
            }

            echo $html;
            ?>
        </div>
    </div>

    <div class="content mt-5 mb-0">
        <div class="d-flex">
            <div class="align-self-center">
                <h1 class="mb-0 font-18">Gudang</h1>
            </div>
        </div>
    </div>
    <div class="double-slider owl-carousel owl-no-dots">
        <?php foreach ($gudang as $key => $value) {

            if ($key == 4) {
                break;
            }
        ?>
            <div class="card m-0 card-style gudangClick" data-link="/simpan/detail/<?= $value['id_gudang']; ?>">
                <img src="/uploads/images/<?= $value['gambar']; ?>" class="img-fluid">
                <div class="p-2 bg-theme rounded-sm">
                    <div class="d-flex">
                        <div>
                            <h4 class="mb-n1 font-14 line-height-xs pb-2"><?= $value['nama_gudang']; ?></h4>
                        </div>
                    </div>
                    <p class="font-9 mb-0"><?= character_limiter($value['alamat'], 20); ?> . </p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {
        $(".gudangClick").click(function(e) {
            e.preventDefault();
            location.href = $(this).data('link');
        });
    });
</script>
<?= $this->endSection(); ?>