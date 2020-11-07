<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"><?= $this->session->userdata('fullname') ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('Profile') ?>">Profile</a>
            </li>
            <?php if ($this->session->userdata('role') == "admin") : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('Users') ?>">Users</a>
                </li>
            <?php endif; ?>
        </ul>
        <a class="btn btn-outline-success my-2 my-sm-0" href="<?= base_url('Login/logout') ?>">Logout</a>
    </div>
</nav>