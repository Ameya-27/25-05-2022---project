<?php
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['user_master_id'])) {
    $page_title = "view";
    $Dashboard = "MANAGER";
    $Dashboard_link = "../manager/manager-dashboard.php";
    $My_Evaluation = "My Evaluation";
    $MyEvaluation_link = "view_manager_task.php";
    $My_Team = "MY TEAM";
    $MyTeam_link = "../manager/manager_myteam.php";
    include "../master/db_conn.php";
    include "../master/pre-header.php";
    include "../master/header.php";
    include "../master/navbar_manager.php";
    include "../master/breadcrumbs.php";
    //
?>
    <!-- main content start here-->

    <div class="p-3">
        <?php $id = $_SESSION['user_master_id'];
        $query = "SELECT form_master.form_id,form_master.task_id,form_master.manager_id,form_master.for_id,task_master.task_title FROM form_master INNER JOIN task_master on form_master.task_id=task_master.task_id WHERE form_master.is_deleted=0 AND task_master.is_deleted=0 AND form_master.is_submit=0"; //where is_delete==0
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) { ?>

            <h1 class="display-4 fs-1">Tasks</h1>
            <table class="table" style="width: 32rem;">
                <thead>
                    <tr>
                        <th scope="col">Form Id</th>
                        <th scope="col">Task Id</th>
                        <th scope="col">Task Title</th>
                        <th scope="col" style="display:none">Manager Id</th>
                        <th scope="col" style="display:none">For Id</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($rows = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <th scope="row"><?= $rows['form_id'] ?></th>
                            <td><?= $rows['task_id'] ?></td>
                            <td><?= $rows['task_title'] ?></td>
                            <td style="display:none"><?= $rows['manager_id'] ?></td>
                            <td style="display:none"><?= $rows['for_id'] ?></td>
                            <td>
                                <a class="btn btn-success evalbtn" href="../task/manager_task.php?vmt_form_id=<?php echo $rows['form_id']; ?> &vmt_task_id=<?php echo $rows['task_id']?> &vmt_task_title=<?php echo $rows['task_title']?> &vmt_manager_id=<?php echo $rows['manager_id']?> &vmt_for_id=<?php echo $rows['for_id']?>">Evaluate/View</a>
                            </td>
                        </tr>
                    <?php $i++;
                    } ?>
                </tbody>
            </table>
        <?php } ?>
    </div>


    <!-- main content start here-->
<?php
    include "../master/footer.php";
    include "../master/after-footer.php";
} else {
    header("Location:../login.php");
}
?>