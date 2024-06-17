<?php $csrf = $params['csrf'] ?? null ?>


<nav class="navbar navbar-expand-lg border-bottom fixed-top pr-font" id="navbar">
  <div class="container-fluid ">
    <a class="navbar-brand " href="/">Brand</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link btn-dark " href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn-dark " href="/admin">Admin</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link btn-dark dropdown-toggle " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item ">Hello</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link btn-dark disabled " href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <?php if (isset($_SESSION['userId'])) : ?>
        <div class="btn-group dropstart">

          <div class="dropdown">
            <button class="btn  dropdown-toggle p-1 " type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="/public/assets/uploads/images/1.png" class="avatar img-fluid rounded-circle" style="height: 30px; width: 30px;" alt="">
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
              <li>
                <form action="/user/logout" class="px-5" method="POST">
                  <?= $csrf->generate() ?>
                  <button class="btn btn-danger " type="submit">Logout</button>
                </form>
              </li>
            </ul>
          </div>


        </div>
      <?php else : ?>
        <div class="form-check form-switch mt-2">
          <input class="form-check-input" type="checkbox" role="switch" id="theme-toggle">
        </div> 
        <a href="/user/register" class="btn btn-dark m-1 border-0" type="submit">Register</a>
        <a href="/user/login" class="btn btn-dark m-1 border-0" type="submit">Login</a>
      <?php endif ?>
    </div>
  </div>
</nav>