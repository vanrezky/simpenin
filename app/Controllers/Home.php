<?php

namespace App\Controllers;

use App\Models\GudangModel;
use App\Models\TransaksiDetailModel;
use App\Models\TransaksiModel;
use App\Models\UserModel;

class Home extends BaseController
{

    public function __construct()
    {
        $this->transaksi = new TransaksiModel();
        $this->transaksiDetail  = new TransaksiDetailModel();
        $this->gudang = new GudangModel();
    }

    public function index()
    {
        $id_user = session('_ci_user_login.id_user');
        $rekomendasi = $this->gudang
            ->select('gudang.*')
            ->join('transaksi T', 'T.id_gudang = gudang.id_gudang', 'left')
            ->groupBy('gudang.id_gudang')->orderBy('SUM(ukuran)', 'DESC')
            ->limit(4)->where("gudang.id_user != '$id_user'")->find();

        $gudang = $this->gudang->where("gudang.id_user != '$id_user'")->find();

        $data = [
            'title' => 'Home',
            'rekomendasi' => $rekomendasi,
            'gudang' => $gudang

        ];
        return view('content/v_home_index', $data);
    }



    public function detail($id)
    {
        $gudang = $this->gudang->where('id_gudang', $id)->first();
        $transaksi = $this->transaksi->select("SUM(ukuran) as total", false)->where('id_gudang', $gudang['id_gudang'])->first();
        if ($gudang) {

            $data = [
                'title' => $gudang['nama_gudang'],
                'data' => $gudang,
                'back' => '/',
                'total' => $transaksi['total']
            ];

            return view('content/v_home_detail', $data);
        }

        return redirect('/');
    }

    public function transaksiStep1($id_gudang = "")
    {

        $gudang = $this->gudang->where('id_gudang', $id_gudang)->first();

        if ($gudang) {
            $kondisi = ['id_gudang' => $id_gudang, 'id_user' => session('_ci_user_login.id_user'), 'jenis' => 'simpan'];
            $transaksi = $this->transaksi->where($kondisi)->first();
            if (!$transaksi) {
                $this->transaksi->save($kondisi);
                $transaksi = $this->transaksi->where($kondisi)->first();
            }

            $transaksi['detail'] = $this->transaksiDetail->where(['id_transaksi' => $transaksi['id_transaksi']])->find();
            $kirim = $this->request->getGet('kirim');
            $data = [
                'title' => $gudang['nama_gudang'],
                'transaksi' => $transaksi,
                'gudang' => $gudang,
                'back' => empty($kirim) ? '/simpan/detail/' . $id_gudang : '/kirim/detail/' . $kirim,
                'kirim' => $kirim,
            ];

            return view('content/v_home_transaksi_step1', $data);
        }

        return redirect('/');
    }

    public function transaksiStep2($id_transaksi)
    {

        $transaksi = $this->transaksi->where(['id_transaksi' => $id_transaksi])->first();

        if ($transaksi) {
            $transaksi['detail'] = $this->transaksiDetail->where('id_transaksi', $transaksi['id_transaksi'])->find();
            if (empty($transaksi['detail'])) {
                return redirect()->back()->with('message', pesan('Opps..|Maaf belum ada barang yang kamu masukkan' . 'warning'));
            }
            $gudang = $this->gudang->where('id_gudang', $transaksi['id_gudang'])->first();
            $kirim = $this->request->getGet('kirim');
            $data = [
                'title' => $gudang['nama_gudang'],
                'transaksi' => $transaksi,
                'gudang' => $gudang,
                'back' => '/simpan/transaksi-step1/' . $gudang['id_gudang'] . (!empty($kirim) ? "?kirim=$kirim" : ''),
                'kirim' => $kirim,
            ];

            return view('content/v_home_transaksi_step2', $data);
        }
    }

    public function transaksiStep2Save($id)
    {
        $detail = $this->transaksiDetail
            ->select('transaksi_detail.*, T.id_gudang')
            ->join('transaksi T', 'T.id_transaksi = transaksi_detail.id_transaksi')
            ->find($id);
        $message = ['success' => false, 'message' => 'Proses hitung tidak dapat dilakukan'];
        if ($detail) {
            // cek ketersediaan gudang 
            $gudang = (new GudangModel())
                ->select("gudang.*, (
                SELECT SUM(TD.panjang * TD.lebar * TD.tinggi) from transaksi T
                left join transaksi_detail TD on TD.id_transaksi = T.id_transaksi
                where T.id_gudang = gudang.id_gudang
            ) as luas_sisa")->find($detail['id_gudang']);

            $ukuran = $this->request->getPost('ukuran');
            $qty = $this->request->getPost('qty');

            if (($ukuran + $gudang['luas_sisa']) > $gudang['luas']) {
                $message = ['success' => false, 'message' => 'Maaf, kuantitas /volume barang anda sudah melewati luas gudang, luas yang tersisa adalah ' . toUang($gudang['luas_sisa']) . 'cm3'];
            } else {
                $this->transaksiDetail->update($id, ['qty' => $qty]);
                $this->transaksi->update($detail['id_transaksi'], ['ukuran' => $ukuran]);
                $message = ['success' => true, 'message' => 'berhasil update kuantitas'];
            }
        }

        return $this->responseJson($message);
    }


    public function transaksiStep3($id_transaksi)
    {
        $kirim = $this->request->getGet('kirim');
        if (!empty($kirim)) {
            return redirect()->to('/kirim/detail/' . $kirim);
        }
        if ($this->request->isAJAX()) {
            $mulai = $this->request->getGet('mulai');
            $selesai = $this->request->getGet('selesai');
            $this->transaksi->update($id_transaksi, ['tgl_mulai' => $mulai, 'tgl_selesai' => $selesai]);
            $ukuran = $this->request->getGet('ukuran');
            return $this->responseJson([
                'mulai' => tanggal($mulai),
                'selesai' => tanggal($selesai),
                'info' => jumlahHari($mulai, $selesai),
                'pembayaran' => totalBayar($ukuran, jumlahHari($mulai, $selesai, true))
            ]);
        }

        $transaksi = $this->transaksi->where(['id_transaksi' => $id_transaksi])->first();

        if ($transaksi) {
            $gudang = $this->gudang->where('id_gudang', $transaksi['id_gudang'])->first();
            $mulai = date('Y-m-d');
            $selesai = date('Y-m-d', strtotime($mulai . '+7 days'));
            $info_hari = (jumlahHari($mulai, $selesai));

            $data = [
                'title' => $gudang['nama_gudang'],
                'transaksi' => $transaksi,
                'gudang' => $gudang,
                'user' => (new UserModel())->find(session('_ci_user_login.id_user')),
                'back' => '/simpan/transaksi-step2/' . $id_transaksi,
                'tanggal' => [
                    'mulai' => $mulai,
                    'selesai' => $selesai,
                    'info' => $info_hari,
                    'jumlah_hari' => jumlahHari($mulai, $selesai, true)
                ]
            ];

            return view('content/v_home_transaksi_step3', $data);
        }
    }


    public function transaksiStep3Save($id_transaksi)
    {
        $detail = $this->transaksi->find($id_transaksi);
        $message = ['success' => false, 'message' => 'Proses hitung tidak dapat dilakukan'];
        if ($detail) {
            $data = [
                'metode_bayar' => $this->request->getPost('metode'),
                'diskon' => $this->request->getPost('diskon'),
                'bayar' => $this->request->getPost('bayar'),
                'total_bayar' => $this->request->getPost('total_bayar'),
                'status' => 1 //oke
            ];

            $this->transaksi->update($id_transaksi, $data);
            $message = ['success' => true, 'message' => 'berhasil update metode bayar'];
        }

        return $this->responseJson($message);
    }

    public function transaksiSave()
    {

        if ($this->request->isAJAX()) {
            $message = ['success' => false, 'message' => 'Proses tidak dapat dilakukan'];
            $transaksi = $this->transaksi->where('id_transaksi', $this->request->getPost('id_transaksi'))->first();
            $transaksiDetail = $this->transaksiDetail->where('id_transaksi_detail', $this->request->getPost('id_transaksi_detail'))->first();
            if ($transaksi) {

                $validasi = [
                    'gambar' => [
                        'rules' => 'uploaded[gambar]|is_image[gambar]|max_size[gambar,2048]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                        'errors' => [
                            'uploaded' => "{field} wajib diinput",
                            'max_size' => 'Ukuran gambar terlalu besar',
                            'is_image' => 'Harus berformat jpg, jpeg, png',
                            'mime_in' => 'Harus berformat jpg, jpeg, png'
                        ]
                    ],
                    'panjang' => [
                        'rules' => 'required|numeric',
                        'errors' => [
                            'required' => 'Panjang tidak boleh kosong',
                            'numeric' => 'Panjang harus berupa angka'
                        ]
                    ],
                    'lebar' => [
                        'rules' => 'required|numeric',
                        'errors' => [
                            'required' => 'Lebar tidak boleh kosong',
                            'numeric' => 'Lebar harus berupa angka'
                        ]
                    ],
                    'tinggi' => [
                        'rules' => 'required|numeric',
                        'errors' => [
                            'required' => 'Tinggi tidak boleh kosong',
                            'numeric' => 'Tinggi harus berupa angka'
                        ]
                    ],
                ];

                // timpa validasi gambar jika transaksi gagal
                if (!empty($transaksiDetail)) {
                    $validasi['gambar']['rules'] = 'is_image[gambar]|max_size[gambar,2048]|mime_in[gambar,image/jpg,image/jpeg,image/png]';
                }
                $valid = $this->validate($validasi);
                if (!$valid) {
                    $message = ['success' => false, 'message' => implode(', ', $this->validator->getErrors())];
                } else {

                    $gambar = $this->request->getFile('gambar');
                    $namaGambar = empty($transaksiDetail) ? NULL : $transaksiDetail['gambar'];
                    if ($gambar->getError() != 4) {
                        $namaGambar = $gambar->getRandomName();
                        $gambar->move('uploads/images/', $namaGambar);

                        if (!empty($transaksiDetail['gambar'])) {
                            if (file_exists('uploads/images/' . $transaksiDetail['gambar'])) {
                                unlink('uploads/images/' . $transaksiDetail['gambar']);
                            }
                        }
                    }

                    $__data = [
                        'id_transaksi' => $transaksi['id_transaksi'],
                        'nama_barang' => $this->request->getPost('nama_barang'),
                        'gambar' => $namaGambar,
                        'panjang' => $this->request->getPost('panjang'),
                        'lebar' => $this->request->getPost('lebar'),
                        'tinggi' => $this->request->getPost('tinggi'),
                        'catatan' => $this->request->getPost('catatan'),
                        'satuan' => 'Pack',
                    ];

                    if (empty($transaksiDetail)) {
                        $db = $this->transaksiDetail;
                        $__data['qty'] = 1;
                        $db->save($__data);
                        $transaksiDetail['id_transaksi_detail'] = $db->insertID;
                        // $ukuranSebelumnya = 0;
                    } else {
                        // $ukuranSebelumnya = $transaksiDetail['panjang'] * $transaksiDetail['lebar'] * $transaksiDetail['tinggi'];
                        $this->transaksiDetail->update($transaksiDetail['id_transaksi_detail'], $__data);
                    }

                    $ukuran = (new TransaksiDetailModel())->select('SUM(panjang * lebar * tinggi) as ukuran')->where('id_transaksi', $transaksi['id_transaksi'])->get()->getRow()->ukuran;
                    // $ukuran = ($transaksi['ukuran'] - $ukuranSebelumnya) + ($this->request->getPost('panjang') * $this->request->getPost('lebar') * $this->request->getPost('tinggi'));
                    $this->transaksi->update($transaksi['id_transaksi'], ['ukuran' => $ukuran]);

                    $data = [
                        'gambar' => '/uploads/images/' . $namaGambar,
                        'nama' => $this->request->getPost('nama_barang'),
                        'id' => $transaksiDetail['id_transaksi_detail'],
                        'ukuran' => $ukuran
                    ];

                    $message = ['success' => true, 'message' => 'Barang berhasil disimpan', 'data' => $data];
                }
            }

            $this->responseJson($message);
        }
    }

    public function barangDetail($id)
    {

        $data = $this->transaksiDetail->where('id_transaksi_detail', $id)->first();
        $data['total'] = $data['panjang'] * $data['lebar'] * $data['tinggi'];
        $data['gambar'] = '/uploads/images/' . $data['gambar'];
        return $this->responseJson($data);
    }

    public function barangHapus($id)
    {
        $transaksiDetail = $this->transaksiDetail->find($id);
        $transaksi = $this->transaksi->find($transaksiDetail['id_transaksi']);
        $ukuran = $transaksi['ukuran'] - ($transaksiDetail['panjang'] * $transaksiDetail['lebar']);

        $this->transaksi->update($transaksiDetail['id_transaksi'], ['ukuran' => $ukuran]);
        $this->transaksiDetail->delete($id);

        if (!empty($transaksiDetail['gambar'])) {
            if (file_exists('uploads/images/' . $transaksiDetail['gambar'])) {
                unlink('uploads/images/' . $transaksiDetail['gambar']);
            }
        }

        return $this->responseJson(['success' => true, 'message' => 'Barang berhasil dihapus']);
    }

    public function akun()
    {


        if ($this->request->isAJAX() && $this->request->getMethod() == 'post') {

            $valid = $this->validate(
                [
                    'foto_profil' => [
                        'label' => 'Foto Profil',
                        'rules' => 'uploaded[foto_profil]|is_image[foto_profil]|max_size[foto_profil,2048]|mime_in[foto_profil,image/jpg,image/jpeg,image/png]',
                        'errors' => [
                            'uploaded' => "{field} wajib diinput",
                            'max_size' => 'Ukuran foto profil terlalu besar',
                            'is_image' => 'Harus berformat jpg, jpeg, png',
                            'mime_in' => 'Harus berformat jpg, jpeg, png'
                        ]
                    ],
                ]
            );


            if (!$valid) {
                return $this->responseJson(['success' => false, 'message' => $this->validator->getError('foto_profil')]);
            }

            $data = (new UserModel())->find(session('_ci_user_login.id_user'));

            $foto = $this->request->getFile('foto_profil');
            $namaFoto = $data['foto_profil'];
            if ($foto->getError() != 4) {
                $namaFoto = $foto->getRandomName();
                $foto->move('uploads/images/', $namaFoto);

                if (!empty($data['foto_profil'])) {
                    if (file_exists('uploads/images/' . $data['foto_profil'])) {
                        unlink('uploads/images/' . $data['foto_profil']);
                    }
                }
            }


            $upd = (new UserModel())->update($data['id_user'], ['foto_profil' => $namaFoto]);
            $message = ['success' => false, 'message' => 'Foto profil gagal diupload!'];
            if ($upd) {
                $message = ['success' => true, 'message' => 'Foto profil berhasil diupload!'];
            }

            return $this->responseJson($message);
        }

        $data = [
            'title' => 'Akun',
            'data' => (new UserModel())->find(session('_ci_user_login.id_user'))
        ];

        return view('content/v_home_akun', $data);
    }

    public function akunAlamat()
    {

        $data = (new UserModel())->find(session('_ci_user_login.id_user'));

        if ($this->request->isAJAX() && $this->request->getMethod() == 'post') {

            $valid = $this->validate([
                'alamat' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Alamat tidak boleh kosong',
                    ]
                ],
            ]);

            if (!$valid) {
                return $this->responseJson(['success' => false, 'message' => $this->validator->getError('alamat')]);
            }

            $upd = (new UserModel())->update($data['id_user'], ['alamat' => $this->request->getPost('alamat')]);
            $message = ['success' => false, 'message' => 'Alamat gagal disimpan!'];
            if ($upd) {
                $message = ['success' => true, 'message' => 'Alamat berhasil disimpan!'];
            }
            return $this->responseJson($message);
        }

        $data = [
            'title' => 'Alamat',
            'data' => $data
        ];


        return view('content/v_home_akun_alamat', $data);
    }

    public function akunAlamatPenerima()
    {
        $message = ['success' => false, 'message' => 'Alamat gagal disimpan!'];
        if ($this->request->isAJAX()) {

            $upd = (new UserModel())->update(session('_ci_user_login.id_user'), ['penerima' => $this->request->getPost('penerima'), 'alamat_penerima' => $this->request->getPost('alamat_penerima')]);
            if ($upd) {
                $message = ['success' => true, 'message' => 'Alamat berhasil disimpan!'];
            }
        }


        return $this->responseJson($message);
    }


    public function akunData()
    {
        $data = (new UserModel())->find(session('_ci_user_login.id_user'));
        if ($this->request->isAJAX() && $this->request->getMethod() == 'post') {

            $validasi = [
                'nama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama lengkap tidak boleh kosong',
                    ]
                ],
                'email' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Email tidak boleh kosong',
                    ]
                ],
                'telp' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Nomor telepon tidak boleh kosong',
                        'numeric' => 'Nomor telepon harus berupa angka'
                    ]
                ],
                'tempat_lahir' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tempat lahir tidak boleh kosong',
                    ]
                ],
                'tanggal_lahir' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal lahir tidak boleh kosong',
                    ]
                ],
            ];


            if (!empty($this->request->getPost('password'))) {
                $validasi['password'] = [
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ];

                $validasi['password2'] = [
                    'label' => 'Konfirmasi Password',
                    'rules' => 'required|matches[password]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'matches' => '{field} tidak cocok dengan {param}'
                    ]
                ];
            }

            $valid = $this->validate($validasi);

            if (!$valid) {
                return $this->responseJson(['success' => false, 'message' => 'Periksa pada info bagian atas form', 'info_lanjut' => pesan('Opps..|' . implode('<br/>', $this->validator->getErrors()), 'danger')]);
            }

            $dataUpd = [
                'nama' => $this->request->getPost('nama'),
                'email' => $this->request->getPost('email'),
                'telp' => $this->request->getPost('telp'),
                'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            ];

            if (!empty($this->request->getPost('password'))) {
                $dataUpd['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            }

            $upd = (new UserModel())->update($data['id_user'], $dataUpd);
            $message = ['success' => false, 'message' => 'Data pribadi gagal dismpan!'];
            if ($upd) {
                $message = ['success' => true, 'message' => 'Data pribadi disimpan!'];
            }
            return $this->responseJson($message);
        }

        $data = [
            'title' => 'Data pribadi',
            'data' => $data
        ];


        return view('content/v_home_akun_data', $data);
    }

    public function pcDetected()
    {

        if (preg_match(
            "/(android|avantgo|blackberry|bolt|boost|cricket|docomo
        |fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i",
            $_SERVER["HTTP_USER_AGENT"]
        )) {
            return redirect('/');
        }

        $data = [
            'title' => 'PC detected'
        ];

        return view('content/v_home_pc_detected', $data);
    }
}
