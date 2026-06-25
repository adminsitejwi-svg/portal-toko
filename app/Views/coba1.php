<?php

/**
 * @var array $inet           data baris d_nomor_inet yang diedit
 * @var array $md_nomer_inet  master nomor inet (id, nama_paket_layanan, kecepatan_bandwidth,
 *                            harga_layanan, nomor_inet_pelanggan, password_inet_pelanggan, nama_vendor)
 * @var array $md_pelanggan   master pelanggan (id, kategori_pelanggan)
 */
?>
<!doctype html>
<html lang="en" class="light">

<head>
    <meta charset="utf-8" />
    <title>Edit Data Nomor Inet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="<?= base_url('store.png') ?>">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f4f7fa;
        }

        .page-wrapper {
            max-width: 1280px;
            margin: 0 auto;
        }

        .page-header {
            background: linear-gradient(135deg, #185a82 0%, #0f3d5c 100%);
            color: white;
            padding: 20px 30px;
            border-radius: 10px 10px 0 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .page-header h2 {
            font-size: 20px;
            font-weight: 700;
        }

        .page-header .subtitle {
            font-size: 13px;
            opacity: .75;
        }

        .form-card {
            background: #fff;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, .08);
            padding: 30px;
        }

        .section-title {
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .8px;
            color: #185a82;
            border-left: 3px solid #185a82;
            padding-left: 10px;
            margin: 28px 0 16px;
        }

        .section-title:first-child {
            margin-top: 0;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        label {
            font-size: 13px;
            font-weight: 600;
            color: #374151;
        }

        label .req {
            color: #e53e3e;
            margin-left: 2px;
        }

        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 9px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
            color: #1f2937;
            background: #fff;
            transition: border-color .2s, box-shadow .2s;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #185a82;
            box-shadow: 0 0 0 3px rgba(24, 90, 130, .12);
        }

        input:disabled,
        select:disabled {
            background: #f3f4f6;
            color: #9ca3af;
            cursor: not-allowed;
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }

        .readonly-box {
            padding: 9px 12px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            font-size: 14px;
            background: #f9fafb;
            color: #374151;
            min-height: 40px;
        }

        .hint {
            font-size: 11px;
            color: #9ca3af;
            font-weight: 400;
        }

        .action-bar {
            display: flex;
            gap: 12px;
            margin-top: 28px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }

        .btn-save {
            flex: 1;
            padding: 12px;
            background: linear-gradient(135deg, #185a82, #0f3d5c);
            color: white;
            border: none;
            border-radius: 7px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
        }

        .btn-save:hover {
            opacity: .9;
        }

        .btn-back {
            padding: 12px 24px;
            background: #6b7280;
            color: white;
            border: none;
            border-radius: 7px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-back:hover {
            background: #4b5563;
        }

        @media (max-width: 640px) {
            .grid-2 {
                grid-template-columns: 1fr;
            }

            .form-card {
                padding: 18px;
            }
        }
    </style>
</head>

<body class="text-[#37474f]">

    <?php if (session()->getFlashdata('error')) : ?>
        <div id="errorAlert" class="fixed top-5 left-1/2 -translate-x-1/2 z-50 w-full max-w-md px-4">
            <div class="bg-red-500 text-white rounded-xl shadow-xl overflow-hidden">
                <div class="flex items-center gap-3 px-5 py-4">
                    <i class="ti ti-alert-circle text-3xl"></i>
                    <div>
                        <h4 class="font-bold">Gagal</h4>
                        <p class="text-sm"><?= session()->getFlashdata('error') ?></p>
                    </div>
                </div>
            </div>
        </div>
        <script>
            setTimeout(() => {
                const b = document.getElementById('errorAlert');
                if (b) b.remove();
            }, 4000);
        </script>
    <?php endif; ?>

    <div class="p-6">
        <div class="page-wrapper">

            <div class="page-header">
                <div>
                    <h2>Edit Data Nomor Inet</h2>
                    <div class="subtitle">ID: <?= esc($inet['id']) ?></div>
                </div>
            </div>

            <div class="form-card">
                <form action="<?= site_url('NMRInet/update') ?>" method="POST" id="FormEditNMRInet">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" value="<?= esc($inet['id']) ?>">

                    <!-- ═══ DATA LAYANAN (dari Master Nomor INET) ═══ -->
                    <div class="section-title">Data Layanan</div>
                    <div class="grid-2">

                        <div class="form-group">
                            <label>Nama Paket Layanan <span class="req">*</span></label>
                            <select name="nomor_inet_id" id="nomor_inet_id" required>
                                <option value="">— Pilih Paket Layanan —</option>
                                <?php foreach ($md_nomer_inet as $ni): ?>
                                    <option value="<?= $ni['id'] ?>"
                                        data-vendor="<?= esc($ni['nama_vendor'] ?? '-', 'attr') ?>"
                                        data-bw="<?= esc($ni['kecepatan_bandwidth'] ?? '-', 'attr') ?>"
                                        data-harga="<?= esc($ni['harga_layanan'] ?? '', 'attr') ?>"
                                        data-nomor="<?= esc($ni['nomor_inet_pelanggan'] ?? '-', 'attr') ?>"
                                        data-haspass="<?= !empty($ni['password_inet_pelanggan']) ? '1' : '0' ?>"
                                        <?= $inet['nomor_inet_id'] == $ni['id'] ? 'selected' : '' ?>>
                                        <?= esc($ni['nama_paket_layanan']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Nama Vendor / Penyedia Layanan</label>
                            <div class="readonly-box" id="vendor_display">—</div>
                        </div>

                        <div class="form-group">
                            <label>Kecepatan / Bandwidth</label>
                            <div class="readonly-box" id="bw_display">—</div>
                        </div>

                        <div class="form-group">
                            <label>Harga Layanan</label>
                            <div class="readonly-box" id="harga_display">—</div>
                        </div>

                        <div class="form-group">
                            <label>Nomor INET / ID Pelanggan</label>
                            <div class="readonly-box" id="nomor_display">—</div>
                        </div>

                        <div class="form-group">
                            <label>Password INET / ID Pelanggan</label>
                            <div class="readonly-box" id="pass_display">—</div>
                        </div>
                    </div>

                    <!-- ═══ PELANGGAN ═══ -->
                    <div class="section-title">Data Pelanggan</div>
                    <div class="grid-2">

                        <div class="form-group">
                            <label>Kategori Pelanggan <span class="req">*</span></label>
                            <select name="pelanggan_id" id="pelanggan_id" required>
                                <option value="">— Pilih Kategori Pelanggan —</option>
                                <?php foreach ($md_pelanggan as $p): ?>
                                    <option value="<?= $p['id'] ?>"
                                        data-kategori="<?= esc($p['kategori_pelanggan'] ?? '', 'attr') ?>"
                                        <?= $inet['pelanggan_id'] == $p['id'] ? 'selected' : '' ?>>
                                        <?= esc($p['kategori_pelanggan'] ?? '-') ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <span class="hint" id="kategori_note"></span>
                        </div>

                        <div class="form-group">
                            <label>Status <span class="req">*</span></label>
                            <select name="status" id="status" required>
                                <option value="">— Pilih Status —</option>
                                <option value="0" <?= $inet['status'] == '0' ? 'selected' : '' ?>>Aktif</option>
                                <option value="1" <?= $inet['status'] == '1' ? 'selected' : '' ?>>Non Aktif</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>ID Pelanggan
                                <span class="hint">(Personal / Perusahaan / Sekolah)</span>
                            </label>
                            <input type="text" name="id_pelanggan" id="id_pelanggan"
                                value="<?= esc($inet['id_pelanggan']) ?>" placeholder="Isi manual">
                        </div>

                        <div class="form-group">
                            <label>Kode Toko
                                <span class="hint">(Alfamidi / Alfamart / Lawson)</span>
                            </label>
                            <input type="text" name="kode_toko" id="kode_toko"
                                value="<?= esc($inet['kode_toko']) ?>" placeholder="Isi manual">
                        </div>
                    </div>

                    <!-- ═══ KETERANGAN ═══ -->
                    <div class="section-title">Keterangan</div>
                    <div class="form-group">
                        <textarea name="keterangan" id="keterangan" rows="3" required><?= esc($inet['keterangan']) ?></textarea>
                    </div>

                    <div class="action-bar">
                        <button type="submit" class="btn-save">Simpan Perubahan</button>
                        <button type="button" class="btn-back"
                            onclick="window.location.href='<?= site_url('NMRInet') ?>'">Kembali</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        feather.replace();

        function toRupiah(angka) {
            if (angka === '' || angka === null || isNaN(angka)) return '—';
            return 'Rp ' + String(angka).replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        /* Isi field read-only dari master Nomor INET */
        const inetSel = document.getElementById('nomor_inet_id');
        const vendorBox = document.getElementById('vendor_display');
        const bwBox = document.getElementById('bw_display');
        const hargaBox = document.getElementById('harga_display');
        const nomorBox = document.getElementById('nomor_display');
        const passBox = document.getElementById('pass_display');

        function refreshInet() {
            const opt = inetSel.options[inetSel.selectedIndex];
            if (!opt || !opt.value) {
                vendorBox.textContent = bwBox.textContent = hargaBox.textContent =
                    nomorBox.textContent = passBox.textContent = '—';
                return;
            }
            vendorBox.textContent = opt.dataset.vendor || '—';
            bwBox.textContent = opt.dataset.bw || '—';
            hargaBox.textContent = opt.dataset.harga ? toRupiah(opt.dataset.harga) : '—';
            nomorBox.textContent = opt.dataset.nomor || '—';
            passBox.textContent = opt.dataset.haspass === '1' ? '•••••• (tersimpan)' : '—';
        }
        inetSel.addEventListener('change', refreshInet);

        /* Kategori → aktifkan ID Pelanggan ATAU Kode Toko */
        const pelangganSel = document.getElementById('pelanggan_id');
        const idPelangganInp = document.getElementById('id_pelanggan');
        const kodeTokoInp = document.getElementById('kode_toko');
        const kategoriNote = document.getElementById('kategori_note');
        const KATEGORI_TOKO = ['alfamidi', 'alfamart', 'lawson'];

        function applyKategori() {
            const opt = pelangganSel.options[pelangganSel.selectedIndex];
            const kategori = (opt && opt.dataset.kategori ? opt.dataset.kategori : '').toLowerCase().trim();

            let pakaiToko = false,
                pakaiId = false;
            if (kategori !== '') {
                pakaiToko = KATEGORI_TOKO.includes(kategori);
                pakaiId = !pakaiToko;
            }

            idPelangganInp.disabled = !pakaiId;
            if (!pakaiId) idPelangganInp.value = '';

            kodeTokoInp.disabled = !pakaiToko;
            if (!pakaiToko) kodeTokoInp.value = '';

            if (kategori === '') kategoriNote.textContent = '';
            else if (pakaiToko) kategoriNote.textContent = 'Isi Kode Toko di bawah.';
            else kategoriNote.textContent = 'Isi ID Pelanggan di bawah.';
        }
        pelangganSel.addEventListener('change', applyKategori);

        /* Jalankan saat halaman dibuka (isi nilai awal) */
        refreshInet();
        applyKategori();
        // pulihkan nilai lama setelah applyKategori (karena field nonaktif dikosongkan)
        (function restoreOld() {
            const oldId = <?= json_encode($inet['id_pelanggan'] ?? '') ?>;
            const oldKode = <?= json_encode($inet['kode_toko'] ?? '') ?>;
            if (!idPelangganInp.disabled && oldId) idPelangganInp.value = oldId;
            if (!kodeTokoInp.disabled && oldKode) kodeTokoInp.value = oldKode;
        })();

        /* Validasi submit: keterangan wajib + aktifkan field disabled */
        document.getElementById('FormEditNMRInet').addEventListener('submit', function(e) {
            const keterangan = document.getElementById('keterangan').value.trim();
            if (keterangan === '') {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Keterangan Wajib Diisi',
                    text: 'Silakan isi kolom keterangan terlebih dahulu.',
                    confirmButtonColor: '#185a82'
                });
                return false;
            }
            idPelangganInp.disabled = false;
            kodeTokoInp.disabled = false;
        });
    </script>

    <?php if (!session()->get('logged_in')) : ?>
        <script>
            window.location.href = "<?= base_url('/login') ?>";
        </script>
    <?php endif; ?>
</body>

</html>