<?php
$uri = service('uri');
$segment = $uri->getSegment('1');
?>
<div id="footer-bar" class="footer-bar-6">
    <a href="/" class="<?= ($segment == '' ||  $segment == 'simpan') ? 'active-nav' : ''; ?>"><i class="fa fa-box"></i><span>Simpan Barang</span></a>
    <a href="/kirim" class="<?= $segment == 'kirim' ? 'active-nav' : ''; ?>"><i class="fa fa-paper-plane"></i><span>Kirim Barang</span></a>
    <a href="/gudang" class="<?= $segment == 'gudang' ? 'active-nav' : ''; ?>"><i class="fa fa-warehouse"></i><span>Gudang</span></a>
    <a href="/akun" class="<?= $segment == 'akun' ? 'active-nav' : ''; ?>"><i class="fa fa-user"></i><span>Akun</span></a>
</div>