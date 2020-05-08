<!doctype html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">

    <title>ورود</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url("assets/library/bootstrap/css/bootstrap.min.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url("assets/fonts/fontawsome/css/all.min.css") ?>">

    <!-- Custom styles for this template -->
    <link href="<?= base_url("assets/css/login.css") ?>" rel="stylesheet">
</head>

<body class="text-center">
<form action="<?= base_url("login/checkUser") ?>" method="post" class="form-signin">
    <h1 class="h3 mb-3 font-weight-normal">سوپر مارکت آنلاین</h1>
    <?php if (isset($_SESSION["error"])) { ?>
        <div class="alert alert-danger" role="alert">
            <?= $_SESSION["error"] ?>
        </div>
    <?php } ?>
    <label for="MobileNumber" class="sr-only"></label>
    <input type="number" id="MobileNumber" name="mobileNumber" class="form-control text-center mb-3"
           placeholder="شماره موبایل خود را وارد کنید" required autofocus>
    <button class="btn btn-lg btn-primary btn-block" type="submit">ورود</button>
    <p class="mt-5 mb-3 text-muted">&copy; 1399</p>
</form>
</body>
</html>
