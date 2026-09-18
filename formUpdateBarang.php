<div class="container-fluid" style="margin-bottom: 100px;">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card" style="width: 65%">
        <div class="card-body">

            <?php foreach($masuk as $m) : ?>
            
                <form method="POST" action="<?php echo base_url('admin/barangMasuk/updateDataAksi') ?>">
                
                    <!-- Hidden Input untuk menjaga kunci utama saat pembaruan -->
                    <input type="hidden" name="kode_barang" value="<?php echo $m->kode_barang ?>">

                    <div class="form-group">
                        <label>Kode Barang</label>
                        <input type="text" class="form-control" value="<?php echo $m->kode_barang ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" name="nama" class="form-control" value="<?php echo $m->nama ?>">
                        <?php echo form_error('nama', '<div class="text-small text-danger">', '</div>') ?>
                    </div>

                    <div class="form-group">
                        <label>Stok Masuk</label>
                        <input type="number" name="stok_masuk" class="form-control" value="<?php echo $m->stok_masuk ?>">
                        <?php echo form_error('stok_masuk', '<div class="text-small text-danger">', '</div>') ?>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Masuk</label>
                        <input type="date" name="tanggal_masuk" class="form-control" value="<?php echo $m->tanggal_masuk ?>">
                        <?php echo form_error('tanggal_masuk', '<div class="text-small text-danger">', '</div>') ?>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?php echo base_url('admin/barangMasuk') ?>" class="btn btn-warning">Batal</a>

                </form>

            <?php endforeach; ?>

        </div>
    </div>

</div>