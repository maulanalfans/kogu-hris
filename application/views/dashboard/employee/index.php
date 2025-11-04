<div class="row align-items-center">
    <div class="border-0 mb-4">
        <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
            <h3 class="fw-bold mb-0"><?= $page_title ?></h3>
            <div class="col-auto d-flex w-sm-100">
                <a type="button" class="btn light-success-bg btn-sm" data-bs-toggle="modal" data-bs-target="#importKaryawanModal"> <i class="icofont-file-excel me-2 fs-6"></i>Import Excel</a> &nbsp;
                <a href="karyawan/form/create" type="button" class="btn btn-dark btn-sm"><i class="icofont-plus-circle me-2 fs-6"></i>Tambah Karyawan</a>
            </div>
        </div>
    </div>
</div> <!-- Row end  -->
<div class="row clearfix g-3">
    <div class="col-sm-12">
        <div class="card mb-3">

            <?= generate_breadcrumb(); ?>
            <div class="card-body">
                <table id="employeeTable" class="table table-hover align-middle mb-0" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Jabatan (Divisi)</th>
                            <th>Unit</th>
                            <th>No Telp</th>
                            <th>Tanggal Bergabung</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($employees as $employee) {
                        ?>
                            <tr>
                                <td>
                                    <span class="fw-bold ms-1"> <a href="<?= base_url('karyawan/' . $employee->id) ?>"><?= $employee->name ?></a></span>
                                </td>
                                <td>
                                    <?= $employee->position_name ?> (<?= $employee->division_name ?>)
                                </td>
                                <td>
                                    <?= $employee->unit_name ?>
                                </td>
                                <td><?= $employee->phone_number ?></td>
                                <td><?= indonesianDate($employee->join_date) ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div><!-- Row End -->

<!-- Modal import -->
<div class="modal fade" id="importKaryawanModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLiveLabel">Import Data Karyawan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Download template <a href="#" style="color: goldenrod;"> disini </a> </p>
                <?= form_open_multipart('EmployeeController/import_xlsx', ['method' => 'POST']); ?>
                <div class="form-control">
                    <input type="file" name="importEmployee" id="importEmployee" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-sm">Import</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>