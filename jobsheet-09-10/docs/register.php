<?php 
$page_title = "Register";
include __DIR__ . '/includes/header.php';

?>
        <section class="main-account">
            <h2>Registrasi Anggota</h2>
            <form id="form-account">
                <p>
                    <label for="nama">Nama</label>
                    <input type="text" id="username" name="user" required>
                </p>
                <p>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="pass" minlength="8" required>
                </p>
                <p>
                    <label for="no_hp">No. Telepon</label>
                    <input type="number" id="no_hp" name="no_hp" required>
                </p>
                <p>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </p>
                <button type="masuk">Daftar</button>
                <a href="">Lupa Password?</a>
                <p>Sudah punya akun? <a href="login.html">Login di sini</a></p>
            </form>
        </section>
<?php include __DIR__ . '/includes/footer.php'; ?>