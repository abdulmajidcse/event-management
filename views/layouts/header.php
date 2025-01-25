<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title . ' - ' . config('name') ?></title>

    <link rel="stylesheet" href="<?php echo asset('/css/bootstrap.min.css') ?>">
</head>

<body>
    <header class="bg-dark" data-bs-theme="dark">
        <div class="container">
            <nav class="navbar bg-dark border-bottom border-body navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand" href="<?php echo url('/') ?>"><?php echo config('name') ?></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link <?php echo currentUri() == '/' ? 'active' : '' ?>" aria-current="page" href="<?php echo url('/') ?>">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo currentUri() == '/about' ? 'active' : '' ?>" href="<?php echo url('/about') ?>">About</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Admin
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#">Profile</a></li>
                                    <li><a class="dropdown-item" href="#">Settings</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <main class="container pt-3" style="min-height: calc(100vh - 122px);">