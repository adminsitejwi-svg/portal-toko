<?php

namespace App\Controllers;


class LayananJwi extends BaseController
{
    public function index()
    {
        $model = new \App\Models\LayananJwiModel();

        $data['MD_layanan_jwi_group'] = $model
            ->orderBy('id', 'DESC')
            ->findAll();

        return view('LayananJwi/index', $data);
    }
    public function create()
    {
        return view('LayananJwi/FormLJ');
    }

    public function save()
    {
        date_default_timezone_set('Asia/Jakarta');

        $model = new \App\Models\LayananJwiModel();

        // ── Cegah data ganda ──
        $cekDup = trim((string) $this->request->getPost('nama_layanan'));
        if ($cekDup !== '' && $model->where('nama_layanan', $cekDup)->first()) {
            return redirect()->back()->withInput()
                ->with('error', 'Data Layanan JWI "' . $cekDup . '" sudah ada. Data tidak boleh ganda.');
        }

        $model->save([
            'nama_layanan' => $this->request->getPost('nama_layanan'),
            'status'        => $this->request->getPost('status'),
            'keterangan'    => $this->request->getPost('keterangan'),
            'created_at'    => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/LayananJwi')
            ->with('success', 'Data Layanan JWI berhasil disimpan');
    }
    public function delete($id)
    {
        $model = new \App\Models\LayananJwiModel();

        $data = $model->find($id);

        if (!$data) {
            return redirect()->back()
                ->with('error', 'Data tidak ditemukan.');
        }

        $model->delete($id);

        return redirect()->to('/LayananJwi')
            ->with('success', 'Data berhasil dihapus.');
    }
    public function update()
    {
        $id = $this->request->getPost('id');

        $model = new \App\Models\LayananJwiModel();

        // ── Cegah data ganda (kecuali baris ini sendiri) ──
        $cekDup = trim((string) $this->request->getPost('nama_layanan'));
        if ($cekDup !== '' && $model->where('nama_layanan', $cekDup)->where('id !=', $id)->first()) {
            return redirect()->back()->withInput()
                ->with('error', 'Data Layanan JWI "' . $cekDup . '" sudah ada. Data tidak boleh ganda.');
        }

        $model->update($id, [

            'nama_layanan' => $this->request->getPost('nama_layanan'),
            'status'     => $this->request->getPost('status'),
            'keterangan' => $this->request->getPost('keterangan'),

        ]);

        return redirect()->to('/LayananJwi')
            ->with('success', 'Data berhasil diperbarui.');
    }
}
