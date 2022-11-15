<?php 
session_start();

if(!isset($_SESSION['id_user'])) {
    header('Location: ./auth-error');
    exit();
}

include_once './php/components/header.php';
?>

      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Články</h1>
      </div>
      
      <div class="align-center">
      <div class="alert alert-success alert-dismissible fade show d-none" role="alert">
      </div>
      <div class="alert alert-danger alert-error alert-dismissible fade show d-none" role="alert">
      </div>
      <form method="POST" class="add-article">
         <label>Zadejte název článku:</label>
         <input type="text" name="articleName" class="rounded-0"/><br>
         <input type="file" name="soubor"/>
         <input type="submit"/>				
      </form>
      </div>

    </main>

    <script src="./js/add_article.js"></script>
  </body>
</html>
