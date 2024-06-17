<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="/public/css/index.css?v=<?= time() ?>">
    <title><?php echo APP_NAME; ?></title>
</head>

<body>
    <?php include 'app/Views/public/components/Navbar.php'; ?>
    <?php include 'app/Views/public/components/Alert.php'; ?>

    <?php if (COOKIE_MODAL_PERM) : ?>
        <?php include 'app/Views/public/components/Cookie.php'; ?>
    <?php endif; ?>

    <?= $params["content"]; ?>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="module" src="/public/js/register.js?v=<?= time(); ?>"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="/public/bootstrap/js/bootstrap.bundle.js"></script>

    <script type="module" src="/public/js/uuid.js?v=<?= time(); ?>"></script>
    <script type="module" src="/public/js/getCookie.js?v=<?= time(); ?>"></script>
    <script src="/public/js/colorTheme.js?v=<?= time(); ?>"></script>

    <?php if (VALIDATORS_PERM) : ?><script type="module" src="/public/js/validators.js?v=<?= time(); ?>"></script><?php endif; ?>
    <?php if (TOAST_PERM) : ?> <?php include 'app/Views/public/components/Toast.php'; ?><script src="/public/js/toast.js?v=<?= time(); ?>"></script><?php endif; ?>
    <?php if (IMG_LOADER_PERM) : ?><script src="/public/js/imgLoader.js?v=<?= time(); ?>"></script><?php endif; ?>
    <?php if (SKELETON_PERM) : ?><?php include 'app/Views/templates/skeletons/card.skeleton.php'; ?><script src="/public/js/skeleton.js?v=<?= time(); ?>"></script><?php endif; ?>


</body>

</html>