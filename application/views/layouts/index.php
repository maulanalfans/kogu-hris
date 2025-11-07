<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <?php $this->load->view('layouts/header'); ?>
</head>

<body>

    <div id="mytask-layout" class="theme-indigo">
        <?php $this->load->view('layouts/sidebar'); ?>

        <!-- main body area -->
        <div class="main px-lg-4 px-md-4">
            <?php $this->load->view('layouts/navbar'); ?>

            <!-- Body: Body -->
            <div class="body d-flex py-3">
                <div class="container-xxl">
                    <?php $this->load->view($content); ?>
                </div>
            </div>
        </div>
        <?php $this->load->view('layouts/footer'); ?>
    </div>
</body>

</html>