<?php 
$page_title = "Login";
include __DIR__ . '/includes/header.php';


?>
        <section class="main-account">
            <h2>Login Petugas</h2>
            <form id="form-account">
                <p>
                    <label for="username">Username</label>
                    <input type="text" id="username" name="user" required>
                </p>
                <p> 
                    <label for="password">Password</label>
                    <input type="password" id="password" name="pass" minlength="8" required>
                </p>
                <button type="submit">Masuk</button>
                <a href="">Lupa Password?</a>
                <p>Belum punya akun? <a href="register.html">Daftar di sini</a></p>
            </form>
        </section>
<?php include __DIR__ . '/includes/footer.php'; ?>