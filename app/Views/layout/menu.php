<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="https://raw.githubusercontent.com/ibnufajar0104/img_statis/main/logo-icon.png" class="logo-icon"
                alt="logo icon" />
        </div>
        <div>
            <h4 class="logo-text"><?= singkatan_aplikasi() ?></h4>
        </div>
        <div class="toggle-icon ms-auto"><i class="bi bi-list"></i></div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <?php if (session()->blok_sistem_id == 99) : ?>
        <?= $this->include('layout/menu1'); ?>
        <?php else : ?>
        <?= $this->include('layout/menu2'); ?>
        <?php endif ?>
    </ul>
    <!--end navigation-->
</aside>