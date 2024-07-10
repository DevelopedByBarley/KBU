<div class="modal fade" id="showUserModal-<?= $user['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white bg-sky-500">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">User Profil</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-column align-items-center text-center p-3 mb-3">
                    <img class="rounded-circle mt-5 mb-3" width="150px" src="/public/assets/images/avatars/<?= $user['avatar'] ?? 'user' ?>.png">
                    <div class="mt-2"><span class="fw-bold text-xl"><?= $user['name'] ?></span></div>
                    <span><?= $user['email'] ?></span>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-6 text-center my-3 text-center">
                            <h5>Azonosító</h5>
                            <p><?= $user['ident_number'] ?></p>
                        </div>
                        <div class="col-6 text-center my-3 text-center">
                            <h5>Csapat ID</h5>
                            <p><?= $user['main_teamRef_id'] ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 text-center my-3 text-center">
                            <h5>Sport Csapat ID</h5>
                            <p><?= $user['team_sportRef_id'] ?></p>
                        </div>
                        <div class="col-6 text-center my-3 text-center">
                            <h5>Duel Sport ID</h5>
                            <p><?= $user['duel_sportRef_id'] ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 text-center my-3 text-center">
                            <h5>Sakk</h5>
                            <p><?= $user['chess'] == 1 ? 'Igen' : 'Nem' ?></p>
                        </div>
                        <div class="col-6 text-center my-3 text-center">
                            <h5>Futás</h5>
                            <p><?= $user['run'] == 1 ? 'Igen' : 'Nem' ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 text-center my-3 text-center">
                            <h5>Áthelyezés</h5>
                            <p><?= $user['transfer'] == 1 ? 'Igen' : 'Nem' ?></p>
                        </div>
                        <div class="col-6 text-center my-3 text-center">
                            <h5>Vegetáriánus</h5>
                            <p><?= $user['vegetarian'] == 1 ? 'Igen' : 'Nem' ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 text-center my-3 text-center">
                            <h5>Actimo</h5>
                            <p><?= $user['actimo'] == 1 ? 'Igen' : 'Nem' ?></p>
                        </div>
                        <div class="col-6 text-center my-3 text-center">
                            <h5>Páros státusz</h5>
                            <p><?= $user['pair_status'] ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 text-center my-3 text-center">
                            <h5>Páros jogosultság</h5>
                            <p><?= $user['pair_eligibility'] ?></p>
                        </div>
                        <div class="col-6 text-center my-3 text-center">
                            <h5>Páros azonosító</h5>
                            <p><?= $user['pairRef_id'] ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 text-center my-3 text-center">
                            <h5>Létrehozás dátuma</h5>
                            <p><?= $user['created_at'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezár</button>
            </div>
        </div>
    </div>
</div>
