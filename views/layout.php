<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Opinion Box</title>
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
  <link href="<?= urlOnline; ?>views/template/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
  <div class="nav" id="nav">
    <nav class="nav__content">
      <div class="nav__toggle" id="nav-toggle">
        <i onclick="check()" class="bx bx-chevron-right"></i>
      </div>
      <a href="https://www.opinionbox.com/" target="_blank" class="nav__logo">
        <i id="logoSquare" class="bx bx-square"></i>
        <span class="nav__logo-name"><img width="50%" style="margin-top: 8px" src="<?= urlOnline; ?>views/template/img/logo.png" rel="stylesheet"></span>
      </a>
      <div class="nav__list">
        <a href="<?= urlOnline; ?>" class="nav__link active-link">
          <i class="bx bx-user"></i>
          <span class="nav__name">Clientes</span>
        </a>
        <a href="<?= urlOnline; ?>relatorios" class="nav__link">
          <i class="bx bx-bar-chart-square"></i>
          <span class="nav__name">Relatórios</span>
        </a>
      </div>
    </nav>
  </div>
  <main class="container section">
    <?php
    call($controller, $action, $params);
    ?>
  </main>
  <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
  <script src="<?= urlOnline; ?>views/template/js/main.js"></script>
  <script src="<?= urlOnline; ?>views/template/js/functions.js"></script>
  <script src="<?= urlOnline; ?>views/template/js/jquery.mask.js"></script>

</body>

</html>