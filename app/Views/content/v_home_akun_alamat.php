<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>

<div class="page-content">
    <div class="card card-style">
        <div class="content">
            <h4>Ubah alamat</h4>
            <p>
                Ubah alamat penejemputan barang
            </p>

            <div class="mt-5 mb-3">
                <form action="" id="form-alamat">
                    <div class="input-style input-style-2 mb-3 pb-1">
                        <span class="input-style-1-active">Alamat</span>
                        <input type="text" placeholder="Alamat kamu.." value="<?= $data['alamat']; ?>" name="alamat">
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
            url: "/akun/alamat",
            data: $("#form-alamat").serialize(),
            dataType: "json",
            success: function(response) {

                if (response.success) {
                    notification('Sukses..', response.message);
                } else {
                    notification('Opps..', response.message);
                }
                return
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('ada error, ' + errorThrown);
            }
        });
    });
</script>
<?= $this->endsection(); ?>