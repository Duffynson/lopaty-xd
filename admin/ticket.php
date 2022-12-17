<?php 
session_start();

if(!isset($_SESSION['id_user'])) {
    header('Location: ./auth-error');
    exit();
}

include_once './php/components/header.php';
?>

      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Ticket #<?php echo $_GET['id'] ?></h1>
      </div>
      <div class="alert alert-success alert-dismissible fade show d-none" role="alert">
      </div>
      <div class="alert alert-danger alert-error alert-dismissible fade show d-none" role="alert">
     </div>

     <form class="container pt-4 add_response_form" method="POST">
        <input type="hidden" value="<?php echo $_GET['id'] ?>" name="ticket_id" id="ticket_id">
        <input type="hidden" name="creator_id" id="creator_id" class="creator_id">
        <label for="ticket_text" class="form-label"></label>
        <div class="d-flex flex-row justify-content-start">
            <textarea class="flex-fill form-control rounded-0" name="ticket_text" id="ticket_text" rows="6" required disabled></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3 rounded-0 d-none add_response">Přidat odpověď</button>
        <button class="btn btn-danger mt-3 rounded-0 close_ticket d-none">Uzavřít ticket</button>
    </form>


    <hr class="mt-5 d-block">

    <div class="ticket_responses container pb-3">
    </div>

</main>

    <script src="./js/ticket.js"></script>
  </body>
</html>
