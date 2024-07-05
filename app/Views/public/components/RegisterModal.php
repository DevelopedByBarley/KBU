<?php $main_teams = $params['main_teams'] ?? [] ?>

<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content dark-bg-main-blue p-lg-5">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">
					Regisztráció
				</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body p-1 p-md-4 p-lg-0">
				<div class="accordion accordion-flush border" id="accordionFlushExample">
					<div class="accordion-item">
						<h2 class="accordion-header">
							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
								Jelentkezési útmutató<i class="fa-solid fa-circle-exclamation text-3xl mx-2 amber-500"></i>
							</button>

						</h2>
						<div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
							<div class="accordion-body">
								<p class="fw-bolder">
									Kedves Kollégák,
								</p>
								<p>
									Szeretnénk felhívni figyelmeteket, hogy a sportnapon való részvételnél az egészségi állapototoknak megfelelő aktivitást válasszatok.
									A sportnapon való részvétel regisztrációjával egyben kinyilvánításra kerül, hogy nincs olyan ismert megbetegedésed, amely az általad választott sportágban, az intenzívebb mozgás által, annak következményeként az egészségi állapotodban rosszabbodást okozna.
									A sportbajnokságokra és minden regisztrációhoz kötött programra a jelentkezéseket érkezési sorrendben fogadjuk.
									A rendezvényre csak egy alkalommal van lehetőség regisztrálni, módosításra nincs lehetőség.
									Minden munkavállaló maximum 2 sportbajnokságra jelentkezhet - 1 csapatsport és 1 páros sport vagy sakk.
									A csoportos órákra a helyszínen lehet majd jelentkezni, érkezési sorrendben.
									Előfordulhat, hogy a céges levelezési rendszerünk a regisztráció visszaigazolását automatikusan karanténba helyezi, ezért azokat néhány órás késéssel kapjátok meg a karanténoldalon keresztül.</p>
								<p class="green-500">
									Szeretnénk felhívni figyelmeteket, hogy a sportnapon való részvételnél az egészségi állapototoknak megfelelő aktivitást válasszatok. A sportnapon való részvétel regisztrációjával egyben kinyilvánításra kerül, hogy nincs olyan ismert megbetegedésed, amely az általad választott sportágban, az intenzívebb mozgás által, annak következményeként az egészségi állapotodban rosszabbodást okozna.
								</p>

							</div>
						</div>
					</div>
				</div>




				<hr class="mt-5">
				<form>
					<div class="row mb-4 mt-4">
						<div class="col-12 col-lg-6 my-2">
							<div class="form-outline">

								<label class="form-label" for="form6Example1">
									Név
									<button type="button" class="btn p-1 m-0" data-bs-toggle="popover" title="Segítség" data-bs-content="Kérjük, hogy a teljes nevedet írd be, elöl legyen a vezetéknév, mögötte a keresztnév.">
										<i class="fa-solid fa-circle-info text-2xl"></i>
									</button>
								</label>
								<input name="name" type="text" id="form6Example1" class="form-control" data-validators='{"name": "name", "required": true, "minLength": 6, "maxLength": 50, "split": true}' />
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
								<input type="text" name="class" id="form6Example2" class="form-control" data-validators='{"name": "class", "required": true, "minLength": 5}' />
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
								<input type="email" name="email" id="form6Example3" class="form-control" data-validators='{"name": "email", "required": true, "email": true, "minLength": 7}' />
							</div>
						</div>

						<div class="col-12 col-lg-6 my-2">
							<div class="form-outline mb-4">
								<label class="form-label" for="form6Example5">
									Törzsszám
									<button type="button" class="btn p-1  m-0" data-bs-toggle="popover" title="Segítség" data-bs-content="A belépőkártyádon található 6 vagy 8 jegyű szám.">
										<i class="fa-solid fa-circle-info text-2xl"></i>
									</button>
								</label>
								<input type="text" name="alt_id" id="form6Example5" class="form-control" data-validators='{"name": "alt_id", "required": true, "minLength": 5}' />
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
								<select class="form-select" aria-label="Select main team" id="main-team" name="main-team" required>

									<!--Rendering main teams-->

									<option value="" selected>Válassza ki a főcsapatot</option>
									<?php foreach ($main_teams as $team) : ?>
										<?php
										$free_spots = $team['max'];
										$team_name = htmlspecialchars($team['name']);
										$team_color = htmlspecialchars($team['color']);
										$team_leader = htmlspecialchars($team['leader']);
										$team_id = htmlspecialchars($team['id']);
										?>


										<option value="<?= $team_id ?>" <?= $free_spots > 0 ? '' : 'disabled' ?>>
											<?= $team_leader ?> - <?= $team_name ?> (<?= $free_spots ?> szabad hely)
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
								<select class="form-select" aria-label="Select main team" id="team-sports" name="team-sport" required>
								</select>
							</div>
						</div>
						<div class="col-12 d-none" id="duel-sports-container">
							<div class="form-outline mb-4">
								<label class="form-label" for="form6Example6">
									Páros sport kiválasztása
									<button type="button" class="btn p-1  m-0" data-bs-toggle="popover" title="Segítség" data-bs-content="Kérjük, figyelmesen olvasd el az összes választható csapat nevét, melyben megtalálod a csapat színét és a csapatkapitány nevét.">
										<i class="fa-solid fa-circle-info text-2xl"></i>
									</button>
								</label>
								<select class="form-select" aria-label="Select main team" id="duel-sports" name="duel-sport" required>
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
								<select class="form-select" aria-label="Select pair status" id="pair-status" name="pair-status" required>
									<option value="" selected>Van párja?</option>
									<option value="1">Van párom</option>
									<option value="2">Párnak jelentkezem</option>
								</select>
							</div>
						</div>

						<div class="col-12 d-none" id="select-pair-eligibility-container">
							<div class="form-outline mb-4">
								<label class="form-label" for="pair-eligibility">
									Ki jelölhet önt párnak?
									<button type="button" class="btn p-1 m-0" data-bs-toggle="popover" title="Segítség" data-bs-content="Kérjük, figyelmesen olvasd el az összes választható csapat nevét, melyben megtalálod a csapat színét és a csapatkapitány nevét.">
										<i class="fa-solid fa-circle-info text-2xl"></i>
									</button>
								</label>
								<select class="form-select" aria-label="Select pair eligibility" id="pair-eligibility" name="pair-eligibility" required>
									<option value="" selected>Jelölje be ki jelölheti önt párnak!</option>
									<option value="1">Bárki megjelölhet</option>
									<option value="2">Jelszót adok meg amivel megjelölhetnek</option>
								</select>
							</div>
						</div>

						<div class="col-12 d-none" id="pairing-password-container">
							<div class="form-outline mb-4">
								<label class="form-label" for="pair-eligibility">
									Jelszót megadása
									<button type="button" class="btn p-1 m-0" data-bs-toggle="popover" title="Segítség" data-bs-content="Kérjük, figyelmesen olvasd el az összes választható csapat nevét, melyben megtalálod a csapat színét és a csapatkapitány nevét.">
										<i class="fa-solid fa-circle-info text-2xl"></i>
									</button>
								</label>
								<div class="d-flex gap-3">
									<input name="pairing_password" type="text" id="pairing_password" class="form-control" />
									<button type="button" class="btn bg-main-gray text-black" id="pw-generator-btn">Generálás</button>
								</div>

							</div>
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save changes</button>
						</div>

						<div>
							<img src="/public/assets/images/icons/logo.png" alt="">
						</div>
					</div>
			</div>
		</div>



















		<!-- 			<div class="p-3">


						<div class="form-outline mb-4">
							<label class="form-label" for="form6Example4">
								Futás
								<button type="button" class="btn p-1  m-0" data-bs-toggle="popover" title="Segítség" data-bs-content="Két távra jelentkezhettek, 2,5 km valamint 5 km. Kérjük, jelöljétek ki a választott távot.">
									<i class="fa-solid fa-circle-info text-2xl"></i>
								</button>
							</label>
							<select class="form-select" aria-label="Select running option">
								<option selected>Táv kiválasztása</option>
								<option value="1">Nem jelentkezem</option>
								<option value="2">Futás (2,5km)</option>
								<option value="2">Futás (5km)</option>
							</select>
						</div>

						<div class="col-12">

							<div class="form-outline mb-4">
								<label class="form-label" for="form6Example4">
									Transzferigény
									<button type="button" class="btn p-1  m-0" data-bs-toggle="popover" title="Segítség" data-bs-content="A Knorr-Bremse telephelyről (1238 Budapest, Helsinki út 105.) a Sport11-hez indítunk igény szerint buszjáratot. A buszok 7.00-kor indulnak a telephelyről a Sportnap helyszínére, majd 14.15-kor visszafele. Kérjük, aki igényel transzfert, pontosan érkezzen.">
										<i class="fa-solid fa-circle-info text-2xl"></i>
									</button>
								</label>
								<select class="form-select" aria-label="Default select example">
									<option selected>Open this select menu</option>
									<option value="1">Igen, reggel</option>
									<option value="2">Igen, délután</option>
									<option value="3">Igen, reggel és délután</option>
								</select>
								<small class="d-block mt-2 orange-500 px-3">
									Kérünk mindenkit, használjátok Ļa transzfer lehetőséget, a tömegközlekedést, vagy érkezzetek egy autóval többen, mert erősen korlátozott a parkolóhelyek száma. Tömegközlekedési lehetőség a helyszínre: 41-es villamos, vagy 187-es busz Kelenföldről (Őrmező felőli oldal)
									Reggel: indulás 7.00-kor a Knorr-Bremse H105 telephely elől (érkezés: Sport 11 elé)
									Délután: indulás 14.45-kor a Sport 11 elől (érkezés: Knorr-Bremse H105 telephely elé)</small>
							</div>
						</div>
				<div class="form-check d-flex mb-4">
					<input class="form-check-input me-2" type="checkbox" value="" id="form6Example8" />
					<label class="form-check-label" for="form6Example8"> Vegetáriánus ebéd igénylése</label>
				</div>

				<div class="form-check d-flex mb-4">
					<input class="form-check-input me-2" type="checkbox" value="" id="form6Example8" />
					<label class="form-check-label" for="form6Example8"> Elolvastam a jelentkezési útmutatót.</label>
				</div>
				<div class="form-check d-flex mb-4">
					<input class="form-check-input me-2" type="checkbox" value="" id="form6Example8" />
					<label class="form-check-label" for="form6Example8"> A jelen Adatkezelési Tájékoztató tartalmát megismertem, megértettem és elfogadom.</label>
				</div>
				<div class="form-check d-flex mb-4">
					<input class="form-check-input me-2" type="checkbox" value="" id="form6Example8" />
					<label class="form-check-label" for="form6Example8">

						A jelen Adatkezelési Tájékoztató ismeretében hozzájárulok ahhoz, hogy a Felvételeket,
						a nevemet, a tartózkodási helyemet, valamint beosztásomat, mint személyes adataimat az Adatkezelő,
						a Felvételek felhasználása során, saját marketing és promóciós céljai elérése érdekében
						az Általános Adatvédelmi Rendelet (General Data Protection Regulation, továbbiakban GDPR),
						valamint az információs önrendelkezési jogról és az információszabadságról 2011. évi CXII.
						törvény rendelkezéseinek megfelelően kezelje és megbízottjaihoz, mint adatfeldolgozókhoz továbbítsa

					</label>
				</div>
			</div> -->