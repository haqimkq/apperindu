<!-- <li class="<?= $url == 'dashboard' ? 'mm-active' : '' ?>"> <a href="<?= site_url() ?>dashboard">
        <div class="parent-icon"><i class="bx bx-home-alt"></i></div>
        <div class="menu-title">Dashboard</div>
    </a> -->

</li>

<li>
    <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="fadeIn animated bx bx-file"></i></div>
        <div class="menu-title">Master Perizinan</div>
    </a>
    <ul>
        <li class="<?= $url == 'izin' ? 'mm-active' : '' ?>">
            <a href="<?= site_url() ?>izin"><i class="bi bi-circle"></i>Izin</a>
        </li>
        <li class="<?= $url == 'permohonan' ? 'mm-active' : '' ?>">
            <a href="<?= site_url() ?>permohonan"><i class="bi bi-circle"></i>Permohonan</a>
        </li>
        <li class="<?= $url == 'persyaratan' ? 'mm-active' : '' ?>">
            <a href="persyaratan"><i class="bi bi-circle"></i>Persyaratan</a>
        </li>
        <li class="<?= $url == 'persyaratan_permohonan' ? 'mm-active' : '' ?>">
            <a href="<?= site_url() ?>persyaratan_permohonan"><i class="bi bi-circle"></i>Persyaratan
                Permohonan</a>
        </li>

    </ul>
</li>
<li>
    <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="bi bi-grid-fill"></i></div>
        <div class="menu-title">Master Kecamatan</div>
    </a>
    <ul>
        <li class="<?= $url == 'kecamatan' ? 'mm-active' : '' ?>">
            <a href="<?= site_url() ?>kecamatan"><i class="bi bi-circle"></i>Kecamatan</a>
        </li>
        <li class="<?= $url == 'kelurahan' ? 'mm-active' : '' ?>">
            <a href="<?= site_url() ?>kelurahan"><i class="bi bi-circle"></i>Kelurahan</a>
        </li>


    </ul>
</li>
<li>
    <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="fadeIn animated bx bx-navigation"></i></div>
        <div class="menu-title">Master Kendali Alur</div>
    </a>
    <ul>
        <li class="<?= $url == 'blok_sistem' ? 'mm-active' : '' ?>">
            <a href="<?= site_url() ?>blok_sistem"><i class="bi bi-circle"></i>Blok Sistem</a>
        </li>
        <li class="<?= $url == 'blok_sistem_tugas' ? 'mm-active' : '' ?>">
            <a href="<?= site_url() ?>blok_sistem_tugas"><i class="bi bi-circle"></i>Blok Sistem Tugas</a>
        </li>
        <li class="<?= $url == 'kendali_alur' ? 'mm-active' : '' ?>">
            <a href=" <?= site_url() ?>kendali_alur"><i class="bi bi-circle"></i>Kendali Alur</a>
        </li>


    </ul>
</li>

<li class="<?= $url == 'pengguna' ? 'mm-active' : '' ?>">
    <a href="<?= site_url() ?>pengguna">
        <div class="parent-icon"><i class="bi bi-person-lines-fill"></i></div>
        <div class="menu-title">Pengguna</div>
    </a>

</li>



<li>
    <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="fadeIn animated bx bx-book-content"></i></div>
        <div class="menu-title">Template</div>
    </a>
    <ul>
        <li class="<?= $url == 'template_sk' ? 'mm-active' : '' ?>">
            <a href="<?= site_url() ?>template_sk"><i class="bi bi-circle"></i>Surat Keterangan</a>
        </li>
        <li class="<?= $url == 'template_rekomendasi' ? 'mm-active' : '' ?>">
            <a href="<?= site_url() ?>template_rekomendasi"><i class="bi bi-circle"></i>Rekomendasi</a>
        </li>



    </ul>
</li>

<li class="<?= $url == 'variabel_sk' ? 'mm-active' : '' ?>">
    <a href="<?= site_url('variabel_sk') ?>">
        <div class="parent-icon"><i class="fadeIn animated bx bx-table""></i></div>
        <div class=" menu-title">Tabel / Variabel</div>
    </a>

</li>


<li class="<?= $url == 'verify' ? 'mm-active' : '' ?>">
    <a href="<?= site_url('verify/dokumen') ?>">
        <div class="parent-icon"><i class="bi bi-check-all"></i></div>
        <div class="menu-title">Verifikasi Dokumen</div>
    </a>

</li>


<li>
    <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="bi bi-gear"></i></div>
        <div class="menu-title">Pengaturan</div>
    </a>
    <ul>
        <li class="<?= $url == 'pengaturan/form_page' ? 'mm-active' : '' ?>">
            <a href="<?= site_url() ?>pengaturan/form_page"><i class="bi bi-circle"></i>Pimpinan</a>
        </li>
        <li class="<?= $url == 'pengaturan/token' ? 'mm-active' : '' ?>">
            <a href="<?= site_url() ?>pengaturan/token"><i class="bi bi-circle"></i>Token</a>
        </li>

        <li class="<?= $url == 'tte_rekomendasi' ? 'mm-active' : '' ?>">
            <a href="<?= site_url() ?>tte_rekomendasi"><i class="bi bi-circle"></i>TTE Rekomendasi</a>
        </li>


    </ul>
</li>