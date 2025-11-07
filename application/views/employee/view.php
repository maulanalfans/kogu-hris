<div class="row clearfix g-3">
    <div class="col-lg-12">
        <?= generate_breadcrumb() ?>

        <!-- Tombol Aksi -->
        <div class="row mt-4 mb-4">
            <div class="col-md-6"><a href="<?= base_url('karyawan') ?>" class="btn btn-secondary btn-sm lift">
                    <i class="icofont-arrow-left"></i> Kembali
                </a></div>
            <div class="col-md-6 text-end">
                <a href="<?= base_url('karyawan/update/' . $employee_data->id) ?>" class="btn btn-warning btn-sm lift">
                    <i class="icofont-pencil-alt-3"></i> Update
                </a>
                <a href="<?= base_url('karyawan/delete/' . $employee_data->id) ?>" class="btn btn-danger btn-sm lift" onclick="return confirm('Yakin ingin menghapus data karyawan ini? Data yang dihapus tidak dapat dikembalikan.');">
                    <i class="icofont-trash"></i> Delete
                </a>
            </div>
        </div>

        <!-- Profile Header Section -->
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-body d-flex align-items-center">
                <div class="me-4">
                    <img src="https://api.dicebear.com/9.x/initials/svg?seed=<?= $employee_data->name ?>" alt="Foto <?= $employee_data->name ?>" class="rounded-circle border" width="110" height="110" style="object-fit: cover;">
                </div>
                <div>
                    <h4 class="mb-1 fw-bold"><?= $employee_data->name ?></h4>
                    <p class="text-muted mb-1">
                        <?= $employee_data->position_name ?> - <?= $employee_data->division_name ?>
                    </p>
                    <span class="badge bg-success"><?= $employee_data->status_name ?></span>
                </div>
            </div>
        </div>

        <!-- Informasi Pribadi -->
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-header bg-light d-flex align-items-center">
                <i class="icofont-user-alt-2 me-2 text-primary"></i>
                <h6 class="mb-0 fw-semibold text-primary">Informasi Pribadi</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <strong>NIP:</strong><br><?= $employee_data->nip ?>
                    </div>
                    <div class="col-md-4">
                        <strong>Jenis Kelamin:</strong><br><?= $employee_data->gender == 'L' ? 'Laki-laki' : 'Perempuan' ?>
                    </div>
                    <div class="col-md-4">
                        <strong>Tanggal Lahir:</strong><br><?= indonesianDate($employee_data->birth_date) ?>
                    </div>
                    <div class="col-md-4">
                        <strong>Email:</strong><br><?= $employee_data->email ?>
                    </div>
                    <div class="col-md-4">
                        <strong>No. Telepon:</strong><br><?= $employee_data->phone_number ?>
                    </div>
                    <div class="col-md-4">
                        <strong>NIK KTP:</strong><br><?= $employee_data->nik_ktp ?>
                    </div>
                    <div class="col-md-4">
                        <strong>Kota Domisili:</strong><br><?= $employee_data->city ?>
                    </div>
                    <div class="col-md-4">
                        <strong>Agama:</strong><br><?= $employee_data->religion_name ?>
                    </div>
                    <div class="col-md-4">
                        <strong>Pendidikan:</strong><br><?= $employee_data->education_level ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Pekerjaan -->
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-header bg-light d-flex align-items-center">
                <i class="icofont-briefcase-1 me-2 text-success"></i>
                <h6 class="mb-0 fw-semibold text-success">Informasi Pekerjaan</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <strong>Unit:</strong><br><?= $employee_data->unit_name ?>
                    </div>
                    <div class="col-md-4">
                        <strong>Divisi:</strong><br><?= $employee_data->division_name ?>
                    </div>
                    <div class="col-md-4">
                        <strong>Jabatan:</strong><br><?= $employee_data->position_name ?>
                    </div>
                    <div class="col-md-4">
                        <strong>Tanggal Bergabung:</strong><br><?= indonesianDate($employee_data->join_date) ?>
                    </div>
                    <div class="col-md-4">
                        <strong>Status:</strong><br><?= $employee_data->status_name ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Kontrak -->
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-header bg-light d-flex align-items-center">
                <i class="icofont-id-card me-2 text-warning"></i>
                <h6 class="mb-0 fw-semibold text-warning">Informasi Kontrak</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <strong>Periode Kontrak:</strong><br>
                        <?= $employee_data->contract_start ? indonesianDate($employee_data->contract_start) : '-' ?>
                        <i> s.d. </i>
                        <?= $employee_data->contract_end ? indonesianDate($employee_data->contract_end) : '-' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>