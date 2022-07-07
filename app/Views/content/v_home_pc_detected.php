<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>
<div data-card-height="231" class="card card-style bg-13 show-no-device" style="height: 231px;">
    <div class="card-center">
        <h1 class="text-center mb-3"><i class="fa fa-2x fa-frown color-red-light"></i></h1>
        <h1 class="text-center color-white bolder font-20 mb-1">Bukan Mobile Terdeteksi</h1>
        <p class="pl-5 pr-5 text-center color-white opacity-90 mb-0">
            Silahkan gunakan smartphone anda untuk pengalaman lebih baik
        </p>
    </div>
    <div class="card-overlay bg-black opacity-80"></div>
</div>

<?= $this->endSection() ?>