<?php require_once './partials/session.php' ?>
<?php require_once './partials/check_if_authenticated.php' ?>

<!DOCTYPE html>
<html lang="en">

<?php
$title = "Template";
require_once './partials/head.php';
?>

<body>
    <div class="wrapper">
        <?php require_once './partials/sidebar.php' ?>

        <div class="main">
            <?php require_once './partials/topbar.php' ?>

            <main class="content">
                <div class="container-fluid p-0">
                    <h1 class="h3 mb-3">Heading</h1>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    Content
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
        const templateMenuElement = document.querySelector("#template-menu");
        templateMenuElement.classList.add("active");
    </script>

</body>

</html>