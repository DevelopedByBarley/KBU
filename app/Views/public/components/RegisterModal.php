<?php
$main_teams = $params['main_teams'] ?? []
?>




<div class="modal fade transition-ease-in-out-300" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content dark-bg-main-blue p-lg-5 p-1">
			<div class="modal-header" id="register-modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">
					Regisztráció <span id="team-header-text"></span>
				</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body p-1 p-md-4 p-lg-0 mt-5">
				<div class="accordion accordion-flush border" id="accordionFlushExample">
					<div class="accordion-item">
						<h2 class="accordion-header">
							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
								Jelentkezési útmutató<i class="fa-solid fa-circle-exclamation text-3xl mx-2 amber-500"></i>
							</button>

						</h2>
						<div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
							<div class="accordion-body">
								<p class="fw-bolder text-xl">
									Kedves Kollégák,
								</p>
								<p>
									Szeretnénk felhívni figyelmeteket, hogy a sportnapon való részvételnél az egészségi állapototoknak megfelelő aktivitást válasszatok.
									A sportnapon való részvétel regisztrációjával egyben kinyilvánításra kerül, hogy nincs olyan ismert megbetegedésed, amely az általad választott sportágban, az intenzívebb mozgás által, annak következményeként az egészségi állapotodban rosszabbodást okozna.
									A sportbajnokságokra és minden regisztrációhoz kötött programra a jelentkezéseket érkezési sorrendben fogadjuk.
									A rendezvényre csak egy alkalommal van lehetőség regisztrálni, módosításra nincs lehetőség.
									Minden munkavállaló maximum 2 sportbajnokságra jelentkezhet - 1 csapatsport és 1 páros sport.
									A csoportos órákra a helyszínen lehet majd jelentkezni, érkezési sorrendben.
									Előfordulhat, hogy a céges levelezési rendszerünk a regisztráció visszaigazolását automatikusan karanténba helyezi, ezért azokat néhány órás késéssel kapjátok meg a karanténoldalon keresztül.</p>
								<p class="green-500">
									Szeretnénk felhívni figyelmeteket, hogy a sportnapon való részvételnél az egészségi állapototoknak megfelelő aktivitást válasszatok. A sportnapon való részvétel regisztrációjával egyben kinyilvánításra kerül, hogy nincs olyan ismert megbetegedésed, amely az általad választott sportágban, az intenzívebb mozgás által, annak következményeként az egészségi állapotodban rosszabbodást okozna.
								</p>

							</div>
						</div>
					</div>
				</div>

				<div class="alert alert-danger mt-2">
					<i class="fa-solid fa-triangle-exclamation text-xl mx-2"></i>
					Figyelem, a jelentkezés folytatásához a törzsszám ellenörzése kötelező!
				</div>




				<hr class="mt-5">
				<form action="/user/register" method="POST" enctype="multipart/form-data">
					<div class=" row mb-4 mt-4">
						<div class="col-12 col-lg-6 my-2">
							<?= $csrf->generate() ?>

							<div class="form-outline">

								<label class="form-label" for="form6Example1">
									Név
									<button type="button" class="btn p-1 m-0" data-bs-toggle="popover" title="Segítség" data-bs-content="Kérjük, hogy a teljes nevedet írd be, elöl legyen a vezetéknév, mögötte a keresztnév.">
										<i class="fa-solid fa-circle-info text-2xl"></i>
									</button>
								</label>
								<input name="name" type="text" id="form6Example1" class="form-control" validators='{"name": "name", "required": true, "minLength": 6, "maxLength": 50, "split": true}' required />
							</div>
						</div>

						<div class="col-12 col-lg-6 my-2">
							<div class="form-outline">
								<label class="form-label" for="form6Example2">
									Költséghely
									<button type="button" class="btn p-1  m-0" data-bs-toggle="popover" title="Segítség" data-bs-content="Amennyiben nem ismered, kérj segítséget a felettesedtől.">
										<i class="fa-solid fa-circle-info text-2xl"></i>
									</button>
								</label>
								<input type="text" name="class" id="form6Example2" class="form-control" validators='{"name": "class", "required": true, "minLength": 3}' required />
							</div>
						</div>

						<div class="col-12 col-lg-6 my-2">
							<div class="form-outline mb-4">
								<label class="form-label" for="form6Example3">
									E-mail cím
									<button type="button" class="btn p-1  m-0" data-bs-toggle="popover" title="Segítség" data-bs-content="A céges és a magán e-mail címet egyaránt elfogadjuk.">
										<i class="fa-solid fa-circle-info text-2xl"></i>
									</button>
								</label>
								<input type="email" name="email" id="form6Example3" class="form-control" validators='{"name": "email", "required": true, "email": true, "minLength": 7}' required />
							</div>
						</div>

						<div class="col-12 col-lg-6 my-2">
							<div class="form-outline mb-4">
								<label class="form-label" for="form6Example5">
									<span class="red-500"></span>Törzsszám <i class="red-500 fa-solid fa-triangle-exclamation text-xl"></i>
									<button type="button" class="btn p-1  m-0" data-bs-toggle="popover" title="Segítség" data-bs-content="A belépőkártyádon található 6 vagy 8 jegyű szám. Figyelem! A jelentkezés folytatásához az ellenörzése kötelező">
										<i class="fa-solid fa-circle-info text-2xl"></i>
									</button>
								</label>
								<input type="number" name="ident-number" id="ident-number" class="form-control" validators='{"name": "ident-number", "required": true, "minLength": 6, "maxLength": 8}' required />
								<button id="check-ident-num" class="btn bg-violet-500 hover-bg-violet-600 text-white" style="min-width: 100px;">Ellenörzés</button>
							</div>
						</div>

						<div class="col-12">
							<div class="form-outline mb-4">
								<label class="form-label" for="form6Example6">
									Főcsapat kiválasztása
									<button type="button" class="btn p-1  m-0" data-bs-toggle="popover" title="Segítség" data-bs-content="Kérjük, figyelmesen olvasd el az összes választható csapat nevét, melyben megtalálod a csapat színét és a csapatkapitány nevét.">
										<i class="fa-solid fa-circle-info text-2xl"></i>
									</button>
								</label>
								<select class="form-select" aria-label="Select main team" id="main-team" name="main-team" required disabled>


									<option value="" selected disabled>Válassza ki a főcsapatot!</option>
									<?php foreach ($main_teams as $team) : ?>
										<?php
										$free_spots = $team['max'];
										$team_name = htmlspecialchars($team['name']);
										$team_color = htmlspecialchars($team['color']);
										$team_leader = htmlspecialchars($team['leader']);
										$team_id = htmlspecialchars($team['id']);
										$color_emoji = htmlspecialchars($team['color_emoji']);
										?>


										<option data-name="<?= $team_name ?>" data-bg="<?= $team_color ?>" value="<?= $team_id ?>" <?= $free_spots > 0 ? '' : 'disabled' ?>>
											<?= $team_leader ?> - <?= $team_name ?> (<?= $free_spots ?> szabad hely) <?= $color_emoji ?>
										</option>
									<?php endforeach; ?>


								</select>
							</div>
						</div>
						<div class="col-12 d-none" id="team-sports-container">

							<div class="form-outline mb-4">
								<label class="form-label" for="form6Example6">
									Csapat sport kiválasztása
									<button type="button" class="btn p-1  m-0" data-bs-toggle="popover" title="Segítség" data-bs-content="Kérjük, figyelmesen olvasd el az összes választható csapat nevét, melyben megtalálod a csapat színét és a csapatkapitány nevét.">
										<i class="fa-solid fa-circle-info text-2xl"></i>
									</button>
								</label>
								<select class="form-select" aria-label="Select team sport" id="team-sport" name="team-sport" required disabled>
								</select>
							</div>
						</div>
						<div class="col-12 d-none" id="duel-sports-container">
							<?php include 'app/Views/public/components/Spinner.php' ?>
							<div class="form-outline mb-4">
								<label class="form-label" for="form6Example6">
									Páros sport kiválasztása
									<button type="button" class="btn p-1  m-0" data-bs-toggle="popover" title="Segítség" data-bs-content="Kérjük, figyelmesen olvasd el az összes választható csapat nevét, melyben megtalálod a csapat színét és a csapatkapitány nevét.">
										<i class="fa-solid fa-circle-info text-2xl"></i>
									</button>
								</label>
								<select class="form-select" aria-label="Select main team" id="duel-spors" name="duel-sport" required disabled>
								</select>
							</div>
						</div>

						<div class="col-12 d-none" id="select-pair-status-container">
							<div class="form-outline mb-4">
								<label class="form-label" for="pair-status">
									Jelölje meg hogy van-e párja!
									<button type="button" class="btn p-1 m-0" data-bs-toggle="popover" title="Segítség" data-bs-content="Kérjük, figyelmesen olvasd el az összes választható csapat nevét, melyben megtalálod a csapat színét és a csapatkapitány nevét.">
										<i class="fa-solid fa-circle-info text-2xl"></i>
									</button>
								</label>
								<select class="form-select" aria-label="Select pair status" id="pair-status" name="pair-status" required disabled>
									<option value="" selected>Van párja?</option>
									<option value="1">Van párom</option>
									<option value="2">Párnak jelentkezem</option>
								</select>
							</div>
						</div>

						<div class="col-12 d-none" id="choose-pair-container">
							<?php include 'app/Views/public/components/Spinner.php' ?>
							<div class="form-outline mb-4">
								<label class="form-label" for="choose-pair">
									Válaszd ki a párt az eddig jelentkezett résztvevők közül!
									<button type="button" class="btn p-1 m-0" data-bs-toggle="popover" title="Segítség" data-bs-content="Kérjük, figyelmesen olvasd el az összes választható csapat nevét, melyben megtalálod a csapat színét és a csapatkapitány nevét.">
										<i class="fa-solid fa-circle-info text-2xl"></i>
									</button>
								</label>
								<input type="text" id="choose-pair-input" class="form-control visually-hidden" value="" name="pair-id" required disabled />
								<ul class="list-group" id="choose-pair-list">
									<!-- <li class="list-group-item bg-red-400">Cras justo odio</li>
									<li class="list-group-item bg-green-400">Dapibus ac facilisis in</li>
									<li class="list-group-item bg-red-400">Morbi leo risus</li>
									<li class="list-group-item bg-green-400">Porta ac consectetur ac</li>
									<li class="list-group-item bg-green-400">Vestibulum at eros</li> -->
								</ul>
							</div>
						</div>

						<div class="col-12 d-none" id="select-pair-eligibility-container">
							<div class="form-outline mb-4">
								<label class="form-label" for="pair-eligibility">
									Ki jelölheti meg önt párnak?
									<button type="button" class="btn p-1 m-0" data-bs-toggle="popover" title="Segítség" data-bs-content="Kérjük, figyelmesen olvasd el az összes választható csapat nevét, melyben megtalálod a csapat színét és a csapatkapitány nevét.">
										<i class="fa-solid fa-circle-info text-2xl"></i>
									</button>
								</label>
								<select class="form-select" aria-label="Select pair eligibility" id="pair-eligibility" name="pair-eligibility" required disabled>
									<option value="" selected disabled>Jelölje be ki jelölheti önt párnak!</option>
									<option value="1">Bárki megjelölhet</option>
									<option value="2">Jelszó megadása vagy automatikus generálása</option>
								</select>
							</div>
						</div>

						<div class="col-12 d-none" id="pairing-password-container">
							<div class="form-outline mb-4">
								<label class="form-label" for="pair-eligibility">
									Jelszó megadása vagy automatikus generálása!
									<button type="button" class="btn p-1 m-0" data-bs-toggle="popover" title="Segítség" data-bs-content="Kérjük, figyelmesen olvasd el az összes választható csapat nevét, melyben megtalálod a csapat színét és a csapatkapitány nevét.">
										<i class="fa-solid fa-circle-info text-2xl"></i>
									</button>
								</label>
								<div class="d-flex gap-3">
									<input name="password" type="text" id="password" class="form-control" required disabled />
									<button type="button" class="btn  bg-violet-500 hover-bg-violet-600" id="pw-generator-btn">Generálás</button>
								</div>

							</div>
						</div>



						<div class="col-12">

							<div class="form-outline mb-4">
								<label class="form-label" for="form6Example4">
									Transzferigény
									<button type="button" class="btn p-1  m-0" data-bs-toggle="popover" title="Segítség" data-bs-content="A Knorr-Bremse telephelyről (1238 Budapest, Helsinki út 105.) a Sport11-hez indítunk igény szerint buszjáratot. A buszok 7.00-kor indulnak a telephelyről a Sportnap helyszínére, majd 14.15-kor visszafele. Kérjük, aki igényel transzfert, pontosan érkezzen.">
										<i class="fa-solid fa-circle-info text-2xl"></i>
									</button>
								</label>
								<select class="form-select" aria-label="Default select example" name="transfer">
									<option value="" selected disabled>Transzferigény kiválasztása!</option>
									<?php foreach (TRANSFERS as $index => $transfer) : ?>
										<option value="<?= $index ?>">
											<?= $transfer ?>
										</option>
									<?php endforeach; ?>
								</select>
								<small class="d-block mt-2 orange-500 px-3">
									Kérünk mindenkit, használjátok Ļa transzfer lehetőséget, a tömegközlekedést, vagy érkezzetek egy autóval többen, mert erősen korlátozott a parkolóhelyek száma. Tömegközlekedési lehetőség a helyszínre: 41-es villamos, vagy 187-es busz Kelenföldről (Őrmező felőli oldal)
									Reggel: indulás 7.00-kor a Knorr-Bremse H105 telephely elől (érkezés: Sport 11 elé)
									Délután: indulás 14.45-kor a Sport 11 elől (érkezés: Knorr-Bremse H105 telephely elé)</small>
							</div>
						</div>

						<div class="col-12">
							<select class="form-select mb-5" aria-label="Default select example" name="actimo" required>
								<option value="" selected disabled>Rendelkezel actimo profillal?</option>
								<option value="1">Igen</option>
								<option value="0">Nem</option>
							</select>
							<div class="form-check d-flex mb-4">
								<input class="form-check-input me-2" type="checkbox" value="" id="vegetarian" name="vegetarian" />
								<label class="form-check-label" for="vegetarian"> Vegetáriánus ebéd igénylése</label>
							</div>

							<div class="form-check d-flex mb-4">
								<input class="form-check-input me-2" type="checkbox" value="" id="guide" required />
								<label class="form-check-label" for="guide"> Elolvastam a jelentkezési útmutatót.</label>
							</div>
							<div class="form-check d-flex mb-4">
								<input class="form-check-input me-2" type="checkbox" value="" id="privacy" required />
								<label class="form-check-label" for="privacy"> A jelen Adatkezelési Tájékoztató tartalmát megismertem, megértettem és elfogadom.</label>
							</div>
							<div class="form-check d-flex mb-4">
								<input class="form-check-input me-2" type="checkbox" value="" id="privacy-perm" required />
								<label class="form-check-label" for="privacy-perm">

									A jelen <a href="#"> Adatkezelési Tájékoztató</a> ismeretében hozzájárulok ahhoz, hogy a Felvételeket,
									a nevemet, a tartózkodási helyemet, valamint beosztásomat, mint személyes adataimat az Adatkezelő,
									a Felvételek felhasználása során, saját marketing és promóciós céljai elérése érdekében
									az Általános Adatvédelmi Rendelet (General Data Protection Regulation, továbbiakban GDPR),
									valamint az információs önrendelkezési jogról és az információszabadságról 2011. évi CXII.
									törvény rendelkezéseinek megfelelően kezelje és megbízottjaihoz, mint adatfeldolgozókhoz továbbítsa

								</label>
							</div>
						</div>

						<div class="modal-footer mt-5 d-flex align-items-center flex-column">
							<div class="d-flex align-items-center justify-content-center gap-3">
								<button type="button" class="btn  btn-lg  btn-secondary" data-bs-dismiss="modal">Bezár</button>
								<button type="submit" class="btn btn-lg bg-green-400 hover-bg-green-500 text-white">Regisztráció</button>
							</div>
							<div class="dark-bg-gray-50 mt-5 w-100 text-center">
								<img class="my-4 mx-2" style="width: 300px;" src="/public/assets/images/logo.png" alt="">
							</div>
						</div>



					</div>
				</form>
			</div>
		</div>