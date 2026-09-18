<div class="container-fluid " style="margin-bottom: 100px;">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <?php echo $this->session->flashdata('pesan') ?>

    <a class="mb-2 mt-2 btn btn-sm btn-success" href="<?php echo base_url('admin/dataKaryawan/tambahData') ?>"><i class="fas fa-plus"></i> Tambah Karyawan</a>

    <table class="table table-striped table-bordered">
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">NIK</th>
            <th class="text-center">Nama Karyawan</th>
            <th class="text-center">Jenis Kelamin</th>
            <th class="text-center">Jabatan</th>
            <th class="text-center">Tanggal Masuk</th>
            <th class="text-center">Status</th>
            <th class="text-center">Photo</th>
            <th class="text-center">Hak Akses</th>
            <th class="text-center">Action</th>
        </tr>

        <?php $no=1; foreach($karyawan as $k) : ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $k->nik ?></td>
            <td><?php echo $k->nama_karyawan ?></td>
            <td><?php echo $k->jenis_kelamin ?></td>
            <td><?php echo $k->jabatan ?></td>
            <td><?php echo $k->tanggal_masuk ?></td>
            <td><?php echo $k->status ?></td>
            <td><img src="<?php echo base_url().'assets/photo/'.$k->photo ?>" width="75px"></td>
                <?php if($k->hak_akses=='1') { ?>
                <td>Admin</td>
                <?php }else{ ?>
                    <td>Karyawan</td>
                    <?php } ?>
            <td class="text-center">
                        <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/dataKaryawan/updateData/'.$k->id_karyawan) ?>"><i class="fas fa-edit"></i></a>
                        <a onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger" href="<?php echo base_url('admin/dataKaryawan/deleteData/'.$k->id_karyawan) ?>"><i class="fas fa-trash"></i></a>
                    </td>
        </tr>
    <?php endforeach; ?>
    </table>
</div>