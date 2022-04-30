<?php

function getAllCategory() {
    global $bdd;
    $category = $bdd->query("SELECT * FROM vCategory");
    $category->execute();
    return $category->fetchAll();
}

function getAllProjects() {
    global $bdd;
    $projects = $bdd->query("SELECT * FROM vProjects");
    $projects->execute();
    return $projects->fetchAll();
}

function getAllSkills() {
    global $bdd;
    $skills = $bdd->query("SELECT * FROM skills");
    $skills->execute();
    return $skills->fetchAll();
}

function getAllSchools() {
    global $bdd;
    $schools = $bdd->query('SELECT id_d, libelle_d, date_format(date_d, "%e/%m/%Y"), id_school, school_address, date_format(start_date, "%e/%m/%Y"), date_format(end_date, "%e/%m/%Y") FROM vSchools ORDER BY id_d DESC');
    $schools->execute();
    return $schools->fetchAll();
}

function getAllCompany() {
    global $bdd;
    $company = $bdd->query('SELECT id_comp, company_name, company_address, date_format(start_date, "%e/%m/%Y"), date_format(end_date, "%e/%m/%Y"), libelle_w FROM vCompany ORDER BY start_date');
    $company->execute();
    return $company->fetchAll();
}

function getInfos() {
    global $bdd;
    $infos = $bdd->query('SELECT lastName, firstName, age, date_format(birthday_date, "%e/%m/%Y"), contact_email, school_url, school_name, website_url, website_title, freelance_status FROM users');
    $infos->execute();
    return $infos->fetchAll();
}


