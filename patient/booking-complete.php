<?php

//learn from w3schools.com

session_start();

if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'p') {
        header("location: ../login.php");
    } else {
        $useremail = $_SESSION["user"];
    }

} else {
    header("location: ../login.php");
}


//import database
include("../connection.php");
$sqlmain = "select * from patient where pemail=?";
$stmt = $database->prepare($sqlmain);
$stmt->bind_param("s", $useremail);
$stmt->execute();
$userrow = $stmt->get_result();
$userfetch = $userrow->fetch_assoc();
$userid = $userfetch["pid"];
$username = $userfetch["pname"];


if ($_POST) {
    if (isset($_POST["booknow"])) {
        $apponum = $_POST["apponum"];
        $scheduleid = $_POST["scheduleid"];
        $date = $_POST["date"];
        $scheduleid = $_POST["scheduleid"];
        $sql_doc = "SELECT doctor.docname FROM doctor 
            INNER JOIN schedule ON doctor.docid = schedule.docid 
            WHERE schedule.scheduleid = ?";
        $stmt_doc = $database->prepare($sql_doc);
        $stmt_doc->bind_param("i", $scheduleid);
        $stmt_doc->execute();
        $result_doc = $stmt_doc->get_result();
        $row_doc = $result_doc->fetch_assoc();
        $docname = $row_doc['docname']; // Nama dokter yang sesuai dengan jadwal
        $sql2 = "INSERT INTO appointment (pname, apponum, scheduleid, appodate, docname) VALUES (?, ?, ?, ?, ?)";
        $stmt2 = $database->prepare($sql2);
        $stmt2->bind_param("sisss", $username, $apponum, $scheduleid, $date, $docname);

        if ($stmt2->execute()) {
            header("Location: appointment.php?action=booking-added&id=" . $apponum . "&titleget=none");
            exit();
        } else {
            echo "Error: " . $stmt2->error;
        }
    }
}
?>