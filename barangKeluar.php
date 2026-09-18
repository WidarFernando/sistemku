<div class="container-fluid" style="margin-bottom: 100px;">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <?php echo $this->session->flashdata('pesan') ?>

    <a class="mb-2 mt-2 btn btn-sm btn-success" href="<?php echo base_url('admin/barangKeluar/tambahData') ?>">
        <i class="fas fa-plus"></i> Tambah Barang
    </a>

    <form method="GET" action="<?php echo base_url('admin/barangKeluar') ?>">
    <div class="input-group input-group-sm">
        <input type="text" name="keyword" class="form-control" placeholder="Cari barang..." value="<?php echo $this->input->get('keyword') ?>">
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit">
                <i class="fas fa-search"></i> Cari
            </button>
        </div>
    </div>
</form>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Kode Barang</th>
                <th class="text-center">Nama Barang</th>
                <th class="text-center">Stok Keluar</th>
                <th class="text-center">Tanggal Keluar</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach($keluar as $k) : ?>
            <tr>
                <td class="text-center"><?php echo $no++ ?></td>
                <td><?php echo $k->kode_barang ?></td>
                <td><?php echo $k->nama ?></td>
                <!-- PERBAIKAN 1: Menggunakan stok_masuk bukan stok_barang -->
                <td class="text-center"><?php echo $k->stok_keluar ?></td>
                <td class="text-center"><?php echo $k->tanggal_keluar ?></td>
                <td class="text-center">
        
                    <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/barangKeluar/updateData/'.$k->kode_barang) ?>">
                        <i class="fas fa-edit"></i>
                    </a>
                   
                    <a onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger" href="<?php echo base_url('admin/barangKeluar/deleteData/'.$k->kode_barang) ?>">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>