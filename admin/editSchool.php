<?php auth(1);

if (!isset($_SESSION['id_u'])) {
    header('Location: https://YassineBenHamdoune.fr/admin-panel');
    exit();
}

$mode_edition = 0;

if (isset($_GET['edit'])) {
    $mode_edition = 1;
    $id_school = $_GET['edit'];
    $school = $bdd->prepare("SELECT * FROM schools WHERE id_school = :id_school");
    $school->bindValue(':id_school', $id_school, PDO::PARAM_INT);
    $school->execute();
    if ($school->rowCount() == 1) {
        $school = $school->fetch();
    }
} else {
    header('Location: schools');
}

if (isset($_POST['modifier'])) {
    $id_school = $_GET['edit'];
    $school_name = $_POST['school_name'];
    $school_address = $_POST['school_address'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    if ($school_name != "" && $school_address != "" && $start_date != "" && $end_date != "") {
        $update = $bdd->prepare("UPDATE schools SET school_name = :school_name, school_address = :school_address, start_date = :start_date, end_date = :end_date WHERE id_school = :id_school");
        $update->bindValue(':school_name', $school_name, PDO::PARAM_STR);
        $update->bindValue(':school_address', $school_address, PDO::PARAM_STR);
        $update->bindValue(':start_date', $start_date, PDO::PARAM_STR);
        $update->bindValue(':end_date', $end_date, PDO::PARAM_STR);
        $update->bindValue(':id_school', $id_school, PDO::PARAM_INT);
        $update->execute();
        header('Location: schools');
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
                <a href="schools" class="btn btn-lg btn-secondary">Retour</a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Modifier un établissement</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="">
                        <div class="form-group mb-3">
                            <input type="text" name="school_name" class="form-control" <?php if ($mode_edition == 1) { ?> value="<?= $school['school_name']; ?>" <?php } ?>>
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" name="school_address" class="form-control" <?php if ($mode_edition == 1) { ?> value="<?= $school['school_address']; ?>" <?php } ?>>
                        </div>
                        <div class="form-group mb-3">
                            <input type="date" name="start_date" class="form-control" <?php if ($mode_edition == 1) { ?> value="<?= $school['start_date']; ?>" <?php } ?>>
                        </div>
                        <div class="form-group mb-3">
                            <input type="date" name="end_date" class="form-control" <?php if ($mode_edition == 1) { ?> value="<?= $school['end_date']; ?>" <?php } ?>>
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
