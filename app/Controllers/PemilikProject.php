<?php

namespace App\Controllers;


class PemilikProject extends BaseController
{
    public function index()
    {
        $model = new \App\Models\PemilikProjectModel();

        $data['MD_pemilik_project'] = $model
            ->orderBy('id', 'DESC')
            ->findAll();

        return view('PemilikProject/index', $data);
    }
    public function create()
    {
        return view('PemilikProject/FormPJ');
    }

    public function save()
    {
        date_default_timezone_set('Asia/Jakarta');

        $model = new \App\Models\PemilikProjectModel();

        // ── Cegah data ganda ──
        $cekDup = trim((string) $this->request->getPost('nama_pemilik'));
        if ($cekDup !== '' && $model->where('nama_pemilik', $cekDup)->first()) {
            return redirect()->back()->withInput()
                ->with('error', 'Data Pemilik Project "' . $cekDup . '" sudah ada. Data tidak boleh ganda.');
        }

        $model->save([
            'nama_pemilik' => $this->request->getPost('nama_pemilik'),
            'alamat_lengkap' => $this->request->getPost('alamat_lengkap'),
            'pic_projek' => $this->request->getPost('pic_projek'),
            'nomor_hp_pic' => $this->request->getPost('nomor_hp_pic'),
            'status' => $this->request->getPost('status'),
            'keterangan' => $this->request->getPost('keterangan'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/PemilikProject')
            ->with('success', 'Data Pemilik Project berhasil disimpan');
    }
    public function delete($id)
    {
        $model = new \App\Models\PemilikProjectModel();

        $data = $model->find($id);

        if (!$data) {
            return redirect()->back()
                ->with('error', 'Data tidak ditemukan.');
        }

        $model->delete($id);

        return redirect()->to('/PemilikProject')
            ->with('success', 'Data berhasil dihapus.');
    }
    public function update()
    {
        $id = $this->request->getPost('id');

        $model = new \App\Models\PemilikProjectModel();

        // ── Cegah data ganda (kecuali baris ini sendiri) ──
        $cekDup = trim((string) $this->request->getPost('nama_pemilik'));
        if ($cekDup !== '' && $model->where('nama_pemilik', $cekDup)->where('id !=', $id)->first()) {
            return redirect()->back()->withInput()
                ->with('error', 'Data Pemilik Project "' . $cekDup . '" sudah ada. Data tidak boleh ganda.');
        }

        $model->update($id, [

            'nama_pemilik' => $this->request->getPost('nama_pemilik'),
            'alamat_lengkap' => $this->request->getPost('alamat_lengkap'),
            'pic_projek' => $this->request->getPost('pic_projek'),
            'nomor_hp_pic' => $this->request->getPost('nomor_hp_pic'),
            'status' => $this->request->getPost('status'),
            'keterangan' => $this->request->getPost('keterangan'),

        ]);

        return redirect()->to('/PemilikProject')
            ->with('success', 'Data berhasil diperbarui.');
    }
}
