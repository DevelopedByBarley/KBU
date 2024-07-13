


<div class="modal fade" id="addMainTeamModal" tabindex="-1" aria-labelledby="addMainTeamModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/main-teams" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMainTeamModalLabel">Új fő csapat hozzáadása</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Név</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3 form-outline">
                        <label for="color" class="form-label">Szín</label>
                        <div>
                            <?php foreach ($params['availableTeams'] as $key => $value) : ?>
                                <input type="radio" id="<?= $key ?>" name="color" value="<?= $key ?>" class="radio-input">
                                <label for="<?= $key ?>" class="radio-label"><?= $value['symbol'] ?></label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="max" class="form-label">Maximum férőhely</label>
                        <input type="number" class="form-control" id="max" name="max" required>
                    </div>
                    <div class="mb-3">
                        <label for="leader" class="form-label">Csapat kapitány</label>
                        <input type="text" class="form-control" id="leader" name="leader" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>