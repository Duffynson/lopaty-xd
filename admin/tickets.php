<?php 
session_start();

if(!isset($_SESSION['id_user'])) {
    header('Location: ./auth-error');
    exit();
}

include_once './php/components/header.php';
?>

      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Podpora</h1>
      </div>

      <div class="alert alert-danger alert-dismissible fade show d-none" role="alert">
      </div>

      <div class="d-flex flex-column justify-items-center align-items-center me-5">
        <a href="./new_ticket" class="btn btn-primary rounded-0">Vytvořit nový ticket</a>
    </div>

      <h3 class="h3 my_tickets_header d-none pt-3">Moje tickety</h3>
      <div class="table-responsive">
        <table class="my-tickets-table table table-striped table-sm text-center">
          <thead class="d-none">
              <tr>
                <th scope="col" class="px-3 text-start">Title</th>
                <th scope="col">Vytvořil</th>
                <th scope="col">Pro koho</th>
                <th scope="col">Vytvořeno</th>
                <th scope="col">Status</th>
                <th scope="col">Akce</th>
            </tr>
          </thead>
        </table>
      </div>

      <h3 class="h3 assigned_tickets_header d-none pt-3">Přiřazené tickety</h3>
      <div class="table-responsive">
        <table class="assigned-tickets-table table table-striped table-sm text-center">
          <thead class="d-none">
              <tr>
                <th scope="col" class="px-3 text-start">Title</th>
                <th scope="col">Vytvořil</th>
                <th scope="col">Pro koho</th>
                <th scope="col">Vytvořeno</th>
                <th scope="col">Status</th>
                <th scope="col">Akce</th>
            </tr>
          </thead>
        </table>
      </div>
    </main>

    <script type="module" src="./js/tickets.js"></script>
  </body>
</html>
