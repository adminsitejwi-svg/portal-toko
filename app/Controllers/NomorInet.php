<?php

namespace App\Controllers;


class NomorInet extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $data['MD_nomer_inet'] = $db->table('md_nomer_inet dc')
            ->select('dc.*, v.nama_vendor')
            ->join('md_vendor v', 'v.id = dc.vendor_id', 'left')
            ->orderBy('dc.id', 'DESC')
            ->get()
            ->getResultArray();

        $vendorModel = new \App\Models\VendorModel();

        $data['md_vendor'] = $vendorModel->findAll();

        return view('NomorInet/index', $data);
    }
    public function create()
    {
        $vendorModel = new \App\Models\VendorModel();


        $data['MD_vendor'] = $vendorModel->findAll();

        return view('NomorInet/FormNomerInet', $data);
    }
    public function save()
    {
        date_default_timezone_set('Asia/Jakarta');

        $model = new \App\Models\NomerInetModel();

        $vendorId      = $this->request->getPost('vendor_id');
        $namaPaketLayanan = trim((string) $this->request->getPost('nama_paket_layanan'));

        // Cek data ganda berdasarkan vendor dan nama paket
        $dup = $model->where('vendor_id', $vendorId)
            ->where('nama_paket_layanan', $namaPaketLayanan)
            ->first();

        if ($dup) {
            return redirect()->back()->withInput()
                ->with(
                    'error',
                    'Paket Layanan "' . $namaPaketLayanan . '" pada vendor tersebut sudah ada.'
                );
        }

        $model->save([
            'vendor_id'       => $vendorId,
            'nama_paket_layanan' => $namaPaketLayanan,
            'kecepatan_bandwidth' => $this->request->getPost('kecepatan_bandwidth'),
            'harga_layanan' => $this->request->getPost('harga_layanan'),
            'nomor_inet_pelanggan' => $this->request->getPost('nomor_inet_pelanggan'),
            'status'          => $this->request->getPost('status'),
            'keterangan'      => $this->request->getPost('keterangan'),
            'created_at'      => date('Y-m-d H:i:s'),
            'password_inet_pelanggan' => password_hash(
                (string) $this->request->getPost('password_inet_pelanggan'),
                PASSWORD_DEFAULT
            ),
        ]);

        return redirect()->to('/NomorInet')
            ->with('success', 'Data Paket Data berhasil disimpan');
    }
    public function delete($id)
    {
        $model = new \App\Models\NomerInetModel();

        $data = $model->find($id);

        if (!$data) {
            return redirect()->back()
                ->with('error', 'Data tidak ditemukan.');
        }

        $model->delete($id);

        return redirect()->to('/NomorInet')
            ->with('success', 'Data berhasil dihapus.');
    }
    public function update()
    {
        date_default_timezone_set('Asia/Jakarta');
        $id    = $this->request->getPost('id');
        $model = new \App\Models\NomerInetModel();

        $vendorId         = $this->request->getPost('vendor_id');
        $namaPaketLayanan = trim((string) $this->request->getPost('nama_paket_layanan'));

        $cekDup = $model
            ->where('vendor_id', $vendorId)
            ->where('nama_paket_layanan', $namaPaketLayanan)
            ->where('id !=', $id)
            ->first();

        if ($cekDup) {
            return redirect()->back()->withInput()
                ->with('error', 'Paket Layanan "' . $namaPaketLayanan . '" pada vendor tersebut sudah ada.');
        }

        $updateData = [
            'vendor_id'            => $vendorId,
            'nama_paket_layanan'   => $namaPaketLayanan,
            'kecepatan_bandwidth'  => $this->request->getPost('kecepatan_bandwidth'),
            'harga_layanan'        => $this->request->getPost('harga_layanan'),
            'nomor_inet_pelanggan' => $this->request->getPost('nomor_inet_pelanggan'),
            'status'               => $this->request->getPost('status'),
            'keterangan'           => $this->request->getPost('keterangan'),
            'updated_at'           => date('Y-m-d H:i:s'),
        ];

        $passwordBaru = (string) $this->request->getPost('password_inet_pelanggan');
        if ($passwordBaru !== '') {
            $updateData['password_inet_pelanggan'] = password_hash($passwordBaru, PASSWORD_DEFAULT);
        }

        $model->update($id, $updateData);

        return redirect()->to('/NomorInet')
            ->with('success', 'Data Paket Data berhasil diperbarui.');
    }
}
