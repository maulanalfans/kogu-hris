<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>404</title>
	<link rel="icon" href="<?= base_url(); ?>favicon.ico" type="image/x-icon"> <!-- Favicon-->
	<!-- project css file  -->
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/my-task.style.min.css">
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
								<!-- Image block -->
								<div class="">
									<img src="<?= base_url(); ?>assets/images/login-img.svg" alt="login-img">
								</div>
							</div>
						</div>

						<div class="col-lg-6 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">
							<div class="w-100 p-3 p-md-5 card border-0 bg-dark text-light" style="max-width: 32rem;">
								<!-- Form -->
								<form class="row g-1 p-3 p-md-4">
									<div class="col-12 text-center mb-1 mb-lg-5">
										<img src="<?= base_url(); ?>assets/images/not_found.svg" class="w240 mb-4" alt="" />
										<h5>Oops! Halaman Tidak Ditemukan</h5>
										<span class="text-light">
											Maaf, halaman yang Anda cari tidak tersedia. Jika Anda merasa ini adalah sebuah kesalahan, silakan laporkan masalah tersebut kepada kami.
										</span>

									</div>
									<div class="col-12 text-center">
										<a title="" class="btn btn-lg btn-block btn-light lift text-uppercase" onclick="history.go(-1)">Kembali</a>
									</div>
								</form>
								<!-- End Form -->
							</div>
						</div>
					</div> <!-- End Row -->

				</div>
			</div>

		</div>

	</div>

	<!-- Jquery Core Js -->
	<script src="<?= base_url(); ?>assets/bundles/libscripts.bundle.js"></script>

</body>

</html>