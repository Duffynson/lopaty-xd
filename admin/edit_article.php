<?php 
session_start();

if(!isset($_SESSION['id_user'])) {
    header('Location: ./auth-error');
    exit();
}

include_once './php/components/header.php';
?>

      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Aktualizace článku</h1>
      </div>
      <div class="alert alert-success alert-dismissible fade show d-none" role="alert">
      </div>
      <div class="alert alert-danger alert-error alert-dismissible fade show d-none" role="alert">
     </div>
      <div class="container">
      <div class="d-flex justify-content-center p-3 article-wrap w-50 m-auto">
      <div class="card rounded-0">

      <h5 class="card-header info-color white-text bg bg-dark text-center py-4 mb-2 rounded-0">
      </h5>
    
      <div class="card-body px-lg-5 pt-0">    
      <form method="POST" class="edit-article md-form" style="color: #757575;">
      <input type="hidden" name="article_id" value=<?php echo $_GET['id'] ?>>
      <div class="file-field">
      <div class="float-left p-3">
         <input type="file" name="soubor" class="rounded-0 form-control">
      </div>
      <div class="file-path-wrapper m-2 p-2 text-center">
          <input class="file-path validate btn btn-primary rounded-0" type="submit" value="Nahrát soubor">
      </div>
      </div>
      </div>
      </div>
      </div>
      </div>
</main>

    <script src="./js/edit_article.js"></script>
  </body>
</html>
