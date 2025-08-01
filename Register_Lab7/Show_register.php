<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <style type="text/css">
        body {
            background-color: #b97777;
            font-family: "Lucida Sans";
            display: block;
        }

        #stylized {
            width: 500px;
            padding: 20px;
            margin: 50px auto;
            background-color: rosybrown;
            border-radius: 15px;
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.2);
        }

        .info-row {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .info-row label {
            width: 120px;
            font-weight: bold;
        }

        .info-row p {
            margin: 0;
            padding-left: 10px;
        }

        h2 {
            color: #831b1b;
        }

        fieldset {
            border: 1px solid #831b1b;
        }

        .button {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 40px;
            height: 40px;
        }
    </style>
</head>
<body>

<div id="stylized">
    <?php
  
    function displayFormData($formData, $field) {
        return isset($formData[$field]) ? htmlspecialchars($formData[$field]) : "ไม่มีข้อมูล";
    }
    function getCurrentDate() {
        date_default_timezone_set("Asia/Bangkok"); // ตั้งเวลาเป็นเวลาประเทศไทย
        return date('d F Y เวลา H:i:s');
    }

    function formatDateThai($date) {
        $dateArray = explode("-", $date);
        $day = $dateArray[2];
        $month = (int)$dateArray[1];
        $year = (int)$dateArray[0];
        
        $monthNames = [
            1 => 'มกราคม', 2 => 'กุมภาพันธ์', 3 => 'มีนาคม', 4 => 'เมษายน',
            5 => 'พฤษภาคม', 6 => 'มิถุนายน', 7 => 'กรกฎาคม', 8 => 'สิงหาคม',
            9 => 'กันยายน', 10 => 'ตุลาคม', 11 => 'พฤศจิกายน', 12 => 'ธันวาคม'
        ];

        $yearThai = $year + 543; // แปลงปีจาก ค.ศ. เป็น พ.ศ.

        return "$day $monthNames[$month] พ.ศ. $yearThai";
    }
    function formatGender($Gender){
        $GenderNames = [
           'Male' => 'เพศชาย','Female' => 'เพศหญิง'
        ];
        return "$GenderNames[$Gender]";
    }

    
    if (!empty($_GET)) {
    ?>
        <div class="info-row">
            <label>ชื่อ - สกุล :</label>
            <p><?php echo displayFormData($_GET, 'Name'); echo "&nbsp; &nbsp;"; echo displayFormData($_GET, 'LName'); ?></p>
        </div>
        <div class="info-row">
            <label>เพศ :</label>
            <p><?php echo formatGender(displayFormData($_GET, 'Gender')); ?></p>
        </div>
        <div class="info-row">
            <label>วันเกิด :</label>
            <p><?php echo formatDateThai(displayFormData($_GET, 'Birth')); ?></p> 
        </div>
        <div class="info-row">
            <label>Username :</label>
            <p><?php echo displayFormData($_GET, 'User'); ?></p>
        </div>
        <div class="info-row">
            <label>Password :</label>
            <p><?php echo ("*********"); ?></p>
        </div>
        <div class="info-row">
            <label>Email :</label>
            <p><?php echo displayFormData($_GET, 'Email'); ?></p>
        </div>
        <div class="info-row">
            <label>วันที่ลงทะเบียน :</label>
            <p><?php echo getCurrentDate(); ?></p> <!-- แสดงวันที่ลงทะเบียน -->
        </div>
    <?php
    } else {
        echo "<p>ไม่มีข้อมูลที่ถูกส่งมา!</p>";
    }
    ?>
</div>

<a href="Lab7_65543206073-0.php">BACK</a>

</body>
</html>
