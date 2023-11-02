<div class="row">
    <div class="col-md-6">
        <table class="table table-borderless">

            <tr>
                <td>Nomor Pendaftaran</td>
                <td>:</td>
                <td><?= $r['tblizinpendaftaran_nomor'] ?></td>
            </tr>
            <tr>
                <td>Tanggal Pendaftaran</td>
                <td>:</td>
                <td><?= tanggal($r['tblizinpendaftaran_tgljam']) ?></td>
            </tr>
            <tr>
                <td>Nomor Identitas</td>
                <td>:</td>
                <td><?= $r['tblizinpendaftaran_idpemohon'] ?></td>
            </tr>
            <tr>
                <td>Nomor NPWP</td>
                <td>:</td>
                <td><?= $r['tblizinpendaftaran_npwp'] ?></td>
            </tr>
            <tr>
                <td>Nama Pemohon</td>
                <td>:</td>
                <td><?= $r['tblizinpendaftaran_namapemohon'] ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><?= $r['tblizinpendaftaran_almtpemohon'] ?></td>
            </tr>
            <tr>
                <td>No. Telepon</td>
                <td>:</td>
                <td><?= $r['tblizinpendaftaran_telponpemohon'] ?></td>
            </tr>


            <tr>
                <td>Keterangan</td>
                <td>:</td>
                <td><?= $r['tblizinpendaftaran_keterangan'] ?></td>
            </tr>

        </table>
    </div>

    <div class="col-md-6">
        <table class="table table-borderless">


            <tr>
                <td>Nama Izin</td>
                <td>:</td>
                <td><?= $r['tblizin_nama'] ?></td>
            </tr>
            <tr>
                <td>Nama Permohonan</td>
                <td>:</td>
                <td><?= $r['tblizinpermohonan_nama'] ?></td>
            </tr>

            <tr>
                <td>Nama Usaha</td>
                <td>:</td>
                <td><?= $r['tblizinpendaftaran_usaha'] ?></td>
            </tr>
            <tr>
                <td>Lokasi Usaha / Bangunan</td>
                <td>:</td>

                <td><?= $r['tblizinpendaftaran_lokasiizin'] ?></td>
            </tr>
            <tr>
                <td>Kecamatan</td>
                <td>:</td>
                <td><?= $r['tblkecamatan_nama'] ?></td>
            </tr>
            <tr>
                <td>Kelurahan</td>
                <td>:</td>
                <td><?= $r['tblkelurahan_nama'] ?></td>
            </tr>

        </table>
    </div>
</div>