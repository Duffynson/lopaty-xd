<?php 
session_start();

if(!isset($_SESSION['id_user'])) {
    header('Location: ./auth-error');
    exit();
}

include_once './php/components/header.php';
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Recenze</h1>
      </div>
      <div class="alert alert-success alert-dismissible fade show d-none" role="alert">
      </div>
      <div class="alert alert-danger alert-error alert-dismissible fade show d-none" role="alert">
     </div>
      <div class="container">
      <div class="d-flex justify-content-center p-2 article-wrap m-auto">
      <div class="card rounded-0" style="width:100%">

      <h5 class="card-header info-color white-text bg bg-dark text-center py-4 mb-2 rounded-0">
      </h5>
    
      <div class="card-body px-lg-5 pt-0">    
      <form method="POST" class="add-review md-form" style="color: #757575;">
        <input type="hidden" id="id_review_hidden" name="id_review" value="<?php echo $_GET['id'] ?>">
        <input type="hidden" id="ID_rizeni" class="ID_rizeni" name="ID_rizeni" value="">
        <div class="text-center">
         <label for="input">Aktuálnost, zajímavost, přínosnost</label>
         <fieldset id="aktualnost">
         <div class="form-check form-check-inline">
          <input class="form-check-input aktualnost" type="radio" name="aktualnost" id="aktualnost1" value="1">
          <label class="form-check-label" for="aktualnost1">1</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input aktualnost" type="radio" name="aktualnost" id="aktualnost2" value="2">
          <label class="form-check-label" for="aktualnost2">2</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input aktualnost" type="radio" name="aktualnost" id="aktualnost3" value="3">
          <label class="form-check-label" for="aktualnost3">3</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input aktualnost" type="radio" name="aktualnost" id="aktualnost4" value="4">
          <label class="form-check-label" for="aktualnost4">4</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input aktualnost" type="radio" name="aktualnost" id="aktualnost5" value="5">
          <label class="form-check-label" for="aktualnost5">5</label>
        </div>
        </fieldset>
      </div>
      <div class="text-center">
        <label for="input">Originalita</label>
        <fieldset id="originalita">
        <div class="form-check form-check-inline">
          <input class="form-check-input originalita" type="radio" name="originalita" id="originalita1" value="1">
          <label class="form-check-label" for="originalita1">1</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input originalita" type="radio" name="originalita" id="originalita2" value="2">
          <label class="form-check-label" for="originalita2">2</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input originalita" type="radio" name="originalita" id="originalita3" value="3">
          <label class="form-check-label" for="originalita3">3</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input originalita" type="radio" name="originalita" id="originalita4" value="4">
          <label class="form-check-label" for="originalita4">4</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input originalita" type="radio" name="originalita" id="originalita5" value="5">
          <label class="form-check-label" for="originalita5">5</label>
        </div>
        </fieldset>
      </div>
      <div class="text-center">
        <label for="input">Odborná úroveň</label>
        <fieldset id="odbornost">
        <div class="form-check form-check-inline">
          <input class="form-check-input odbornost" type="radio" name="odbornost" id="odbornost1" value="1">
          <label class="form-check-label" for="odbornost1">1</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input odbornost" type="radio" name="odbornost" id="odbornost2" value="2">
          <label class="form-check-label" for="odbornost2">2</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input odbornost" type="radio" name="odbornost" id="odbornost3" value="3">
          <label class="form-check-label" for="odbornost3">3</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input odbornost" type="radio" name="odbornost" id="odbornost4" value="4">
          <label class="form-check-label" for="odbornost4">4</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input odbornost" type="radio" name="odbornost" id="odbornost5" value="5">
          <label class="form-check-label" for="odbornost5">5</label>
        </div>
        </fieldset>
      </div>
      <div class="text-center">
        <label for="input">Jazyková a stylistická úroveň</label>
        <fieldset id="jazyk">
        <div class="form-check form-check-inline">
          <input class="form-check-input jazyk" type="radio" name="jazyk" id="jazyk1" value="1">
          <label class="form-check-label" for="jazyk1">1</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input jazyk" type="radio" name="jazyk" id="jazyk2" value="2">
          <label class="form-check-label" for="jazyk2">2</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input jazyk" type="radio" name="jazyk" id="jazyk3" value="3">
          <label class="form-check-label" for="jazyk3">3</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input jazyk" type="radio" name="jazyk" id="jazyk4" value="4">
          <label class="form-check-label" for="jazyk4">4</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input jazyk" type="radio" name="jazyk" id="jazyk5" value="5">
          <label class="form-check-label" for="jazyk5">5</label>
        </div>
        </fieldset>
      </div>
      <div class="file-field">
      <div class="float-left p-3">
        <label for="textComment">Textový komentář</label>
        <textarea name="textComment" class="rounded-0 form-control comment"></textarea>
      </div>
      <div class="file-path-wrapper m-2 p-2 text-center">
          <input class="file-path validate btn btn-success rounded-0 submit_review d-none" type="submit" name="submit" value="Přidat recenzi">
      </div>
      </div>
      </form>
      </div>
      </div>
      </div>
</div>
</main>
<script src="./js/add_review.js"></script>
</body>
</html>
