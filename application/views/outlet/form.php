<div class="container mt-3">
    <?= generate_breadcrumb() ?>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0"><?= $section_title ?></h5>
        </div>
        <div class="card-body">
            <?= form_open() ?>
            <div class="mb-3">
                <label for="unit_name" class="form-label">Nama Outlet</label>
                <input type="text" name="unit_name" class="form-control" value="<?= set_value('unit_name', isset($outlet->unit_name) ? $outlet->unit_name : '') ?>" required>
                <?= form_error('unit_name', '<small class="text-danger">', '</small>') ?>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control"><?= set_value('description', isset($outlet->description) ? $outlet->description : '') ?></textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="latitude" class="form-label">Latitude</label>
                    <input type="text" name="latitude" class="form-control" value="<?= set_value('latitude', isset($outlet->latitude) ? $outlet->latitude : '') ?>" required>
                    <?= form_error('latitude', '<small class="text-danger">', '</small>') ?>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="longitude" class="form-label">Longitude</label>
                    <input type="text" name="longitude" class="form-control" value="<?= set_value('longitude', isset($outlet->longitude) ? $outlet->longitude : '') ?>" required>
                    <?= form_error('longitude', '<small class="text-danger">', '</small>') ?>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="<?= base_url('outlet') ?>" class="btn btn-secondary">Kembali</a>
            <?= form_close() ?>
        </div>
    </div>
</div>