<div class="modal fade" id="updateUserModal-<?= $user['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white bg-warning">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Regisztráció frissítése (FEJLESZTÉS ALATT)</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <div class="my-3 text-center">
                        <i class="fa-solid fa-triangle-exclamation text-2xl"></i>
                    </div>
                    <p>
                        Ha a profil rendelkezik párral, akkor frissítése esetén a hozzá tartozó pár kapcsolat törlésre kerül!
                        <br>
                        Ilyen esetben ez ehhez a profilhoz tartozó pár marad a sportjában és elérhetővé válik mindenki számára.
                    </p>
                </div>
                <form method="POST" enctype="multipart/form-data" action="/admin/update">
                    <?= $csrf->generate() ?>
                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                    
                    <div class="form-group my-2">
                        <label for="name">Név</label>
                        <input name="name" type="text" value="<?= $user['name'] ?>" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Adja meg a nevét" required>
                    </div>
                    
                    <div class="form-outline mt-4">
                        <label class="form-label" for="main-team">Fő csapat kiválasztása</label>
                        <select class="form-select" aria-label="Fő csapat kiválasztása" id="main-team" name="main-team" required>
                            <option value="" disabled>Válassza ki a főcsapatot</option>
                            <option value="0" <?= $user['main_teamRef_id'] == 0 ? 'selected' : '' ?>>Nem jelentkezem</option>
                            <?php foreach ($main_teams as $team) : ?>
                                <?php
                                $free_spots = $team['max'];
                                $team_name = htmlspecialchars($team['name']);
                                $team_color = htmlspecialchars($team['color']);
                                $team_leader = htmlspecialchars($team['leader']);
                                $team_id = htmlspecialchars($team['id']);
                                $color_emoji = htmlspecialchars($team['color_emoji']);
                                ?>
                                <option <?= $user['main_teamRef_id'] == $team_id ? 'selected' : '' ?> value="<?= $team_id ?>" <?= $free_spots > 0 ? '' : 'disabled' ?>>
                                    <?= $team_leader ?> - <?= $team_name ?> (<?= $free_spots ?> szabad hely) <?= $color_emoji ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-outline mt-4">
                        <label class="form-label" for="team-sport">Csapat sport kiválasztása</label>
                        <select class="form-select" aria-label="Csapat sport kiválasztása" id="team-sport" name="team-sport" required>
                            <option value="" disabled>Válassza ki a csapat sportot</option>
                            <option value="0" <?= $user['team_sportRef_id'] == 0 ? 'selected' : '' ?>>Nem jelentkezem</option>
                            <?php foreach ($team_sports as $sport) : ?>
                                <?php
                                $sport_name = htmlspecialchars($sport['name']);
                                $sport_id = htmlspecialchars($sport['id']);
                                $free_spots = $sport['max'];
                                foreach ($users as $u) {
                                    if ((int)$u['team_sportRef_id'] === (int)$sport['id']) {
                                        $free_spots--;
                                    }
                                }
                                ?>
                                <option <?= $user['team_sportRef_id'] == $sport_id ? 'selected' : '' ?> value="<?= $sport_id ?>" <?= $free_spots > 0 ? '' : 'disabled' ?>>
                                    <?= $sport_name ?> - (<?= $free_spots ?> szabad hely)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-outline mt-4">
                        <label class="form-label" for="duel-sport">Páros sport kiválasztása</label>
                        <select class="form-select" aria-label="Páros sport kiválasztása" id="duel-sport" name="duel-sport" required>
                            <option value="" disabled>Válassza ki a páros sportot</option>
                            <option value="0" <?= $user['duel_sportRef_id'] == 0 ? 'selected' : '' ?>>Nem jelentkezem</option>
                            <?php foreach ($duel_sports as $sport) : ?>
                                <?php
                                $sport_name = htmlspecialchars($sport['name']);
                                $sport_id = htmlspecialchars($sport['id']);
                                $free_spots = $sport['max'];
                                foreach ($users as $u) {
                                    if ((int)$u['duel_sportRef_id'] === (int)$sport['id']) {
                                        $free_spots--;
                                    }
                                }
                                ?>
                                <option <?= $user['duel_sportRef_id'] == $sport_id ? 'selected' : '' ?> value="<?= $sport_id ?>" <?= $free_spots > 0 ? '' : 'disabled' ?>>
                                    <?= $sport_name ?> - (<?= $free_spots ?> szabad hely)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-check mt-3 mb-4">
                        <input type="checkbox" class="form-check-input" id="chess" name="chess" value="1" <?= $user['chess'] == 1 ? 'checked' : '' ?>>
                        <label class="form-check-label" for="chess">Sakk</label>
                    </div>
                    
                    <div class="form-check mt-3 mb-4">
                        <input type="checkbox" class="form-check-input" id="run" name="run" value="1" <?= $user['run'] == 1 ? 'checked' : '' ?>>
                        <label class="form-check-label" for="run">Futás</label>
                    </div>
                    
                    <div class="form-check mt-3 mb-4">
                        <input type="checkbox" class="form-check-input" id="transfer" name="transfer" value="1" <?= $user['transfer'] == 1 ? 'checked' : '' ?>>
                        <label class="form-check-label" for="transfer">Transzfer</label>
                    </div>
                    
                    <div class="form-check mt-3 mb-4">
                        <input type="checkbox" class="form-check-input" id="vegetarian" name="vegetarian" value="1" <?= $user['vegetarian'] == 1 ? 'checked' : '' ?>>
                        <label class="form-check-label" for="vegetarian">Vegetáriánus</label>
                    </div>
                    
                    <div class="form-outline mt-4">
                        <label class="form-label" for="pair-status">Páros státusz</label>
                        <select class="form-select" aria-label="Páros státusz" id="pair-status" name="pair-status" required>
                            <option value="0" <?= $user['pair_status'] == 0 ? 'selected' : '' ?>>Nincs páros</option>
                            <option value="1" <?= $user['pair_status'] == 1 ? 'selected' : '' ?>>Keres párost</option>
                            <option value="2" <?= $user['pair_status'] == 2 ? 'selected' : '' ?>>Párosban van</option>
                        </select>
                    </div>
                    <div class="border p-2 py-3 my-4 rounded-4">
                        
                        <div class="form-check mt-3 mb-4">
                            <input type="checkbox" class="form-check-input" id="pair-eligibility" name="pair-eligibility" value="1" <?= $user['pair_eligibility'] == 1 ? 'checked' : '' ?>>
                            <label class="form-check-label" for="pair-eligibility">Páros eligibilitás</label>
                        </div>
                        
                        <div class="form-outline mt-4">
                            <label class="form-label" for="pair-password">Páros jelszó</label>
                            <input name="pair-password" type="text" class="form-control" id="pair-password" aria-describedby="pair-passwordHelp" placeholder="Adja meg a páros jelszót" value="<?= $user['pair_password'] ?>">
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning text-white">Frissítés</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezárás</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
