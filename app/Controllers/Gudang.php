<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GudangModel;

class Gudang extends BaseController
{
    public function index()
    {
        $id_user = session('_ci_user_login.id_user');
        $gudang = (new GudangModel());
        if ($this->request->getGet('q')) {
            $gudang = $gudang->groupStart()
                ->like('nama_gudang', $this->request->getGet('q'), 'both')
                ->orLike('deskripsi', $this->request->getGet('q'), 'both')
                ->groupEnd();
        }
        $gudang = $gudang->orderBy('id_gudang', 'DESC')->where("id_user = $id_user")->findAll();
        $data = [
            'title' => 'Gudang',
            'data' => $gudang,
            'q' => $this->request->getGet('q')

        ];
        return view('content/v_gudang_index', $data);
    }

    public function data($id = "")
    {


        if ($this->request->getMethod() == 'post') {

            $id_gudang = $this->request->getPost('id_gudang');
            $gudang = (new GudangModel())->where('id_gudang', $id_gudang)->get()->getRowArray();

            $validasi = [
                'nama_gudang' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Gudang tidak boleh kosong',
                    ]
                ],
                'alamat' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Alamat tidak boleh kosong',
                    ]
                ],
                'luas' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Luas gudang tidak boleh kosong',
                        'numeric' => 'Luas gudang harus berupa angka'
                    ]
                ],
                'deskripsi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Deskripsi tidak boleh kosong',
                    ]
                ],
                'fasilitas' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pilih minimal satu fasilitas',
                    ]
                ],
                'gambar' => [
                    'label' => 'Gambar',
                    'rules' => 'uploaded[gambar]|is_image[gambar]|max_size[gambar,2048]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'uploaded' => "{field} wajib diinput",
                        'max_size' => 'Ukuran gambar terlalu besar',
                        'is_image' => 'Harus berformat jpg, jpeg, png',
                        'mime_in' => 'Harus berformat jpg, jpeg, png'
                    ]
                ]

            ];

            if ($gudang) {
                $validasi['gambar']['rules'] = 'is_image[gambar]|max_size[gambar,2048]|mime_in[gambar,image/jpg,image/jpeg,image/png]';
            }

            $valid = $this->validate($validasi);


            if (!$valid) {
                $message = ['success' => false, 'message' => 'Periksa pada info bagian atas form', 'info_lanjut' => pesan('Opps..|' . implode('<br/>', $this->validator->getErrors()), 'danger')];
                return $this->responseJson($message);
            }

            $gambar = $this->request->getFile('gambar');
            $namaGambar = isset($gudang['gambar']) ?  $gudang['gambar'] : NULL;
            $uploadImages = false;
            if ($gambar->getError() != 4) {
                $namaGambar = $gambar->getRandomName();
                $uploadImages = true;
            }

            $__data = [
                'nama_gudang' => $this->request->getPost('nama_gudang'),
                'alamat' => $this->request->getPost('alamat'),
                'luas' => $this->request->getPost('luas'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'fasilitas' => json_encode($this->request->getPost('fasilitas')),
                'gambar' => $namaGambar,
                'id_user' => session('_ci_user_login.id_user')
            ];


            if ($gudang) {
                $__pros = (new GudangModel())->update($id_gudang, $__data);
            } else {
                $__pros = (new GudangModel())->save($__data);
            }

            $message = ['success' => false, 'message' => 'Gudang gagal disimpan!'];
            if ($__pros) {
                if ($uploadImages) {
                    // upload images
                    $gambar->move('uploads/images/', $namaGambar);
                    if (!empty($gudang['gambar'])) {
                        if (file_exists('uploads/images/' . $gudang['gambar'])) {
                            unlink('uploads/images/' . $gudang['gambar']);
                        }
                    }
                }

                $message = ['success' => true, 'message' => 'Gudang berhasil disimpan!'];
            }

            return $this->responseJson($message);
        }


        $gudang = (new GudangModel())->find($id);

        $data = [
            'title' =>  !empty($gudang) ? 'Edit Gudang' : 'Tambah Gudang',
            'data' => $gudang
        ];

        return view('content/v_gudang_data', $data);
    }
}
