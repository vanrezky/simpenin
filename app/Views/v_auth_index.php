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
                    <h1 class="font-30">Hai, Silahkan Masuk</h1>
                    <p style="font-weight: light;">Masukkan detail akunmu untuk masuk ke halaman</p>

                    <form method="post" id="form-login">
                        <div class="input-style has-icon input-style-1 input-required">
                            <i class="input-icon fa fa-user"></i>
                            <input type="name" name="username" placeholder="Nama Pengguna">
                        </div>
                        <div class="input-style has-icon input-style-1 input-required">
                            <i class="input-icon fa fa-lock"></i>
                            <input type="password" name="password" placeholder="Kata Sandi">
                        </div>
                        <div class="row pt-3 mb-3">
                            <div class="col-6 text-left">
                                <a href="/" class="color-highlight">Lupa Password?</a>
                            </div>
                        </div>
                        <a href="#" bSubmit class="btn btn-full btn-l font-600 font-13 gradient-highlight mt-4 rounded-s">Masuk</a>
                        <div class="divider"></div>

                        <div class="col-12 text-center">
                            <p>Belum punya akun? <a href="/daftar" class="color-highlight"><b>Daftar</b></a></p>

                        </div>
                    </form>
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
            $("#form-login").submit();
        });
    </script>
</body>