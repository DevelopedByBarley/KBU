<?php $csrf = $params['csrf'];; ?>


<header>
	<div class="container-fluid px-lg-5  mt-5 mb-10">
		<div class="row d-flex align-items-center justify-content-center" id="header">
			<div class="col-12 col-xl-6 offset-xl-1 col-xxl-6 px-5 mt-5 d-flex align-items-center justify-content-center">
				<div class="mt-5 text-center text-xl-start">
					<h1 class="fw-bolder text-nowrap m-0">KNORR BREMSE</h1>
					<h2 class="fw-bolder mt-0">Sportnap</h2>
					<p class="fw-normal ">2023. Május 12.</p>
					<button data-bs-toggle="modal" data-bs-target="#formModal" class="btn btn-lg shadow gray-50 bg-main-blue dark-bg-gray-50 dark-text-main-blue rounded-0 mt-1">Regisztráció</button>
				</div>
			</div>
			<div class="col-12 col-xl-5 col-xxl-5 text-center mt-5">
				<div class="blur-load parallax-wrap">
					<img parallax="1" class="img-fluid rounded-5" id="runner" loading="lazy" src="/public/assets/images/running.png" alt="..." />
				</div>
			</div>
		</div>
	</div>
</header>

<!-- <div class="side-nav d-none d-xl-flex align-items-center justify-content-around">
	<a href="#register" class="text-decoration-none main-blue dark-text-gray-50">Regisztráció</a>
	<a href="#rule-tiles" class="text-decoration-none main-blue dark-text-gray-50">Szabályzat</a>
	<a href="#programs" class="text-decoration-none main-blue dark-text-gray-50">Program</a>
</div>
 -->


<div class="container mt-5 mt-lg-0" id="programs">
	<div class="row">
		<div class="col-12">
			<h1 class="fw-bolder light-text-main-blue display-5">Programok</h1>
		</div>
		<div class="col-12 col-lg-6">
			<!-- Section: Timeline -->
			<section class="py-5">
				<ul class="timeline">
					<li class="timeline-item mb-5">
						<h5 class="fw-bold main-blue dark-text-main-orange">07:30 - 08:30</h5>
						<p class="mb-2 fw-bold">Helyszíni regisztráció, reggeli</p>
					</li>

					<li class="timeline-item mb-5">
						<h5 class="fw-bold main-blue dark-text-main-orange">08:00 - 08:30</h5>
						<p class="mb-2 fw-bold">Megnyitó, bajnokságok menetének ismertetése</p>
					</li>

					<li class="timeline-item mb-5">
						<h5 class="fw-bold main-blue dark-text-main-orange">08:30 - 13:45</h5>
						<p class="mb-2 fw-bold">Sportbajnokságok és egyéb programok</p>
						<p class="text-muted">
							(csoportos órák a Fitness termekben, futás,ergométer,
							mini sportpályák, bringa park, cornhole, focikapu sebességmérővel,
							óriás csocsóasztal,interaktív aréna, kinect, logikai játékok, kézműves foglalkozás és textilzsák festés)

						</p>
					</li>
					<li class="timeline-item mb-5">
						<h5 class="fw-bold main-blue dark-text-main-orange">11:30 - 13:30</h5>
						<p class="mb-2 fw-bold">Ebéd kuponos rendszerben</p>
					</li>

					<li class="timeline-item mb-5">
						<h5 class="fw-bold main-blue dark-text-main-orange">14:00 - 14:30</h5>
						<p class="tmb-2 fw-bold">Eredményhirdetés és programzárás</p>

					</li>
				</ul>
			</section>
			<!-- Section: Timeline -->
		</div>
		<div class="col-12 col-lg-6"  id="timeline-images">
			<div class="row">
				<div class="col-12 col-md-6 my-4">
					<div class="blur-load">
						<img src="/public/assets/images/foci-1.jpg" loading="lazy" class="img-fluid timeline-img  timeline-img-1 shadow rounded-0" alt="">
					</div>
				</div>
				<div class="col-12 col-md-6 my-4">
					<div class="blur-load">
						<img src="/public/assets/images/csocso-3.jpg" loading="lazy" class="img-fluid timeline-img  timeline-img-2 shadow rounded-0" alt="">
					</div>
				</div>
				<div class="col-12 col-md-6 my-4">
					<div class="blur-load">
						<img src="/public/assets/images/joga.jpg" loading="lazy" class="img-fluid timeline-img  timeline-img-3 shadow rounded-0" alt="">
					</div>
				</div>
				<div class="col-12 col-md-6 my-4">
					<div class="blur-load">
						<img src="/public/assets/images/dij.jpg" loading="lazy" class="img-fluid timeline-img  timeline-img-4 shadow rounded-0" alt="">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div id="first-info" class="gray-50 bg-main-blue dark-bg-light-blue min-h-400 mt-8">
	<div class="container">
		<div class="row">
			<div class="col-12" id="transfer-info">
				<div class="min-h-400 d-flex align-items-center justify-content-center flex-column p-3 py-5">
					<p class="text-xl fw-bold">
						Transzfer lehetőség: A Knorr-Bremse telephelyről (1238 Budapest, Helsinki út 105.) a
						Sport11-hez indítunk igény szerint buszjáratot. A buszok 7:00-kor indulnak a telephelyről a
						Sportnap helyszínére, majd 14:45-kor visszafele. Kérjük, aki a regisztráció során igényelt transzfert, pontosan érkezzen.
					</p>
					<p class="text-xl red-500 fw-bold">
						Kérünk mindenkit, használjátok a transzfer lehetőséget,
						a tömegközlekedést, vagy érkezzetek egy autóval többen,
						mert erősen korlátozott a parkolóhelyek száma. Tömegközlekedési lehetőség
						a helyszínre: 41-es villamos, vagy 187-es busz Kelenföldről (Őrmező felőli oldal)
					</p>
				</div>

				<div class="min-h-200 bg-main-blue dark-bg-light-blue border-0  skew" style="clip-path: polygon(0 0, 0 53%, 100% 0);">
				</div>
			</div>
		</div>
	</div>
</div>

<section class="container min-h-500" id="rule-tiles">
	<div class="row mt-10 mb-5">
		<div class="col-12">
			<h1 class="text-center display-5 fw-bolder main-blue dark-text-gray-50">
				Sportbajnokságok szabályzata
			</h1>
		</div>
	</div>
	<div class="row gap-4 d-flex justify-content-center" id="tiles">
		<div class="col-12 col-lg-5 tile p-0 rounded-4 shadow min-h-300">
			<div class="blur-load">
				<img class="img" loading="lazy" src="/public/assets/images/foc-2.jpg" alt="..." />
			</div>
			<div class="wrapper h-100 bg-main-blue opacity-50"></div>
			<div class="content w-75">
				<h1 class="text-white text-center py-3">Foci</h1>
				<p class="text-white">
					Foci – 5+1 fő/csapat + maximum 4 csere, 2*12
					perces meccsekkel (a jelentkező csapatok
					számától függően több csoportban körmérkőzést
					szervezünk, majd a legjobb 8 csapat kieséses
					rendszerben játszik tovább egészen a döntőkig)
				</p>
				<div class="btn btn-outline-warning rounded-0 btn-xl-lg mb-2">
					Játékszabály
				</div>
			</div>
		</div>
		<div class="col-12 col-lg-5 tile p-0  rounded-4 shadow">
			<div class="blur-load">
				<img class="img" loading="lazy" src="/public/assets/images/csocso-2.jpg" alt="..." />
			</div>
			<div class="wrapper h-100 bg-main-blue opacity-50"></div>
			<div class="content w-75">
				<h1 class="text-white text-center py-3">Csocsó</h1>
				<p class="text-white">
					Csocsó – 2 fő/csapat, 10 gól vagy 10 perc/meccs
					, amelyik előbb bekövetkezik,
					egyenes kieséssel
				</p>
				<div class="btn btn-outline-warning rounded-0 btn-xl-lg mb-2">
					Játékszabály
				</div>
			</div>
		</div>
		<div class="col-12 col-lg-5 tile p-0  rounded-4 shadow">
			<div class="blur-load">
				<img class="img" loading="lazy" src="/public/assets/images/sport.jpg" alt="..." />
			</div>
			<div class="wrapper  h-100 bg-main-blue opacity-50"></div>
			<div class="content w-75">
				<h1 class="text-white text-center py-3">Sorverseny</h1>
				<p class="text-white">
					Lorem ipsum dolor sit amet, consectetur adipiscing
					elit. Fusce pretium auctor quam,
					ut pharetra justo tristique eu.
					Praesent elit sem, vulputate
					sit amet ultrices eget, accumsan ac ligula.
				</p>
				<div class="btn btn-outline-warning rounded-0 btn-xl-lg mb-2">
					Játékszabály
				</div>
			</div>
		</div>
		<div class="col-12 col-lg-5 tile p-0 rounded-4 shadow">
			<div class="blur-load">
				<img class="img" loading="lazy" src="/public/assets/images/ping-pong-2.jpg" alt="..." />
			</div>
			<div class="wrapper  h-100 bg-main-blue opacity-50"></div>
			<div class="content w-75">
				<h1 class="text-white text-center py-3">Ping Pong</h1>
				<p class="text-white">
					Ping-pong – 2 fő/csapat, egyenes kieséses
					rendszerben, 1 nyert szettig (21 pont) vagy
					15 percig, amelyik előbb bekövetkezik,
					az elődöntők, a bronzmeccs és a döntő
					két nyert szettig tartanak
				</p>
				<div class="btn btn-outline-warning rounded-0 btn-xl-lg mb-2">
					Játékszabály
				</div>
			</div>
		</div>
	</div>


</section>


<div id="second-info" class="gray-50 bg-main-blue dark-bg-light-blue min-h-400 mt-8">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="min-h-400 d-flex justify-content-center flex-column p-xl-5">
					<p class="text-xl fw-bold">
						A sportbajnokságok meccseinek időbeosztása a regisztráció lezárulását
						követően lesz elérhető Actimón, Intraneten és a csapatkapitányoknál.

					</p>
					<p class="text-xl fw-bold">
						Azok a csapatok, akik nem jelennek meg a kiírt meccsük kezdési időpontjáig,
						automatikusan elveszítik az adott mérkőzést.
					</p>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="container">
	<div class="row" id="register">
		<div class="col-12 min-h-200 d-flex align-items-center justify-content-center">
			<button data-bs-toggle="modal" data-bs-target="#formModal" class="btn btn-warning rounded-5 px-7 text-white btn-lg">Regisztráció</button>
		</div>
	</div>

</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-12 d-flex flex-column flex-md-row align-items-center justify-content-between  my-3">
			<img class="my-4 dark-bg-gray-50 p-3" style="width: 300px;" src="/public/assets/images/logo.png" alt="">
			<div class="bg-danger w-100 text-center">

			</div>
			<div>
				<p class="m-0 text-center" style="font-style: italic;">Szervező cég:</p>
				<a href="https://max.hu/" target="_blank">
					<img src="/public/assets/images/Max_Logo_White.png" class="bg-dark p-3 max-h-200 max-w-200" alt="">
				</a>
			</div>
		</div>
	</div>
</div>


<?php include 'app/Views/public/components/RegisterModal.php' ?>