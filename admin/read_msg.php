<!doctype html>
<?php include_once '../php/db.php';?>
<?php include_once './php/components/header.php';?>
<?php 
if(isset($_GET['id'])){
    $main_id = $_GET['id'];
    $sql_update = mysqli_query($conn, "UPDATE notifications SET status = 1 WHERE id = '$main_id'");
}
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Administrace</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href="./style/dashboard.css" rel="stylesheet">
</head>
<body>
<header>
<div class="container mt-5">
    <div class="row">
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">subject</th>
      <th scope="col">Comment</th>
      <th scope="col">Date</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sr_no=1;
     $sql_get = mysqli_query($conn, "SELECT * FROM notifications WHERE status = 1");
    while($main_result = mysqli_fetch_assoc($sql_get))
    :?>
    <tr>
      <th scope="row"><?php echo $main_result['id']; ?></th>
      <td><?php echo $main_result['subjekt']; ?></td>
      <td><?php echo $main_result['comment']; ?></td>
      <td><?php echo $main_result['created_at']; ?></td>
      <td><a href="delete.php?id=<?php echo $main_result['id']?>;"><i class="fa-solid fa-trash text-danger"></i></a></td>
    </tr>
    <?php endwhile;?>
  </tbody>
</table>
    </div>
</div>
</header>
<div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky sidebar-sticky">
        <?php if(isset($_SESSION['id_user'])) echo "
        <h6 class='sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase'>
          <span>Agenda</span>
        </h6> "; ?>
          <ul class="nav flex-column">
          <?php 
            if(isset($_SESSION['id_user'])) echo "
            <li class='nav-item'>
                <a class='nav-link' aria-current='page' href='./clanek'>
                <i class='fa-solid fa-plus fa-fw'></i>
              Přidat článek
              </a>
            </li>";
            if(isset($_SESSION['id_user'])) echo "
            <li class='nav-item'>
                <a class='nav-link' aria-current='page' href='./clanky'>
                <i class='fa-solid fa-users fa-fw'></i>
                Články
              </a>
            </li>";
            if(isset($_SESSION['id_user'])) echo "
            <li class='nav-item'>
                <a class='nav-link' aria-current='page' href='./processes'>
                <i class='fa-solid fa-list-check fa-fw'></i>
              Řízení
              </a>
            </li>";
            if(isset($_SESSION['id_user'])) echo "
            <li class='nav-item'>
              <a class='nav-link' aria-current='page' href='./recenze'>
                <i class='fa-solid fa-file fa-fw'></i>
                Recenze
              </a>
            </li>"; ?>
          </ul> 

          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
          <span>Ostatní</span>
          </h6>
        <ul class="nav flex-column mb-2">
          <?php if(isset($_SESSION['id_user']) && $_SESSION['role'] == 4) echo "
          <li class='nav-item'>
            <a class='nav-link' aria-current='page' href='./users'>
              <i class='fa-solid fa-users fa-fw'></i>
              Uživatelé
            </a>
          </li>";
          if(isset($_SESSION['id_user'])) echo "
          <li class='nav-item'>
            <a class='nav-link' href='./user?id={$_SESSION['id_user']}'>
              <i class='fa-solid fa-user fa-fw'> </i>
              Můj účet
            </a>
          </li>"; ?>
          <li class="nav-item">
            <a class="nav-link" href="../">
              <i class="fa-solid fa-newspaper fa-fw"></i>
              Časopis
            </a>
          </li>
          <?php if(isset($_SESSION['id_user'])) echo "
          <li class='nav-item'>
            <a class='nav-link' href='../../php/logout'>
              <i class='fa-solid fa-right-from-bracket fa-fw'></i>
              Odhlásit se
            </a>
          </li>"; ?>
        </ul>
      </div>
    </nav>
        </div>
      
    </div>

  <main class="col-md-9 ms-md-auto col-lg-10 px-md-4">
