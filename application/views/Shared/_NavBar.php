<nav class="navbar navbar-expand navbar-theme">
    <a class="sidebar-toggle d-flex me-2">
        <i class="hamburger align-self-center"></i>
    </a>

    <?php $menu = explode("/", $content); {
        if($menu[0] != "Shared") { ?>
            <a href="<?= site_url($menu[0]) ?>"><?= $menu[0] ?></a> 

            <?php if($menu[1] != "Index") { ?>
                &nbsp / &nbsp 
                <a href="<?= site_url($menu[0].'/'.$menu[1]) ?>"><?= $menu[1] ?></a>
            <?php } ?>

        <?php } 
    } ?>
    
    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle position-relative" href="#" id="messagesDropdown" data-bs-toggle="dropdown">
                    <i class="align-middle fas fa-envelope-open"></i>
                </a>
            </li>
            <li class="nav-item dropdown ms-lg-2">
                <a class="nav-link dropdown-toggle position-relative" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                    <i class="align-middle fas fa-bell"></i>
                    <span class="indicator"></span>
                </a>
            </li>
            <li class="nav-item dropdown ms-lg-2">
                <a class="nav-link dropdown-toggle position-relative" href="#" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="align-middle fas fa-cog"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <?php if($this->session->userdata['logged_in']['id_usertype'] != "Admin") { ?>
                        <a href="<?= site_url('Dashboards/Profile') ?>" class="dropdown-item" href="#"><i class="align-middle me-1 fas fa-fw fa-user"></i>Profil</a>
                        <div class="dropdown-divider"></div>
                    <?php } ?>
                    <a class="dropdown-item" href="<?= site_url('Home/SignOut')?>"><i class="align-middle me-1 fas fa-fw fa-arrow-alt-circle-right"></i>Keluar</a>
                </div>
            </li>
        </ul>
    </div>
</nav>