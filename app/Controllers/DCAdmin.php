<?php

namespace App\Controllers;


class DCAdmin extends BaseController
{
    public function index()
    {
        $model = new \App\Models\DCModel();

        $data['MD_dc'] = $model
            ->orderBy('id', 'DESC')
            ->findAll();

        return view('DCAdmin/index', $data);
    }
    public function create()
    {
        return view('DCAdmin/FormDC');
    }

    public function save()
    {
        $validation = \Config\Services::validation();

        $rules = [

            'nama_dc' => 'required',
            'alamat_dc' => 'required',
            'status' => 'required',
            'keterangan' => 'required'

        ];

        if (!$this->validate($rules)) {

            return redirect()->back()
                ->withInput()
                ->with('error', 'Semua field wajib diisi.');
        }

        $model = new \App\Models\DCModel();

        // ── Cegah data ganda ──
        $cekDup = trim((string) $this->request->getPost('nama_dc'));
        if ($cekDup !== '' && $model->where('nama_dc', $cekDup)->first()) {
            return redirect()->back()->withInput()
                ->with('error', 'Data DC "' . $cekDup . '" sudah ada. Data tidak boleh ganda.');
        }

        $model->save([
            'nama_dc'    => $this->request->getPost('nama_dc'),
            'alamat_dc'  => $this->request->getPost('alamat_dc'),
            'status'     => $this->request->getPost('status'),
            'keterangan' => $this->request->getPost('keterangan')
        ]);

        return redirect()->to('/DCAdmin')
            ->with('success', 'Data DC berhasil disimpan');
    }
    public function delete($id)
    {
        $model = new \App\Models\DCModel();

        $data = $model->find($id);

        if (!$data) {
            return redirect()->back()
                ->with('error', 'Data tidak ditemukan.');
        }

        $model->delete($id);

        return redirect()->to('/DCAdmin')
            ->with('success', 'Data berhasil dihapus.');
    }
    public function update()
    {
        $id = $this->request->getPost('id');

        $model = new \App\Models\DCModel();

        // ── Cegah data ganda (kecuali baris ini sendiri) ──
        $cekDup = trim((string) $this->request->getPost('nama_dc'));
        if ($cekDup !== '' && $model->where('nama_dc', $cekDup)->where('id !=', $id)->first()) {
            return redirect()->back()->withInput()
                ->with('error', 'Data DC "' . $cekDup . '" sudah ada. Data tidak boleh ganda.');
        }

        $model->update($id, [

            'nama_dc'    => $this->request->getPost('nama_dc'),
            'alamat_dc'  => $this->request->getPost('alamat_dc'),
            'status'     => $this->request->getPost('status'),
            'keterangan' => $this->request->getPost('keterangan'),

        ]);

        return redirect()->to('/DCAdmin')
            ->with('success', 'Data berhasil diperbarui.');
    }
}
