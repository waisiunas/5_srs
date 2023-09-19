<?php require_once './database/connection.php' ?>
<?php require_once './partials/session.php' ?>
<?php require_once './partials/check_if_authenticated.php' ?>

<?php
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
} else {
    header('location: ./show-registrations.php');
}

$sql = "SELECT * FROM `registrations` WHERE `id` = $id";
$result = $conn->query($sql);
if ($result->num_rows === 1) {
    $sql = "DELETE FROM `registrations` WHERE `id` = $id";
    $result = $conn->query($sql);
    if ($result) {
        $_SESSION['success'] = "Magic has been spelled!";
    } else {
        $_SESSION['error'] = "Magic has failed to spell!";
    }
    header('location: ./show-registrations.php');
} else {
    header('location: ./show-registrations.php');
}
?>