<?php
$main_teams = $params['main_teams'] ?? [];
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
							<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="true" aria-controls="flush-collapseThree">
								Jelentkezési útmutató<i class="fa-solid fa-circle-exclamation text-3xl mx-2 amber-500"></i>
							</button>
						</h2>
						<div id="flush-collapseThree" class="accordion-collapse collapse show" data-bs-parent="#accordionFlushExample">
							<div class="accordion-body">
								<h1 class="fw-bolder m-3">
									Kedves Kollégák,
								</h1>
								<h3 class="text-danger">
									Fontos tudnivalók a regisztráció kitöltéséhez:
								</h3>

								<ul>
									<li>
										A fő csapat kiválasztásához a törzsszám ellenőrzése kötelező, ezt az lila ellenőrzés gombbal lehet megtenni, ezután lehet csak kiválasztani a főcsapatot, és az alcsapatokat.
									</li>
									<li>
										Fő csapatok kiválasztása után lehetőségetek van választani 1 csapat sportot és 1 páros sportot.
									</li>
									<li>
										Páros sport kiválasztása után választható opciók a "Párt választok a regisztráltak listájából" és a "Nincs párom, ezért választható párnak jelentkezem" opciókat.
									</li>
									<ul>
										<li class="my-2">
											<b>Nincs párom, ezért választható párnak jelentkezem</b>: <br>
											Ennél az opciónál beregisztrálhatsz párként, ezután megadhatod hogy bárki bejelölhessen téged, vagy pedíg megadhatsz egy jelszót amit később megoszthatsz azzal a párral akivel együtt szeretnél lenni,
										</li>
										<li class="my-2">
											<b>Párt választok a regisztráltak listájából </b>: <br>Ilyenkor az <span class="text-danger">"EDDIG MÁR EBBE A CSAPATBA REGISZTRÁLT"</span> felhasználók közül választhatsz,
											<br>
											<span class="bg-orange-600 text-white p-1">
												Azok a párok, akik együtt akarnak játszani, előre beszéljék meg, hogy ki osztja meg jelszavát a másikkal.
												Figyeljetek arra, hogy osszátok meg a helyes jelszót illetve azt hogy melyik főcsapatba és melyik páros sportba regisztráltatok
											</span>

										</li>
									</ul>

								</ul>

								<p>
									Szeretnénk felhívni figyelmeteket, hogy a sportnapon való részvételnél az egészségi állapototoknak megfelelő aktivitást válasszatok.
									A sportnapon való részvétel regisztrációjával egyben kinyilvánításra kerül, hogy nincs olyan ismert betegséged, amely az általad választott sportágban, az intenzívebb mozgás által, annak következményeként az egészségi állapotodban rosszabbodást okozna.
									A sportbajnokságokra és minden regisztrációhoz kötött programra a jelentkezéseket érkezési sorrendben fogadjuk.
									A rendezvényre csak egy alkalommal van lehetőség regisztrálni, módosításra nincs lehetőség.
									Minden munkavállaló maximum 2 sportbajnokságra jelentkezhet - 1 csapatsport és 1 páros sport.
								</p>



								<p>

									A csoportos órákra a helyszínen lehet majd jelentkezni, érkezési sorrendben.
									Előfordulhat, hogy a céges levelezési rendszerünk a regisztráció visszaigazolását automatikusan karanténba helyezi, ezért azokat néhány órás késéssel kapjátok meg a karanténoldalon keresztül.

								</p>

							</div>
						</div>
					</div>
				</div>


				<div class="alert alert-danger mt-2">
					<i class="fa-solid fa-triangle-exclamation text-xl mx-2"></i>
					Figyelem, a fő és alcsapatok kiválasztásához a törzsszám ellenőrzése kötelező!
				</div>




				<hr class="mt-5">
				<form action="/user/register" method="POST" enctype="multipart/form-data">
					<?php if (!REGISTRATION_OPENED): ?>
						<div class="text-center">

							<h3>A regisztráció lezárult! </h3>
						</div>

						<?php return; ?>
					<?php endif ?>
					<div class=" row mb-4 mt-4">
						<div class="col-12 col-lg-6 my-2">
							<?= $csrf->generate() ?>

							<div class="form-outline">

								<label class="form-label" for="form6Example1">
									Név <small><i>(Teljes név)</i></small>
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
									Költséghely <small><i>(Amennyiben nem ismered, kérj segítséget a felettesedtől.)</i></small>
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
									<span class="red-500"></span>Törzsszám <small><i>(Írd be az érvényes törzsszámod és kattints az ellenőrzés gombra)</i> </small>
									<button type="button" class="btn p-1  m-0" data-bs-toggle="popover" title="Segítség" data-bs-content="A belépőkártyádon található 6 vagy 8 jegyű szám. Figyelem! A jelentkezés folytatásához az ellenőrzése kötelező">
										<i class="fa-solid fa-circle-info text-2xl"></i>
									</button>
								</label>
								<input type="number" name="ident-number" id="ident-number" class="form-control" validators='{"name": "ident-number", "required": true, "minLength": 6, "maxLength": 8}' required />

								<button id="check-ident-num" class="btn bg-violet-500 hover-bg-violet-600 text-white d-flex align-items-center justify-content-center" style="min-width: 100px;">
									Ellenőrzés
									<i class="red-500 fa-solid fa-triangle-exclamation text-xl mx-1"></i>
								</button>
							</div>
						</div>

						<div class="col-12">
							<div class="form-outline mb-4">
								<label class="form-label" for="form6Example6">
									Főcsapat kiválasztása <small><i>(Törzsszám ellenőrzése után válaszd ki a főcsapatot)</i></small>
									<button type="button" class="btn p-1  m-0" data-bs-toggle="popover" title="Segítség" data-bs-content="Kérjük, figyelmesen olvasd el az összes választható csapat nevét, melyben megtalálod a csapat színét és a csapatkapitány nevét.">
										<i class="fa-solid fa-circle-info text-2xl"></i>
									</button>
								</label>
								<select class="form-select" aria-label="Select main team" id="main-team" name="main-team" required disabled>


									<option value="" selected disabled>Válaszd ki a főcsapatot!</option>
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
									Csapat sport kiválasztása <small><i>(Főcsapat kiválasztása után válaszd ki a csapat sportot)</i> </small>
									<button type="button" class="btn p-1  m-0" data-bs-toggle="popover" title="Segítség" data-bs-content="Kérjük, figyelmesen olvasd el az összes választható sport nevét.">
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
									Páros sport kiválasztása <small><i>(Főcsapat kiválasztása után válaszd ki a páros sportot)</i> </small>
									<button type="button" class="btn p-1  m-0" data-bs-toggle="popover" title="Segítség" data-bs-content="Kérjük, figyelmesen olvasd el az összes választható sport nevét.">
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
									Jelöld meg hogy van-e párod! <small><i>(Páros sport kiválasztása után válaszd ki hogy van-e párod vagy nincs!)</i> </small>
									<button type="button" class="btn p-1 m-0" data-bs-toggle="popover" title="Segítség" data-bs-content="Kérjük, válassza ki hogy rendelkezik-e párral , ez esetben megkapja az adott sportra már regisztrált szabad felhasználók listáját, vagy jelentkezzen párnak és válassza ki hogy ki jelölheti be önt párnak.">
										<i class="fa-solid fa-circle-info text-2xl"></i>
									</button>
								</label>
								<select class="form-select" aria-label="Select pair status" id="pair-status" name="pair-status" required disabled>
									<option value="" selected>Válaszd ki a sporttársad</option>
									<option value="1">Párt választok a regisztráltak listájából.</option>
									<option value="2">Nincs párom, ezért választható párnak jelentkezem.</option>
								</select>
							</div>
						</div>

						<div class="col-12 d-none" id="choose-pair-container">
							<?php include 'app/Views/public/components/Spinner.php' ?>
							<div class="form-outline mb-4">
								<label class="form-label" for="choose-pair">
									Válaszd ki a párt az eddig jelentkezett résztvevők közül!
									<p class="bg-orange-500  p-1 text-white">Párt a már erre a csapatra regisztrált felhasználók közül választhatsz, ha nincsa listában a párod akkor egyeztessetek hogy ki regisztráljon be előbb</p>
									<button type="button" class="btn p-1 m-0" data-bs-toggle="popover" title="Segítség" data-bs-content="Kérjük, válaszd ki a párodat a résztvevők közül , a kékkel jelöltek azonnal jelölhetőek, a sárga kulcsal ellátott felhasznáók bejelöléséhez jelszó szükséges.">
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
									Ki jelölhet meg párnak? <small><i>(Ha a "Nincs párom, ezért választható párnak jelentkezem" opciót választottad, jelöld be hogy ki jelölhet be párnak)</i> </small>
									<button type="button" class="btn p-1 m-0" data-bs-toggle="popover" title="Segítség" data-bs-content="Kérjük, jelöljd be ki jelölhet be párnak, itt beállíthatod hogy bárki által jelölhető legyen a későbbiekben vagy adhat meg jelszót , amelyet a regisztrációt követően az  e-mail címedre fogunk küldeni.">
										<i class="fa-solid fa-circle-info text-2xl"></i>
									</button>
								</label>
								<select class="form-select" aria-label="Select pair eligibility" id="pair-eligibility" name="pair-eligibility" required disabled>
									<option value="" selected disabled>Jelöld be ki jelölhet be párnak!</option>
									<option value="1">Bárki megjelölhet ebben a csapatban párnak</option>
									<option value="2">Megadok egy jelszót amivel a párom majd megjelölhet</option>
								</select>
							</div>
						</div>

						<div class="col-12 d-none" id="pairing-password-container">
							<div class="form-outline mb-4">
								<label class="form-label" for="pair-eligibility">
									Jelszó megadása amivel megjelölhetnek téged párnak!
									<button type="button" class="btn p-1 m-0" data-bs-toggle="popover" title="Segítség" data-bs-content="Kérjük , adj meg jelszavót amelyel később bejelölhetnek.">
										<i class="fa-solid fa-circle-info text-2xl"></i>
									</button>
									<p class="bg-orange-500 text-white p-1 fw-bold">
										(Adj meg jelszót , ezt a jelszót a visszaigazoló e-mailben megtalálod, és oszd meg párjoddal a kiválasztott csapat nevével együtt hogy később mikor ő regisztrál bejelölhessen téged!)
									</p>
								</label>
								<div class="d-flex gap-3">
									<input name="password" type="text" id="password" class="form-control" required placeholder="Jelszó megadása.." disabled />
									<!-- <button type="button" class="btn  bg-violet-500 hover-bg-violet-600 text-white" id="pw-generator-btn">Generálás</button> -->
								</div>

							</div>
						</div>



						<div class="col-12">

							<div class="form-outline mb-4">
								<label class="form-label" for="form6Example4">
									Igényelsz transzfert?
									<button type="button" class="btn p-1  m-0" data-bs-toggle="popover" title="Segítség" data-bs-content="A Knorr-Bremse telephelyről (1238 Budapest, Helsinki út 105.) a Sport11-hez indítunk igény szerint buszjáratot. A buszok 7.00-kor indulnak a telephelyről a Sportnap helyszínére, majd 14.15-kor visszafele. Kérjük, aki igényel transzfert, pontosan érkezzen.">
										<i class="fa-solid fa-circle-info text-2xl"></i>
									</button>
								</label>
								<select class="form-select" aria-label="Default select example" name="transfer" required>
									<option value="" selected disabled>Transzferigény kiválasztása!</option>
									<?php foreach (TRANSFERS as $index => $transfer) : ?>
										<option value="<?= $index ?>">
											<?= $transfer ?>
										</option>
									<?php endforeach; ?>
								</select>
								<small class="d-block mt-2 orange-500 px-3">
									Kérünk mindenkit, használjátok a transzfer lehetőséget, a tömegközlekedést, vagy érkezzetek egy autóval többen, mert erősen korlátozott a parkolóhelyek száma. Tömegközlekedési lehetőség a helyszínre: 41-es villamos, vagy 187-es busz Kelenföldről (Őrmező felőli oldal)
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
	</div>
</div>