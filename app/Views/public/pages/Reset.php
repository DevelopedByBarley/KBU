<?php
$token = htmlspecialchars($_GET['token'], ENT_QUOTES, 'UTF-8');
$expires = htmlspecialchars($_GET['expires'], ENT_QUOTES, 'UTF-8');
$user = $params['user'] ?? null;

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex flex-column align-items-center justify-content-center bg-gray-50 dark-bg-main-blue">
            <div class="mt-10 text-center">
                <h1 class="my-3">Regisztráció vagy pár törlése!</h1>
                <div class="mb-3">
                    <p class="bg-danger p-3 rounded-3">Figyelem ez a link csak egyszer használható fel!</p>
                </div>
            </div>
            <div class="btn-group flex-column flex-md-row gap-3">
                <a class="btn text-2xl border-gray-900 dark-border-gray-50 hover-bg-gray-900 hover-gray-50" href="/user/delete?token=<?= $token ?>&expires=<?= $expires ?>">
                    Törlöm a regisztrációmat
                </a>
                <?php if (isset($user['pairRef_id'])) : ?>
                    <a class="btn text-2xl border-gray-900 dark-border-gray-50 hover-bg-gray-900 hover-gray-50" href="/user/reset-pair?token=<?= $token ?>&expires=<?= $expires ?>">
                        Törlöm a páromat
                    </a>
                <?php endif ?>
                <?php if (isset($user['duel_sportRef_id']) && !isset($user['pairRef_id'])) : ?>
                    <button id="new-pair-select" class="btn text-2xl border-gray-900 dark-border-gray-50 hover-bg-gray-900 hover-gray-50">
                        Párt választok
                    </button>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>


<form id="reset-form" class="d-none" user-id="<?= $user['id'] ?? null ?>" pair-ref-id="<?= $user['duel_sportRef_id'] ?? null ?>" action="/user/update-pair/<?= $user['id'] ?>?token=<?= $token ?>&expires=<?= $expires ?>" method="POST">

    <div class="container">
        <div class="row">
            <div class="col-12 mt-10">
                <div class="col-12 d-none" id="new-pair-container">
                    <div class="form-outline mb-4">
                        <label class="form-label" for="choose-pair">
                            Válaszd ki a párt az eddig jelentkezett résztvevők közül!
                            <button type="button" class="btn p-1 m-0" data-bs-toggle="popover" title="Segítség" data-bs-content="Kérjük, válassza ki a párját a résztvevők közül , a kékkel jelöltek azonnal jelölhetőek, a sárga kulcsal ellátott felhasznáók bejelöléséhez jelszó szükséges.">
                                <i class="fa-solid fa-circle-info text-2xl"></i>
                            </button>
                        </label>
                        <ul class="list-group" id="choose-new-pair-list">
                            <!-- <li class="list-group-item bg-red-400">Cras justo odio</li>
									<li class="list-group-item bg-green-400">Dapibus ac facilisis in</li>
									<li class="list-group-item bg-red-400">Morbi leo risus</li>
									<li class="list-group-item bg-green-400">Porta ac consectetur ac</li>
									<li class="list-group-item bg-green-400">Vestibulum at eros</li> -->
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-12 d-none" id="choose-new-pair-container">
                <div class="form-outline mb-4">
                    <label class="form-label" for="choose-pair">
                        Válaszd ki a párt az eddig jelentkezett résztvevők közül!
                        <button type="button" class="btn p-1 m-0" data-bs-toggle="popover" title="Segítség" data-bs-content="Kérjük, válassza ki a párját a résztvevők közül , a kékkel jelöltek azonnal jelölhetőek, a sárga kulcsal ellátott felhasznáók bejelöléséhez jelszó szükséges.">
                            <i class="fa-solid fa-circle-info text-2xl"></i>
                        </button>
                    </label>
                    <input type="text" id="choose-new-pair-input" class="form-control visually-hidden" value="" name="pair-id" required disabled />
                    <ul class="list-group" id="choose-new-pair-list">
                        <!-- <li class="list-group-item bg-red-400">Cras justo odio</li>
									<li class="list-group-item bg-green-400">Dapibus ac facilisis in</li>
									<li class="list-group-item bg-red-400">Morbi leo risus</li>
									<li class="list-group-item bg-green-400">Porta ac consectetur ac</li>
									<li class="list-group-item bg-green-400">Vestibulum at eros</li> -->
                    </ul>
                </div>
            </div>
            <div class="col-12">
                <button type="submit">Elküld</button>
            </div>
        </div>
    </div>
</form>


