<nav style="display: flex; border-radius: 8px 8px 0 0;">
        <a class="lbr-border-bottom lbr-text-logo" style="padding: 8px 24px;">Allegro</a>
        <div class="lbr-border-bottom lbr-flex-expand">
        </div>
        <div class="lbr-menu lbr-flex">
            <a href="/dashboard" <?php if($context["current"] == "dashboard"): ?> class="active" <?php endif ?>><i class="fas fa-envelope-open-text lbr-margin-small-right"></i>Messages</a>
            <a href="/people" <?php if($context["current"] == "people"): ?> class="active" <?php endif ?>><i class="fas fa-users lbr-margin-small-right"></i>Classmates</a>
            <a href="/account" <?php if($context["current"] == "account"): ?> class="active" <?php endif ?>><i class="fas fa-cog lbr-margin-small-right"></i>Account</a>
        </div>
    </nav>