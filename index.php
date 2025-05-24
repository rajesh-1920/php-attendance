<?php
session_start();
require_once('classes/actions.class.php');
$actionClass = new Actions();
$page = $_GET['page'] ?? "home";
$page_title = ucwords(str_replace("_", " ", $page));
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once('inc/header.php'); ?>

<body>
    <?php include_once('inc/navigation.php'); ?>

    <div class="content-wrapper">
        <?php if (isset($_SESSION['flashdata']) && !empty($_SESSION['flashdata'])): ?>
            <div class="flashdata flashdata-<?= $_SESSION['flashdata']['type'] ?? 'default' ?>">
                <div class="flashdata-message">
                    <div><?= $_SESSION['flashdata']['msg'] ?? '' ?></div>
                    <div>
                        <a href="javascript:void(0)" onclick="this.closest('.flashdata').remove()" class="flashdata-close">[x]</a>
                    </div>
                </div>
            </div>
            <?php unset($_SESSION['flashdata']); ?>
        <?php endif; ?>
        <div class="main-wrapper">
            <?php include_once("pages/{$page}.php"); ?>
        </div>
    </div>

    <?php include_once('inc/footer.php'); ?>
</body>

</html>