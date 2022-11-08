<?php 
session_start();
$role = $_SESSION['role'];

if(!isset($_SESSION['id_user']) || ($role != 4 && $_SESSION['id_user'] != $_GET['id'])) {
    header("Location: ./auth-error");
    exit();
}

include_once './php/components/header.php';

?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Správa uživatele</h1>
  </div>


  <div class="alert alert-success alert-dismissible fade show d-none" role="alert">
  </div>

  <div class="alert alert-danger alert-dismissible fade show d-none" role="alert">
  </div>

  
  <form class="user-detail row g-4 d-none" method="POST">
    <div class="col-md-12">
      <label for="id_user" class="form-label"><span class="text-danger">*</span> ID</label>
      <input type="text" class="form-control" id="id_user" name="id_user" readonly="readonly" required>
      <div class="id_user-error error-message text-danger form-text">&nbsp;</div>
    </div>
    <div class="col-md-4 col-sm-6 mt-1">
      <label for="firstname" class="form-label"><span class="text-danger">*</span> Jméno</label>
      <input type="text" class="form-control" id="firstname" name="firstname" required>
      <div class="firstname-error error-message text-danger form-text">&nbsp;</div>
    </div>
    <div class="col-md-4 col-sm-6 mt-1">
      <label for="lastname" class="form-label"><span class="text-danger">*</span> Příjmení</label>
      <input type="text" class="form-control" id="lastname" name="lastname" required>
      <div class="lastname-error error-message text-danger form-text">&nbsp;</div>
    </div>
    <div class="col-md-4 col-sm-6 mt-1">
      <label for="email" class="form-label"><span class="text-danger">*</span> Email</label>
      <input type="email" class="form-control" id="email" name="email" required>
      <div class="email-error error-message text-danger form-text">&nbsp;</div>
    </div>
    <div class="col-md-4 col-sm-6 mt-1">
      <label for="address" class="form-label">Adresa</label>
      <input type="text" class="form-control" id="address" name="address">
      <div class="address-error error-message text-danger form-text">&nbsp;</div>
    </div>
    <div class="col-md-4 col-sm-6 mt-1">
      <label for="phone" class="form-label">Telefonní číslo</label>
      <input type="tel" class="form-control" id="phone" name="phone">
      <div class="phone-error error-message text-danger form-text">&nbsp;</div>
    </div>
    <div class="col-md-4 col-sm-6 mt-1">
      <label for="role" class="form-label"><span class="text-danger">*</span> Role</label>
      <select id="role" class="form-select" name="role">
        <option value="0" <?php if($role != 0 && $role != 4) echo "disabled"?>>Autor</option>
        <option value="1" <?php if($role != 1 && $role != 4) echo "disabled"?> >Recenzent</option>
        <option value="2" <?php if($role != 2 && $role != 4) echo "disabled"?> >Redaktor</option>
        <option value="3" <?php if($role != 3 && $role != 4) echo "disabled"?> >Šéfredaktor</option>
        <option value="4" <?php if($role != 4 && $role != 4) echo "disabled"?> >Administrátor</option>
      </select>
      <div class="role-error error-message text-danger form-text">&nbsp;</div>
    </div>
    <div class="col-12 text-end  mt-1">
      <button type="submit" class="btn btn-primary rounded-0 border-0">Uložit změny</button>
    </div>
  </form>
  
  <form class="change-password row g-3 mt-5 d-none" method="POST">
  
    <div class="col-sm-6">
      <label for="password" class="form-label"><span class="required text-danger"></span>Nové heslo</label>
      <input type="password" class="form-control" id="password" name="password"  minlength="8" maxlength="100" required>
      <div class="password-error error-message text-danger form-text">&nbsp;</div>
    </div>
    <div class="col-sm-6">
      <label for="password_again" class="form-label"><span class="required text-danger"></span>Nové heslo znovu</label>
      <input type="password" class="form-control" id="password_again" name="password_again"  maxlength="100" minlength="8" required>
      <div class="password_again-error error-message text-danger form-text">&nbsp;</div>
    </div>

    <div class="col-12 text-end mt-1 pb-5">
      <button type="submit" class="btn btn-primary rounded-0 border-0 change-password-button">Změnit heslo</button>
    </div>
    <input type="hidden" id="id_user_hidden" name="id_user" value="<?php echo $_GET['id'] ?>">
  </form>
</main>
    <script type="module" src="./js/user.js"></script>
  </body>
</html>
