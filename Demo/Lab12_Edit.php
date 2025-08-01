<?php
session_start();

// เชื่อมต่อฐานข้อมูล
$mysqli = new mysqli("localhost", "root", "1234", "mystore");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// ตรวจสอบว่ามีการกดปุ่ม "แก้ไขข้อมูลลูกค้า" และเป็นการส่งแบบ POST หรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["Customer_id"];
    $name = $_POST["Name"];
    $lname = $_POST["LName"];
    $gender = $_POST["Gender"] ?? "";
    $birth = $_POST["Birth"];
    $address = $_POST["Address"];
    $province = $_POST["Province"];
    $zipcode = $_POST["Zipcode"];
    $tel = $_POST["Tel"];
    $description = $_POST["suggest"];

    // ใช้ Prepared Statement เพื่ออัปเดตข้อมูล
    $sql = "UPDATE customer SET 
                Customer_Name = ?, 
                Customer_Lastname = ?, 
                Gender = ?, 
                Birthdate = ?, 
                Address = ?, 
                Province = ?, 
                Zipcode = ?, 
                Telephone = ?, 
                Customer_Description = ? 
            WHERE Customer_id = ?";
    
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssssssssss", $name, $lname, $gender, $birth, $address, $province, $zipcode, $tel, $description, $id);

    if ($stmt->execute()) {
        // อัปเดตเสร็จแล้วให้ Redirect ไปที่ show.php
        header("Location: Lab12_ShowCus.php");
        exit();
    } else {
        $_SESSION['errorMessage'] = "เกิดข้อผิดพลาดในการอัปเดตข้อมูล";
    }

    $stmt->close();
}

// รับค่า id จาก URL
$id = $_GET["id"] ?? "";

// ดึงข้อมูลลูกค้า
$sql = "SELECT * FROM customer WHERE Customer_id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();
$mysqli->close();

// ตรวจสอบ Error Message
$errorMessage = $_SESSION['errorMessage'] ?? "";
unset($_SESSION['errorMessage']); // เคลียร์ค่าหลังจากแสดง
?>


<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แก้ไขข้อมูลลูกค้า</title>
    <style>
 body {
            background-color: #b97777;
            font-family: "Lucida Sans";
        }

        div {
            width: 600px;
            padding: 40px;
            margin: 100px auto;
            background-color: rosybrown;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
        #stylized {
            font-family: "Lucida Sans";
        }

        #stylized input {
            float: left;
            width: 200px;
            border: solid 1px black;
            padding: 4px 2px;
        }

        #stylized label {
            float: left;
            width: 200px;
            padding: 6px 4px;
        }


        h2 {
            color:rgb(0, 0, 0);
        }

        fieldset {
            border: 1px solid rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            
        }

        .button {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            left: 32%;
            transform: translate(-50%, -50%);
            width: 40px;
            height: 40px;
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, 0.3);
            margin: 10px;
        }

        /* Popup */
        #customPopup {
            display: <?= $errorMessage ? 'flex' : 'none' ?>;
            position: fixed;
            inset: 0;
            justify-content: center;
            align-items: center;
            background-color: rgba(255, 255, 255, 0.7);
        }

        .popup-box {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            width: 300px;
        }

        #popupClose {
            cursor: pointer;
            color: red;
            font-size: 18px;
            float: right;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div id="stylized">
    <h2 style="color:#831b1b;text-decoration: underline;">แก้ไขข้อมูลลูกค้า</h2>
    <fieldset>
        <legend><h2>ข้อมูลส่วนตัว</h2></legend>
        <form name="FormEdit" action="edit_customer.php" method="post">
            <input type="hidden" name="Customer_id" value="<?= htmlspecialchars($row["Customer_id"] ?? '') ?>">

            <label>ชื่อ :</label> 
            <input type="text" name="Name" value="<?= htmlspecialchars($row["Customer_Name"] ?? '') ?>"><br><br>

            <label>นามสกุล :</label> 
            <input type="text" name="LName" value="<?= htmlspecialchars($row["Customer_Lastname"] ?? '') ?>"><br><br>

            <label >เพศ :</label>
            <label style="display:flex; width: 100px; "><input type="radio" name="Gender" value="ชาย" <?= ($row["Gender"] ?? '') == "ชาย" ? "checked" : "" ?>> ชาย
            <input type="radio" name="Gender" value="หญิง" <?= ($row["Gender"] ?? '') == "หญิง" ? "checked" : "" ?>> หญิง </label><br><br>

            <label>วัน-เดือน-ปี เกิด :</label> 
            <input type="date" name="Birth" value="<?= htmlspecialchars($row["Birthdate"] ?? '') ?>"><br><br>

            <label>ที่อยู่ :</label> 
            <input type="text" name="Address" value="<?= htmlspecialchars($row["Address"] ?? '') ?>"><br><br>

            <label>จังหวัด :</label> 
            <select name="Province">
                <?php
                $provinces = ["เชียงใหม่", "ลำพูน", "เชียงราย", "ลำปาง", "แม่ฮ่องสอน", "พะเยา", "แพร่", "น่าน"];
                foreach ($provinces as $province) {
                    $selected = ($row["Province"] ?? '') == $province ? "selected" : "";
                    echo "<option value='$province' $selected>$province</option>";
                }
                ?>
            </select><br><br>

            <label>รหัสไปรษณีย์ :</label> 
            <input type="text" name="Zipcode" value="<?= htmlspecialchars($row["Zipcode"] ?? '') ?>"><br><br>

            <label>โทรศัพท์ :</label> 
            <input type="text" name="Tel" value="<?= htmlspecialchars($row["Telephone"] ?? '') ?>"><br><br>

            <label>รายละเอียดอื่นๆ :</label>
            <textarea name="suggest" rows="4" cols="30"><?= htmlspecialchars($row["Customer_Description"] ?? '') ?></textarea><br><br>

            <input class="button" type="submit" value="แก้ไขข้อมูลลูกค้า">
            <input class="button" type="button" value="ยกเลิก" onclick="window.location.href='Lab12_ShowCus.php';">
        </form>
    </fieldset>
</div>

<div id="customPopup">
    <div class="popup-box">
        <span id="popupClose" onclick="closePopup()">&times;</span>
        <p><?= $errorMessage ?></p>
    </div>
</div>

<script>
    function closePopup() {
        document.getElementById("customPopup").style.display = "none";
    }
</script>

</body>
</html>
