<?php
$token = htmlspecialchars($_GET['token'], ENT_QUOTES, 'UTF-8');
$expires = htmlspecialchars($_GET['expires'], ENT_QUOTES, 'UTF-8');
$user = $params['user'] ?? null;

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 h-90 d-flex flex-column align-items-center justify-content-center bg-gray-50 dark-bg-main-blue">
            <div class="my-3 text-center">
                <h1 class="my-3">Regisztráció vagy pár törlése!</h1>
                <div class="mb-3">
                    <p class="bg-danger p-3 rounded-3">Figyelem ez a link csak egyszer használható fel!</p>
                </div>
            </div>
            <div class="btn-group flex-column flex-md-row gap-3">
                <a class="btn text-2xl border-gray-900 dark-border-gray-50 hover-bg-gray-900 hover-gray-50" href="/user/delete?token=<?= $token ?>&expires=<?= $expires ?>">
                    Törlöm a regisztrációmat
                </a>
                <?php if ($user['pairRef_id']) : ?>
                    <a class="btn text-2xl border-gray-900 dark-border-gray-50 hover-bg-gray-900 hover-gray-50" href="/user/reset-pair?token=<?= $token ?>&expires=<?= $expires ?>">
                        Törlöm a páromat
                    </a>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>