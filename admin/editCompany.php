<?php auth(1);

if (!isset($_SESSION['id_u'])) {
    header('Location: https://YassineBenHamdoune.fr/admin-panel');
    exit();
}

$mode_edition = 0;

if (isset($_GET['edit'])) {
    $mode_edition = 1;
    $id_comp = $_GET['edit'];
    $company = $bdd->prepare("SELECT * FROM company WHERE id_comp = :id_comp");
    $company->bindValue(':id_comp', $id_comp, PDO::PARAM_INT);
    $company->execute();
    if ($company->rowCount() == 1) {
        $company = $company->fetch();
    }
} else {
    header('Location: company');
}

if (isset($_POST['modifier'])) {
    $id_comp = $_GET['edit'];
    $company_name = $_POST['company_name'];
    $company_address = $_POST['company_address'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    if ($company_name != "" && $company_address != "" && $start_date != "" && $end_date != "") {
        $update = $bdd->prepare("UPDATE company SET company_name = :company_name, company_address = :company_address, start_date = :start_date, end_date = :end_date WHERE id_comp = :id_comp");
        $update->bindValue(':company_name', $company_name, PDO::PARAM_STR);
        $update->bindValue(':company_address', $company_address, PDO::PARAM_STR);
        $update->bindValue(':start_date', $start_date, PDO::PARAM_STR);
        $update->bindValue(':end_date', $end_date, PDO::PARAM_STR);
        $update->bindValue(':id_comp', $id_comp, PDO::PARAM_INT);
        $update->execute();
        header('Location: company');
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
                            <input type="text" name="company_name" class="form-control" <?php if ($mode_edition == 1) { ?> value="<?= $company['company_name']; ?>" <?php } ?>>
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" name="company_address" class="form-control" <?php if ($mode_edition == 1) { ?> value="<?= $company['company_address']; ?>" <?php } ?>>
                        </div>
                        <div class="form-group mb-3">
                            <input type="date" name="start_date" class="form-control" <?php if ($mode_edition == 1) { ?> value="<?= $company['start_date']; ?>" <?php } ?>>
                        </div>
                        <div class="form-group mb-3">
                            <input type="date" name="end_date" class="form-control" <?php if ($mode_edition == 1) { ?> value="<?= $company['end_date']; ?>" <?php } ?>>
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
