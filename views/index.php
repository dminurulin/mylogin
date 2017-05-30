<?php require 'views/templates/header.php'; ?>

<?php

if (isset($_SESSION['id'])) {
    $userid = $_SESSION['id'];
    // echo "Ваш ID : $userid";
    $username = $_SESSION['username'];
    $fio = $_SESSION['fio'];
    require 'views/forms/edit_form.php';
    require 'views/forms/logout_form.php';
    require 'views/templates/footer.php';
} else {
    require 'views/templates/menu.php';
    require 'views/templates/footer.php';
}
?>


