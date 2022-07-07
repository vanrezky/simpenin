<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>

<div class="page-content">
    <div class="mb-4">
        <div class="divider mb-4"></div>
        <div class="d-flex content mt-0 mb-1">
            <!-- right side of profile. increase image width to increase column size-->
            <div>
                <a data-menu="menu-follow" href="javascript:void(0)"><img src="/assets/images/empty.png" data-src="<?= !empty($data['foto_profil']) ? '/uploads/images/' . $data['foto_profil'] : ''; ?>" width="85" height="85" class="rounded-circle mr-3 shadow-xl preload-img"></a>
            </div>
            <!-- left side of profile -->
            <div class="flex-grow-1">
                <h2 style="margin-top: 25px;"><?= character_limiter($data['nama'], 15); ?></h2>
            </div>
        </div>
        <div class="divider mb-3"></div>
        <div class="content">
            <h4 class="mb-3">Pengaturan Akun</h4>
            <p class="mb-n2"><b><a href="/akun/alamat">Alamat</a></b></p>
            <p class="opacity-60 font-12" style="margin-bottom: 5px;">Atur alamat penjemputan barang</p>
            <p class="mb-n2"><b><a href="#">Pembayaran Instan</a></b></p>
            <p class="opacity-60 font-12" style="margin-bottom: 5px;">E-wallet, kartu kredit & debit instan terdaftar</p>
            <p class="mb-n2"><b><a href="/akun/data">Data Pribadi</a></b></p>
            <p class="opacity-60 font-12">Ubah kata sandi, dan data diri</p>
            <p class="mt-3"><b><a href="/logout" class="color-red-dark">Keluar</a></b></p>
        </div>
    </div>
</div>

<!-- Follow Menu -->
<div id="menu-follow" class="menu menu-box-modal rounded-m" data-menu-width="300" data-menu-height="380">

    <div class="text-center">
        <img src="/assets/images/empty.png" data-src="<?= !empty($data['foto_profil']) ? '/uploads/images/' . $data['foto_profil'] : ''; ?>" width="150" height="150" class="mx-auto mt-4 rounded-circle preload-img">
        <p class="text-center font-15 mt-4"><?= $data['nama']; ?></p>
        <div class="divider mb-0"></div>
        <a href="javascript:void(0)" bImg class="color-red-dark font-15 font-600 text-center py-3 d-block">Ubah Foto</a>
        <div class="divider mb-0"></div>
        <a href="#" class="close-menu color-theme font-15 text-center py-3 d-block">Cancel</a>
    </div>
</div>

<form class="d-none" id="form-foto">
    <input type="file" name="foto_profil" iProfil>
</form>
<?= $this->endsection(); ?>

<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {
        $("[bImg]").click(function(e) {
            e.preventDefault();
            $("[iProfil]").click();
        });

        $('[iProfil]').change(function(e) {
            if ($(this)[0].files.length !== 0) {
                $("#form-foto").submit();
            }
        });

        $("#form-foto").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "/akun",
                data: new FormData(this),
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false,
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        notification('Sukses..', response.message);
                        location.reload(false);
                    } else {
                        notification('Opps..', response.message);
                    }
                    return
                }
            });
        });

    });
</script>
<?= $this->endSection(); ?>