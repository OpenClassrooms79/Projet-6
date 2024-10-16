<section id="account-public">
    <section id="profile-public">
        <?= Components::get('profileDisplay', $user, count($books), false) ?>
        <a href="" class="button inverse text-center">Écrire un message</a>
    </section>
    <?= Components::get('bookList', $books); ?>
</section>
