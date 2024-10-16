<section id="account-public">
    <section id="profile-public">
        <?= Components::profileDisplay($user, count($books), false) ?>
        <a href="" class="button inverse text-center">Écrire un message</a>
    </section>
    <?php
    echo Components::bookList($books);
    ?>
</section>
