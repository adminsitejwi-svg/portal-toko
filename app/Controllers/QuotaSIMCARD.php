<?php

namespace App\Controllers;


class QuotaSIMCARD extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $data['md_quota_simcard'] = $db->table('md_quota_simcard qs')
            ->select('
            qs.*,
            dc.nama_paket_data,
            v.nama_vendor
        ')
            ->join('md_data_celullar dc', 'dc.id = qs.data_celullar_id', 'left')
            ->join('md_vendor v', 'v.id = dc.vendor_id', 'left')
            ->orderBy('qs.id', 'DESC')
            ->get()
            ->getResultArray();

        $data['md_data_celullar'] = $db->table('md_data_celullar dc')
            ->select('dc.*, v.nama_vendor')
            ->join('md_vendor v', 'v.id = dc.vendor_id', 'left')
            ->orderBy('dc.nama_paket_data', 'ASC')
            ->get()
            ->getResultArray();

        return view('QuotaSIMCARD/index', $data);
    }
    public function create()
    {
        $db = \Config\Database::connect();

        $data['md_data_celullar'] = $db->table('md_data_celullar dc')
            ->select('dc.*, v.nama_vendor')
            ->join('md_vendor v', 'v.id = dc.vendor_id', 'left')
            ->orderBy('dc.nama_paket_data', 'ASC')
            ->get()
            ->getResultArray();

        return view('QuotaSIMCARD/FormQuotaSIMCARD', $data);
    }
    public function save()
    {
        $model = new \App\Models\QuotaSIMCARDModel();
        date_default_timezone_set('Asia/Jakarta');   // <-- tambahkan
        $model = new \App\Models\QuotaSIMCARDModel();
        // ... sisanya tetap

        $dataCelullarId = $this->request->getPost('data_celullar_id');
        $isiQuota       = trim($this->request->getPost('isi_quota_internet'));

        $cek = $model->where('data_celullar_id', $dataCelullarId)
            ->where('isi_quota_internet', $isiQuota)
            ->first();

        if ($cek) {
            return redirect()->back()->withInput()
                ->with('error', 'Quota internet tersebut sudah tersedia.');
        }

        $model->save([
            'data_celullar_id'      => $dataCelullarId,
            'isi_quota_internet'    => $isiQuota,
            'harga_quota_internet'  => $this->request->getPost('harga_quota_internet'),
            'status'                => $this->request->getPost('status'),
            'keterangan'            => $this->request->getPost('keterangan'),
            'created_at'            => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/QuotaSIMCARD')
            ->with('success', 'Data quota berhasil disimpan.');
    }
    public function delete($id)
    {

        $model = new \App\Models\QuotaSIMCARDModel();

        $data = $model->find($id);

        if (!$data) {
            return redirect()->back()
                ->with('error', 'Data tidak ditemukan.');
        }

        $model->delete($id);

        return redirect()->to('/QuotaSIMCARD')
            ->with('success', 'Data berhasil dihapus.');
    }
    public function update()
    {

        date_default_timezone_set('Asia/Jakarta');   // <-- tambahkan
        $id = $this->request->getPost('id');
        // ... sisanya tetap
        $id = $this->request->getPost('id');

        $model = new \App\Models\QuotaSIMCARDModel();

        $dataCelullarId = $this->request->getPost('data_celullar_id');
        $isiQuota       = trim($this->request->getPost('isi_quota_internet'));

        $cek = $model->where('data_celullar_id', $dataCelullarId)
            ->where('isi_quota_internet', $isiQuota)
            ->where('id !=', $id)
            ->first();

        if ($cek) {
            return redirect()->back()->withInput()
                ->with('error', 'Quota internet tersebut sudah tersedia.');
        }

        $model->update($id, [
            'data_celullar_id'      => $dataCelullarId,
            'isi_quota_internet'    => $isiQuota,
            'harga_quota_internet'  => $this->request->getPost('harga_quota_internet'),
            'status'                => $this->request->getPost('status'),
            'keterangan'            => $this->request->getPost('keterangan'),
            'updated_at'            => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/QuotaSIMCARD')
            ->with('success', 'Data quota berhasil diperbarui.');
    }
}
