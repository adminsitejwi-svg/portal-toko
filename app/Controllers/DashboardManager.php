<?php

namespace App\Controllers;

use App\Models\PerangkatModel;

class DashboardManager extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $dcModel        = new \App\Models\DCModel();
        $vendorModel    = new \App\Models\VendorModel();
        $perangkatModel = new PerangkatModel();
        $alfamidiModel  = new \App\Models\AlfamidiModel();
        $lawsonModel    = new \App\Models\LawsonModel(); // Tambahan
        $mediaKoneksiModel = new \App\Models\MediaKoneksiModel();
        $layananJwiModel   = new \App\Models\LayananJwiModel();
        $alfamartModel     = new \App\Models\AlfamartModel();

        $merekPerangkat = $perangkatModel
            ->select('merk_perangkat, COUNT(*) as jumlah')
            ->groupBy('merk_perangkat')
            ->orderBy('jumlah', 'DESC')
            ->findAll();

        $data['total_midi'] = $alfamidiModel->countAll();

        $data['total_aktif'] = $alfamidiModel
            ->where('status', 'Aktif')
            ->countAllResults();

        $data['total_nonaktif'] = $alfamidiModel
            ->where('status', 'Non Aktif')
            ->countAllResults();
        // =========================
        $data['total_lawson'] = $lawsonModel->countAll();

        $data['total_lawson_aktif'] = $lawsonModel
            ->where('status', 'Aktif')
            ->countAllResults();

        $data['total_lawson_nonaktif'] = $lawsonModel
            ->where('status', 'Non Aktif')
            ->countAllResults();
        $data['totalDC'] = $dcModel->countAllResults();

        // Total Alfamart
        $data['total_alfamart'] = $alfamartModel->countAll();

        $data['total_alfamart_aktif'] = $alfamartModel
            ->where('status', 'Aktif')
            ->countAllResults();

        $data['total_alfamart_nonaktif'] = $alfamartModel
            ->where('status', 'Non Aktif')
            ->countAllResults();
        $data['vendor'] = $vendorModel
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $data['merekPerangkat'] = $merekPerangkat;

        $data['totalPerangkat'] = $perangkatModel
            ->countAllResults();

        $data['totalMediaKoneksi'] = $mediaKoneksiModel
            ->countAllResults();

        $data['totalLayananJwi'] = $layananJwiModel
            ->countAllResults();

        return view('manager/dashboard', $data);
    }
}
