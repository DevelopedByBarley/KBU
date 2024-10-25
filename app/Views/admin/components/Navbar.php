<?php
$csrf = $params['csrf'] ?? null;
$currentUrl = $_SERVER['REQUEST_URI'];
?>

<?php if (isset($_SESSION['adminId'])) : ?>
    <nav class="navbar navbar-expand-lg">
        <div class="w-100 d-flex align-items-center justify-content-between">
            <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <i class="fas fa-bars"></i>
            </button>
            <div class="w-100 d-flex justify-content-end align-items-center px-2">
                <form action="/admin/logout" method="POST">
                    <?= $csrf->generate() ?>
                    <button type="submit" class="btn btn-outline-danger">Kijelentkezés</button>
                </form>
                <div class="form-check form-switch theme-switcher p-0 mx-3">
                    <input type="checkbox" class="form-check-input checkbox text-2xl" role="switch" id="theme-toggle">
                    <label for="theme-toggle" class="dark-bg-sky-700 bg-gray-300 checkbox-label">
                        <i class="fas fa-moon"></i>
                        <i class="fas fa-sun"></i>
                        <span class="ball"></span>
                    </label>
                </div>
            </div>
        </div>
    </nav>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">
                <span>
                    <img src="/public/assets/images/avatars/<?= $params['admin']['avatar']?>.png" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                </span> <?= $params['admin']['name'] ?>
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div>
                Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists, etc.
            </div>
            <div class="dropdown mt-5">
                <ul class="list-group border-0">
                    <a href="/admin/dashboard" class="text-decoration-none">
                        <li class="list-group-item <?= $currentUrl == '/admin/dashboard' ? 'active' : '' ?> border-0 rounded-0 py-3" aria-current="true">Vezérlőpult</li>
                    </a>
                    <a href="/admin/settings" class="text-decoration-none" disabled>
                        <li class="list-group-item <?= $currentUrl == '/admin/settings' ? 'active' : '' ?> border-0 rounded-0 py-3">Beállítások</li>
                    </a>
                    <a href="/admin/table" class="text-decoration-none">
                        <li class="list-group-item <?= $currentUrl == '/admin/table' ? 'active' : '' ?> border-0 rounded-0 py-3">Regisztrációk</li>
                    </a>
                    <a href="/admin/sports" class="text-decoration-none">
                        <li class="list-group-item <?= $currentUrl == '/admin/sports' ? 'active' : '' ?> border-0 rounded-0 py-3">Sportok</li>
                    </a>
                    <a href="#" class="text-decoration-none">
                        <li class="list-group-item <?= $currentUrl == '/admin/form' ? 'active' : '' ?> border-0 rounded-0 py-3  bg-red-400">Form</li>
                    </a>
                    <a href="#" class="text-decoration-none">
                        <li class="list-group-item <?= $currentUrl == '/admin/mailbox' ? 'active' : '' ?> border-0 rounded-0 py-3 bg-red-400">Mail box</li>
                    </a>
                    <a href="#" class="text-decoration-none">
                        <li class="list-group-item <?= $currentUrl == '/admin/calendar' ? 'active' : '' ?> border-0 rounded-0 py-3  bg-red-400">Calendar</li>
                    </a>
                </ul>
            </div>
        </div>
    </div>
<?php endif ?>