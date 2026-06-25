<?php

namespace App\Controllers;

class NMRInet extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $data['MD_inet'] = $db->table('d_nomor_inet s')
            ->select('
                s.*,
                v.nama_vendor,
                ni.nama_paket_layanan,
                ni.kecepatan_bandwidth,
                ni.harga_layanan,
                ni.nomor_inet_pelanggan,
                ni.password_inet_pelanggan,
                p.kategori_pelanggan
            ')
            ->join('md_nomer_inet ni', 'ni.id = s.nomor_inet_id', 'left')
            ->join('md_vendor v',      'v.id = ni.vendor_id',     'left')
            ->join('md_pelanggan p',   'p.id = s.pelanggan_id',   'left')
            ->orderBy('s.id', 'DESC')
            ->get()
            ->getResultArray();

        return view('NMRInet/index', $data);
    }

    public function create()
    {
        $db = \Config\Database::connect();

        $data['md_nomer_inet'] = $db->table('md_nomer_inet ni')
            ->select('ni.*, v.nama_vendor')
            ->join('md_vendor v', 'v.id = ni.vendor_id', 'left')
            ->orderBy('ni.nama_paket_layanan', 'ASC')->get()->getResultArray();
        $data['md_pelanggan'] = $db->table('md_pelanggan')->get()->getResultArray();

        return view('NMRInet/FormNMRInet', $data);
    }

    public function save()
    {
        date_default_timezone_set('Asia/Jakarta');
        $model = new \App\Models\NMRInetModel();

        $model->save([
            'nomor_inet_id' => $this->request->getPost('nomor_inet_id'),
            'pelanggan_id'  => $this->request->getPost('pelanggan_id'),
            'id_pelanggan'  => $this->request->getPost('id_pelanggan'),
            'kode_toko'     => $this->request->getPost('kode_toko'),
            'status'        => $this->request->getPost('status'),
            'keterangan'    => $this->request->getPost('keterangan'),
            'created_at'    => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/NMRInet')->with('success', 'Data Nomor Inet berhasil disimpan.');
    }

    public function edit($id)
    {
        $model = new \App\Models\NMRInetModel();
        $data['inet'] = $model->find($id);

        if (!$data['inet']) {
            return redirect()->to('/NMRInet')->with('error', 'Data tidak ditemukan.');
        }

        $db = \Config\Database::connect();
        $data['md_nomer_inet'] = $db->table('md_nomer_inet ni')
            ->select('ni.*, v.nama_vendor')
            ->join('md_vendor v', 'v.id = ni.vendor_id', 'left')
            ->orderBy('ni.nama_paket_layanan', 'ASC')->get()->getResultArray();
        $data['md_pelanggan'] = $db->table('md_pelanggan')->get()->getResultArray();

        return view('NMRInet/EditFormNMRInet', $data);
    }

    public function update()
    {
        date_default_timezone_set('Asia/Jakarta');
        $id    = $this->request->getPost('id');
        $model = new \App\Models\NMRInetModel();

        $model->update($id, [
            'nomor_inet_id' => $this->request->getPost('nomor_inet_id'),
            'pelanggan_id'  => $this->request->getPost('pelanggan_id'),
            'id_pelanggan'  => $this->request->getPost('id_pelanggan'),
            'kode_toko'     => $this->request->getPost('kode_toko'),
            'status'        => $this->request->getPost('status'),
            'keterangan'    => $this->request->getPost('keterangan'),
        ]);

        return redirect()->to('/NMRInet')->with('success', 'Data Nomor Inet berhasil diperbarui.');
    }

    public function delete($id)
    {
        $model = new \App\Models\NMRInetModel();
        if (!$model->find($id)) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
        $model->delete($id);
        return redirect()->to('/NMRInet')->with('success', 'Data berhasil dihapus.');
    }
}
