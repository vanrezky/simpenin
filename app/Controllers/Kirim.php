<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KirimDetailModel;
use App\Models\KirimModel;
use App\Models\TransaksiDetailModel;
use App\Models\TransaksiModel;
use App\Models\UserModel;

class Kirim extends BaseController
{
    public function index()
    {
        //
        $id_user = session('_ci_user_login.id_user');
        $transaksi = (new TransaksiModel())->select([
            '*',
            "(SELECT SUM(TD.qty) from transaksi_detail TD where TD.id_transaksi = transaksi.id_transaksi) as jumlah_barang",
            "(SELECT SUM(KD.qty) from kirim_detail KD INNER JOIN kirim K on K.id_kirim = KD.id_kirim where K.id_transaksi = transaksi.id_transaksi) as jumlah_kirim"
        ])->join('gudang G', 'G.id_gudang = transaksi.id_gudang', 'left')
            ->where(['transaksi.id_user' => $id_user, 'jenis' => 'simpan', 'status' => 1])->findAll();

        $data = [
            'title' => 'Gudang',
            'data' => $transaksi,
            'q' => $this->request->getGet('q')

        ];
        return view('content/v_kirim_index', $data);
    }


    public function detail($id_transaksi)
    {
        $id_user = session('_ci_user_login.id_user');
        $transaksi = (new TransaksiModel())->select([
            '*',
            "(SELECT SUM(TD.qty) from transaksi_detail TD where TD.id_transaksi = transaksi.id_transaksi) as jumlah_barang"
        ])->join('gudang G', 'G.id_gudang = transaksi.id_gudang', 'left')
            ->where(['transaksi.id_user' => $id_user, 'jenis' => 'simpan', 'status' => 1])->find($id_transaksi);

        $transaksi['detail'] = (new TransaksiDetailModel())->where('id_transaksi', $id_transaksi)->find();
        $data = [
            'title' => 'List Barang Gudang',
            'data' => $transaksi,
            'q' => $this->request->getGet('q'),
            'back' => '/kirim',

        ];
        return view('content/v_kirim_detail', $data);
    }

    public function kirim($id_transaksi)
    {
        $id_user = session('_ci_user_login.id_user');
        $transaksi = (new TransaksiModel())->select([
            '*',
            "(SELECT SUM(TD.qty) from transaksi_detail TD where TD.id_transaksi = transaksi.id_transaksi) as jumlah_barang"
        ])->join('gudang G', 'G.id_gudang = transaksi.id_gudang', 'left')
            ->where(['transaksi.id_user' => $id_user, 'jenis' => 'simpan', 'status' => 1])->find($id_transaksi);

        $transaksi['detail'] = (new TransaksiDetailModel())->where('id_transaksi', $id_transaksi)->find();
        $data = [
            'title' => 'Kirim Barang',
            'data' => $transaksi,
            'user' => (new UserModel())->find($id_user),
            'q' => $this->request->getGet('q'),
            'back' => '/kirim/detail/' . $id_transaksi

        ];
        return view('content/v_kirim_kirim', $data);
    }

    public function save()
    {

        if ($this->request->isAJAX()) {

            $user = (new UserModel())->where('id_user', session('_ci_user_login.id_user'))->first();
            $kirim = [
                'id_user' => $user['id_user'],
                'penerima' => $user['penerima'],
                'alamat' => $user['alamat_penerima'],
                'id_transaksi' => $this->request->getPost('id_transaksi'),
                'ukuran' => $this->request->getPost('ukuran'),
                // 'harga' => $this->request->getPost('total'),
                'harga' => 45000,
                'metode_bayar' => $this->request->getPost('metode_bayar'),
            ];
            $db = (new KirimModel());
            $db->save($kirim);
            $id_kirim = $db->insertID;

            $detail = [];
            $barang = $this->request->getPost('barang');
            $qty = $this->request->getPost('qty');

            foreach ($barang as $k => $v) {

                if ($qty[$k] > 0) {
                    $detail[] = ['id_transaksi_detail' => $v, 'qty' => $qty[$k], 'id_kirim' => $id_kirim];
                    $transDetail = (new TransaksiDetailModel())->where('id_transaksi_detail',  $v)->first();
                    if ($transDetail) {
                        $trans = (new TransaksiModel())->find($transDetail['id_transaksi']);
                        $sisa = ($transDetail['qty'] - $qty[$k]);
                        $ukuran_terakhir = $trans['ukuran'] - ($qty[$k] * $transDetail['panjang'] * $transDetail['lebar']);
                        (new TransaksiModel())->update($transDetail['id_transaksi'], ['ukuran' => $ukuran_terakhir]);
                        (new TransaksiDetailModel())->update($v, ['qty' => $sisa]);
                    }
                }
            }


            $ins = (new KirimDetailModel())->insertBatch($detail);

            if ($ins) {
                $message = ['success' => true, 'message' => 'berhasil disimpan!'];
            } else {
                $message = ['success' => false, 'message' => 'proses gagal disimpan!'];
            }

            return $this->responseJson($message);
        }
    }

    public function pengiriman($id_transaksi)
    {
        $kirim = (new KirimModel())->where('id_transaksi', $id_transaksi)->find();
        if ($kirim) {
            $data = [
                'title' => 'Pengiriman',
                'data' => $kirim,
                'back' => '/kirim'
            ];
            return view('content/v_kirim_pengiriman', $data);
        }
    }


    public function pengirimanDetail($id_kirim)
    {

        $kirim = (new KirimModel())
            ->select('*, kirim.ukuran, kirim.harga, G.alamat')
            ->join('transaksi T', 'T.id_transaksi = kirim.id_transaksi', 'left')
            ->join('gudang G', 'G.id_gudang = T.id_gudang', 'left')
            ->find($id_kirim);

        if ($kirim) {
            $kirim['detail'] = (new KirimDetailModel())
                ->select('kirim_detail.*, TD.nama_barang, panjang, lebar, tinggi, gambar')
                ->join('transaksi_detail TD', 'TD.id_transaksi_detail = kirim_detail.id_transaksi_detail', 'left')
                ->where('id_kirim', $id_kirim)->find();
            $data = [
                'title' => 'Detail Pengiriman',
                'data' => $kirim,
                'back' => '/kirim/pengiriman/' . $kirim['id_transaksi']
            ];
            return view('content/v_kirim_pengiriman_detail', $data);
        }
    }

    public function lacak($id_kirim)
    {

        $kirim = (new KirimModel())
            ->select('*, kirim.ukuran, kirim.harga, G.alamat, kirim.created_at')
            ->join('transaksi T', 'T.id_transaksi = kirim.id_transaksi', 'left')
            ->join('gudang G', 'G.id_gudang = T.id_gudang', 'left')
            ->find($id_kirim);

        if ($kirim) {
            $data = [
                'title' => 'Detail Pengiriman',
                'data' => $kirim,
                'back' => '/kirim/pengiriman-detail/' . $kirim['id_kirim']
            ];
            return view('content/v_kirim_lacak', $data);
        }
    }
}
