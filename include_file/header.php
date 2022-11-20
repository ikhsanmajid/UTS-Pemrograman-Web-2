<?php

if (empty($_SESSION['username']) || !isset($_SESSION['username'])) {
?>
  <nav class="navbar bg-light">
    <div class="container-fluid">
      <span class="navbar-brand mb-0 h1">Kabar Kita</span>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRegister">
        Register
      </button>
    </div>
  </nav>
<?php
} else {
?>
  <nav class="navbar bg-light">
    <div class="container-fluid">
      <span class="navbar-brand mb-0 h1">Kabar Kita</span>
      Selamat datang, <?= $_SESSION['username'] ?>
      <a href="../logout.php" class="btn btn-danger">Logout</a>
    </div>
  </nav>
<?php
}
?>