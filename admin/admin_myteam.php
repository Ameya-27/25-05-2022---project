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
    $AllEmployee_link = "allEmployee.php";
    $MyTeam_link = "admin_myteam.php";
    $Parameter = "PARAMETER";
    $Parameter_link = "../parameter/view_para.php";
    include "../master/db_conn.php";
    include "../master/pre-header.php";
    include "../master/header.php";
    include "../master/navbar_admin.php";
    include "../master/breadcrumbs.php";
?>
    <?php
    $id = $_SESSION['user_master_id'];
    $sql = "SELECT * FROM user_master where is_deleted = 0 AND manager_id = '$id' ORDER BY user_master_id ASC"; //where is_delete==0
    $res = mysqli_query($conn, $sql);
    ?>
    <html>

    <body>
        <div class="container d-flex  align-items-center" style="min-height: 30vh">
            <div class="p-3">
                <?php
                $id = $_SESSION['user_master_id'];
                $sql = "SELECT * FROM user_master where is_deleted = 0 AND manager_id = '$id' ORDER BY user_master_id ASC"; //where is_delete==0
                $res = mysqli_query($conn, $sql);
                if (mysqli_num_rows($res) > 0) { ?>

                    <h1 class="display-4 fs-1">Members</h1>
                    <table class="table" style="width: 32rem;">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">User name</th>
                                <th scope="col">Role</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            while ($rows = mysqli_fetch_assoc($res)) { ?>
                                <tr>
                                    <th scope="row"><?= $i ?></th>
                                    <td><?= $rows['name'] ?></td>
                                    <td><?= $rows['email'] ?></td>
                                    <td><?= $rows['role'] ?></td>
                                    <td>
                                        <a class="btn btn-success evalbtn" href="../evaluation_form/create.php">Evaluate/View</a>
                                    </td>
                                </tr>
                            <?php $i++;
                            } ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
    </body>

    </html>
<?php
    // content end
    include "../master/footer.php";
    include "../master/after-footer.php";
} else {
    header('Location:../login.php');
}
?>