<?php require_once './database/connection.php' ?>
<?php require_once './partials/session.php' ?>
<?php require_once './partials/check_if_authenticated.php' ?>

<?php
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
} else {
    header('location: ./show-registrations.php');
}

$sql = "SELECT * FROM `students`";
$result = $conn->query($sql);
$students = $result->fetch_all(MYSQLI_ASSOC);

$sql = "SELECT * FROM `courses`";
$result = $conn->query($sql);
$courses = $result->fetch_all(MYSQLI_ASSOC);

$sql = "SELECT * FROM `registrations` WHERE `id` = $id";
$result = $conn->query($sql);
if ($result->num_rows === 1) {
    $registration = $result->fetch_assoc();
} else {
    header('location: ./show-registrations.php');
}

$student_id = $registration['student_id'];
$course_id = $registration['course_id'];

if (isset($_POST['submit'])) {
    $student_id = htmlspecialchars($_POST['student_id']);
    $course_id = htmlspecialchars($_POST['course_id']);

    if (empty($student_id)) {
        $error = "Please select a student!";
    } elseif (empty($course_id)) {
        $error = "Please select a course!";
    } else {
        $sql = "UPDATE `registrations` SET `student_id` = '$student_id', `course_id` = '$course_id' WHERE `id` = $id";
        $result = $conn->query($sql);
        if ($result) {
            $success = "Magic has been spelled!";
        } else {
            $error = "Magic has failed to spell!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php
$title = "Edit Registration";
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
                            <h1 class="h3">Edit Registration</h1>
                        </div>
                        <div class="col-6 text-end">
                            <a href="./show-registrations.php" class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php require_once "./partials/alerts.php" ?>
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>?id=<?php echo $id ?>" method="POST">
                                        <div class="mb-3">
                                            <label for="student_id" class="form-label">Student Name</label>
                                            <select class="form-select" id="student_id" name="student_id">
                                                <option value="">Select a student!</option>
                                                <?php
                                                foreach ($students as $student) {
                                                    if ($student['id'] === $student_id) { ?>
                                                        <option value="<?php echo $student['id'] ?>" selected><?php echo $student['name'] ?></option>
                                                    <?php
                                                    } else { ?>
                                                        <option value="<?php echo $student['id'] ?>"><?php echo $student['name'] ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="course_id" class="form-label">Course Name</label>
                                            <select class="form-select" id="course_id" name="course_id">
                                                <option value="">Select a course!</option>
                                                <?php
                                                foreach ($courses as $course) {
                                                    if ($course['id'] === $course_id) { ?>
                                                        <option value="<?php echo $course['id'] ?>" selected><?php echo $course['name'] ?></option>
                                                    <?php
                                                    } else { ?>
                                                        <option value="<?php echo $course['id'] ?>"><?php echo $course['name'] ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
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
        const registrationsMenuElement = document.querySelector("#registrations-menu");
        registrationsMenuElement.classList.add("active");
    </script>

</body>

</html>