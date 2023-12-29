<?php

namespace App\Controllers;

use App\Models\Modelmahasiswa;

class Mahasiswa extends BaseController
{
    public function index()
    {

        return view('mahasiswa\viewtampildata');
        // d($mhs->findAll());
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {
            // $mhs = new Modelmahasiswa;
            $data = [
                'tampildata' => $this->mhs->findAll()
            ];
            $msg = [
                'data' => view('mahasiswa/datamahasiswa', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function formtambah()
    {
        if ($this->request->isAJAX()) {
            $msg = [
                'data' => view('mahasiswa/modaltambah')
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }


    public function simpandata()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nim' => [
                    'label' => 'NIM',
                    'rules' => 'required|is_unique[mahasiswa.nim]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama',
                    ]
                ]
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'nim' => $validation->getError('nim')
                    ]
                ];
            } else {
                $simpandata = [
                    'nim' => $this->request->getVar('nim'),
                    'nama' => $this->request->getVar('nama'),
                    'tmplahir' => $this->request->getVar('tmplahir'),
                    'tgllahir' => $this->request->getVar('tgllahir'),
                    'jenkel' => $this->request->getVar('jenkel'),
                ];

                // $mhs = new Modelmahasiswa;

                $this->mhs->insert($simpandata);
                $msg = [
                    'sukses' => 'Data berhasil disimpan'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $nim = $this->request->getVar('nim');

            // $mhs = new Modelmahasiswa;
            $row = $this->mhs->find($nim);
            // dd($row);
            $data1 = [
                'nim' => $row['nim'],
                'nama' => $row['nama'],
                'tmplahir' => $row['tmplahir'],
                'tgllahir' => $row['tgllahir'],
                'jenkel' => $row['jenkel'],
            ];

            $msg = [
                'sukses' => view('mahasiswa/modaledit', $data1)
            ];
            echo json_encode($msg);
        }
    }

    public function updatedata()
    {
        if ($this->request->isAJAX()) {

            $simpandata = [
                'nama' => $this->request->getVar('nama'),
                'tmplahir' => $this->request->getVar('tmplahir'),
                'tgllahir' => $this->request->getVar('tgllahir'),
                'jenkel' => $this->request->getVar('jenkel'),
            ];
            // $mhs = new Modelmahasiswa;
            $nim = $this->request->getVar('nim');

            $this->mhs->update($nim, $simpandata);
            $msg = [
                'sukses' => 'Data berhasil diupdate'
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {

            $nim = $this->request->getVar('nim');
            // $mhs = new Modelmahasiswa;

            $this->mhs->delete($nim);
            $msg = [
                'sukses' => "Mahasiswa Dengan NIM $nim berhasil dihapus"
            ];

            echo json_encode($msg);
        }
    }
}
