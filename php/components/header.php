<?php session_start() ?>
<!DOCTYPE html>
<html lang='cs' class="h-100">
  <head>
    <title>Los Lopatos</title>
    <meta charset='utf-8'>
    <meta name='robots' content='all'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href='./assets/lopata.png' rel='shortcut icon' type='image/png'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style/login.css" type="text/css"> 
    <link type="text/css" href="./style/main.css" rel="stylesheet">   
  </head>

<body class="d-flex flex-column h-100">
    <header>
  <nav class="navbar navbar-expand-md fixed-top shadow-sm bg-dark navbar-dark ">
    <div class="container">
      <a class="navbar-brand" href="./"><img src="./assets/lopata.png" alt="" width="30" height="30" class="d-inline-block align-text-top">Los Lopatos</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ms-auto mb-2 mb-md-0 d-flex">
          <li class="nav-item text-right">
            <a class="nav-link  <?php if($_SERVER['SCRIPT_NAME'] == '/index.php') echo 'active'?>" aria-current="page" href="./">Domů</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($_SERVER['SCRIPT_NAME'] == '/publish.php') echo 'active'?>" href="./publish">Jak publikovat</a>
          </li>
          <li class='separator'>
          </li>
          <li class='nav-item'>
            <?php 
              if(!isset($_SESSION['id_user']))
                if($_SERVER['SCRIPT_NAME'] == '/login.php') echo "<a class='nav-link active' href='./login'>Přihlášení</a>";
                else echo "<a class='nav-link' href='./login'>Přihlášení</a>";
              else echo "<a class='nav-link' class='name' href='./admin/user?id={$_SESSION['id_user']}'>[{$_SESSION['firstname']} {$_SESSION['lastname']}]</a>"; ?>
          </li>
          <li class='nav-item'>
            <?php
              if(!isset($_SESSION['id_user']))
                if($_SERVER['SCRIPT_NAME'] == '/register.php') echo "<a class='nav-link active' href='./register'>Registrace</a>";
                else echo "<a class='nav-link' href='./register'>Registrace</a>";
              else echo "<a class='nav-link' href='./admin'>Agenda</a>"; ?>
          </li>
          <?php if(isset($_SESSION['id_user'])) echo "<li class='nav-item'><a class='nav-link' href='./php/logout'>Odhlásit</a></li>"; ?>
        </ul>
      </div>
    </div>
  </nav>
</header>

<main class="flex-shrink-0">
    <div class="container">
        