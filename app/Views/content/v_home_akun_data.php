<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>

<div class="page-content">
    <div class="card card-style">
        <div class="content">
            <h4>Data Pribadi</h4>
            <p>
                Ubah data pribadi atau ubah password secara berkala
            </p>

            <div class="mt-5 mb-3">
                <form action="" id="form-data">
                    <div class="input-style input-style-2 mb-3 pb-1">
                        <span class="input-style-1-active">Username</span>
                        <input type="text" placeholder="Username" value="<?= $data['username']; ?>" name="username" readonly disabled>
                    </div>
                    <div class="input-style input-style-2 mb-3 pb-1">
                        <span class="input-style-1-active">Nama Lengkap</span>
                        <input type="text" placeholder="Nama Lengkap" value="<?= $data['nama']; ?>" name="nama" required>
                    </div>
                    <div class="input-style input-style-2 mb-3 pb-1">
                        <span class="input-style-1-active">Email</span>
                        <input type="email" placeholder="email" value="<?= $data['email']; ?>" name="email" required>
                    </div>
                    <div class="input-style input-style-2 mb-3 pb-1">
                        <span class="input-style-1-active">No. Telepon</span>
                        <input type="text" placeholder="0822..." value="<?= $data['telp']; ?>" name="telp" required>
                    </div>
                    <div class="input-style input-style-2 mb-3 pb-1">
                        <span class="input-style-1-active">Tempat Lahir</span>
                        <input type="text" placeholder="Tempat Lahir" value="<?= $data['tempat_lahir']; ?>" name="tempat_lahir" required>
                    </div>
                    <div class="input-style input-style-2 mb-3 pb-1">
                        <span class="input-style-1-active">Tanggal Lahir</span>
                        <input type="date" placeholder="" value="<?= $data['tanggal_lahir']; ?>" name="tanggal_lahir" required>
                    </div>

                    <div class="divider mb-3"></div>
                    <div class="alert alert-small bg-yellow-dark" role="alert">
                        <p class="color-white">Kosongkan, jika tidak merubah password</p>
                    </div>
                    <div class="input-style input-style-2 mb-3 pb-1">
                        <span class="input-style-1-active">Password</span>
                        <input type="password" placeholder="password" value="" name="password">
                    </div>
                    <div class="input-style input-style-2 mb-3 pb-1">
                        <span class="input-style-1-active">Konfirmasi Password</span>
                        <input type="password" placeholder="password" value="" name="password2">
                    </div>
                </form>
            </div>

            <a href="javascript:void(0)" bSimpan class="btn btn-full btn-m gradient-highlight rounded-s font-13 font-600 mt-4">Simpan</a>
        </div>
    </div>
</div>
<?= $this->endsection(); ?>

<?= $this->section('script'); ?>
<script>
    $("[bSimpan]").click(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: "/akun/data",
            data: $("#form-data").serialize(),
            dataType: "json",
            success: function(response) {

                if (response.success) {
                    notification('Sukses..', response.message);
                } else {
                    notification('Opps..', response.message, response.info_lanjut);
                }
                return
            }
        });
    });
</script>
<?= $this->endsection(); ?>