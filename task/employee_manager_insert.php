<?php
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['user_master_id'])) {
    include "../master/db_conn.php";
    if (isset($_POST['submit'])) {
        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        //creating new variable and storing the values of the post method
        $form_id = test_input($_POST['form_id']);
        //echo $form_id;
        $task_id = test_input($_POST['title']);
        //echo $task_id;
        //echo $for_id;
        $desc = test_input($_POST['desc']);
        //echo $desc;
        //$manager_name = $_SESSION['username'];
        $manager_id = test_input($_POST['manager_id']);
        /*--------------------------------------Parameter insertion start---------------------------------------------

        $sql_4 = "SELECT para_id FROM para_master WHERE is_deleted = 0";
        $result_4 = mysqli_query($conn, $sql_4);

        while ($row = $result_4->fetch_assoc()) : {
                $id = $row['para_id'];
                if (!empty($_POST["parameter_$id"]) && !empty($_POST["rating_$id"])) {
                    $para_id = $_POST["parameter_$id"];
                    $sql_5 = "INSERT into form_isto_para (form_id,task_id,para_id,user_master_id) values ('$form_id','$task_id','$para_id','$for_id')";
                    $result_5 = mysqli_query($conn, $sql_5);
                    $rating_id = $_POST["rating_$id"];
                    if ($_SESSION['role'] == 'admin') {
                        $sql_6 = "UPDATE form_isto_para SET rating_manager = '$rating_id' WHERE form_id = $form_id AND para_id = $para_id";
                    }
                    $result_6 = mysqli_query($conn, $sql_6);
                }
            }
        endwhile;

        if ($result_5 != True) {
            echo "Error: " . $sql_5 . "<br>" . $conn->error;
        }

        --------------------------------Parameter insertion end ---------------------------------------------- */

        /*--------------------------------------update desc from form master start----------------------------------------------*/
        if ($_SESSION['role'] == 'employee') {
            if($_SESSION['is_manager']==1){
            $sql_3 = "UPDATE form_master SET desc_emp = '$desc' WHERE form_id = $form_id ";
            $result_3 = mysqli_query($conn, $sql_3);
            }
        }
       
        if ($result_3 != True) {
            echo "Error: " . $sql_3 . "<br>" . $conn->error;
        }

        /*-------------------------------------update desc from form master end---------------------------------------------- */
    }
} else {
    header("Location:../login.php");
}
