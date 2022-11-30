<?php 
session_start();

if(!isset($_SESSION['id_user']) || $_SESSION['role'] != 4) {
  header('Location: ./auth-error');
  exit();
}

include_once './php/components/header.php';
?>

      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Uživatelé</h1>
      </div>

      <div class="alert alert-danger alert-dismissible fade show d-none" role="alert">
      </div>

      <div class="table-responsive">
        <table class="users-table table table-striped table-sm">
          <thead class="d-none">
              <tr>
                <th scope="col" class="px-3">ID</th>
                <th scope="col">Firstname</th>
                <th scope="col">Lastname</th>
                <th scope="col">Email</th>
                <th scope="col" class="role">Role</th>
                <th scope="col" class="actions">Akce</th>
            </tr>
          </thead>
        </table>
      </div>
    </main>

<script src="./js/users.js"></script>
  </body>
</html>
