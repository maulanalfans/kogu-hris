<div class="row align-items-center">
    <div class="border-0 mb-4">
        <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
            <h3 class="fw-bold mb-0"><?= $page_title ?></h3>
            <div class="col-auto d-flex w-sm-100">
                <a href="karyawan/form/create" type="button" class="btn btn-dark btn-sm"><i class="icofont-plus-circle me-2 fs-6"></i>Tambah Karyawan</a>
            </div>
        </div>
    </div>
</div> <!-- Row end  -->
<div class="row clearfix g-3">
    <div class="col-sm-12">
        <div class="card mb-3">
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
                                    <span class="fw-bold ms-1"> <?= $employee->name ?></span>
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