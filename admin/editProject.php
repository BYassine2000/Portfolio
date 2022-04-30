<?php auth(1);

if (!isset($_SESSION['id_u'])) {
    header('Location: https://YassineBenHamdoune.fr/admin-panel');
    exit();
}

$mode_edition = 0;

if (isset($_GET['edit'])) {
    $mode_edition = 1;
    $id_p = $_GET['edit'];
    $project = $bdd->prepare("SELECT * FROM projects WHERE id_p = :id_p");
    $project->bindValue(':id_p', $id_p, PDO::PARAM_INT);
    $project->execute();
    if ($project->rowCount() == 1) {
        $project = $project->fetch();
    }
} else {
    header('Location: projects');
}

if (isset($_POST['modifier'])) {
    $id_p = $_GET['edit'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $id_cat = $_POST['id_cat'];
    $github_url = $_POST['github_url'];
    if ($title != "" && $description != "") {
        $update = $bdd->prepare("UPDATE projects SET title = :title, description = :description, id_cat = :id_cat, github_url = :github_url WHERE id_p = :id_p");
        $update->bindValue(':title', $title, PDO::PARAM_STR);
        $update->bindValue(':description', $description, PDO::PARAM_STR);
        $update->bindValue(':id_cat', $id_cat, PDO::PARAM_INT);
        $update->bindValue(':github_url', $github_url, PDO::PARAM_STR);
        $update->bindValue(':id_p', $id_p, PDO::PARAM_INT);
        $update->execute();
        header('Location: projects');
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
                <a href="projects" class="btn btn-lg btn-secondary">Retour</a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Modifier un projet</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="">
                        <div class="form-group mb-3">
                            <input type="text" name="title" class="form-control" <?php if ($mode_edition == 1) { ?> value="<?= $project['title']; ?>" <?php } ?>>
                        </div>
                        <div class="form-group mb-3">
                            <textarea name="description" class="form-control"><?php if ($mode_edition == 1) { ?> <?= $project['description']; ?> <?php } ?></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <select name="id_cat" class="form-select">
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
                        <div class="form-group mb-3">
                            <input type="url" name="github_url" class="form-control" <?php if ($mode_edition == 1) { ?> value="<?= $project['github_url']; ?>" <?php } ?>>
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
