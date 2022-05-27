<?php
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['user_master_id'])) {
    $page_title = "admin_team";
    $Dashboard = "ADMIN";
    $Department = "DEPARTMENT";
    $Employee = "EMPLOYEE";
    $Dashboard_link = "admin-dashboard.php";
    $Department_link = "../department/create_dept.php";
    $All_Employee = "ALL EMPLOYEES";
    $My_Team = "MY TEAM";
    $AllEmployee_link = "../admin/allEmployee.php";
    $MyTeam_link = "../admin/admin_myteam.php";
    $Parameter = "PARAMETER";
    $Parameter_link = "../parameter/view_para.php";
    include "../master/db_conn.php";
    include "../master/pre-header.php";
    include "../master/close_header.php";
?>
    <style>
        .slidecontainer {
            width: 100%;
        }

        .slider {
            -webkit-appearance: none;
            width: 100%;
            height: 15px;
            border-radius: 5px;
            background: #d3d3d3;
            outline: none;
            opacity: 0.7;
            -webkit-transition: .2s;
            transition: opacity .2s;
        }

        .slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: #04AA6D;
            cursor: pointer;
        }

        .slider::-moz-range-thumb {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: #04AA6D;
            cursor: pointer;
        }
    </style>
    <?php
    include "../master/header.php";
    include "../master/navbar_admin.php";
    include "../master/breadcrumbs.php";
    ?>
    <div class="app">
        <div class="container-fluid p-h-0 p-v-20 bg full-height d-flex" style="background-image: url('assets/images/others/login-3.png')">
            <div class="d-flex flex-column justify-content-between w-100">
                <div class="container d-flex h-100">
                    <div class="row align-items-center w-100">
                        <div class="col-md-7 col-lg-11 m-h-auto">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between m-b-30">
                                        <img class="img-fluid" alt="" src="assets/images/logo/logo.png">
                                        <!-- form-id-start -->
                                        <h2 class="m-b-0">
                                            <?php
                                            $sql = "SELECT form_id FROM form_master WHERE is_deleted=0";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = $result->fetch_assoc()) :
                                            ?>
                                                <?php echo $row['form_id']; ?>
                                            <?php
                                            endwhile;
                                            ?>
                                        </h2>
                                        <!-- form-id-end -->
                                    </div>
                                    <form action="insert.php" method="POST">
                                        <?php if (isset($_GET['error'])) { ?>
                                            <div class="alert alert-danger" role="alert">
                                                <?= $_GET['error'] ?>
                                            </div>
                                        <?php } ?>
                                        <!-- form-task-start -->
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="title">Task Title:</label>
                                            <div class="input-affix">
                                                <i class="prefix-icon anticon anticon-user"></i>
                                                <input type="text" class="form-control" id="title" name="title" placeholder="task_title">
                                            </div>
                                        </div>
                                        <!-- form-task-end -->
                                        <!-- form-evaluation-start -->
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="desc">Evaluation:</label>
                                            <div class="input-affix">
                                                <i class="prefix-icon anticon anticon-user"></i>
                                                <input type="text" class="form-control" id="desc" name="desc" placeholder="task_eval">
                                            </div>
                                        </div>
                                        <!-- form-evaluation-end -->
                                        <!-- form-para drop list-start 
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1" for="para">Parameter</label>
                                            <select class="form-control" id="para" name="para">
                                                <option value="" disabled selected hidden>Please Select</option>
                                                <?php
                                                /*$sql = "SELECT para_id,para_title FROM para_master WHERE is_deleted = 0 ORDER BY para_id ASC ";
                                                $result = mysqli_query($conn, $sql);
                                                while ($row = $result->fetch_assoc()) :
                                                ?>
                                                    <option value="<?php echo $row['para_id']; ?>"> <?php echo $row['para_title']; ?></option>
                                                <?php
                                                endwhile;
                                                */ ?>
                                            </select>
                                        </div>
                                         form-para drop list-end -->


                                        <!-- form-checkbox -start -->
                                        <div class="form-group">
                                            <?php $sql = "SELECT para_id,para_title FROM para_master WHERE is_deleted = 0 ORDER BY para_id ASC ";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = $result->fetch_assoc()) : ?>
                                                <input type="checkbox" name="<?php echo $row['para_title'] ?>" id="<?php echo $row['para_id'] ?>" value="<?php echo $row['para_title'] ?>">
                                                <label for="exampleFormControlSelect1" for="para"><?php echo $row['para_title'] ?></label>
                                                <span class ="form-group"  >
                                                    <label>min </label>
                                                    <input type="text" maxlength="2" size='3'>
                                                </span>
                                                <span class ="form-group">
                                                    <label>max </label>
                                                    <input type="text" maxlength="2" size='3'>
                                                </span>
                                                <span class ="form-group">
                                                <label>rate </label>
                                                <input type="text" maxlength="2" size='3'>
                                                </span>

                                                <br>
                                            <?php
                                            endwhile;
                                            ?>
                                        </div>
                                        <!-- form-checkbox -end -->
                                        <!---------------------------Range Slider start------------------------------>
                                        <h6>Rating</h6>

                                        <div class="slidecontainer">
                                            <input type="range" min="1" max="100" class="slider" id="myRange">
                                            <p>Value: <span id="demo"></span></p>
                                        </div>

                                        <script>
                                            var slider = document.getElementById("myRange");
                                            var output = document.getElementById("demo");
                                            output.innerHTML = slider.value;

                                            slider.oninput = function() {
                                                output.innerHTML = this.value;
                                            }
                                        </script>
                                        <!----------------------------Range Slider end --------------------------------------------------------->
                                        <!-- form-employee -start -->

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
                                        <!-- form-employee -end -->
                                        <!-- form-submit -start -->
                                        <div class="form-group">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <button class="btn btn-primary" name="submit">Submit</button>
                                            </div>
                                        </div>
                                        <!-- form-submit -end -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php } else {
    header("Location:../login.php");
}
include "../master/footer.php";
include "../master/after-footer.php";
