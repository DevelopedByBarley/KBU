<?php $main_teams = $params['data']['pages'] ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-9 col-lg-4 offset-1">
            <h1 class="mt-10">Fő csapatok</h1>
            <!-- Button to open the modal -->
            <button type="button" class="btn bg-sky-500 mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Csapat hozzáadása
            </button>

            <?php include 'app/Views/admin/components/AddMainTeamModal.php' ?>
        </div>
    </div>




    <div class="row">
        <div class="col-12">
            <div class="d-flex p-5 my-5 align-items-start justify-content-center flex-column gap-3 table-responsive">
                <table class="table align-middle mb-0 rounded shadow">
                    <thead class="bg-teal-500">
                        <tr>
                            <th>ID</th>
                            <th>Szín</th>
                            <th>Név</th>
                            <th>Max</th>
                            <th>Vezető</th>
                            <th>Létrehozva</th>
                            <th>Műveletek</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($main_teams as $team) : ?>
                            <tr>
                                <td><?= htmlspecialchars($team['id']) ?></td>
                                <td><?= htmlspecialchars($team['color_emoji']) ?></td>
                                <td><?= htmlspecialchars($team['name']) ?></td>
                                <td><?= htmlspecialchars($team['max']) ?></td>
                                <td><?= htmlspecialchars($team['leader']) ?></td>
                                <td><?= htmlspecialchars($team['created_at']) ?></td>
                                <td>
                                    <div class="btn-group gap-2">
                                        <button type="button" class="btn btn-rounded btn-sm fw-bold bg-sky-500 text-white" data-bs-toggle="modal" data-bs-target="#showTeamModal-<?= $team['id'] ?>">Show</button>
                                        <button type="button" class="btn btn-rounded btn-sm fw-bold bg-yellow-500 text-white" data-bs-toggle="modal" data-bs-target="#updateTeamModal-<?= $team['id'] ?>">Edit</button>
                                        <button type="button" class="btn btn-rounded btn-sm fw-bold bg-red-500 text-white" data-bs-toggle="modal" data-bs-target="#deleteTeamModal-<?= $team['id'] ?>">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <?php include 'app/Views/public/components/Pagination.php' ?>
                </table>
            </div>
        </div>
    </div>

</div>