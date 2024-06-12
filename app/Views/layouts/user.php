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
            <a class="navbar-brand" href="#">Job Portal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home
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
                            <i class="fas fa-user"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-sliders-h fa-fw"></i> Account</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt fa-fw"></i> Log Out</a></li>
                        </ul>
                    </li>
                </ul>
                <!--form class="d-flex">
                    <input class="form-control me-sm-2" type="search" placeholder="Search" spellcheck="false" data-ms-editor="true">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                </form-->
            </div>
        </div>
    </nav>
</header>

<main class="flex-shrink-0 mt-5">
    <?php echo $content; ?>
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