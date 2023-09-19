<?php require_once './database/connection.php' ?>
<?php require_once './partials/session.php' ?>
<?php require_once './partials/check_if_authenticated.php' ?>

<?php
$sql = "SELECT `s`.`name` AS `student_name`, `c`.`name` AS `course_name`, `r`.`id` AS `id`, `r`.`created_at` AS `created_at`
FROM `students` AS `s`
JOIN `registrations` AS `r`
ON `s`.`id` = `r`.`student_id`
JOIN `courses` AS `c`
ON `r`.`course_id` = `c`.`id`";
$result = $conn->query($sql);
$registrations = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<?php
$title = "Registrations";
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
                            <h1 class="h3">Registrations</h1>
                        </div>
                        <div class="col-6 text-end">
                            <a href="./add-registration.php" class="btn btn-outline-primary">Add Registration</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php require_once "./partials/alerts.php" ?>
                                    <?php
                                    if ($result->num_rows > 0) { ?>
                                        <table class="table table-bordered m-0">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Student Name</th>
                                                    <th>Course Name</th>
                                                    <th>Created at</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                $sr = 1;
                                                foreach ($registrations as $registration) { ?>
                                                    <tr>
                                                        <td><?php echo $sr++; ?></td>
                                                        <td><?php echo $registration['student_name'] ?></td>
                                                        <td><?php echo $registration['course_name'] ?></td>
                                                        <td><?php echo date("d-M-Y", strtotime($registration['created_at'])); ?></td>
                                                        <td>
                                                            <a href="./edit-registration.php?id=<?php echo $registration['id'] ?>" class="btn btn-primary">Edit</a>
                                                            <a href="./delete-registration.php?id=<?php echo $registration['id'] ?>" class="btn btn-danger">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    <?php
                                    } else { ?>
                                        <div class="alert alert-info m-0">No record found!</div>
                                    <?php
                                    }
                                    ?>
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