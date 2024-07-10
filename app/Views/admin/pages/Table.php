<?php
$users = $params['data']['pages'];
?>

<div class="container-fluid min-h-95 d-flex p-5 my-5 align-items-start justify-content-center flex-column-reverse gap-5">
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
          <th>Pár</th>
          <th>Létrehozva</th>
          <th>Műveletek</th>

        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $user) : ?>
          <tr>
            <td>
              <div class="d-flex align-items-center">
                <!-- Assuming you have a profile image for each user, update the image source -->
                <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                <div class="ms-3">
                  <p class="fw-bold mb-1"><?= htmlspecialchars($user['name']); ?></p>
                  <!-- Display user email -->
                  <p class="text-muted mb-0"><?= htmlspecialchars($user['email']); ?></p>
                </div>
              </div>
            </td>
            <td>
              <!-- Example of job title and department -->
              <p class="fw-Nemrmal mb-1"><?= htmlspecialchars($user['ident_number']); ?></p>
              <p class="text-muted mb-0"><?= htmlspecialchars($user['class']); ?></p>
            </td>
            <td>
              <?= $user['run'] == '0' ? 'Nem' : 'Igen'; ?>
            </td>
            <td>
              <?= $user['transfer'] == '0' ? 'Nem' : 'Igen'; ?>
            </td>
            <td>
              <?= $user['vegetarian'] == '0' ? 'Nem' : 'Igen'; ?>
            </td>
            <td>
              <?= $user['actimo'] == '0' ? 'Nem' : 'Igen'; ?>
            </td>
            <td>
              <?= htmlspecialchars($user['main_teamRef_id']); ?>
            </td>
            <td>
              <?= htmlspecialchars($user['team_sportRef_id']); ?>
            </td>
            <td>
              <?= $user['duel_sportRef_id'] ? 'Igen' : 'Nem'; ?>
            </td>
            <td>
              <?php
              // Determine badge color and status text based on user status, eligibility, and password
              $status = (int) $user['pair_status'];
              $eligibility = (int) $user['pair_eligibility'];
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
                case 2:
                  if (!$pairRefId && $password === 1) {
                    $badge_color = 'bg-orange-500';
                    $status_text = 'Jelszóval várakozik';
                  }
                case 2:
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
              <?= empty($user['pair_password']) ? 'Nem' : 'Igen'; ?>
            </td>
            <td>
              <?= $user['pairRef_id'] ? 'Igen' : 'Nem'; ?>
            </td>
            <td>
              <?= htmlspecialchars($user['created_at']); ?>
            </td>
            <td>
              <div class="btn-group gap-3" role="group" aria-label="Műveletek">
                <button type="button" class="btn bg-sky-500" data-bs-toggle="modal" data-bs-target="#showUserModal-<?= $user['id'] ?>">Megtekintés</button>
                <?php require 'app/Views/admin/components/ShowUserModal.php' ?>
                <button type="button" class="btn bg-yellow-500">Frissítés</button>
                <button type="button" class="btn btn-danger">Törlés</button>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <div class="text-center mt-3">
    <?php include 'app/Views/public/components/Pagination.php'; ?>
    <a href="/admin/export-registers" class="btn btn-success">Exportálás Excel-be</a>
  </div>
</div>