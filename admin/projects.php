<?php auth(1);

if (!isset($_SESSION['id_u'])) {
    header('Location: https://YassineBenHamdoune.fr/admin-panel');
    exit();
}

$projects = $bdd->query("SELECT * FROM projects ORDER BY id_p DESC");

$mode_edition = 0;

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $id_cat = $_POST['id_cat'];
    $github_url = $_POST['github_url'];
    if ($title != "" && $description != "" && $github_url != "") {
        $insert = $bdd->prepare("INSERT INTO projects (title, description, id_cat, github_url) VALUES (:title, :description, :id_cat, :github_url)");
        $insert->bindValue(':title', $title, PDO::PARAM_STR);
        $insert->bindValue(':description', $description, PDO::PARAM_STR);
        $insert->bindValue(':id_cat', $id_cat, PDO::PARAM_INT);
        $insert->bindValue(':github_url', $github_url, PDO::PARAM_STR);
        $insert->execute();
        header('Location: projects');
    } else {
        Alerts::setFlash("Veuillez compléter tous les champs !", "warning");
    }
}

if (isset($_GET['id_p'])) {
    $id_p = $_GET['id_p'];
    $delete = $bdd->prepare("DELETE FROM projects WHERE id_p = :id_p");
    $delete->bindValue(':id_p', $id_p, PDO::PARAM_INT);
    $delete->execute();
    header('Location: projects');
}

require 'css_files.php';

?>

<div class="container mt-4">
    <div class="row d-flex justify-content-center">
        <div class="col-12 mt-5">
            <?= Alerts::getFlash(); ?>
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Mes projets</h3>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal_project">
                        + Ajouter un projet
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-striped text-center">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Titre du projet</th>
                            <th scope="col">Description du projet</th>
                            <th scope="col">Catégorie du projet</th>
                            <th scope="col">Lien GitHub du projet</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($projects as $project) { ?>
                            <tr>
                                <td><?= $project['id_p']; ?></td>
                                <td><?= $project['title']; ?></td>
                                <td><?= $project['description']; ?></td>
                                <td><?= $project['id_cat']; ?></td>
                                <td><a href="<?= $project['github_url']; ?>" target="_blank"><?= $project['github_url']; ?></a></td>
                                <td>
                                    <a href="editProject?edit=<?= $project['id_p']; ?>" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                    </a><br><br>
                                    <a class="btn btn-danger font-weight-bolder" href="projects&id_p=<?= $project['id_p']; ?>" onclick="return(confirm('Voulez-vous vraiment supprimer ce projet ?'));">
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

<div class="modal fade" id="modal_project" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un projet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <?= $helper->input('title', 'Titre du projet', 'text'); ?>
                    <?= $helper->textarea('description', 'Description du projet'); ?>
                    <div class="form-group mb-3">
                        <label for="id_cat" class="form-label">Catégorie du projet</label>
                        <select name="id_cat" id="id_cat" class="form-select">
                            <?php
                            $query = $bdd->query("SELECT * FROM category");
                            $category = $query->fetchAll();
                            foreach ($category as $cat) {
                            ?>
                                <option value="<?= $cat['id_cat']; ?>"><?= $cat['title']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <?= $helper->input('github_url', 'Lien GitHub du projet', 'url'); ?>
                    <div class="mt-4">
                        <div class="d-flex justify-content-center">
                            <?= $helper->button('submit', 'submit', 'success', 'Ajouter le projet'); ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require 'js_files.php'; ?>
