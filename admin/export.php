<?php

//learn from w3schools.com

session_start();

if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'a') {
        header("location: ../login.php");
    }

} else {
    header("location: ../login.php");
}
include("../connection.php");
$sql = "SELECT appoid, pname, apponum, scheduleid, appodate, docname FROM appointment"; // Ganti 'nama_tabel' dengan nama tabel Anda
$result = $database->query($sql);

// Header untuk file Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=export_data.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Menampilkan header kolom
echo "<table border='1'>";
echo "<tr>
        <th>Appo ID</th>
        <th>Patient Name</th>
        <th>Appointment Number</th>
        <th>Schedule ID</th>
        <th>Appointment Date</th>
        <th>Doctor Name</th>
      </tr>";

// Menampilkan data dari database
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['appoid']}</td>
                <td>{$row['pname']}</td>
                <td>{$row['apponum']}</td>
                <td>{$row['scheduleid']}</td>
                <td>{$row['appodate']}</td>
                <td>{$row['docname']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No data available</td></tr>";
}
echo "</table>";


//import database
include("../connection.php");


?>