<?php
include_once './php/components/header.php';

// Pokud je uživatel už přihlášený, přesměruj ho na index.php
if(isset($_SESSION['id_user'])) {
    header('Location: ./');
    exit();
}

?>
    
    <div class="login-wrap bg-light p-4 mt-5">
        <h2 class="text-center fw-bold">Přihlášení</h2>
        <form class="login-form" method="POST"> 
            <div class="error error-message text-center fs-6 text-danger">&nbsp;</div>
            <div class="mb-3 mt-4 form-item form-floating">
                <input type="email" class="form-control rounded-0 border-0" id="email" name="email" required autofocus placeholder="Email">
                <label for="email" class="form-label">Email</label>
                <div class="email-error error-message text-danger form-text">&nbsp;</div>
            </div>
            <div class="mb-3 form-item form-floating">
            <input type="password" class="form-control rounded-0 border-0" id="password" name="password" required placeholder="Heslo">
            <label for="password" class="form-label">Heslo</label>
            <div class="password-error error-message text-danger form-text">&nbsp;</div>
        </div>
        <button type="submit" class="btn btn-dark mt-3 py-2 w-100 rounded-0">Přihlásit se</button>
        <p class="text-center pt-4 mb-0">Ještě nemáte účet? <a href="./register" id="go-register" class="login-form-redirect text-decoration-none">Vytvořit účet</a></p>
    </form>
</div>

    <script src="./js/login.js"></script>

<?php include_once './php/components/footer.php'; ?>