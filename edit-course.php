<?php require_once './database/connection.php' ?>
<?php require_once './partials/session.php' ?>
<?php require_once './partials/check_if_authenticated.php' ?>

<?php
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
} else {
    header('location: ./show-courses.php');
}

$sql = "SELECT * FROM `courses` WHERE `id` = $id";
$result = $conn->query($sql);
if ($result->num_rows === 1) {
    $course = $result->fetch_assoc();
} else {
    header('location: ./show-courses.php');
}

$name = $course['name'];
$duration = $course['duration'];

if (isset($_POST['submit'])) {
    $name = htmlspecialchars($_POST['name']);
    $duration = htmlspecialchars($_POST['duration']);

    if (empty($name)) {
        $error = "Enter the course name!";
    } elseif (empty($duration)) {
        $error = "Enter the course duration!";
    } else {
        $sql = "UPDATE `courses` SET `name` = '$name',`duration` = '$duration' WHERE `id` = $id";
        $result = $conn->query($sql);
        if ($result) {
            $success = "Magic has been spelled!";
        } else {
            $success = "Magic has failed to spell!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php
$title = "Edit Course";
require_once './partials/head.php';
?>

<body>
    <div class="wrapper">
        <?php require_once './partials/sidebar.php' ?>

        <div class="main">
            <?php require_once './partials/topbar.php' ?>

            <main class="content">
                <div class="container-fluid p-0">
                    <div class="row mb-3">
                        <div class="col-6">
                            <h1 class="h3">Edit Course</h1>
                        </div>
                        <div class="col-6 text-end">
                            <a href="./show-courses.php" class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php require_once "./partials/alerts.php" ?>
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>?id=<?php echo $id ?>" method="POST">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Course Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter the course name!" value="<?php echo $name ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="duration" class="form-label">Course Duration</label>
                                            <input type="text" class="form-control" id="duration" name="duration" placeholder="Enter the course duration!" value="<?php echo $duration ?>">
                                        </div>

                                        <div>
                                            <input type="submit" class="btn btn-primary" name="submit">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <?php require_once './partials/footer.php' ?>
        </div>
    </div>

    <script src="./assets/js/app.js"></script>
    <script>
        const coursesMenuElement = document.querySelector("#courses-menu");
        coursesMenuElement.classList.add("active");
    </script>

</body>

</html>