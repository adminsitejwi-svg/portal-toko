<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Register User</title>
    <link rel="icon" type="image/png" href="<?= base_url('store.png') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg">

        <h2 class="text-2xl font-bold text-center mb-6">
            Register User
        </h2>

        <form id="registerForm" action="<?= site_url('register/save') ?>" method="post" novalidate>

            <?= csrf_field() ?>

            <!-- tampilkan error dari server (CodeIgniter) jika ada -->
            <?php if (session()->getFlashdata('errors')) : ?>
                <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-600 rounded-lg text-sm">
                    <?php foreach (session()->getFlashdata('errors') as $err) : ?>
                        <div><?= esc($err) ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="mb-4">
                <label class="block mb-2 font-medium">Username</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    value="<?= old('username') ?>"
                    class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan username">
                <p class="error-msg text-red-500 text-sm mt-1 hidden" data-for="username"></p>
            </div>



            <div class="mb-4">
                <label class="block mb-2 font-medium">Password</label>
                <div class="relative">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="w-full border rounded-lg px-4 py-2 pr-12 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan password">
                    <button
                        type="button"
                        onclick="togglePassword('password','iconPassword')"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500">
                        <i id="iconPassword" class="ti ti-eye"></i>
                    </button>
                </div>
                <p class="error-msg text-red-500 text-sm mt-1 hidden" data-for="password"></p>
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-medium">Confirm Password</label>
                <input
                    type="password"
                    id="confirm_password"
                    name="confirm_password"
                    class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Ulangi password">
                <p class="error-msg text-red-500 text-sm mt-1 hidden" data-for="confirm_password"></p>
            </div>

            <button
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold">
                Register
            </button>

            <div class="text-center mt-5">
                <span class="text-gray-600">Sudah punya akun?</span>
                <a href="<?= site_url('login') ?>" class="text-blue-600 hover:text-blue-800 font-semibold ml-1">Login</a>
            </div>
        </form>

    </div>

</body>
<script>
    function togglePassword(inputId, iconId) {

        let input = document.getElementById(inputId);
        let icon = document.getElementById(iconId);

        if (input.type === "password") {

            input.type = "text";

            icon.classList.remove("ti-eye");
            icon.classList.add("ti-eye-off");

        } else {

            input.type = "password";

            icon.classList.remove("ti-eye-off");
            icon.classList.add("ti-eye");
        }
    }
</script>
<script>
    // PENGHALANG KOSMETIK SAJA — bukan security, mudah dilewati
    document.addEventListener('contextmenu', e => e.preventDefault()); // klik kanan
    document.addEventListener('keydown', e => {
        if (e.key === 'F12') e.preventDefault(); // F12
        if (e.ctrlKey && e.shiftKey && ['I', 'J', 'C'].includes(e.key.toUpperCase())) e.preventDefault();
        if (e.ctrlKey && e.key.toUpperCase() === 'U') e.preventDefault(); // view-source
    });
</script>
<script>
    function showError(field, message) {
        const input = document.getElementById(field);
        const msg = document.querySelector('.error-msg[data-for="' + field + '"]');
        if (msg) {
            msg.textContent = message;
            msg.classList.remove('hidden');
        }
        if (input) input.classList.add('border-red-500');
    }

    function clearError(field) {
        const input = document.getElementById(field);
        const msg = document.querySelector('.error-msg[data-for="' + field + '"]');
        if (msg) {
            msg.textContent = '';
            msg.classList.add('hidden');
        }
        if (input) input.classList.remove('border-red-500');
    }

    document.getElementById('registerForm').addEventListener('submit', function(e) {
        let valid = true;

        const username = document.getElementById('username').value.trim();
        const password = document.getElementById('password').value;
        const confirm = document.getElementById('confirm_password').value;

        // reset semua error dulu
        ['username', 'password', 'confirm_password'].forEach(clearError);

        // cek kosong
        if (username === '') {
            showError('username', 'Username wajib diisi');
            valid = false;
        }
        if (password === '') {
            showError('password', 'Password wajib diisi');
            valid = false;
        }
        if (confirm === '') {
            showError('confirm_password', 'Konfirmasi password wajib diisi');
            valid = false;
        }

        // cek password cocok (hanya jika keduanya terisi)
        if (password !== '' && confirm !== '' && password !== confirm) {
            showError('confirm_password', 'Konfirmasi password tidak cocok');
            valid = false;
        }

        // kalau ada yang tidak valid, batalkan submit
        if (!valid) e.preventDefault();
    });

    // hapus pesan error saat user mulai mengetik/memilih
    ['username', 'password', 'confirm_password'].forEach(function(id) {
        const el = document.getElementById(id);
        if (el) {
            el.addEventListener('input', () => clearError(id));
            el.addEventListener('change', () => clearError(id));
        }
    });
</script>

</html>