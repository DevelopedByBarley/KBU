<?php $main_teams = $params['main_teams'] ?? [] ?>



<div class="modal fade" id="addTeamSportModal" tabindex="-1" aria-labelledby="addTeamSportModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="/team-sports" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="addTeamSportModalLabel">Új csapatsport hozzáadása</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label for="name" class="form-label">Név</label>
            <input type="text" class="form-control" id="name" name="name" required  validators='{"name": "name", "required": true, "minLength":  3}'>
          </div>
          <div class="mb-3 form-outline">
            <label for="color" class="form-label">Szín</label>
            <select class="form-select" aria-label="Select main team" id="main-team" name="main-team" required>
              <option value="" selected disabled>Válassza ki a főcsapatot</option>
              <option value="0">Nem jelentkezem</option>
              <?php foreach ($main_teams as $team) : ?>
                <?php
                $free_spots = $team['max'];
                $team_name = htmlspecialchars($team['name']);
                $team_color = htmlspecialchars($team['color']);
                $team_leader = htmlspecialchars($team['leader']);
                $team_id = htmlspecialchars($team['id']);
                $color_emoji = htmlspecialchars($team['color_emoji']);
                ?>


                <option value="color=<?= $team_color ?>;id=<?= $team_id ?>" <?= $free_spots > 0 ? '' : 'disabled' ?>>
                  <?= $team_leader ?> - <?= $team_name ?> (<?= $free_spots ?> szabad hely) <?= $color_emoji ?>
                </option>
              <?php endforeach; ?>


            </select>
          </div>
          <div class="mb-3">
            <label for="max" class="form-label">Maximum férőhely</label>
            <input type="number" class="form-control" id="max" name="max"  min="1" max="100" required>
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