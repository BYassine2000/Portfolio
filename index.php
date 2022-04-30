<?php

require 'src/Autoloader.php';
Autoloader::register();

$session = new Session();

require 'src/functions.php';
require 'src/constants.php';
$bdd = myPDO(HOSTNAME, DATABASE, USERNAME, PASSWORD);

require 'src/Helpers.php';
$helper = new Helpers();

if (!isset($_GET['p']) || $_GET['p'] == "") {
    $page = "controllers/homeControllers.php";
} else {
    if ($_GET['p'] == "admin-panel") {
        $page = "admin/login.php";
    } elseif ($_GET['p'] == "admin-panel/profile") {
        $page = "admin/profile.php";
    } elseif ($_GET['p'] == "admin-panel/filters") {
        $page = "admin/filters.php";
    } elseif ($_GET['p'] == "admin-panel/editFilter") {
        $page = "admin/editFilter.php";
    } elseif ($_GET['p'] == "admin-panel/category") {
        $page = "admin/category.php";
    } elseif ($_GET['p'] == "admin-panel/editCategory") {
        $page = "admin/editCategory.php";
    } elseif ($_GET['p'] == "admin-panel/projects") {
        $page = "admin/projects.php";
    } elseif ($_GET['p'] == "admin-panel/editProject") {
        $page = "admin/editProject.php";
    } elseif ($_GET['p'] == "admin-panel/images") {
        $page = "admin/images.php";
    } elseif ($_GET['p'] == "admin-panel/editImage") {
        $page = "admin/editImage.php";
    } elseif ($_GET['p'] == "admin-panel/skills") {
        $page = "admin/skills.php";
    } elseif ($_GET['p'] == "admin-panel/editSkill") {
        $page = "admin/editSkill.php";
    } elseif ($_GET['p'] == "admin-panel/schools") {
        $page = "admin/schools.php";
    } elseif ($_GET['p'] == "admin-panel/editSchool") {
        $page = "admin/editSchool.php";
    } elseif ($_GET['p'] == "admin-panel/diplomes") {
        $page = "admin/diplomes.php";
    } elseif ($_GET['p'] == "admin-panel/editDiplome") {
        $page = "admin/editDiplome.php";
    } elseif ($_GET['p'] == "admin-panel/company") {
        $page = "admin/company.php";
    } elseif ($_GET['p'] == "admin-panel/editCompany") {
        $page = "admin/editCompany.php";
    } elseif ($_GET['p'] == "admin-panel/works") {
        $page = "admin/works.php";
    } elseif ($_GET['p'] == "admin-panel/editWork") {
        $page = "admin/editWork.php";
    } elseif ($_GET['p'] == "admin-panel/logout") {
        $page = "admin/logout.php";
    } elseif (file_exists("controllers/".$_GET['p']."Controllers.php")) {
        $page = "controllers/".$_GET['p']."Controllers.php";
    } else {
        $page = "controllers/404Controllers.php";
    }
}

ob_start();
    require $page;
    $contents = ob_get_contents();
ob_get_clean();

require 'template.php';
