<?php

$users = $params['data']['pages'];
$main_teams = $params['main_teams'] ?? [];
$team_sports = $params['team_sports'] ?? [];
$duel_sports = $params['duel_sports'] ?? [];
$csrf = $params['csrf'] ?? null;


function find_team_by_id($teams, $id)
{
  foreach ($teams as $team) {
    if ($team['id'] == $id) {
      return $team;
    }
  }
  return null;
}

?>

<?php if (count($users) === 0) : ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 min-h-95 d-flex align-items-center justify-content-center">
        <h2>

          Jelenleg nincs egyetlen regisztráció sem
        </h2>
      </div>
    </div>
  </div>
  <?php return; ?>
<?php endif ?>


<div class="container-fluid min-h-95 d-flex p-5 my-5 align-items-start justify-content-center flex-column-reverse gap-5">
  <div class="row w-100">
    <div class="col-12">
      <div class="table-responsive min-h-700 w-100">
        <table class="table align-middle mb-0 rounded rounded-lg shadow">
          <thead class="bg-teal-500">
            <tr>
              <th>Név</th>
              <th>Törzsszám és osztály</th>
              <th>Futás</th>
              <th>Transzfer</th>
              <th>Vegetáriánus</th>
              <th>Actimo</th>
              <th>Fő csapat</th>
              <th>Csapat sport</th>
              <th>Páros sport</th>
              <th>Pár státusz</th>
              <th>Van jelszava?</th>
              <th>Van párja?</th>
              <th>Regisztrált</th>
              <th>Műveletek</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users as $user) : ?>
              <tr>
                <td>
                  <div class="d-flex align-items-center">
                    <img src="/public/assets/images/avatars/<?= AVATARS[array_rand(AVATARS)]; ?>.png" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                    <div class="ms-3">
                      <p class="fw-bold mb-1"><?= htmlspecialchars($user['name']); ?></p>
                      <p class="text-muted mb-0"><?= htmlspecialchars($user['email']); ?></p>
                    </div>
                  </div>
                </td>
                <td>
                  <p class="fw-Nemrmal mb-1"><?= htmlspecialchars($user['ident_number']); ?></p>
                  <p class="text-muted mb-0"><?= htmlspecialchars($user['class']); ?></p>
                </td>
                <td>
                  <?= $user['run'] == '0' ? '<i class="fa-solid fa-xmark"></i>' : '<i class="fa-solid fa-thumbs-up"></i>'; ?>
                </td>
                <td>
                  <?= $user['transfer'] == '0' ? '<i class="fa-solid fa-xmark"></i>' : '<i class="fa-solid fa-thumbs-up"></i>'; ?>
                </td>
                <td>
                  <?= $user['vegetarian'] == '0' ? '<i class="fa-solid fa-xmark"></i>' : '<i class="fa-solid fa-thumbs-up"></i>'; ?>
                </td>
                <td>
                  <?= $user['actimo'] == '0' ? '<i class="fa-solid fa-xmark"></i>' : '<i class="fa-solid fa-thumbs-up"></i>'; ?>
                </td>
                <td>
                  <div class="py-0 px-5 rounded-3 text-white text-center bg-<?= find_team_by_id($main_teams, (int)$user['main_teamRef_id'])['color'] ?? '' ?>">
                    <p> <?= find_team_by_id($main_teams, (int)$user['main_teamRef_id'])['leader'] ?? 'Nem jelentkezett' ?></p>
                  </div>
                </td>
                <td>
                  <?= find_team_by_id($team_sports, (int)$user['team_sportRef_id'])['name'] ?? 'Nem jelentkezett' ?>
                </td>
                <td>
                  <?= find_team_by_id($duel_sports, (int)$user['duel_sportRef_id'])['name'] ?? 'Nem jelentkezett' ?>
                </td>
                <td>
                  <?php
                  $status = (int)$user['pair_status'];
                  $eligibility = (int)$user['pair_eligibility'];
                  $password = empty($user['pair_password']) ? 0 : 1;
                  $pairRefId = $user['pairRef_id'];
                  $badge_color = '';
                  $status_text = '';

                  switch ($status) {
                    case 1:
                      if ($pairRefId) {
                        $badge_color = 'bg-teal-500';
                        $status_text = 'Van párja';
                      }
                      break;
                    case 2:
                      if ($pairRefId) {
                        $badge_color = 'bg-teal-500';
                        $status_text = 'Van párja';
                      }
                      if (!$pairRefId && $password === 1) {
                        $badge_color = 'bg-orange-500';
                        $status_text = 'Jelszóval várakozik';
                      }
                      if (!$pairRefId && $password === 0) {
                        $badge_color = 'bg-purple-500';
                        $status_text = 'Jelszó nélkül várakozik';
                      }
                      break;
                    default:
                      $badge_color = 'bg-gray-500';
                      $status_text = 'Nem jelentkezett';
                  }
                  ?>
                  <span class="badge <?= $badge_color; ?> rounded-pill d-inline"><?= htmlspecialchars($status_text); ?></span>
                </td>
                <td>
                  <?= !empty($user['pair_password']) ? '<i class="fa-solid fa-thumbs-up"></i>' : '<i class="fa-solid fa-xmark"></i>'; ?>
                </td>
                <td>
                  <?= $user['pairRef_id'] ? '<i class="fa-solid fa-thumbs-up"></i>' : '<i class="fa-solid fa-xmark"></i>'; ?>
                </td>
                <td>
                  <?= htmlspecialchars($user['created_at']); ?>
                </td>
                <td class="min-w-500">
                  <div class="d-flex gap-2">
                    <button type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#showUserModal-<?= $user['id'] ?>">Megtekintés</button>
                    <?php require 'app/Views/admin/components/ShowUserModal.php' ?>
                    <button type="button" class="btn text-white btn-warning" data-bs-toggle="modal" data-bs-target="#updateUserModal-<?= $user['id'] ?>">Frissítés</button>
                    <?php require 'app/Views/admin/components/UpdateUserModal.php' ?>
                    <button type=" button" class="btn text-white btn-danger" data-bs-toggle="modal" data-bs-target="#deleteUserModal-<?= $user['id'] ?>">Törlés</button>
                    <?php require 'app/Views/admin/components/DeleteUserModal.php' ?>
                    <button type=" button" class="btn text-white bg-violet-500 hover-bg-violet-600">Token küldése</button>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="text-center mt-3">
    <?php include 'app/Views/public/components/Pagination.php'; ?>
    <a href="/admin/export-registers" class="btn btn-success">Exportálás Excel-be</a>
  </div>
</div>