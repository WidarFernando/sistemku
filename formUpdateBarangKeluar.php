<div class="container-fluid" style="margin-bottom: 100px;">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card" style="width: 65%">
        <div class="card-body">

            <?php foreach($keluar as $k) : ?>
            
                <form method="POST" action="<?php echo base_url('admin/barangKeluar/updateDataAksi') ?>">
                
                    <!-- Hidden Input untuk menjaga kunci utama saat pembaruan -->
                    <input type="hidden" name="kode_barang" value="<?php echo $k->kode_barang ?>">

                    <div class="form-group">
                        <label>Kode Barang</label>
                        <input type="text" class="form-control" value="<?php echo $k->kode_barang ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" name="nama" class="form-control" value="<?php echo $k->nama ?>">
                        <?php echo form_error('nama', '<div class="text-small text-danger">', '</div>') ?>
                    </div>

                    <div class="form-group">
                        <label>Stok Keluar</label>
                        <input type="number" name="stok_keluar" class="form-control" value="<?php echo $k->stok_keluar ?>">
                        <?php echo form_error('stok_keluar', '<div class="text-small text-danger">', '</div>') ?>
                    </div>

                    <div class="form-group">
                        <label>Tanggal keluar</label>
                        <input type="date" name="tanggal_keluar" class="form-control" value="<?php echo $k->tanggal_keluar ?>">
                        <?php echo form_error('tanggal_keluar', '<div class="text-small text-danger">', '</div>') ?>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?php echo base_url('admin/barangKeluar') ?>" class="btn btn-warning">Batal</a>

                </form>

            <?php endforeach; ?>

        </div>
    </div>

</div>