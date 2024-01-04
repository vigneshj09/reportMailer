<?php
require "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['action'] == 'save') {
        $date = isset($_POST['dateInput']) ? $_POST['dateInput'] : null;
        $status = isset($_POST['status']) ? $_POST['status'] : null;

        $morning = isset($_POST['morning']) && $_POST['morning'] == 'true' ? 1 : 0;
        $Night = isset($_POST['night']) && $_POST['night'] == 'true' ? 1 : 0;
        $Evening = isset($_POST['evening']) && $_POST['evening'] == 'true' ? 1 : 0;
        $afternoon = isset($_POST['afternoon']) && $_POST['afternoon'] == 'true' ? 1 : 0;

        $mode = isset($_POST['mode']) ? $_POST['mode'] : null;

        $date = mysqli_real_escape_string($con, $date);
        $mode = mysqli_real_escape_string($con, $mode);
        $status = mysqli_real_escape_string($con, $status);

        //~ Check if the record already exists
        $checkQry = "SELECT * FROM report WHERE date = '$date'";
        $checkResult = mysqli_query($con, $checkQry);

        if (mysqli_num_rows($checkResult) > 0) {
            //~ If the record exists, update it
            $updateQry = "UPDATE report SET `mode` = '$mode', `status` = '$status', `morning` = $morning, `afternoon` = $afternoon, `evening` = $Evening, `night` = $Night WHERE `date` = '$date'";
            $updateResult = mysqli_query($con, $updateQry);

            if ($updateResult) {
                echo "Data Updated";
            } else {
                echo "Error updating data: " . mysqli_error($con);
            }
        } else {
            //~ If the record doesn't exist, insert a new one
            $insertQry = "INSERT INTO report (`date`, `mode`, `status`, `morning`, `afternoon`, `evening`, `night`) VALUES ('$date', '$mode', '$status', $morning, $afternoon, $Evening, $Night)";
            $resultQry = mysqli_query($con, $insertQry);

            if ($resultQry) {
                echo "Data Inserted";
            } else {
                echo "Error inserting data: " . mysqli_error($con);
            }
        }
    }else if($_POST['action'] == "fetchDetails"){ 
        $date = $_POST['dateInput'];


        $checkQry = "SELECT * FROM report WHERE date = '$date'";
        $checkResult = mysqli_query($con, $checkQry);
        if (mysqli_num_rows($checkResult) > 0) {
            $result = mysqli_fetch_assoc($checkResult);
            echo json_encode($result);
        }else{
            echo "no date found";
        }

    }
}
?>
