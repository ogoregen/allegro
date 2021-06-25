<?php

require_once "../core/template.php";

use function Allegro\Core\template\includeTemplate;

?>

<div class="lbr-flex lbr-flex-vertical lbr-background-shapes-4">
  <?php includeTemplate("nav.php") ?>
  <div class="lbr-container-medium lbr-flex lbr-flex-middle lbr-flex-center lbr-flex-expand lbr-flex-vertical lbr-margin lbr-margin-0-bottom">
    <div class="lbr-section lbr-width-full lbr-border">
      <h1 class="lbr-margin-0-top">Frequently Asked Questionss</h1>
      <h4>Is Allegro safe and secure?</h4>
      <p>As we use high-quality technical standards to improve the security of information technology, passwords are encrypted, which is a step up from password protection.</p>

      <h4>Why is Allegro asynchronous?</h4>
      <p>Instant messaging is no longer useful as it used to be. Especially hard to follow the flow of messages written without much thought of chat groups are not efficient. Asynchronous messages encourage composing better, fewer, more efficient messages.</p>

      <h4>How can I change my password?</h4>
      <ul>
        <li>Go to dashboard <a href="http://localhost/dashboard" target="_blank"></a></li>
        <li>Click on Accounts</li>
        <li>Click on Security</li>
        <li>Enter your Current Password</li>
        <li>Enter your New Password</li>
        <li>Click on Update</li>
      </ul>

      <h4>How can I change my mail address?</h4>
      <ul>
        <li>Go to <a href="http://localhost/dashboard" target="_blank">dashboard</a></li>
        <li>Click on Accounts</li>
        <li>Click on Account Details</li>
        <li>Enter your New Mail Address</li>
        <li>Click on Update</li>
      </ul>

      <h4>What is your Privacy Policy?</h4>
      <p>Your privacy is important to us. It is Allegro's policy to respect your privacy and comply with any applicable law and regulation regarding any personal information we may collect about you.</p>
      <p>Go to the <a href="http://localhost/privacy" target="_blank"> Privacy Policy </a> page to read more.</p>

      <p>If you wish, you can contact us at support@allegroapp.me or you can send a message to us.</p>
      <section id="content">
        <div class="wrapper">
          <article class="col-1">
            <div class="indent-left">
              <h3 class="p1">Do you have a different question? Contact us:</h3>


              <form id="contact-form" action="faq.php" method="post" enctype="multipart/form-data">

                <fieldset>

                  <label><span class="text-form">Subject:</span>
                    <input type="text" name="topic">
                  </label>

                  <div class="wrapper">
                    <div class="text-form">Message:</div>
                    <div class="extra-wrap">
                      <textarea type="text" name="message"></textarea>
                    </div>
                  </div>
                  <br>
                  <button type="submit" name="form" class="button-2">Send</button>
                </fieldset>
              </form>
      </section>
    </div>
  </div>
</div>
</div>


<?php includeTemplate("footer.php", ["current" => "support"]) ?>
</div>
