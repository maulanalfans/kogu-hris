<div class="container mt-3">
    <?= generate_breadcrumb() ?>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0"><?= $section_title ?></h5>
            <a href="<?= base_url('outlet/create') ?>" class="btn btn-primary btn-sm">Tambah Outlet</a>
        </div>
        <div class="card-body">
            <?php if ($this->session->flashdata('success')) : ?>
                <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>

            <table class="table table-hover align-middle mb-0" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Unit</th>
                        <th>Deskripsi</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Dibuat Pada</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($outlets as $outlet) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $outlet->unit_name ?></td>
                            <td><?= $outlet->description ?></td>
                            <td><?= $outlet->latitude ?></td>
                            <td><?= $outlet->longitude ?></td>
                            <td><?= indonesianDate($outlet->created_at, 'full') ?></td>
                            <td>
                                <a href="<?= base_url('outlet/update/' . $outlet->id) ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="<?= base_url('outlet/delete/' . $outlet->id) ?>" onclick="return confirm('Yakin hapus data ini?')" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>