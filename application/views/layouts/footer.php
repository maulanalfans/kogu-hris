<?php if ($this->session->flashdata('toastr')) : ?>
    <script>
        const toastData = <?= json_encode($this->session->flashdata('toastr')); ?>;
    </script>
<?php endif; ?>
<script>
    $(document).ready(function() {

        $('table').addClass('nowrap').dataTable({
            responsive: true,
            columnDefs: [{
                targets: [-1, -3],
                className: 'dt-body-right'
            }]
        });

        if (typeof toastData !== 'undefined') {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "4000"
            };
        }
        switch (toastData.type) {
            case 'error':
                toastr.error(toastData.message, toastData.title);
                break;
            default:
                toastr.success(toastData.message, toastData.title);
                break;
        }

    });
</script>