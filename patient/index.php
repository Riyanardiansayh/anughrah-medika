<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">

    <title>Beranda</title>
    <style>
        .dashbord-tables {
            animation: transitionIn-Y-over 0.5s;
        }

        .filter-container {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table,
        .anime {
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>


</head>

<body>
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


    //echo $userid;
    //echo $username;
    
    ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px">
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title" style="font-size: 18px;">
                                        <?php echo substr($username, 0, 50) ?>
                                    </p>
                                    <p class="profile-subtitle" style="font-size: 14px; padding-top:10px;">
                                        <?php echo substr($useremail, 0, 50) ?>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../logout.php"><input type="button" value="Log out"
                                            class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-home menu-active menu-icon-home-active">
                        <a href="index.php" class="non-style-link-menu non-style-link-menu-active">
                            <div>
                                <p class="menu-text">Beranda</p>
                        </a>
        </div></a>
        </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-doctor">
                <a href="doctors.php" class="non-style-link-menu">
                    <div>
                        <p class="menu-text">semua dokter</p>
                </a>
    </div>
    </td>
    </tr>

    <tr class="menu-row">
        <td class="menu-btn menu-icon-session">
            <a href="schedule.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Sesi Terjadwal</p>
                </div>
            </a>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-appoinment">
            <a href="appointment.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Pemesanan Saya</p>
            </a></div>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-settings">
            <a href="settings.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Pengaturan</p>
            </a></div>
        </td>
    </tr>

    </table>
    </div>
    <div class="dash-body" style="margin-top: 15px">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;">

            <tr>

                <td colspan="1" class="nav-bar">
                    <p style="font-size: 23px;padding-left:12px;font-weight: 600;margin-left:20px;">Beranda</p>

                </td>
                <td width="25%">

                </td>
                <td width="15%">
                    <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                        Tanggal hari ini
                    </p>
                    <p class="heading-sub12" style="padding: 0;margin: 0;">
                        <?php
                        date_default_timezone_set('Asia/Kolkata');

                        $today = date('Y-m-d');
                        echo $today;


                        $patientrow = $database->query("select  * from  patient;");
                        $doctorrow = $database->query("select  * from  doctor;");
                        $appointmentrow = $database->query("select  * from  appointment where appodate>='$today';");
                        $schedulerow = $database->query("select  * from  schedule where scheduledate='$today';");


                        ?>
                    </p>
                </td>
                <td width="10%">
                    <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img
                            src="../img/calendar.svg" width="100%"></button>
                </td>


            </tr>
            <tr>
                <td colspan="4">

                    <center>
                        <table class="filter-container doctor-header patient-header" style="border: none;width:95%"
                            border="0">
                            <tr>
                                <td>
                                    <h3>Selamat Datang!</h3>
                                    <h1><?php echo $username ?>.</h1>
                                    <p>Belum tahu tentang dokter? tidak masalah mari kita lompat ke
                                        <a href="doctors.php" class="non-style-link"><b>"Semua Dokter"</b></a> bagian
                                        atau
                                        <a href="schedule.php" class="non-style-link"><b>"Sesi"</b> </a><br>
                                        Lacak riwayat janji temu Anda yang lalu dan yang akan datang.<br>Cari tahu juga
                                        perkiraan waktu kedatangan dokter atau konsultan medis Anda.<br><br>
                                    </p>

                                    <h3>Salurkan Dokter Di Sini</h3>
                                    <form action="schedule.php" method="post" style="display: flex">

                                        <input type="search" name="search" class="input-text "
                                            placeholder="Cari Dokter dan Kami akan Menemukan Sesi yang Tersedia"
                                            list="doctors" style="width:45%;">&nbsp;&nbsp;

                                        <?php
                                        echo '<datalist id="doctors">';
                                        $list11 = $database->query("select  docname,docemail from  doctor;");

                                        for ($y = 0; $y < $list11->num_rows; $y++) {
                                            $row00 = $list11->fetch_assoc();
                                            $d = $row00["docname"];

                                            echo "<option value='$d'><br/>";

                                        }
                                        ;

                                        echo ' </datalist>';
                                        ?>


                                        <input type="Submit" value="Cari" class="login-btn btn-primary btn"
                                            style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">

                                        <br>
                                        <br>

                                </td>
                            </tr>
                        </table>
                    </center>

                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <table border="0" width="100%"">
                            <tr>
                                <td width=" 50%">

                        <center>
                            <table class="filter-container" style="border: none;" border="0">
                                <tr>
                                    <td colspan="4">
                                        <p style="font-size: 20px;font-weight:600;padding-left: 12px;">Status</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;">
                                        <div class="dashboard-items"
                                            style="padding:20px;margin:auto;width:95%;display: flex">
                                            <div>
                                                <div class="h1-dashboard">
                                                    <?php echo $doctorrow->num_rows ?>
                                                </div><br>
                                                <div class="h3-dashboard">
                                                    Semua Dokter &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </div>
                                            </div>
                                            <div class="btn-icon-back dashboard-icons"
                                                style="background-image: url('../img/icons/doctors-hover.svg');"></div>
                                        </div>
                                    </td>
                                    <td style="width: 25%;">
                                        <div class="dashboard-items"
                                            style="padding:20px;margin:auto;width:95%;display: flex;">
                                            <div>
                                                <div class="h1-dashboard">
                                                    <?php echo $patientrow->num_rows ?>
                                                </div><br>
                                                <div class="h3-dashboard">
                                                    Semua Pasien &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </div>
                                            </div>
                                            <div class="btn-icon-back dashboard-icons"
                                                style="background-image: url('../img/icons/patients-hover.svg');"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;">
                                        <div class="dashboard-items"
                                            style="padding:20px;margin:auto;width:95%;display: flex; ">
                                            <div>
                                                <div class="h1-dashboard">
                                                    <?php echo $appointmentrow->num_rows ?>
                                                </div><br>
                                                <div class="h3-dashboard">
                                                    Pemesanan Baru &nbsp;&nbsp;
                                                </div>
                                            </div>
                                            <div class="btn-icon-back dashboard-icons"
                                                style="margin-left: 0px;background-image: url('../img/icons/book-hover.svg');">
                                            </div>
                                        </div>

                                    </td>

                                    <td style="width: 25%;">
                                        <div class="dashboard-items"
                                            style="padding:20px;margin:auto;width:95%;display: flex;padding-top:21px;padding-bottom:21px;">
                                            <div>
                                                <div class="h1-dashboard">
                                                    <?php echo $schedulerow->num_rows ?>
                                                </div><br>
                                                <div class="h3-dashboard" style="font-size: 15px">
                                                    Sesi Hari Ini
                                                </div>
                                            </div>
                                            <div class="btn-icon-back dashboard-icons"
                                                style="background-image: url('../img/icons/session-iceblue.svg');">
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            </table>
                        </center>


                </td>
                <td>



                    <p style="font-size: 20px;font-weight:600;padding-left: 40px;" class="anime">Pemesanan Anda yang
                        Akan Datang</p>
                    <center>
                        <div class="abc scroll" style="height: 250px;padding: 0;margin: 0;">
                            <table width="85%" class="sub-table scrolldown" border="0">
                                <thead>

                                    <tr>
                                        <th class="table-headin">


                                            Menunjuk. Nomor

                                        </th>
                                        <th class="table-headin">


                                            Judul Sesi

                                        </th>

                                        <th class="table-headin">
                                            Dokter
                                        </th>
                                        <th class="table-headin">

                                            Tanggal & Waktu yang Dijadwalkan

                                        </th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $nextweek = date("Y-m-d", strtotime("+1 week"));
                                    $sqlmain = "SELECT 
                                            schedule.scheduleid, 
                                            schedule.title, 
                                            doctor.docname, 
                                            patient.pname, 
                                            schedule.scheduledate, 
                                            schedule.scheduletime, 
                                            appointment.appodate, 
                                            appointment.apponum 
                                        FROM schedule 
                                        INNER JOIN appointment ON schedule.scheduleid = appointment.scheduleid 
                                        INNER JOIN patient ON patient.pname = appointment.pname 
                                        INNER JOIN doctor ON schedule.docid = doctor.docid 
                                        WHERE patient.pname = '$username' 
                                        AND schedule.scheduledate >= '$today' 
                                        ORDER BY schedule.scheduledate ASC";

                                    //echo $sqlmain;
                                    $result = $database->query($sqlmain);

                                    if ($result->num_rows == 0) {
                                        echo '<tr>
                                                    <td colspan="4">
                                                    <br><br><br><br>
                                                    <center>
                                                    <img src="../img/notfound.svg" width="25%">
                                                    
                                                    <br>
                                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Tidak ada yang bisa ditampilkan di sini!</p>
                                                    <a class="non-style-link" href="schedule.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Menyalurkan Dokter &nbsp;</font></button>
                                                    </a>
                                                    </center>
                                                    <br><br><br><br>
                                                    </td>
                                                    </tr>';

                                    } else {
                                        for ($x = 0; $x < $result->num_rows; $x++) {
                                            $row = $result->fetch_assoc();
                                            $scheduleid = $row["scheduleid"];
                                            $title = $row["title"];
                                            $apponum = $row["apponum"];
                                            $docname = $row["docname"];
                                            $scheduledate = $row["scheduledate"];
                                            $scheduletime = $row["scheduletime"];

                                            echo '<tr>
                                                        <td style="padding:30px;font-size:25px;font-weight:700; text-align: center;"> &nbsp;' .
                                                $apponum
                                                . '</td>
                                                        <td style="padding:20px; text-align: center;"> &nbsp;' .
                                                substr($title, 0, 30)
                                                . '</td>
                                                        <td style="text-align:center;">
                                                        ' . substr($docname, 0, 50) . '
                                                        </td>
                                                        <td style="text-align:center;">
                                                            ' . substr($scheduledate, 0, 10) . ' ' . substr($scheduletime, 0, 5) . '
                                                        </td>

                
                                                       
                                                    </tr>';

                                        }
                                    }

                                    ?>

                                </tbody>

                            </table>
                        </div>
                    </center>







                </td>
            </tr>
        </table>
        </td>
        <tr>
            </table>
    </div>
    </div>


</body>

</html>