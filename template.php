<!DOCTYPE html>
<html lang="en">
<head>
    <title>YassineBenHamdoune.fr</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/vendor/aos/aos.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/glightbox/css/glightbox.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body style="background-color: #f8f9fa!important;">

<i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

<header id="header" class="d-flex flex-column justify-content-center">

    <nav id="navbar" class="navbar nav-menu">
        <ul>
            <li>
                <a href="#hero" class="nav-link scrollto active">
                    <i class="bx bx-home"></i>
                    <span>Accueil</span>
                </a>
            </li>
            <li>
                <a href="#about" class="nav-link scrollto">
                    <i class="bx bx-user"></i>
                    <span>About</span>
                </a>
            </li>
            <li>
                <a href="#working" class="nav-link scrollto">
                    <i class="bx bxs-school"></i>
                    <span>Working</span>
                </a>
            </li>
            <li>
                <a href="#portfolio" class="nav-link scrollto">
                    <i class="bx bx-book-content"></i>
                    <span>Portfolio</span>
                </a>
            </li>
            <li>
                <a href="#diplome" class="nav-link scrollto">
                    <i class="bx bxs-award"></i>
                    <span>BTS SIO</span>
                </a>
            </li>
            <li>
                <a href="#contact" class="nav-link scrollto">
                    <i class="bx bx-envelope"></i>
                    <span>Contact</span>
                </a>
            </li>
            <?php if (isset($_SESSION['id_u'])) { ?>
                <li>
                    <a href="logout" class="nav-link scrollto bg-danger">
                        <i class="bx bx-power-off text-light"></i>
                        <span>Déconnexion</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </nav>

</header>

<?= $contents; ?>

<footer id="footer">
    <div class="container">
        <h3>Yassine Ben Hamdoune</h3>
        <p>Étudiant en BTS SIO à l'École IRIS de Paris</p>
        <div class="social-links">
            <a href="https://www.facebook.com/tombruaire92" class="facebook" target="_blank">
                <i class="bx bxl-facebook"></i>
            </a>
            <a href="https://www.linkedin.com/in/tombruaire/" class="linkedin" target="_blank">
                <i class="bx bxl-linkedin"></i>
            </a>
        </div>
        <div class="copyright">
            &copy; Copyright <strong><span>YassineBenHamdoune.fr</span></strong>. Tout droits réservés
        </div>
    </div>
</footer>

<?php if (!isset($_SESSION['id_u'])) { ?>
<div id="preloader"></div>
<?php } ?>

<a href="" class="back-to-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
</a>

<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/purecounter/purecounter.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/typed.js/typed.min.js"></script>
<script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>