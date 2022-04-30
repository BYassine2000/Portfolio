<?php auth(1);

if (!isset($_SESSION['id_u'])) {
    header('Location: https://YassineBenHamdoune.fr/admin-panel');
    exit();
}

if (isset($_POST['new-age'])) {
    $age = $_POST['age'];
    if ($age != "") {
        $update = $bdd->prepare("UPDATE users SET age = :age WHERE id_u = 1");
        $update->bindValue(':age', $age, PDO::PARAM_INT);
        $update->execute();
        Session::destroy();
    } else {
        Alerts::setFlash("Le champ ne doit pas être vide !", "warning");
    }
}

if (isset($_POST['new-contact'])) {
    $contact_email = $_POST['contact_email'];
    if ($contact_email != "") {
        $update = $bdd->prepare("UPDATE users SET contact_email = :contact_email WHERE id_u = 1");
        $update->bindValue(':contact_email', $contact_email, PDO::PARAM_STR);
        $update->execute();
        Session::destroy();
    } else {
        Alerts::setFlash("Le champ ne doit pas être vide !", "warning");
    }
}

if (isset($_POST['new-urlschool'])) {
    $school_url = $_POST['school_url'];
    if ($school_url != "") {
        $update = $bdd->prepare("UPDATE users SET school_url = :school_url WHERE id_u = 1");
        $update->bindValue(':school_url', $school_url, PDO::PARAM_STR);
        $update->execute();
        Session::destroy();
    } else {
        Alerts::setFlash("Le champ ne doit pas être vide !", "warning");
    }
}

if (isset($_POST['new-nameschool'])) {
    $school_name = $_POST['school_name'];
    if ($school_name != "") {
        $update = $bdd->prepare("UPDATE users SET school_name = :school_name WHERE id_u = 1");
        $update->bindValue(':school_name', $school_name, PDO::PARAM_STR);
        $update->execute();
        Session::destroy();
    } else {
        Alerts::setFlash("Le champ ne doit pas être vide !", "warning");
    }
}

if (isset($_POST['new-urlwebsite'])) {
    $website_url = $_POST['website_url'];
    if ($website_url != "") {
        $update = $bdd->prepare("UPDATE users SET website_url = :website_url WHERE id_u = 1");
        $update->bindValue(':website_url', $website_url, PDO::PARAM_STR);
        $update->execute();
        Session::destroy();
    } else {
        Alerts::setFlash("Le champ ne doit pas être vide !", "warning");
    }
}

if (isset($_POST['new-namewebsite'])) {
    $website_title = $_POST['website_title'];
    if ($website_title != "") {
        $update = $bdd->prepare("UPDATE users SET website_title = :website_title WHERE id_u = 1");
        $update->bindValue(':website_title', $website_title, PDO::PARAM_STR);
        $update->execute();
        Session::destroy();
    } else {
        Alerts::setFlash("Le champ ne doit pas être vide !", "warning");
    }
}

if (isset($_POST['new-freelance'])) {
    $freelance_status = $_POST['freelance_status'];
    $update = $bdd->prepare("UPDATE users SET freelance_status = :freelance_status WHERE id_u = 1");
    $update->bindValue(':freelance_status', $freelance_status, PDO::PARAM_STR);
    $update->execute();
    Session::destroy();
}

require 'css_files.php';

?>


<div class="container-fluid mt-4">
    <div class="row d-flex justify-content-center reveal">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-auto">
                    <div class="card bg-success">
                        <div class="card-body bg-success col-auto" style="border-radius:.25rem!important;">
                            <h2 class="text-center text-light">
                                Bienvenue sur votre profil <?= $_SESSION['firstName'] ?> <?= $_SESSION['lastName'] ?> !
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-4">
            <?= Alerts::getFlash(); ?>
        </div>
        <div class="col-xl-3 mt-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="align-middle me-1" data-feather="settings"></i>
                        Paramètres du profil
                    </h5>
                </div>
                <div class="list-group list-group-flush" role="tablist">
                    <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#informations" role="tab">
                        <i class="align-middle me-1" data-feather="align-left"></i>
                        Informations générales
                    </a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#edit-age" role="tab">
                        <i class="align-middle me-1" data-feather="edit-2"></i>
                        Modifier mon âge
                    </a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#edit-contact" role="tab">
                        <i class="align-middle me-1" data-feather="edit-2"></i>
                        Modifier mon adresse de contact
                    </a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#edit-urlschool" role="tab">
                        <i class="align-middle me-1" data-feather="edit-2"></i>
                        Modifier l'url de l'école
                    </a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#edit-nameschool" role="tab">
                        <i class="align-middle me-1" data-feather="edit-2"></i>
                        Modifier le nom de l'école
                    </a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#edit-urlwebsite" role="tab">
                        <i class="align-middle me-1" data-feather="edit-2"></i>
                        Modifier l'url de mon site
                    </a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#edit-namewebsite" role="tab">
                        <i class="align-middle me-1" data-feather="edit-2"></i>
                        Modifier le nom de l'url
                    </a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#edit-freelance" role="tab">
                        <i class="align-middle me-1" data-feather="edit-2"></i>
                        Modifier mon statut de Freelance
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-3">
            <div class="tab-content">
                <div class="tab-pane fade show active mt-4" id="informations" role="tabpanel">
                    <div class="card" style="background-color: #4682B4;">
                        <div class="card-header">
                            <h5 class="card-title text-light mb-0">
                                Informations de mon profil
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="text-light">
                                <b>NOM</b> :
                                <?= $_SESSION['lastName']; ?>
                            </p>
                            <p class="text-light">
                                <b>Prénom</b> :
                                <?= $_SESSION['firstName']; ?></b>
                            </p>
                            <p class="text-light">
                                <b>Âge</b> :
                                <?= $_SESSION['age']; ?></b>
                            </p>
                            <p class="text-light">
                                <b>Date de naissance</b> :
                                <?= $_SESSION['birthday_date']; ?></b>
                            </p>
                            <p class="text-light">
                                <b>Contact</b> :
                                <?= $_SESSION['contact_email']; ?></b>
                            </p>
                            <p class="text-light">
                                <b>URL de l'école</b> :
                                <?= $_SESSION['school_url']; ?></b>
                            </p>
                            <p class="text-light">
                                <b>Nom de l'école</b> :
                                <?= $_SESSION['school_name']; ?></b>
                            </p>
                            <p class="text-light">
                                <b>URL de mon site</b> :
                                <?= $_SESSION['website_url']; ?></b>
                            </p>
                            <p class="text-light">
                                <b>Nom de mon site</b> :
                                <?= $_SESSION['website_title']; ?></b>
                            </p>
                            <p class="text-light">
                                <b>Freelance</b> :
                                <?= $_SESSION['freelance_status']; ?></b>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade mt-4" id="edit-age" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">Modification de l'âge</h3>
                            <form method="post" action="" class="mt-4">
                                <div class="mb-3 d-flex justify-content-center">
                                    <input type="number" name="age" autocomplete="off" class="form-control w-50" value="<?= $_SESSION['age']; ?>">
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="d-grid gap-2 col-12 mx-auto">
                                        <button type="submit" name="new-age" class="btn btn-lg btn-primary active fw-bold fs-lg mt-3">
                                            Modifier mon âge
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade mt-4" id="edit-contact" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">Modification de l'adresse de contact</h3>
                            <form method="post" action="" class="mt-4">
                                <div class="mb-3 d-flex justify-content-center">
                                    <input type="email" name="contact_email" autocomplete="off" class="form-control w-75" value="<?= $_SESSION['contact_email']; ?>">
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="d-grid gap-2 col-12 mx-auto">
                                        <button type="submit" name="new-contact" class="btn btn-lg btn-primary active fw-bold fs-lg mt-3">
                                            Modifier mon adresse de contact
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade mt-4" id="edit-urlschool" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">Modification de l'url de l'école</h3>
                            <form method="post" action="" class="mt-4">
                                <div class="mb-3 d-flex justify-content-center">
                                    <input type="url" name="school_url" id="email" autocomplete="off" class="form-control" value="<?= $_SESSION['school_url']; ?>">
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="d-grid gap-2 col-12 mx-auto">
                                        <button type="submit" name="new-urlschool" class="btn btn-lg btn-primary active fw-bold fs-lg mt-3">
                                            Modifier l'url de l'école
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade mt-4" id="edit-nameschool" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">Modification du nom de l'école</h3>
                            <form method="post" action="" class="mt-4">
                                <div class="mb-3 d-flex justify-content-center">
                                    <input type="text" name="school_name" id="email" autocomplete="off" class="form-control" value="<?= $_SESSION['school_name']; ?>">
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="d-grid gap-2 col-12 mx-auto">
                                        <button type="submit" name="new-nameschool" class="btn btn-lg btn-primary active fw-bold fs-lg mt-3">
                                            Modifier le nom de l'école
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade mt-4" id="edit-urlwebsite" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">Modification de l'url du site</h3>
                            <form method="post" action="" class="mt-4">
                                <div class="mb-3 d-flex justify-content-center">
                                    <input type="url" name="website_url" id="email" autocomplete="off" class="form-control" value="<?= $_SESSION['website_url']; ?>">
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="d-grid gap-2 col-12 mx-auto">
                                        <button type="submit" name="new-urlwebsite" class="btn btn-lg btn-primary active fw-bold fs-lg mt-3">
                                            Modifier l'url de mon site
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade mt-4" id="edit-namewebsite" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">Modification du nom du site</h3>
                            <form method="post" action="" class="mt-4">
                                <div class="mb-3 d-flex justify-content-center">
                                    <input type="text" name="website_title" autocomplete="off" class="form-control" value="<?= $_SESSION['website_title']; ?>">
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="d-grid gap-2 col-12 mx-auto">
                                        <button type="submit" name="new-namewebsite" class="btn btn-lg btn-primary active fw-bold fs-lg mt-3">
                                            Modifier le nom de mon site
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade mt-4" id="edit-freelance" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">Modification du statut de Freelance</h3>
                            <form method="post" action="" class="mt-4">
                                <p class="card-text"><b>Statut actuel</b> : <?= $_SESSION['freelance_status']; ?></p>
                                <div class="d-flex justify-content-center">
                                    <?= $helper->select('freelance_status', '', array( 'Indisponible' => 'Indisponible', 'Disponible' => 'Disponible')) ?>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="d-grid gap-2 col-12 mx-auto">
                                        <button type="submit" name="new-freelance" class="btn btn-lg btn-primary active fw-bold fs-lg mt-3">
                                            Modifier mon status de Freelance
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

<?php require 'js_files.php'; ?>
