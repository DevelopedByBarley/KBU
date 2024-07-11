<div class="modal fade" id="deleteUserModal-<?= $user['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Admin Törlése</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-column align-items-center text-center p-3 pt-5">
                    <img class="rounded-circle mt-5" width="150px" src="/public/assets/images/avatars/user.png">
                    <div class="mt-2">
                        <span class="fw-bold text-xl"><?= $user['name'] ?></span>
                    </div>
                    <span><?= $user['email'] ?></span>
                    <div class="mt-1 badge bg-sky-500 p-2 mt-2">
                        (<?= $user['created_at'] ?>)
                    </div>
                </div>
                <div class="alert alert-danger text-center mt-4">
                    Biztosan törölni szeretnéd ezt a usert? Ez a művelet nem visszavonható.
                </div>
            </div>
            <div class="modal-footer">
                <form method="POST" action="/admin/delete-user/<?= $user['id'] ?>">
                    <?= $csrf->generate() ?>
                    <button type="submit" class="btn btn-danger">Törlés</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezár</button>
            </div>
        </div>
    </div>
</div>