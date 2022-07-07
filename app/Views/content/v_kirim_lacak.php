<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>
<?php

$mulai = date_create($data['created_at']);
$hari_ini = date_create();


$diff = date_diff($mulai, $hari_ini);
$diantar = false;
$dikirim = false;
$diterima = false;
if ($diff->d > 1) $diantar = true;
if ($diff->d > 2) $dikirim = true;
if ($diff->d > 5) $diterima = true;


?>
<div class="card" id="form-kirim">
    <div class="content mt-2">
        <div class="timeline-body">
            <div class="timeline-deco"></div>

            <div class="timeline-item">
                <i class="fas fa-box-open bg-blue-dark shadow-xl timeline-icon"></i>
                <div class="timeline-item-content">
                    <h5 class="font-400 color-blue-light mt-2">
                        Barang sedang disiapkan
                    </h5>
                </div>
            </div>

            <div class="timeline-item">
                <i class="fas fa-paper-plane <?= $diantar ? 'bg-blue-dark' : 'color-black'; ?> shadow-xl timeline-icon"></i>
                <div class="timeline-item-content">
                    <h5 class="font-400 <?= $diantar ? 'color-blue-light' : ''; ?>  mt-2">
                        Barang diantar ke jasa ekspedisi
                    </h5>
                </div>
            </div>

            <div class="timeline-item">
                <i class="fas fa-bus <?= $dikirim ? 'bg-blue-dark' : 'color-black'; ?> shadow-xl timeline-icon"></i>
                <div class="timeline-item-content">
                    <h5 class="font-400 <?= $dikirim ? 'color-blue-light' : ''; ?> mt-2">
                        Barang dikirim oleh kurir
                    </h5>
                </div>
            </div>
            <div class="timeline-item">
                <i class="fas fa-box-open <?= $diterima ? 'bg-blue-dark' : 'color-black'; ?> shadow-xl timeline-icon"></i>
                <div class="timeline-item-content">
                    <h5 class="font-400 <?= $diterima ? 'color-blue-light' : ''; ?> mt-2">
                        Barang diterima oleh penerima
                    </h5>
                </div>
            </div>
        </div>

        <h4 class="font-400">Status Pengiriman</h4>
        <div>
            <?php
            if ($diterima) {
                echo '<p style="line-height:15px" class="mb-2"><span class="color-blue-light">' . tanggal(date('Y-m-d', strtotime($data['created_at'] . '+5 days'))) . '</span><br /><small>Barang diterima oleh penerima</small></p>';
            }
            if ($dikirim) {
                echo '<p style="line-height:15px" class="mb-2"><span class="color-blue-light">' . tanggal(date('Y-m-d', strtotime($data['created_at'] . '+2 days'))) . '</span><br /><small>Barang dikirim oleh JNE YES</small></p>';
            }
            if ($diantar) {
                echo '<p style="line-height:15px" class="mb-2"><span class="color-blue-light">' . tanggal(date('Y-m-d', strtotime($data['created_at'] . '+1 days'))) . '</span><br /><small>Barang diantar ke ekspedisi JNE oleh tim SIMPEN.IN</small></p>';
            }
            ?>
            <p style="line-height:15px"><span class="color-blue-light"><?= tanggal(date('Y-m-d', strtotime($data['created_at']))); ?></span><br /><small>Pembayaran telah diterima dan barang sedang dipersiapkan</small></p>
        </div>
    </div>
</div>
<style>
    .timeline-body {
        position: relative;
        margin-top: 0px !important;
        padding-top: 5px;
        z-index: 2;
        background-color: #fff !important;
        padding-bottom: 10px;
        box-shadow: none !important;
    }

    .timeline-item-content,
    .timeline-item-content-full {
        border: 0;
        background-color: #fff;
        margin: 0 10px 10px 90px;
        padding: 15px 10px;
    }
</style>
<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {
        $("#footer-bar").hide();
    });
</script>
<?= $this->endSection(); ?>