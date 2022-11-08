<?php
include_once './php/components/header.php';

// Pokud je uživatel už přihlášený, přesměruj ho na index.php
if(isset($_SESSION['id_user'])) {
    header('Location: ./');
    exit();
}

?>
<div class="register-wrap bg-light p-4 mb-5 mt-5">
    <h2 class="text-center fw-bold">Registrace</h2>
    <form method="POST" class="register-form">
    <div class="error error-message text-center fs-6 text-danger">&nbsp;</div>
        <div class="mb-3 mt-4 form-item form-floating">
            <input type="text" class="form-control rounded-0 border-0" id="firstname" name="firstname" maxlength="100" required autofocus placeholder="Jméno" pattern="^[\p{L}\s]+$">
            <label for="firstname" class="form-label"><span class="text-danger">*</span> Jméno</label>
            <div class="firstname-error error-message text-danger form-text">&nbsp;</div>
        </div>
        <div class="mb-3 mt-4 form-item form-floating">
            <input type="text" class="form-control rounded-0 border-0" id="lastname" name="lastname"  maxlength="100" required placeholder="Příjmení" pattern="^[\p{L}\s]+$">
            <label for="lastname" class="form-label"><span class="text-danger">*</span> Příjmení</label>
            <div class="lastname-error error-message text-danger form-text">&nbsp;</div>
        </div>
        <div class="mb-3 mt-4 form-item form-floating">
            <input type="email" class="form-control rounded-0 border-0" id="email" name="email" maxlength="100" required placeholder="Email">
            <label for="email" class="form-label"><span class="text-danger">*</span> Email</label>
            <div class="email-error error-message text-danger form-text">&nbsp;</div>
        </div>
        <div class="mb-3 mt-4 form-item form-floating">
            <input type="password" class="form-control rounded-0 border-0" id="password" name="password"  minlength="8" maxlength="100" required placeholder="Heslo">
            <label for="password" class="form-label"><span class="text-danger">*</span> Heslo</label>
            <div class="password-error error-message text-danger form-text">&nbsp;</div>
        </div>
        <div class="mb-3 form-item form-floating">
            <input type="password" class="form-control rounded-0 border-0" id="password_again" name="password_again"  maxlength="100" minlength="8" required placeholder="Znovu heslo">
            <label for="password_again" class="form-label"><span class="text-danger">*</span> Znovu heslo</label>
            <div class="password_again-error error-message text-danger form-text">&nbsp;</div>
        </div>
        <button type="submit" class="btn btn-dark mt-3 register-button py-2 w-100 rounded-0" disabled>Vytvořit účet</button>
        <p class="text-center pt-4 mb-0">Už máte účet? <a href="./login" id="go-login" class="login-form-redirect text-decoration-none">Přihlásit se</a></p>
    </form>
</div>

    <script src="./js/register.js"></script>

<?php include_once './php/components/footer.php'; ?>