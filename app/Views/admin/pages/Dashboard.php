<?php $csrf = $params['csrf'] ?? null ?>


<h1>Dashboard</h1>
<form action="/admin/logout" method="POST">
  <?= $csrf->generate() ?>
  <button type="submit">Logout</button>
</form>