<?php auth(1);

if (!isset($_SESSION['id_u'])) {
    header('Location: https://YassineBenHamdoune.fr/admin-panel');
    exit();
}

$mode_edition = 0;

if (isset($_GET['edit'])) {
    $mode_edition = 1;
    $id_s = $_GET['edit'];
    $skill = $bdd->prepare("SELECT * FROM skills WHERE id_s = :id_s");
    $skill->bindValue(':id_s', $id_s, PDO::PARAM_INT);
    $skill->execute();
    if ($skill->rowCount() == 1) {
        $skill = $skill->fetch();
    }
} else {
    header('Location: skills');
}

if (isset($_POST['modifier'])) {
    $id_s = $_GET['edit'];
    $libelle = $_POST['libelle'];
    $lvl = $_POST['lvl'];
    if ($libelle != "" && $lvl != "") {
        if ($lvl <= 100) {
            $update = $bdd->prepare("UPDATE skills SET libelle = :libelle, lvl = :lvl WHERE id_s = :id_s");
            $update->bindValue(':libelle', $libelle, PDO::PARAM_STR);
            $update->bindValue(':lvl', $lvl, PDO::PARAM_INT);
            $update->bindValue(':id_s', $id_s, PDO::PARAM_INT);
            $update->execute();
            header('Location: skills');
        } else {
            Alerts::setFlash("Votre niveau ne doit pas dépassé 100", "danger");
        }
    } else {
        Alerts::setFlash("Les champs ne doivent pas être vides !","warning");
    }
}

require 'css_files.php';

?>

<div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-4 mt-5 mt-lg-0">
            <?= Alerts::getFlash(); ?>
            <div class="d-flex justify-content-center mb-3">
                <a href="skills" class="btn btn-lg btn-secondary">Retour</a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Modifier une compétence</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="">
                        <div class="form-group mb-3">
                            <input type="text" name="libelle" class="form-control" <?php if ($mode_edition == 1) { ?> value="<?= $skill['libelle']; ?>" <?php } ?>>
                        </div>
                        <div class="form-group mb-3">
                            <input type="number" name="lvl" max="100" class="form-control" <?php if ($mode_edition == 1) { ?> value="<?= $skill['lvl']; ?>" <?php } ?>>
                        </div>
                        <div class="mt-4">
                            <div class="d-flex justify-content-center">
                                <?= $helper->button('submit', 'modifier', 'primary', 'Valider'); ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'js_files.php'; ?>
