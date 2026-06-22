<?php

namespace App\Controllers;


class MediaKoneksi extends BaseController
{
    public function index()
    {
        $model = new \App\Models\MediaKoneksiModel();

        $data['MD_media_koneksi'] = $model
            ->orderBy('id', 'DESC')
            ->findAll();

        return view('MediaKoneksi/index', $data);
    }
    public function create()
    {
        return view('MediaKoneksi/FormMK');
    }

    public function save()
    {
        date_default_timezone_set('Asia/Jakarta');

        $model = new \App\Models\MediaKoneksiModel();

        // ── Cegah data ganda ──
        $cekDup = trim((string) $this->request->getPost('media_koneksi'));
        if ($cekDup !== '' && $model->where('media_koneksi', $cekDup)->first()) {
            return redirect()->back()->withInput()
                ->with('error', 'Data Media Koneksi "' . $cekDup . '" sudah ada. Data tidak boleh ganda.');
        }

        $model->save([
            'media_koneksi' => $this->request->getPost('media_koneksi'),
            'status'        => $this->request->getPost('status'),
            'keterangan'    => $this->request->getPost('keterangan'),
            'created_at'    => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/MediaKoneksi')
            ->with('success', 'Data Media Koneksi berhasil disimpan');
    }
    public function delete($id)
    {
        $model = new \App\Models\MediaKoneksiModel();

        $data = $model->find($id);

        if (!$data) {
            return redirect()->back()
                ->with('error', 'Data tidak ditemukan.');
        }

        $model->delete($id);

        return redirect()->to('/MediaKoneksi')
            ->with('success', 'Data berhasil dihapus.');
    }
    public function update()
    {
        $id = $this->request->getPost('id');

        $model = new \App\Models\MediaKoneksiModel();

        // ── Cegah data ganda (kecuali baris ini sendiri) ──
        $cekDup = trim((string) $this->request->getPost('media_koneksi'));
        if ($cekDup !== '' && $model->where('media_koneksi', $cekDup)->where('id !=', $id)->first()) {
            return redirect()->back()->withInput()
                ->with('error', 'Data Media Koneksi "' . $cekDup . '" sudah ada. Data tidak boleh ganda.');
        }

        $model->update($id, [

            'media_koneksi'    => $this->request->getPost('media_koneksi'),
            'status'     => $this->request->getPost('status'),
            'keterangan' => $this->request->getPost('keterangan'),

        ]);

        return redirect()->to('/MediaKoneksi')
            ->with('success', 'Data berhasil diperbarui.');
    }
}
