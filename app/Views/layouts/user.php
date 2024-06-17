<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Web2 - Job Portal</title>
    <link href="/vendor/Flatly/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100 bg-light" cz-shortcut-listen="true">

<header>
    <nav class="navbar navbar-expand-lg bg-primary fixed-top" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="/">Job Portal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Home
                            <span class="visually-hidden">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Carreer</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Information Technology</a>
                            <a class="dropdown-item" href="#">Accounting</a>
                            <a class="dropdown-item" href="#">Anything else</a>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 profile-menu">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']['name']) : 'Account'; ?>
                            &nbsp;<i class="fas fa-user"></i>
                        </a>

                        <?php if (isset($_SESSION['user'])): ?>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-sliders-h fa-fw"></i> Account</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <form action="/logout" method="post">
                                <li><button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt fa-fw"></i> Log Out</button></li>
                            </form>
                        </ul>
                        <?php else: ?>

                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="fa-solid fa-right-to-bracket"></i>&nbsp; Sign In</button></li>
                            <li><a class="dropdown-item" href="/signup"><i class="fa-solid fa-user-plus"></i>&nbsp; Sign Up</a></li>
                        </ul>

                        <?php endif; ?>

                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main class="flex-shrink-0 mt-5">

    <?php if (isset($_SESSION['message'])): ?>
        <div class="position-fixed top-0 end-0 mt-5 me-4">
            <div class="alert alert-dismissible mt-5
            <?php
            echo $_SESSION['msgType'];
            unset($_SESSION['msgType']); ?>
            ">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']); ?>
            </div>
        </div>
    <?php endif; ?>

    <?php echo $content; ?>


    <!-- Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <form id="login-form" action="/login" method="post">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="loginModalLabel">Sign In</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="E-mail Address" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required pattern=".{8,}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary mx-auto">Sign In</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


</main>

<footer class="footer mt-auto py-3 bg-primary">
    <div class="container text-center">
        <span class="text-light">Web 2 - Job Portal by Amilcar Santana</span>
    </div>
</footer>

<script src="https://kit.fontawesome.com/6ffc72a9ab.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>