<div class="row clearfix g-3">
    <div class="col-lg-12 col-md-12 flex-column">
        <?= generate_breadcrumb() ?>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0"><?= $section_title ?></h5>
            </div>
            <div class="card-body">

                <!-- Global Validation Error -->
                <?php if (validation_errors()) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Oops!</strong> Terjadi kesalahan pada update data.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <div class="mt-2">
                            <?= validation_errors('<div class="text-danger small">', '</div>'); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?= form_open('karyawan/update/' . $employee->id, ['method' => 'POST', 'autocomplete' => 'off']) ?>

                <div class="row g-3">

                    <!-- NIP -->
                    <div class="col-md-4">
                        <label class="form-label">NIP</label>
                        <input type="text" class="form-control <?= form_error('nip') ? 'is-invalid' : ''; ?>" name="nip" value="<?= set_value('nip', $employee->nip); ?>" required>
                        <div class="invalid-feedback"><?= form_error('nip'); ?></div>
                    </div>

                    <!-- Nama -->
                    <div class="col-md-8">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control <?= form_error('name') ? 'is-invalid' : ''; ?>" name="name" value="<?= set_value('name', $employee->name); ?>" required>
                        <div class="invalid-feedback"><?= form_error('name'); ?></div>
                    </div>

                    <!-- Gender -->
                    <div class="col-md-4">
                        <label class="form-label">Jenis Kelamin</label>
                        <select class="form-select <?= form_error('gender') ? 'is-invalid' : ''; ?>" name="gender" required>
                            <option value="">Pilih</option>
                            <option value="L" <?= set_select('gender', 'L', $employee->gender == 'L'); ?>>Laki-laki</option>
                            <option value="P" <?= set_select('gender', 'P', $employee->gender == 'P'); ?>>Perempuan</option>
                        </select>
                        <div class="invalid-feedback"><?= form_error('gender'); ?></div>
                    </div>

                    <!-- No. Telepon -->
                    <div class="col-md-4">
                        <label class="form-label">No. Telepon</label>
                        <input type="text" class="form-control <?= form_error('phone_number') ? 'is-invalid' : ''; ?>" name="phone_number" value="<?= set_value('phone_number', $employee->phone_number); ?>">
                        <div class="invalid-feedback"><?= form_error('phone_number'); ?></div>
                    </div>

                    <!-- Email -->
                    <div class="col-md-4">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control <?= form_error('email') ? 'is-invalid' : ''; ?>" name="email" value="<?= set_value('email', $employee->email); ?>">
                        <div class="invalid-feedback"><?= form_error('email'); ?></div>
                    </div>

                    <!-- NIK -->
                    <div class="col-md-4">
                        <label class="form-label">NIK KTP</label>
                        <input type="text" class="form-control <?= form_error('nik_ktp') ? 'is-invalid' : ''; ?>" name="nik_ktp" value="<?= set_value('nik_ktp', $employee->nik_ktp); ?>">
                        <div class="invalid-feedback"><?= form_error('nik_ktp'); ?></div>
                    </div>

                    <!-- Kota -->
                    <div class="col-md-4">
                        <label class="form-label">Kota</label>
                        <input type="text" class="form-control <?= form_error('city') ? 'is-invalid' : ''; ?>" name="city" value="<?= set_value('city', $employee->city); ?>">
                        <div class="invalid-feedback"><?= form_error('city'); ?></div>
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="col-md-4">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="birth_date" value="<?= set_value('birth_date', $employee->birth_date); ?>">
                    </div>

                    <!-- Status -->
                    <div class="col-md-4">
                        <label class="form-label">Status</label>
                        <select class="form-select <?= form_error('status_id') ? 'is-invalid' : ''; ?>" name="status_id" required>
                            <option value="">Pilih Status</option>
                            <?php foreach ($statuses as $status) : ?>
                                <option value="<?= $status->id ?>" <?= set_select('status_id', $status->id, $employee->status_id == $status->id); ?>>
                                    <?= $status->status_name ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('status_id'); ?></div>
                    </div>

                    <!-- Unit -->
                    <div class="col-md-4">
                        <label class="form-label">Unit</label>
                        <select class="form-select <?= form_error('unit_id') ? 'is-invalid' : ''; ?>" name="unit_id" required>
                            <option value="">Pilih Unit</option>
                            <?php foreach ($units as $unit) : ?>
                                <option value="<?= $unit->id ?>" <?= set_select('unit_id', $unit->id, $employee->unit_id == $unit->id); ?>>
                                    <?= $unit->unit_name ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('unit_id'); ?></div>
                    </div>

                    <!-- Jabatan -->
                    <div class="col-md-4">
                        <label class="form-label">Jabatan</label>
                        <select class="form-select <?= form_error('position_id') ? 'is-invalid' : ''; ?>" name="position_id" required>
                            <option value="">Pilih Jabatan</option>
                            <?php foreach ($positions as $position) : ?>
                                <option value="<?= $position->id ?>" <?= set_select('position_id', $position->id, $employee->position_id == $position->id); ?>>
                                    <?= $position->position_name ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('position_id'); ?></div>
                    </div>

                    <!-- Divisi -->
                    <div class="col-md-4">
                        <label class="form-label">Divisi</label>
                        <select class="form-select <?= form_error('division_id') ? 'is-invalid' : ''; ?>" name="division_id" required>
                            <option value="">Pilih Divisi</option>
                            <?php foreach ($divisions as $division) : ?>
                                <option value="<?= $division->id ?>" <?= set_select('division_id', $division->id, $employee->division_id == $division->id); ?>>
                                    <?= $division->division_name ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('division_id'); ?></div>
                    </div>

                    <!-- Pendidikan -->
                    <div class="col-md-4">
                        <label class="form-label">Pendidikan</label>
                        <select class="form-select" name="education_id">
                            <option value="">Pilih Pendidikan</option>
                            <?php foreach ($educations as $education) : ?>
                                <option value="<?= $education->id ?>" <?= set_select('education_id', $education->id, $employee->education_id == $education->id); ?>>
                                    <?= $education->education_level ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Agama -->
                    <div class="col-md-4">
                        <label class="form-label">Agama</label>
                        <select class="form-select" name="religion_id">
                            <option value="">Pilih Agama</option>
                            <?php foreach ($religions as $religion) : ?>
                                <option value="<?= $religion->id ?>" <?= set_select('religion_id', $religion->id, $employee->religion_id == $religion->id); ?>>
                                    <?= $religion->religion_name ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Join Date -->
                    <div class="col-md-4">
                        <label class="form-label">Tanggal Bergabung</label>
                        <input type="date" class="form-control" name="join_date" value="<?= set_value('join_date', $employee->join_date); ?>">
                    </div>

                    <!-- Kontrak -->
                    <div class="col-md-4">
                        <label class="form-label">Mulai Kontrak</label>
                        <input type="date" class="form-control" name="contract_start" value="<?= set_value('contract_start', $employee->contract_start); ?>">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Akhir Kontrak</label>
                        <input type="date" class="form-control" name="contract_end" value="<?= set_value('contract_end', $employee->contract_end); ?>">
                    </div>
                </div>

                <hr>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Role User</label>
                        <div class="small">*Pastikan role user sesuai kebutuhan sistem.</div>
                        <select class="form-select" name="role_id">
                            <option value="">Role User</option>
                            <?php foreach ($roles as $role) : ?>
                                <option value="<?= $role->id ?>" <?= set_select('role_id', $role->id, $employee_roles->role_id == $role->id); ?>>
                                    <?= $role->role_description ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                    <a href="<?= base_url('karyawan') ?>" class="btn btn-secondary btn-sm">Batal</a>
                </div>

                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>