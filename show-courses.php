<?php require_once './database/connection.php' ?>
<?php require_once './partials/session.php' ?>
<?php require_once './partials/check_if_authenticated.php' ?>

<?php
$sql = "SELECT * FROM `courses`";
$result = $conn->query($sql);
$courses = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<?php
$title = "Courses";
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
							<h1 class="h3">Courses</h1>
						</div>
						<div class="col-6 text-end">
							<a href="./add-course.php" class="btn btn-outline-primary">Add Course</a>
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
													<th>Course Name</th>
													<th>Course Duration</th>
													<th>Created at</th>
													<th>Action</th>
												</tr>
											</thead>

											<tbody>
												<?php
												$sr = 1;
												foreach ($courses as $course) { ?>
													<tr>
														<td><?php echo $sr++; ?></td>
														<td><?php echo $course['name'] ?></td>
														<td><?php echo $course['duration'] ?></td>
														<td><?php echo date("d-M-Y", strtotime($course['created_at'])); ?></td>
														<td>
															<a href="./edit-course.php?id=<?php echo $course['id'] ?>" class="btn btn-primary">Edit</a>
															<a href="./delete-course.php?id=<?php echo $course['id'] ?>" class="btn btn-danger">Delete</a>
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
		const coursesMenuElement = document.querySelector("#courses-menu");
		coursesMenuElement.classList.add("active");
	</script>

</body>

</html>