  <!-- HEADER -->
  <header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="<?php echo ROUTES['app']['Home'] ?>">
      <img class="navbar-brand-full" src="<?php echo media(); ?>img/logo-uniajc.svg" width="95" alt="logo uniajc">
      <img class="navbar-brand-minimized" src="<?php echo media(); ?>img/logo-uniajc.svg" width="30" alt="logo uniajc">
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
      <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="nav navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
          <img class="img-avatar" src="<?php echo media(); ?>img/avatars/user-default.svg" alt="admin@bootstrapmaster.com">
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <div class="dropdown-header text-center">
            <strong>Bienvenido <br> <?php echo $_SESSION['nombre']; ?> </strong>
          </div>
          <a class="dropdown-item" href="<?php echo ROUTES['app']['Logout'] ?>">
            <i class="fa fa-lock"></i> Salir
          </a>

        </div>
      </li>
    </ul>
  </header>
  <!-- HEADER -->