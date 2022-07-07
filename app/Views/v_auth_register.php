<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <title><?= $title; ?> | Simpen.In</title>
    <link rel="stylesheet" type="text/css" href="/assets/styles/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/style.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/assets/fonts/css/fontawesome-all.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/app/icons/icon-192x192.png">
</head>

<body class="theme-light">

    <div id="preloader">
        <div class="spinner-border color-highlight" role="status"></div>
    </div>

    <div id="page">
        <div class="page-content header-clear-medium">
            <?= session('message'); ?>
            <div class="card card-style">
                <div class="content">
                    <h1 class="font-30">Selamat Bergabung!</h1>
                    <p style="font-weight: light;">Semoga hari kamu indah ;)</p>
                    <form action="" method="post">
                        <div class="input-style has-icon input-style-1 input-required">
                            <i class="input-icon fa fa-user"></i>
                            <input type="text" placeholder="Nama Lengkap" name="nama" required>
                        </div>
                        <div class="input-style has-icon input-style-1 input-required">
                            <i class="input-icon fa fa-envelope"></i>
                            <input type="email" placeholder="Email" name="email" required>
                        </div>
                        <div class="input-style has-icon input-style-1 input-required">
                            <i class="input-icon fa fa-user"></i>
                            <input type="text" placeholder="Nama Pengguna (Username)" name="username" required>
                        </div>
                        <div class="input-style has-icon input-style-1 input-required">
                            <i class="input-icon fa fa-lock"></i>
                            <input type="password" placeholder="Password" name="password" required>
                        </div>
                        <div class="input-style has-icon input-style-1 input-required">
                            <i class="input-icon fa fa-lock"></i>
                            <input type="password" placeholder="Konfirmasi Password" name="password2" required>
                        </div>
                        <button type="submit" id="btn-submit" class="d-none"></button>
                        <a href="#" bSubmit class="btn btn-full btn-l font-600 font-13 gradient-highlight mt-4 rounded-s">Daftar</a>
                        <div class="divider"></div>
                    </form>
                    <div class="col-12 text-center">
                        <p>Sudah memiliki akun? <a href="/login" class="color-highlight"><b>Masuk</b></a></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="/assets/scripts/jquery.js"></script>
    <script type="text/javascript" src="/assets/scripts/bootstrap.min.js"></script>
    <script type="text/javascript" src="/assets/scripts/custom.js"></script>
    <script>
        $("[bSubmit]").click(function(e) {
            e.preventDefault();
            $("#btn-submit").click();
        });
    </script>
</body>