<?php 
session_start();

if(!isset($_SESSION['id_user'])) {
    header('Location: ./auth-error');
    exit();
}

include_once './php/components/header.php';
?>

      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Vytvoření ticketu</h1>
      </div>
      <div class="alert alert-success alert-dismissible fade show d-none" role="alert">
      </div>
      <div class="alert alert-danger alert-error alert-dismissible fade show d-none" role="alert">
     </div>

     <form class="container pt-4 new_ticket_form">
        <div class="d-flex flex-row justify-content-start gap-4">
            <div class="mb-3 flex-fill">
                <label for="ticket_title" class="form-label">Název title</label>
                <input type="text" class="form-control rounded-0" id="ticket_title" name="ticket_title" required>
            </div>
            <div class="mb-3 flex-fill">
                <label for="ticket_receiver" class="form-label">Pro koho</label>
                <select id="ticket_receiver" name="ticket_receiver" class="form-select rounded-0" required>
                    <option value="3">Šéfredaktor</option>
                    <option value="4">Administrátor</option>
                </select>
            </div>
        </div>

        <label for="ticket_text" class="form-label">Popis problému</label>
        <div class="d-flex flex-row justify-content-start">
            <textarea class="flex-fill form-control rounded-0" name="ticket_text" id="ticket_text" rows="6" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3 rounded-0">Vytvořit ticket</button>
    </form>

</main>

    <script src="./js/new_ticket.js"></script>
  </body>
</html>
