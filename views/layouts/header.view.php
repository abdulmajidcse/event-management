<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title . ' - ' . config('name') ?></title>

    <link rel="stylesheet" href="<?php echo asset('/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('/css/sweetalert2.min.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('/css/app.css') ?>">
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
                            <?php if (auth()->check()) { ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <?php echo e(auth()->user()->name); ?>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="<?php echo url('/profile') ?>">Profile</a></li>
                                        <li><a class="dropdown-item" href="<?php echo url('/change-password') ?>">Change Password</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <form method="POST" action="<?php echo url('/logout'); ?>">
                                                <a href="<?php echo url('/logout'); ?>"
                                                    class="dropdown-item"
                                                    onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                                    Logout
                                                </a>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            <?php } else { ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo currentUri() == '/login' ? 'active' : '' ?>" href="<?php echo url('/login') ?>">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo currentUri() == '/register' ? 'active' : '' ?>" href="<?php echo url('/register') ?>">Register</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <main class="container py-3" style="min-height: calc(100vh - 122px);">