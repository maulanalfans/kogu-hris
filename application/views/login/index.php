<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title><?= SITE_NAME ?></title>
	<link rel="icon" href="<?= base_url('assets/images/logo.png') ?>" type="image/x-icon"> <!-- Favicon-->
	<link rel="stylesheet" href="<?= base_url('assets/css/my-task.style.min.css') ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>

	<div id="mytask-layout" class="theme-indigo">
		<div class="main p-2 py-3 p-xl-5">
			<div class="body d-flex p-0 p-xl-5">
				<div class="container-xxl">
					<div class="row g-0">
						<div class="col-md-6 d-none d-md-flex justify-content-center align-items-center rounded-md auth-h100">
							<div>
								<div class="text-center mb-4">
									<img src="<?= base_url('assets/images/logo.png') ?>" alt="login-img">
								</div>
								<div>
									<img src="<?= base_url('assets/images/interview.svg') ?>" alt="login-img" style="max-width: 70vh;">
								</div>
							</div>
						</div>

						<div class="col-md-6 d-flex justify-content-center align-items-center border-0 rounded-md auth-h100">
							<div class="w-100 p-3 p-md-5 card border-0 bg-dark text-light" style="max-width: 32rem;">
								<!-- Form -->
								<?= form_open('LoginController/login', ['class' => 'row g-1 p-3 p-md-4']) ?>
								<div class="col-12 text-center mb-1 mb-2">
									<h1><?= SITE_NAME ?></h1>
									<span>Silakan masukkan kredensial valid anda.</span>
								</div>

								<div class="col-12">
									<div class="mb-2">
										<label class="form-label">Username</label>
										<input type="text" name="username" value="<?= set_value('username') ?>" class="form-control form-control-md" placeholder="Username">
										<?= form_error('username', '<small class="text-danger">', '</small>') ?>
									</div>
								</div>

								<div class="col-12">
									<div class="mb-2">
										<label class="form-label">Password</label>
										<input type="password" name="password" class="form-control form-control-md" placeholder="***************">
										<?= form_error('password', '<small class="text-danger">', '</small>') ?>
									</div>
								</div>

								<input type="hidden" name="latitue" value="">
								<input type="hidden" name="longitude" value="">

								<div class="col-12 mt-2 mb-2">
									<button type="submit" class="btn btn-md btn-block btn-light lift">Masuk</button>
								</div>
								<?= form_close() ?>
								<!-- End Form -->
							</div>
						</div>
					</div> <!-- End Row -->
				</div>
			</div>
		</div>
	</div>

	<?php if ($this->session->flashdata('error')) : ?>
		<script>
			const toastData = <?= json_encode($this->session->flashdata('error')); ?>;
		</script>
	<?php endif; ?>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="<?= base_url('assets/bundles/libscripts.bundle.js') ?>"></script>
	<script>
		$(document).ready(function() {
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(
					function(position) {
						$('#latitude').val(position.coords.latitude);
						$('#longitude').val(position.coords.longitude);
						alert("Lokasi berhasil diambil: " + position.coords.latitude + ", " + position.coords.longitude);
					},
					function(error) {
						let message = "";
						switch (error.code) {
							case error.PERMISSION_DENIED:
								message = "Izin lokasi ditolak. Aktifkan izin GPS di browser.";
								break;
							case error.POSITION_UNAVAILABLE:
								message = "Informasi lokasi tidak tersedia.";
								break;
							case error.TIMEOUT:
								message = "Waktu permintaan lokasi habis.";
								break;
							default:
								message = "Terjadi kesalahan tidak diketahui.";
								break;
						}
						alert("Gagal mendapatkan lokasi: " + message);
						console.error("Geolocation error:", error);
					}
				);
			} else {
				alert("Browser kamu tidak mendukung fitur lokasi.");
			}

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
					toastr.error(toastData.message, toastData.title);
					break;
			}
		});
	</script>

</body>

</html>