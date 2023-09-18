<?php require_once './database/connection.php' ?>
<?php require_once './partials/session.php' ?>
<?php require_once './partials/check_if_authenticated.php' ?>

<?php
$name = $email = "";

if (isset($_POST['submit'])) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);

    if (empty($name)) {
        $error = "Enter the student name!";
    } elseif (empty($email)) {
        $error = "Enter the student email!";
    } else {
        $sql = "SELECT * FROM `students` WHERE `email` = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows === 0) {
            $sql = "INSERT INTO `students`(`name`, `email`) VALUES ('$name', '$email')";
            $result = $conn->query($sql);
            if ($result) {
                $success = "Magic has been spelled!";
                $name = $email = "";
            } else {
                $error = "Magic has failed to spell!";
            }
        } else {
            $error = "Email already exists!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php
$title = "Add Student";
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
                            <h1 class="h3">Add Student</h1>
                        </div>
                        <div class="col-6 text-end">
                            <a href="./show-students.php" class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php require_once "./partials/alerts.php" ?>
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Student Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter the student name!" value="<?php echo $name ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Student Email</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter the student email!" value="<?php echo $email ?>">
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
        const studentsMenuElement = document.querySelector("#students-menu");
        studentsMenuElement.classList.add("active");
    </script>

</body>

</html>