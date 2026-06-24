<?php

namespace App\Controllers;


class DataSI extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $data['MD_simcard'] = $db->table('d_simcard s')
            ->select('
            s.*,
            v.nama_vendor,
            dc.nama_paket_data,
            qs.isi_quota_internet,
            qs.harga_quota_internet,
            p.kategori_pelanggan
        ')
            ->join('md_data_celullar dc', 'dc.id = s.data_cellular_id', 'left')
            ->join('md_vendor v',         'v.id = dc.vendor_id',        'left')
            ->join('md_quota_simcard qs', 'qs.id = s.quota_simcard_id', 'left')
            ->join('md_pelanggan p',      'p.id = s.pelanggan_id',      'left')
            ->orderBy('s.id', 'DESC')
            ->get()
            ->getResultArray();

        return view('DataSI/index', $data);
    }
    public function create()
    {
        $db = \Config\Database::connect();

        $data['md_data_celullar'] = $db->table('md_data_celullar dc')
            ->select('dc.*, v.nama_vendor')
            ->join('md_vendor v', 'v.id = dc.vendor_id', 'left')
            ->orderBy('dc.nama_paket_data', 'ASC')->get()->getResultArray();
        $data['md_quota_simcard'] = $db->table('md_quota_simcard')->get()->getResultArray();
        $data['md_pelanggan']     = $db->table('md_pelanggan')->get()->getResultArray();

        return view('DataSI/FormDataSI', $data);
    }
    public function save()
    {
        date_default_timezone_set('Asia/Jakarta');

        $model = new \App\Models\DataSIModel();

        // cegah MSISDN ganda
        $msisdn = trim((string) $this->request->getPost('nomor_msisdn'));
        if ($msisdn !== '' && $model->where('nomor_msisdn', $msisdn)->first()) {
            return redirect()->back()->withInput()
                ->with('error', 'Nomor MSISDN "' . $msisdn . '" sudah ada. Data tidak boleh ganda.');
        }

        $model->save([
            'data_cellular_id' => $this->request->getPost('data_cellular_id'),
            'quota_simcard_id' => $this->request->getPost('quota_simcard_id'),
            'pelanggan_id'     => $this->request->getPost('pelanggan_id'),
            'nomor_msisdn'     => $msisdn,
            'nomor_issid_ime'  => $this->request->getPost('nomor_issid_ime'),
            'id_pelanggan'     => $this->request->getPost('id_pelanggan'),
            'kode_toko'        => $this->request->getPost('kode_toko'),
            'status'           => $this->request->getPost('status'),
            'keterangan'       => $this->request->getPost('keterangan'),
            'created_at'       => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/DataSI')
            ->with('success', 'Data Simcard berhasil disimpan.');
    }
    public function delete($id)
    {
        $model = new \App\Models\DataSIModel();

        $data = $model->find($id);

        if (!$data) {
            return redirect()->back()
                ->with('error', 'Data tidak ditemukan.');
        }

        $model->delete($id);

        return redirect()->to('/DataSI')
            ->with('success', 'Data berhasil dihapus.');
    }
    public function update()
    {
        date_default_timezone_set('Asia/Jakarta');

        $id    = $this->request->getPost('id');
        $model = new \App\Models\DataSIModel();

        // cegah MSISDN ganda (kecuali baris ini sendiri)
        $msisdn = trim((string) $this->request->getPost('nomor_msisdn'));
        if ($msisdn !== '' && $model->where('nomor_msisdn', $msisdn)->where('id !=', $id)->first()) {
            return redirect()->back()->withInput()
                ->with('error', 'Nomor MSISDN "' . $msisdn . '" sudah ada. Data tidak boleh ganda.');
        }

        $model->update($id, [
            'data_cellular_id' => $this->request->getPost('data_cellular_id'),
            'quota_simcard_id' => $this->request->getPost('quota_simcard_id'),
            'pelanggan_id'     => $this->request->getPost('pelanggan_id'),
            'nomor_msisdn'     => $msisdn,
            'nomor_issid_ime'  => $this->request->getPost('nomor_issid_ime'),
            'id_pelanggan'     => $this->request->getPost('id_pelanggan'),
            'kode_toko'        => $this->request->getPost('kode_toko'),
            'status'           => $this->request->getPost('status'),
            'keterangan'       => $this->request->getPost('keterangan'),
        ]);

        return redirect()->to('/DataSI')
            ->with('success', 'Data Simcard berhasil diperbarui.');
    }
    public function edit($id)
    {
        $model = new \App\Models\DataSIModel();
        $data['simcard'] = $model->find($id);

        if (!$data['simcard']) {
            return redirect()->to('/DataSI')->with('error', 'Data tidak ditemukan.');
        }

        // kirim juga master data yang dibutuhkan form edit (vendor, paket, quota, pelanggan)
        $db = \Config\Database::connect();
        $data['md_data_celullar'] = $db->table('md_data_celullar dc')
            ->select('dc.*, v.nama_vendor')
            ->join('md_vendor v', 'v.id = dc.vendor_id', 'left')
            ->orderBy('dc.nama_paket_data', 'ASC')->get()->getResultArray();
        $data['md_quota_simcard'] = $db->table('md_quota_simcard')->get()->getResultArray();
        $data['md_pelanggan']     = $db->table('md_pelanggan')->get()->getResultArray();

        return view('DataSI/EditFormDataSimcard', $data);
    }
}
