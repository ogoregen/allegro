<h1>Hello <?= $context["name"] ?>!</h1>

<p>Please follow this link to confirm your request to change your email address to <?= $context["newEmail"] ?>:</p>
<p><a href="<?= $context["verificationLink"] ?>"><?= $context["verificationLink"] ?></a></p>