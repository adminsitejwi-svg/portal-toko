<?php

namespace App\Controllers;


class LayananVendor extends BaseController
{
    public function index()
    {
        $model = new \App\Models\LayananVendorModel();

        $data['MD_layanan_vendor'] = $model
            ->orderBy('id', 'DESC')
            ->findAll();

        return view('Vendor/LayananVendor', $data);
    }
    public function create()
    {
        return view('Vendor/FormLV');
    }

    public function save()
    {
        date_default_timezone_set('Asia/Jakarta');

        $model = new \App\Models\LayananVendorModel();

        // ── Cegah data ganda ──
        $cekDup = trim((string) $this->request->getPost('nama_layanan'));
        if ($cekDup !== '' && $model->where('nama_layanan', $cekDup)->first()) {
            return redirect()->back()->withInput()
                ->with('error', 'Data Layanan Vendor "' . $cekDup . '" sudah ada. Data tidak boleh ganda.');
        }

        $model->save([
            'nama_layanan' => $this->request->getPost('nama_layanan'),
            'status' => $this->request->getPost('status'),
            'keterangan' => $this->request->getPost('keterangan'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/LayananVendor')
            ->with('success', 'Data Layanan Vendor berhasil disimpan');
    }
    public function delete($id)
    {
        $model = new \App\Models\LayananVendorModel();

        $data = $model->find($id);

        if (!$data) {
            return redirect()->back()
                ->with('error', 'Data tidak ditemukan.');
        }

        $model->delete($id);

        return redirect()->to('/LayananVendor')
            ->with('success', 'Data berhasil dihapus.');
    }
    public function update()
    {
        $id = $this->request->getPost('id');

        $model = new \App\Models\LayananVendorModel();

        // ── Cegah data ganda (kecuali baris ini sendiri) ──
        $cekDup = trim((string) $this->request->getPost('nama_layanan'));
        if ($cekDup !== '' && $model->where('nama_layanan', $cekDup)->where('id !=', $id)->first()) {
            return redirect()->back()->withInput()
                ->with('error', 'Data Layanan Vendor "' . $cekDup . '" sudah ada. Data tidak boleh ganda.');
        }

        $model->update($id, [

            'nama_layanan' => $this->request->getPost('nama_layanan'),
            'status' => $this->request->getPost('status'),
            'keterangan' => $this->request->getPost('keterangan'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/LayananVendor')
            ->with('success', 'Data berhasil diperbarui.');
    }
}
