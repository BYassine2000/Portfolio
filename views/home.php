<section id="hero" class="d-flex flex-column justify-content-center">
    <div class="container" data-aos="zoom-in" data-aos-delay="100">
        <h1>Yassine Ben Hamdoune</h1>
        <p>I'm <span class="typed" data-typed-items="Student, Developer, Gamer"></span></p>
        <div class="social-links">
            </a>
            <a href="https://www.linkedin.com/in/yassine-ben-hamdoune-1783a718b/" class="linkedin" target="_blank">
                <i class="bx bxl-linkedin"></i>
            </a>
        </div>
    </div>
</section>

<main id="main">

    <section id="about" class="about">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>À propos de moi</h2>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <img src="assets/img/photo.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-8 pt-4 pt-lg-0 content">
                    <h3>Étudiant en BTS SIO</h3>
                    <p class="fst-italic">Retrouvez ci-dessous les différentes informations me concernant :</p>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul>
                                <?php foreach ($infos as $info) { ?>
                                <li>
                                    <i class="bi bi-chevron-right"></i>
                                    <strong>Nom :</strong>
                                    <span><?= $info['lastName']; ?></span>
                                </li>
                                <li>
                                    <i class="bi bi-chevron-right"></i>
                                    <strong>Prénom :</strong>
                                    <span><?= $info['firstName']; ?></span>
                                </li>
                                <li>
                                    <i class="bi bi-chevron-right"></i>
                                    <strong>Âge :</strong>
                                    <span><?= $info['age']; ?> ans</span>
                                </li>
                                <li>
                                    <i class="bi bi-chevron-right"></i>
                                    <strong>Anniversaire :</strong>
                                    <span><?= $info['date_format(birthday_date, "%e/%m/%Y")']; ?></span>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul>
                                <?php foreach ($infos as $info2) { ?>
                                <li>
                                    <i class="bi bi-chevron-right"></i>
                                    <strong>Contact :</strong>
                                    <span><a href="mailto:<?= $info2['contact_email']; ?>"><?= $info2['contact_email']; ?></a></span>
                                </li>
                                <li>
                                    <i class="bi bi-chevron-right"></i>
                                    <strong>Études :</strong>
                                    <span><a href="<?= $info2['school_url'] ?>" target="_blank"><?= $info2['school_name']; ?></a></span>
                                </li>
                                <li>
                                    <i class="bi bi-chevron-right"></i>
                                    <strong>Website :</strong>
                                    <span><a href="<?= $info2['website_url']; ?>" target="_blank"><?= $info2['website_title']; ?></a></span>
                                </li>
                                <li>
                                    <i class="bi bi-chevron-right"></i>
                                    <strong>Freelance :</strong>
                                    <span class="text-danger"><?= $info2['freelance_status']; ?></span>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <p>22 ans et toujours passioné par l'informatique depuis mon plus jeune âge, j'en ai décider de faire mon métier. Les sites internet sont une passion pour moi. Je souhaiterai, plus tard, devenir « Développeur de sites internet ».</p>
                </div>
            </div>
        </div>
    </section>

    <section id="skills" class="skills section-bg">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Compétences</h2>
            </div>
            <div class="row d-flex justify-content-center skills-content">
                <div class="col-lg-6">
                    <?php foreach ($skills as $skill) { ?>
                    <div class="progress">
                        <span class="skill"><?= $skill['libelle']; ?> <i class="val"><?= $skill['lvl']; ?>%</i></span>
                        <div class="progress-bar-wrap">
                            <div class="progress-bar" role="progressbar" aria-valuenow="<?= $skill['lvl']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

    <section id="working" class="resume">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Working</h2>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <h3 class="resume-title">Scolarités / Schools</h3>
                    <?php foreach ($schools as $school) { ?>
                    <div class="resume-item">
                        <h4><?= $school['id_school']; ?></h4>
                        <p><em><?= $school['school_address']; ?></em></p>
                        <h5><?= $school['date_format(start_date, "%e/%m/%Y")']; ?> - <?= $school['date_format(end_date, "%e/%m/%Y")']; ?></h5>
                        <ul>
                            <li><?= $school['date_format(date_d, "%e/%m/%Y")']; ?> - <?= $school['libelle_d']; ?></li>
                        </ul>
                    </div>
                    <?php } ?>
                </div>
                <div class="col-lg-6">
                    <h3 class="resume-title">Stages / Professionals Experiences</h3>
                    <?php foreach ($company as $comp) { ?>
                    <div class="resume-item">
                        <h4><?= $comp['company_name']; ?></h4>
                        <p><em><?= $comp['company_address']; ?></em></p>
                        <h5><?= $comp['date_format(start_date, "%e/%m/%Y")']; ?> - <?= $comp['date_format(end_date, "%e/%m/%Y")']; ?></h5>
                        <ul>
                            <li><?= $comp['libelle_w']; ?></li>
                        </ul>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-4">
                <a class="btn btn-primary" href="assets/files/CV.Yassine" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download me-1" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                    </svg>
                    Télécharger mon CV
                </a>
            </div>
            <div class="d-flex justify-content-center mt-4">
                <a class="btn btn-primary" href="assets/files/tableau_synthese" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download me-1" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                    </svg>
                    Télécharger mon tableau de synthese
                </a>
            </div>
            <div class="d-flex justify-content-center mt-4">
                <a class="btn btn-primary" href="https://www.canva.com/design/DAE_MNbAORU/Cb37NMJwmN_xWSph0hVKmg/view?utm_content=DAE_MNbAORU&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download me-1" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                    </svg>
                    Consulter ma veille technologique
                </a>
            </div>
        </div>
    </section>
    <section id="portfolio" class="portfolio section-bg">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Projets / Projects</h2>
            </div>
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
                    <ul id="portfolio-flters">
                        <li data-filter="*" class="filter-active">All</li>
                        <?php
                        foreach ($category as $cat) {
                        ?>
                        <li data-filter=".filter-<?= $cat['id_f']; ?>"><?= $cat['title']; ?></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>

            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
             <?php foreach ($projects as $project) { ?>
                <div class="col-lg-4 col-md-6 portfolio-item filter-<?= $project['id_f']; ?>">
                    <div class="portfolio-wrap">
                        <img src="<?= $project['chemin']; ?><?= $project['nom']; ?>" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4><?= $project['title']; ?></h4>
                            <div class="portfolio-links">
                                <a href="<?= $project['chemin']; ?><?= $project['nom']; ?>" data-gallery="portfolioGallery" class="portfolio-lightbox me-2" title="<?= $project['title']; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-zoom-in" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                                        <path d="M10.344 11.742c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1 6.538 6.538 0 0 1-1.398 1.4z"/>
                                        <path fill-rule="evenodd" d="M6.5 3a.5.5 0 0 1 .5.5V6h2.5a.5.5 0 0 1 0 1H7v2.5a.5.5 0 0 1-1 0V7H3.5a.5.5 0 0 1 0-1H6V3.5a.5.5 0 0 1 .5-.5z"/>
                                    </svg>
                                </a>
                                <a href="<?= $project['github_url']; ?>" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>
                                        <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>

        </div>
    </section>

    <section id="diplome" class="services">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Qu'est-ce que le BTS SIO ?</h2>
                <div class="card">
                    <div class="card-body text-start">
                        <div class="card-title">
                            <h3>Introduction</h3>
                        </div>
                        <p class="card-text">
                            Le BTS SIO <small>(Services Informatiques aux Organisations)</small> a été créé en septembre 2011 afin de remplacer le BTS Informatique de Gestion. Le BTS SIO répond plus que jamais aux besoins du marché du travail, grâce aux compétences acquises, parfaitement adaptées au besoins des entreprise en informatique.
                        </p>
                    </div>
                    <div class="card-body text-start">
                        <div class="card-title">
                            <h3>Les options</h3>
                        </div>
                        <p class="card-text">
                            Le BTS SIO possède <u>deux options</u> :
                            <ul>
                                <li>
                                    <b>SISR</b> <small>(Solutions d'Infrastructures, Système et Réseaux)</small> : permet à son détenteur de mettre en place et de gérer des infrastructures réseaux au sein d'une organisation.
                                </li>
                                <li>
                                    <b>SLAM</b> <small>(Solutions Logiciels et Application Métiers)</small> : forme des professionnels capables de concevoir des programmes destinées à la gestion d'une organisation.
                                </li>
                            </ul>
                        </p>
                    </div>
                    <div class="card-body text-start">
                        <div class="card-title">
                            <h3>Matières étudiées</h3>
                        </div>
                        <ul>
                            <li>Expression et communication de langue anglaise</li>
                            <li>Culture général et expression</li>
                            <li>Mathématiques</li>
                            <li>Algorithmique appliqués à l'informatique</li>
                            <li>Économie et Management</li>
                            <li>Droit de l'informatique</li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <p class="card-text">À l'issue d'un BTS SIO, il est possible de poursuivre les études ou de rejoindre le marché de l'emploi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Me contacter / Contact-me</h2>
            </div>
            <div class="row mt-1">
                <div class="col-lg-12 mt-5 mt-lg-0">
                    <form method="post" action="">
                        <div class="form-group mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Your email address" required>
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" name="subject" class="form-control" placeholder="Subject of message" required>
                        </div>
                        <div class="form-group mb-3">
                            <textarea name="message" rows="5" placeholder="Your message" class="form-control" required></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="submit" class="btn btn-primary">Envoyer le message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</main>
