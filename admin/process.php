<?php 
session_start();

if(!isset($_SESSION['id_user'])) {
    header('Location: ./auth-error');
    exit();
}

include_once './php/components/header.php';
?>

      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Řízení článku</h1>
      </div>

      <div class="alert alert-danger alert-dismissible fade show d-none" role="alert">
      </div>

      <div class="process-detail fs-6 w-50 mx-auto">

      <table class="table article-table w-100 table-xl">
        <tbody>
          <tr>
            <th scope="row">ID článku:</th>
            <td class="ID_article" colspan="2" ></td>
          </tr>
          <tr>
            <th scope="row">Autor článku:</th>
            <td class="ID_user" colspan="2" ><span class="autor_firstname"></span> <span class="autor_lastname"></span></td>
          </tr>
          <tr>
            <th scope="row">Název článku</th>
            <td class="title" colspan="2" class="title"></td>
          </tr>
          <tr>
            <th scope="row">Datum vydání</th>
            <td colspan="2" class="datum_vydani"></td>
          </tr>
            <tr>
              <th scope="row" rowspan="2">Soubory</th>
              <td><a href="" class="soubor"></a></td>
            </tr>
            <tr>
              <td>
                <a href="" class="soubor2"></a>
                <form class="allow_upload_button d-none">
                  <button type="submit" class="btn-primary btn rounded-0" style="padding: 6px 12px; margin-right: 10px;">Předat zpět autorovi</a>
                </form>
              </td>
            </tr>
        </tbody>
      </table>

      <table class="table process-table w-100 table-xl mt-5">
        <tbody>
          <tr>
            <th scope="row">ID řízení:</th>
            <td colspan="2" class="ID_rizeni"></td>
          </tr>
          <tr>
            <th scope="row">Redaktor:</th>
            <td colspan="2" class=""><span class="editor_firstname"></span> <span class="editor_lastname"></span></td>
          </tr>
          <tr>
            <th scope="row">Status</th>
            <td colspan="2" class="status"></td>
          </tr>
          <tr>
            <th scope="row">Datum vytvoření</th>
            <td colspan="2" class="datum_vytvoreni"></td>
            <td>
          </tr>
          <tr>
            <th scope="row">Datum ukončení</th>
            <td colspan="2" class="datum_ukonceni"></td>
          </tr>
          <tr>
            <th scope="row" rowspan="2">Recenze</th>
            <td class=""><span class="rizeni1_firstname">
              <form method="POST" class="form_rizeni1 d-none">
                <select name="recenzent1" id="rizeni1_firstname_select"></select>
                <input type="hidden" value="<?php echo $_GET['id']; ?>" name="id">
                <input type="submit" value="Vybrat" class="btn btn-primary" style="position: relative; top: -3px;">
              </form>
            </span> <span class="rizeni1_lastname"></span>
              </td>
            <td><a href="" class="btn btn-primary fs-6 show_rizeni1 d-none">Zobrazit</a></td>
          </tr>
          <tr>
            <td class=""><span class="rizeni2_firstname">
            <form method="POST" class="form_rizeni2 d-none">
                <select name="recenzent2" id="rizeni2_firstname_select"></select>
                <input type="hidden" value="<?php echo $_GET['id']; ?>" name="id">
                <input type="submit" value="Vybrat" class="btn btn-primary" style="position: relative; top: -3px;">
              </form>
            </span> <span class="rizeni2_lastname"></span></td>
            <td><a href="" class="btn btn-primary fs-6 show_rizeni2 d-none">Zobrazit</a></td>
          </tr>
          <tr>
            <th scope="row">Komentář</th>
            <td></td>
            <td></td>
          </tr>
        </tbody>
      </table>

      <div class="process-detail-buttons text-center pb-3 d-none">
        <form class="approve-process" style="display: inline-block; margin-right: 10px;">
          <button type="submit" class="btn-success btn rounded-0" style="padding: 6px 12px;">Schválit</a>
        </form>

        <form class="reject-process">
          <button type="submit" class="btn-danger btn rounded-0" style="padding: 6px 12px;">Zamítnout</a>
        </form>
      </div>

      </div>

    </main>
    <script type="module" src="./js/process.js"></script>
  </body>
</html>
