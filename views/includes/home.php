<section id="home">
    <div>
        <div>
            <h1>Rejoignez nos lecteurs passionnés</h1>
            <p class="home-text">Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres.</p>

            <a class="button" href="echanges">Découvrir</a>
        </div>
    </div>
    <div>
        <div class="home-image">
            <img class="big-image" src="<?= IMG_PATH ?>livres.png" alt="Livres">
            <p class="big-image-signature">Hamza</p>
        </div>
    </div>
</section>

<section id="last-books">
    <h2 class="text-center">Les derniers livres ajoutés</h2>

    <div class="lastbooks">
        <?php
        foreach ($books as $book) {
            echo Components::book($book);
        }
        ?>
    </div>

    <a class="button center" href="echanges">Voir tous les livres</a>

</section>

<h2 class="text-center" id="how-it-works-title">Comment ça marche ?</h2>

<p class="text-center">Échanger des livres avec TomTroc c’est simple et<br>amusant ! Suivez ces étapes pour commencer :</p>

<section id="how-it-works">
    <article>Inscrivez-vous gratuitement sur notre plateforme.</article>

    <article>Ajoutez les livres que vous souhaitez échanger à votre profil.</article>

    <article>Parcourez les livres disponibles chez d'autres membres.</article>

    <article>Proposez un échange et discutez avec d'autres passionnés de lecture.</article>
</section>

<a class="button center inverse" href="echanges">Voir tous les livres</a>

<div id="banner">
    <img src="<?= IMG_PATH ?>books3.jpg" alt="bannière" id="banner-img">
</div>

<h2 id="our-values-title">Nos valeurs</h2>

<p id="our-values">
    Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.<br><br>

    Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé.<br><br>

    Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.
</p>
<div id="signature">
    <span id="signature-text" class="light-text">L’équipe Tom Troc</span>
    <img alt="" src="<?= IMG_PATH ?>coeur.svg">
</div>