<p><?= $_SESSION["user"]->fullName()." just sent you a message:" ?></p>

<h2><?= $context["message"]->subject ?></h2>

<?= $context["message"]->body ?>