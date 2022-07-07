<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <title><?= $title; ?> | Simpen.in</title>
    <link rel="stylesheet" type="text/css" href="/assets/styles/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/style.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/assets/fonts/css/fontawesome-all.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/app/icons/icon-192x192.png">
</head>

<body class="theme-light">
    <style>
        .selectgroup {
            display: inline-flex;
        }

        .w-100 {
            width: 100%;
        }

        input[type=checkbox],
        input[type=radio] {
            box-sizing: border-box;
            padding: 0;
        }

        .selectgroup-item {
            -ms-flex-positive: 1;
            flex-grow: 1;
            position: relative;
            padding: 3px;
        }

        .selectgroup-input {
            opacity: 0;
            position: absolute;
            z-index: -1;
            top: 0;
            left: 0;
        }

        .selectgroup-input:checked+.selectgroup-button {
            background-color: #2061C3;
            color: #fff;
            z-index: 1000;
        }

        .selectgroup-button {
            background-color: #fdfdff;
            border-color: #e4e6fc;
            border-width: 1px;
            border-style: solid;
            display: block;
            text-align: center;
            padding: .5rem;
            /* height: 68px; */
            position: relative;
            cursor: pointer;
            border-radius: 3px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            font-size: 13px;
            min-width: 2.375rem;
            line-height: 15px;
        }

        .selectgroup-button-icon {
            padding-left: .5rem;
            padding-right: .5rem;
        }

        .selectgroup-button>i {
            font-size: 20px !important;
        }

        .selectgroup-button>small {
            padding: 0px !important;
            display: block;
        }

        input[type="date"] {
            display: block;
            position: relative;
            padding: .5rem 1.7rem .5rem .5rem;

            font-size: 1rem;
            font-family: monospace;

            border: 1px solid #8292a2;
            border-radius: 0.25rem;
            background:
                white url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='22' viewBox='0 0 20 22'%3E%3Cg fill='none' fill-rule='evenodd' stroke='%23688EBB' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' transform='translate(1 1)'%3E%3Crect width='18' height='18' y='2' rx='2'/%3E%3Cpath d='M13 0L13 4M5 0L5 4M0 8L18 8'/%3E%3C/g%3E%3C/svg%3E") right 1rem center no-repeat;

            cursor: pointer;
        }

        input[type="date"]:focus {
            outline: none;
            border-color: #3acfff;
            box-shadow: 0 0 0 0.25rem rgba(0, 120, 250, 0.1);
        }

        ::-webkit-datetime-edit {}

        ::-webkit-datetime-edit-fields-wrapper {}

        ::-webkit-datetime-edit-month-field:hover,
        ::-webkit-datetime-edit-day-field:hover,
        ::-webkit-datetime-edit-year-field:hover {
            background: rgba(0, 120, 250, 0.1);
        }

        ::-webkit-datetime-edit-text {
            opacity: 0;
        }

        ::-webkit-clear-button,
        ::-webkit-inner-spin-button {
            display: none;
        }

        ::-webkit-calendar-picker-indicator {
            position: absolute;
            width: 2rem;
            height: 100%;
            top: 0;
            right: 0;
            bottom: 0;
            opacity: 0;
            cursor: pointer;
            color: rgba(0, 120, 250, 1);
            background: rgba(0, 120, 250, 1);

        }

        input[type="date"]:hover::-webkit-calendar-picker-indicator {
            opacity: 0.05;
        }

        input[type="date"]:hover::-webkit-calendar-picker-indicator:hover {
            opacity: 0.15;
        }
    </style>

    <div id="preloader">
        <div class="spinner-border color-highlight" role="status"></div>
    </div>

    <div id="page">
        <?= $this->include('inc/menu'); ?>
        <?php
        $uri = current_url(true);

        try {
            $segment_3 = $uri->getSegment(3);
        } catch (Exception $e) {
            $segment_3 = '';
        }

        if (empty($segment_3)) {
            echo '<div class="page-title page-title-fixed">
                        <h1>Simpen.in</h1>
                    </div>';
        } else {
            echo '<div class="header header-fixed">
                    <a href="' . (isset($back) ? $back : '/' . $uri->getSegment(2)) . '" class="header-icon header-icon-1"><i class="fas fa-arrow-left"></i></a>
                </div>';
        }
        ?>
        <div class="page-title-clear"></div>

        <div id="informasi-lanjut"></div>
        <?= $this->renderSection('content'); ?>
        <div id="notification-1" data-dismiss="notification-1" data-delay="3000" data-autohide="true" class="notification notification-ios bg-dark-dark ml-2 mr-2 mt-2 rounded-s fade hide">
            <span class="notification-icon color-white rounded-s">
                <i class="fa fa-bell"></i>
                <i data-dismiss="notification-1" class="fa fa-times-circle"></i>
            </span>
            <h1 class="font-18 color-white mb-n3" title>All Good</h1>
            <p class="pt-1" desc>
                I'm a notification. I show at the top or bottom of the page.
            </p>
        </div>
    </div>
    <script type="text/javascript" src="/assets/scripts/jquery.js"></script>
    <script type="text/javascript" src="/assets/scripts/bootstrap.min.js"></script>
    <script type="text/javascript" src="/assets/scripts/custom.js"></script>
    <script type="text/javascript" src="/assets/scripts/van.js"></script>
    <?= $this->renderSection('script'); ?>


    <script>
        $(document).ready(function() {
            $("input:text").each(function(e) {
                $(this).attr('autocomplete', 'off');
            })
        });
    </script>
</body>