<?php
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['user_master_id'])) {
    $page_title = "create";
    $Dashboard = "ADMIN";
    $Department = "DEPARTMENT";
    $Employee = "EMPLOYEE";
    $Dashboard_link = "admin/admin-dashboard.php";
    $Department_link = "department/create_dept.php";
    $All_Employee = "ALL EMPLOYEES";
    $My_Team = "MY TEAM";
    $AllEmployee_link = "allEmployee.php";
    $MyTeam_link = "admin_myteam.php";
    $Parameter = "PARAMETER";
    $Parameter_link = "../parameter/view_para.php";
    //include "../master/db_conn.php";
    include "../master/pre-header.php";
    include "../master/header.php";
    include "../master/navbar_admin.php";
    include "../master/breadcrumbs.php";
    include "../master/db_conn.php";
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Enlink - user-login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- Favicon -->
        <link rel="shortcut icon" href="assets/images/logo/favicon.png">

        <!-- page css -->

        <!-- Core css -->
        <link href="assets/css/app.min.css" rel="stylesheet">

    </head>

    <body>
        <div class="app">
            <div class="container-fluid p-h-0 p-v-20 bg full-height d-flex" style="background-image: url('assets/images/others/login-3.png')">
                <div class="d-flex flex-column justify-content-between w-100">
                    <div class="container d-flex h-100">
                        <div class="row align-items-center w-100">
                            <div class="col-md-7 col-lg-5 m-h-auto">
                                <div class="card shadow-lg">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between m-b-30">
                                            <img class="img-fluid" alt="" src="assets/images/logo/logo.png">
                                            <h2 class="m-b-0">$form_id</h2>
                                        </div>
                                        <form action="insert.php" method="POST">
                                            <?php if (isset($_GET['error'])) { ?>
                                                <div class="alert alert-danger" role="alert">
                                                    <?= $_GET['error'] ?>
                                                </div>
                                            <?php } ?>
                                            <div class="form-group">
                                                <label class="font-weight-semibold" for="title">Task Title:</label>
                                                <div class="input-affix">
                                                    <i class="prefix-icon anticon anticon-user"></i>
                                                    <input type="text" class="form-control" id="title" name="title" placeholder="task_title">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="font-weight-semibold" for="desc">Task Description:</label>
                                                <div class="input-affix">
                                                    <i class="prefix-icon anticon anticon-user"></i>
                                                    <input type="text" class="form-control" id="desc" name="desc" placeholder="task_desc">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1" for="para">Parameter</label>
                                                <select class="form-control" id="para" name="para">
                                                    <option value="" disabled selected hidden>Please Select</option>
                                                    <?php
                                                    $sql = "SELECT para_id,para_title FROM para_master WHERE is_deleted = 0 ORDER BY para_id ASC ";
                                                    $result = mysqli_query($conn, $sql);
                                                    while ($row = $result->fetch_assoc()) :
                                                    ?>
                                                        <option value="<?php echo $row['para_id']; ?>"> <?php echo $row['para_title']; ?></option>
                                                    <?php
                                                    endwhile;
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1" for="employee">Employee</label>
                                                <select class="form-control" id="employee" name="employee">
                                                    <option value="" disabled selected hidden>Please Select</option>
                                                    <option value=0>No needed</option>
                                                    <?php
                                                    $id = $_SESSION['user_master_id'];
                                                    $sql = "SELECT name FROM user_master WHERE is_deleted=0 AND manager_id = $id ORDER BY user_master_id ASC ";
                                                    $result = mysqli_query($conn, $sql);
                                                    while ($row = $result->fetch_assoc()) :
                                                    ?>
                                                        <option value="<?php echo $id; ?>"> <?php echo $row['name']; ?></option>
                                                    <?php
                                                    endwhile;
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <button class="btn btn-primary" name="submit">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-none d-md-flex p-h-40 justify-content-between">
                        <span class="">© 2019 ThemeNate</span>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a class="text-dark text-link" href="">Legal</a>
                            </li>
                            <li class="list-inline-item">
                                <a class="text-dark text-link" href="">Privacy</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <!-- Core Vendors JS -->
        <script src="assets/js/vendors.min.js"></script>

        <!-- page js -->

        <!-- Core JS -->
        <script src="assets/js/app.min.js"></script>

    </body>

    </html>
<?php } else {
    header("Location:../login.php");
}
