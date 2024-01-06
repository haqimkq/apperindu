<!-- <li class="<?= $url == 'dashboard' ? 'mm-active' : '' ?>"> <a href="<?= site_url() ?>dashboard">
        <div class="parent-icon"><i class="bx bx-home-alt"></i></div>
        <div class="menu-title">Dashboard</div>
    </a>

</li> -->
<?php if (in_array(session()->blok_sistem_id, get_blok_sistem_type_2())) : ?>
    <li class="<?= $url == 'pemohon' ? 'mm-active' : '' ?>"> <a href="<?= site_url() ?>pemohon">
            <div class="parent-icon"><i class="bi bi-person-fill"></i></div>
            <div class="menu-title">Pemohon</div>
        </a>

    </li>

    <li class="<?= $url == 'pendaftaran' ? 'mm-active' : '' ?>"> <a href="<?= site_url() ?>pendaftaran">
            <div class="parent-icon"><i class="fadeIn animated bx bx-file"></i></div>
            <div class="menu-title">Pendaftaran</div>
        </a>

    </li>

    <li class="<?= $url == 'pendaftaran_online' ? 'mm-active' : '' ?>"> <a href="<?= site_url('pendaftaran_online') ?>">
            <div class="parent-icon"><i class="fadeIn animated bx bx-globe"></i></div>
            <div class="menu-title">Pendaftaran Online</div>
        </a>

    </li>
<?php endif ?>
<?php if (in_array(session()->blok_sistem_id, get_blok_sistem_type_5())) : ?>
    <li class="<?= $url == 'validasi' ? 'mm-active' : '' ?>"> <a href="<?= site_url() ?>validasi">
            <div class="parent-icon"><i class="fadeIn animated bx bx-check"></i></div>
            <div class="menu-title">Validasi Berkas</div>
        </a>

    </li>
<?php endif ?>
<?php if (in_array(session()->blok_sistem_id, get_blok_sistem_type_3())) : ?>
    <li class="<?= $url == 'cetak_sk' ? 'mm-active' : '' ?>"> <a href="<?= site_url() ?>cetak_sk">
            <div class="parent-icon"><i class="fadeIn animated bx bx-file"></i></div>
            <div class="menu-title">Cetak SK</div>
        </a>

    </li>
    <li class="<?= $url == 'rekap' ? 'mm-active' : '' ?>"> <a href="<?= site_url() ?>rekap">
            <div class="parent-icon"><i class="fadeIn animated bx bx-table"></i></div>
            <div class="menu-title">Rekapitulasi</div>
        </a>

    </li>
<?php endif ?>

<?php if (in_array(session()->blok_sistem_id, get_blok_sistem_type_4())) : ?>
    <li class="<?= $url == 'rekomendasi' ? 'mm-active' : '' ?>"> <a href="<?= site_url() ?>rekomendasi">
            <div class="parent-icon"><i class="fadeIn animated bx bx-file"></i></div>
            <div class="menu-title">Rekomendasi</div>
        </a>

    </li>
    <li class="<?= $url == 'rekap_rekomendasi' ? 'mm-active' : '' ?>"> <a href="<?= site_url() ?>rekap_rekomendasi">
            <div class="parent-icon"><i class="fadeIn animated bx bx-table"></i></div>
            <div class="menu-title">Rekap Rekomendasi</div>
        </a>

    </li>
<?php endif ?>
<li>
    <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="fadeIn animated bx bx-navigation"></i></div>
        <div class="menu-title">Kendali Berkas</div>
    </a>
    <ul>
        <li class="<?= $url == 'kendali_berkas/view/dikirim' ? 'mm-active' : '' ?>">
            <a href="<?= site_url() ?>kendali_berkas/view/dikirim"><i class="bi bi-circle"></i>Dikirim</a>
        </li>
        <li class="<?= $url == 'kendali_berkas/view/salah_kirim' ? 'mm-active' : '' ?>">
            <a href="<?= site_url() ?>kendali_berkas/view/salah_kirim"><i class="bi bi-circle"></i>Salah Kirim</a>
        </li>
        <li class="<?= $url == 'kendali_berkas/view/arsip' ? 'mm-active' : '' ?>">
            <a href=" <?= site_url() ?>kendali_berkas/view/arsip"><i class="bi bi-circle"></i>Arsip</a>
        </li>


    </ul>
</li>






<?php if (session()->blok_sistem_id == 127) : ?>

    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bi bi-pencil-square"></i></div>
            <div class="menu-title">TTE</div>
        </a>
        <ul>
            <li class="<?= $url == 'tte/view/berkas' ? 'mm-active' : '' ?>">
                <a href="<?= site_url() ?>tte/view/berkas"><i class="bi bi-circle"></i>Berkas</a>
            </li>
            <li class="<?= $url == 'tte/view/berkas_mandiri' ? 'mm-active' : '' ?>">
                <a href="<?= site_url() ?>tte/view/berkas_mandiri"><i class="bi bi-circle"></i>Berkas Layanan
                    Mandiri</a>
            </li>
            <li class="<?= $url == 'tte/view/sudah' ? 'mm-active' : '' ?>">
                <a href=" <?= site_url() ?>tte/view/sudah"><i class="bi bi-circle"></i>Sudah di TTE</a>
            </li>


        </ul>
    </li>
<?php endif ?>