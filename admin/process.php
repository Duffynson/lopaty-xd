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

      <div class="process-detail fs-6 w-50 mx-auto">

      <table class="table process-table w-100">
        <tbody>
          <tr>
            <th scope="row">ID článku:</th>
            <td class="ID_article" colspan="2" >1</td>
          </tr>
          <tr>
            <th scope="row">Autor článku:</th>
            <td class="ID_user" colspan="2" >Jožo Kokotos</td>
          </tr>
          <tr>
            <th scope="row">Název článku</th>
            <td class="title" colspan="2" >Ja nevjem uš</td>
          </tr>
          <tr>
            <th scope="row">Datum vydání</th>
            <td colspan="2" class="datum_vydani"></td>
          </tr>
          <tr>
            <th scope="row" rowspan="2">Soubory</th>
            <td class="files" class="soubor">Soubor1</td>
          </tr>
          <tr>
            <td>Soubor2</td>
          </tr>
        </tbody>
      </table>

      <table class="table process-table w-100">
        <tbody>
          <tr>
            <th scope="row">ID řízení:</th>
            <td colspan="2" class="ID_rizeni">1</td>
          </tr>
          <tr>
            <th scope="row">Redaktor:</th>
            <td colspan="2" class="">Jožo Kokotos</td>
          </tr>
          <tr>
            <th scope="row">Status</th>
            <td colspan="2" >Ja nevjem uš</td>
          </tr>
          <tr>
            <th scope="row">Datum vytvoření</th>
            <td colspan="2" >2022-11-27</td>
            <td>
          </tr>
          <tr>
            <th scope="row">Datum ukončení</th>
            <td colspan="2" >2022-11-27</td>
          </tr>
          <tr>
            <th scope="row" rowspan="2">Recenze</th>
            <td class="text-danger">Ferko recenzent1</td>
            <td></td>
          </tr>
          <tr>
            <td class="text-success">Ferko recenzent2</td>
            <td><a href="./review?id=1" class="btn btn-primary fs-6">Zobrazit</a></td>
          </tr>
          <tr>
            <th scope="row">Komentář</th>
            <td></td>
            <td><a href="#" class="btn btn-primary fs-6">Zobrazit</a></td>
          </tr>
        </tbody>
      </table>

      <div class="process-detail-buttons text-center pb-3">
        <form class="approve-process" style="display: inline-block; margin-right: 10px;">
          <button type="submit" class="btn-success btn rounded-0" style="padding: 6px 12px;">Schválit</a>
        </form>

        <form class="reject-process">
          <button type="submit" class="btn-danger btn rounded-0" style="padding: 6px 12px;">Zamítnout</a>
        </form>
      </div>

      </div>

    </main>
    <script src="./js/process.js"></script>
  </body>
</html>
