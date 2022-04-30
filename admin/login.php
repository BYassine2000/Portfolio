<?php

if (isset($_SESSION['id_u'])) {
    header('Location: https://YassineBenHamdoune.fr/admin-panel/profile');
    exit();
}

if (isset($_POST['sublogin'])) {
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    if ($username != "" && $password != "") {
        $user = $bdd->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
        $user->bindValue(':username', $username, PDO::PARAM_STR);
        $user->bindValue(':password', $password, PDO::PARAM_STR);
        $user->execute();
        $user = $user->fetch();
        if ($user) {
            $session->setVar('id_u', $user['id_u']);
            $session->setVar('lastName', $user['lastName']);
            $session->setVar('firstName', $user['firstName']);
            $session->setVar('age', $user['age']);
            $session->setVar('birthday_date', $user['birthday_date']);
            $session->setVar('contact_email', $user['contact_email']);
            $session->setVar('school_url', $user['school_url']);
            $session->setVar('school_name', $user['school_name']);
            $session->setVar('website_url', $user['website_url']);
            $session->setVar('website_title', $user['website_title']);
            $session->setVar('freelance_status', $user['freelance_status']);
            $session->setVar('username', $user['username']);
            $session->setVar('password', $user['password']);
            $session->setVar('lvl', $user['lvl']);
            if ($user['lvl'] == 1) {
                header('Location: admin-panel/profile');
            } else {
                Alerts::setFlash("Vous n'avez pas la permission d'accéder !", "danger");
            }
        } else {
            Alerts::setFlash("Identifiants incorrects.", "danger");
        }
    } else {
        Alerts::setFlash("Veuillez compléter tous les champs.", "warning");
    }
}

?>
<div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-4 mt-5 mt-lg-0">
            <?= Alerts::getFlash(); ?>
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Veuillez-vous identifier.</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="">
                        <?= $helper->input('username', 'Pseudo', 'text'); ?>
                        <?= $helper->input('password', 'Mot de passe', 'password'); ?>
                        <div class="mt-4">
                            <div class="d-flex justify-content-center">
                                <?= $helper->button('submit', 'sublogin', 'primary', 'Connexion'); ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
