<?php

namespace App\Controllers;


class Vendor extends BaseController
{
    public function index()
    {
        $model = new \App\Models\VendorModel();

        $data['MD_Vendor'] = $model
            ->orderBy('id', 'DESC')
            ->findAll();

        return view('Vendor/index', $data);
    }
    public function create()
    {
        return view('Vendor/FormVendor');
    }

    public function save()
    {
        date_default_timezone_set('Asia/Jakarta');

        $model = new \App\Models\VendorModel();

        // ── Cegah data ganda ──
        $cekDup = trim((string) $this->request->getPost('nama_vendor'));
        if ($cekDup !== '' && $model->where('nama_vendor', $cekDup)->first()) {
            return redirect()->back()->withInput()
                ->with('error', 'Data Vendor "' . $cekDup . '" sudah ada. Data tidak boleh ganda.');
        }

        $model->save([
            'nama_vendor' => $this->request->getPost('nama_vendor'),
            'alamat_vendor' => $this->request->getPost('alamat_vendor'),
            'status' => $this->request->getPost('status'),
            'keterangan' => $this->request->getPost('keterangan'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/Vendor')
            ->with('success', 'Data Vendor berhasil disimpan');
    }
    public function delete($id)
    {
        $model = new \App\Models\VendorModel();

        $data = $model->find($id);

        if (!$data) {
            return redirect()->back()
                ->with('error', 'Data tidak ditemukan.');
        }

        $model->delete($id);

        return redirect()->to('/Vendor')
            ->with('success', 'Data berhasil dihapus.');
    }
    public function update()
    {
        $id = $this->request->getPost('id');

        $model = new \App\Models\VendorModel();

        // ── Cegah data ganda (kecuali baris ini sendiri) ──
        $cekDup = trim((string) $this->request->getPost('nama_vendor'));
        if ($cekDup !== '' && $model->where('nama_vendor', $cekDup)->where('id !=', $id)->first()) {
            return redirect()->back()->withInput()
                ->with('error', 'Data Vendor "' . $cekDup . '" sudah ada. Data tidak boleh ganda.');
        }

        $model->update($id, [

            'nama_vendor' => $this->request->getPost('nama_vendor'),
            'alamat_vendor' => $this->request->getPost('alamat_vendor'),
            'status' => $this->request->getPost('status'),
            'keterangan' => $this->request->getPost('keterangan'),
            'created_at' => date('Y-m-d H:i:s')

        ]);

        return redirect()->to('/Vendor')
            ->with('success', 'Data berhasil diperbarui.');
    }
}
