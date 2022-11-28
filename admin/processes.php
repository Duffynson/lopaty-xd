<?php 
session_start();

if(!isset($_SESSION['id_user'])) {
    header('Location: ./auth-error');
    exit();
}

include_once './php/components/header.php';
?>

      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Řízení</h1>
      </div>

      <div class="alert alert-danger alert-dismissible fade show d-none" role="alert">
      </div>

        <h3 class="h3 my_processes_header d-none">Moje řízení</h3>
      <div class="table-responsive">
        <table class="my-processes-table table table-striped table-sm text-center">
          <thead class="d-none">
              <tr>
                <th scope="col" class="px-3 text-start">ID</th>
                <th scope="col">Název</th>
                <th scope="col">Status</th>
                <th scope="col">Přidáno</th>
                <th scope="col">Akce</th>
            </tr>
          </thead>
        </table>
      </div>

      <h3 class="h3 unclaimed_processes_header d-none">Volná řízení</h3>
      <div class="table-responsive">
        <table class="unclaimed-processes-table table table-striped table-sm text-center">
          <thead class="d-none">
              <tr>
              <th scope="col" class="px-3 text-start">ID</th>
              <th scope="col">Název</th>
                <th scope="col">Status</th>
                <th scope="col">Přidáno</th>
                <th scope="col">Akce</th>
            </tr>
          </thead>
        </table>
      </div>

    </main>

    <script src="./js/processes.js"></script>
  </body>
</html>
