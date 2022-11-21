<?php
session_start();
if (isset($_SESSION['username'])){
    header('Location: admin/index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
</head>

<body>
    <div class="vh-100 bg-info bg-opacity-50">
        <?php include 'include_file/header.php'; ?>
        <div class="position-relative h-75">
            <div class="position-absolute top-50 start-50 translate-middle">
                <!-- Login -->
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Login Page</h4>
                    </div>
                    <div class="card-body p-3">
                        <form>
                            <div class="mb-3">
                                <label for="usernameLogin" class="form-label">Username</label>
                                <input type="text" class="form-control" id="usernameLogin">
                            </div>
                            <div class="mb-3">
                                <label for="passwordLogin" class="form-label">Password</label>
                                <input type="password" class="form-control" id="passwordLogin">
                            </div>
                        </form>
                    </div>
                    <div class="d-flex justify-content-center">
                        <p class="text-center">user: admin | password: admin</p>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button id="login" class="btn btn-success">Login</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div id="alertLogin"></div>
        </div>
    </div>


    <!-- Modal -->
    <!-- Modal Registrasi -->
    <div class="modal fade" id="modalRegister" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="registerModalLabel">Register</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="usernameRegister" class="form-label">Username</label>
                            <input type="text" class="form-control" id="usernameRegister">
                        </div>
                        <div class="mb-3">
                            <label for="passwordRegister" class="form-label">Password</label>
                            <input type="password" class="form-control" id="passwordRegister">
                        </div>
                        <div class="mb-3">
                            <label for="password2Register" class="form-label">Ulangi Password</label>
                            <input type="password" class="form-control" id="password2Register">
                        </div>
                    </form>

                    <div class="d-flex justify-content-center">
                        <div id="alertRegister"></div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button id="register" class="btn btn-info text-end">Register</button>
                </div>
            </div>
        </div>
    </div>

</body>

<script src="assets/js/bootstrap.js" defer></script>
<script src="assets/js/loginPage.js"></script>

</html>