<div class="row" id="js-contacts">
<?php
for ($i = 1; $i <= 10; $i++) {
    ?>
    <div class="col-xl-4">
        <div id="c_<?php echo $i; ?>" class="card border shadow-0 mb-g shadow-sm-hover"
            data-filter-tags="player_<?php echo $i; ?>">
            <div
                class="card-body border-faded border-top-0 border-left-0 border-right-0 rounded-top">
                <div class="d-flex flex-row align-items-center">
                    <span class="status status-success mr-3">
                        <span class="rounded-circle profile-image d-block "
                            style="background-image:url('../img/profile-pics/default_profile.jpg'); background-size: cover;"></span>
                    </span>
                    <div class="info-card-text flex-1">
                        <a href="javascript:void(0);"
                            class="fs-xl text-truncate text-truncate-lg text-info"
                            data-toggle="dropdown" aria-expanded="false">
                            Player <?php echo $i; ?>
                            <i class="fal fa-angle-down d-inline-block ml-1 fs-md"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Send Email</a>
                            <a class="dropdown-item" href="#">Add to next game</a>
                            <a class="dropdown-item" href="#">Drop player</a>
                        </div>
                        <span class="text-truncate text-truncate-xl">Position <?php echo $i; ?></span>
                    </div>
                    <button class="js-expand-btn btn btn-sm btn-default d-none"
                        data-toggle="collapse" data-target="#c_<?php echo $i; ?> > .card-body + .card-body"
                        aria-expanded="false">
                        <span class="collapsed-hidden">+</span>
                        <span class="collapsed-reveal">-</span>
                    </button>
                </div>
            </div>
            <div class="card-body p-0 collapse show">
                <div class="p-3">
                    <a href="tel:+13174562564" class="mt-1 d-block fs-sm fw-400 text-dark">
                        <i class="fal fa-mobile-alt text-muted mr-2"></i> +1 317-456-2564</a>
                    <a href="mailto:player<?php echo $i; ?>@nfldashboard.com"
                        class="mt-1 d-block fs-sm fw-400 text-dark">
                        <i class="fal fa-envelope text-muted mr-2"></i>
                        player<?php echo $i; ?>@nfldashboard.com</a>
                    <address class="fs-sm fw-400 mt-4 text-muted">
                        <i class="fal fa-map-pin mr-2"></i> Address <?php echo $i; ?>
                    </address>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>