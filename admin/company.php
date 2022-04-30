<?php auth(1);

if (!isset($_SESSION['id_u'])) {
    header('Location: https://YassineBenHamdoune.fr/admin-panel');
    exit();
}

$company = $bdd->query("SELECT * FROM company ORDER BY id_comp DESC");

$mode_edition = 0;

if (isset($_POST['submit'])) {
    $company_name = $_POST['company_name'];
    $company_address = $_POST['company_address'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    if ($company_name != "" && $company_address != "" && $start_date != "" && $end_date != "") {
        $insert = $bdd->prepare("INSERT INTO company (company_name, company_address, start_date, end_date) VALUES (:company_name, :company_address, :start_date, :end_date)");
        $insert->bindValue(':company_name', $company_name, PDO::PARAM_STR);
        $insert->bindValue(':company_address', $company_address, PDO::PARAM_STR);
        $insert->bindValue(':start_date', $start_date, PDO::PARAM_STR);
        $insert->bindValue(':end_date', $end_date, PDO::PARAM_STR);
        $insert->execute();
        header('Location: company');
    } else {
        Alerts::setFlash("Veuillez compléter tous les champs !", "warning");
    }
}

if (isset($_GET['id_comp'])) {
    $id_comp = $_GET['id_comp'];
    $delete = $bdd->prepare("DELETE FROM company WHERE id_comp = :id_comp");
    $delete->bindValue(':id_comp', $id_comp, PDO::PARAM_INT);
    $delete->execute();
    header('Location: company');
}

require 'css_files.php';

?>
<div class="container mt-4">
    <div class="row d-flex justify-content-center">
        <div class="col-12 mt-5">
            <?= Alerts::getFlash(); ?>
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Sociétés</h3>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal_company">
                        + Ajouter une société
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-striped text-center">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom de la société</th>
                            <th scope="col">Adresse de la société</th>
                            <th scope="col">Date début</th>
                            <th scope="col">Date fin</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($company as $comp) { ?>
                            <tr>
                                <td><?= $comp['id_comp']; ?></td>
                                <td><?= $comp['company_name']; ?></td>
                                <td><?= $comp['company_address']; ?></td>
                                <td><?= $comp['start_date']; ?></td>
                                <td><?= $comp['end_date']; ?></td>
                                <td>
                                    <a href="editCompany?edit=<?= $comp['id_comp']; ?>" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                    </a>
                                    <a class="btn btn-danger font-weight-bolder" href="company&id_comp=<?= $comp['id_comp']; ?>" onclick="return(confirm('Voulez-vous vraiment supprimer cette société ?'));">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_company" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter une société</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <?= $helper->input('company_name', 'Nom de la société', 'text'); ?>
                    <?= $helper->input('company_address', 'Adresse de la société', 'text'); ?>
                    <?= $helper->input('start_date', 'Date début', 'date'); ?>
                    <?= $helper->input('end_date', 'Date fin', 'date'); ?>
                    <div class="mt-4">
                        <div class="d-flex justify-content-center">
                            <?= $helper->button('submit', 'submit', 'success', 'Ajouter l\'établissement'); ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require 'js_files.php'; ?>
