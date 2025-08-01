<?php
session_start();

// เชื่อมต่อฐานข้อมูล
$mysqli = new mysqli("localhost", "root", "1234", "mystore");

// ตรวจสอบการเชื่อมต่อ
if ($mysqli->connect_errno) {
    die("Failed to connect: " . $mysqli->connect_error);
}

// Initialize error message variable
$errorMessage = "";

// ตรวจสอบการส่งฟอร์ม
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formData = array_map('trim', $_POST);

    // ตรวจสอบว่ากรอกข้อมูลครบ
    if (in_array("", $formData, true)) {
        $errorMessage = "กรุณากรอกข้อมูลให้ครบทุกช่อง";
    } elseif ($formData['pwd'] !== $formData['Conpwd']) {
        $errorMessage = "รหัสผ่านไม่ตรงกัน!!";
    } elseif (strtotime($formData['Birth']) >= strtotime(date('Y-m-d'))) {
        $errorMessage = "วันเกิดไม่ถูกต้อง!!";
    }

    // ถ้าไม่มี Error ให้บันทึกลงฐานข้อมูล
    if ($errorMessage === "") {
        $Name = $mysqli->real_escape_string($_POST["Name"]);
        $LName = $mysqli->real_escape_string($_POST["LName"]);
        $Gender = $mysqli->real_escape_string($_POST["Gender"]);
        $Birthdate = $mysqli->real_escape_string($_POST["Birth"]);
        $Addr = $mysqli->real_escape_string($_POST["Addr"]);
        $Prov = $mysqli->real_escape_string($_POST["Prov"]);
        $Zipc = $mysqli->real_escape_string($_POST["Zipc"]);
        $Tel = $mysqli->real_escape_string($_POST["Tel"]);
        $User = $mysqli->real_escape_string($_POST["User"]);
        $suggest = $mysqli->real_escape_string($_POST["suggest"]);
        $pwd = $mysqli->real_escape_string($_POST["pwd"]); // เข้ารหัสรหัสผ่าน
        // $pwd = password_hash($_POST["pwd"], PASSWORD_BCRYPT); // เข้ารหัสรหัสผ่าน

        // SQL Insert
        $sqladd = "INSERT INTO customer (Customer_Name, Customer_Lastname, Gender, Birthdate, Address, Province, Zipcode, Telephone, username, password,Customer_Description)
                   VALUES ('$Name', '$LName', '$Gender', '$Birthdate', '$Addr', '$Prov', '$Zipc', '$Tel', '$User', '$pwd', '$suggest')";

        if ($mysqli->query($sqladd)) {
            header("Location: Lab12_ShowCus.php"); // เปลี่ยนหน้าเมื่อบันทึกสำเร็จ
            exit;
        } else {
            $errorMessage = "เกิดข้อผิดพลาด: " . $mysqli->error;
        }
    }

    $_SESSION['errorMessage'] = $errorMessage;
}

// โหลดข้อความ Error จาก Session
$errorMessage = isset($_SESSION['errorMessage']) ? $_SESSION['errorMessage'] : "";
unset($_SESSION['errorMessage']); // เคลียร์หลังจากโหลด

$mysqli->close();
?>


<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
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

        /* Popup สไตล์ใหม่ */
        #customPopup {
            display: none;
            position: fixed;
            inset: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(255, 255, 255, 0);
            border: None;
        }

        .popup-box {
            background-color:rgba(255, 255, 255, 0.81);
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
    <script>
document.addEventListener("DOMContentLoaded", function () {
    function showAlert(input, message) {
        if (!input.dataset.validated) { // ตรวจสอบว่าเคย alert ไปแล้วหรือยัง
            alert(message);
            input.dataset.validated = "true"; // ตั้งค่าเพื่อป้องกัน alert ซ้ำ
            input.focus();
        }
    }

    function validateLength(input, minLength, message) {
        input.addEventListener("blur", function () {
            if (input.value.trim().length < minLength) {
                showAlert(input, message);
            } else {
                delete input.dataset.validated; // ถ้าข้อมูลถูกต้อง ล้างค่าเพื่อให้ alert ใหม่ได้
            }
        });

        input.addEventListener("input", function () {
            delete input.dataset.validated; // เมื่อลงมือแก้ไข ล้างค่าเพื่อให้ alert ใหม่ได้
        });
    }

    function validateNumber(input, minLength, message) {
        input.addEventListener("keyup", function () {
            input.value = input.value.replace(/[^0-9]/g, "");
        });

        input.addEventListener("blur", function () {
            if (input.value.length < minLength) {
                showAlert(input, message);
            } else {
                delete input.dataset.validated;
            }
        });

        input.addEventListener("input", function () {
            delete input.dataset.validated;
        });
    }

    validateLength(document.getElementById("Name"), 3, "กรุณากรอกชื่อให้ครบอย่างน้อย 3 ตัวอักษร");
    validateLength(document.getElementsByName("LName")[0], 3, "กรุณากรอกนามสกุลให้ครบอย่างน้อย 3 ตัวอักษร");
    validateLength(document.getElementsByName("Addr")[0], 3, "กรุณากรอกที่อยู่ให้ครบอย่างน้อย 3 ตัวอักษร");
    validateNumber(document.getElementsByName("Zipc")[0], 5, "กรุณากรอกรหัสไปรษณีย์ให้ครบ 5 ตัวเลข");
    validateNumber(document.getElementsByName("Tel")[0], 10, "กรุณากรอกเบอร์โทรศัพท์ให้ครบ 10 ตัวเลข");
    validateLength(document.getElementsByName("User")[0], 5, "กรุณากรอก Username อย่างน้อย 5 ตัวอักษร");
    validateLength(document.getElementsByName("pwd")[0], 8, "กรุณากรอกรหัสผ่านอย่างน้อย 8 ตัวอักษร");
});


    </script>
</head>

<body>



<div id="stylized">
<h2 style="color:#831b1b;text-decoration: underline;">เพิ่มข้อมูลลูกค้า</h2>
    <fieldset>
        <legend>
            <h2>ข้อมูลส่วนตัว</h2>
        </legend>
        <form name="FormAdd" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label>ชื่อ :</label> <input type="text" id="Name"name="Name"><br><br>
            <label>นามสกุล :</label> <input type="text" name="LName"><br><br>
            <label>เพศ :</label>
            <label style="display:flex; width: 100px; "><input type="radio" name="Gender" value="ชาย">ชาย
            <input type="radio" name="Gender" value="หญิง">หญิง</label><br><br>
            <label>วัน-เดือน-ปี เกิด :</label> <input type="date" name="Birth"><br><br>
            <label>ที่อยู่ :</label> <input type="text" name="Addr"><br><br>
            <label>จังหวัด :</label>
            <select style=" width: 200px; border: solid 1px black; padding: 4px 2px;" name="Prov">
            <option value="เชียงใหม่" selected="selected">เชียงใหม่</option>
            <option value="ลำพูน">ลำพูน</option>
            <option value="เชียงราย">เชียงราย</option>
            <option value="ลำปาง">ลำปาง</option>
            <option value="แม่ฮ่องสอน">แม่ฮ่องสอน</option>
            <option value="พะเยา">พะเยา</option>
            <option value="แพร่">แพร่</option>
            <option value="น่าน">น่าน</option>
            </select><br><br>
            <label>รหัสไปรษณีย์ :</label> <input type="text" name="Zipc"><br><br>
            <label>โทรศัพท์ :</label> <input type="text" name="Tel"><br><br>
            <label>รายละเอียดอื่นๆ :</label><textarea style="border-color: black;" name="suggest" rows="9" cols="30">พิมพ์ข้อความ</textarea>
<br>
        <fieldset style="width: 95%; margin: 0 auto;">
        <legend>
            <h2>Account ของลูกค้า</h2>
        </legend>
            <label>Username :</label> <input type="text" name="User"><br><br>
            <label>Password :</label> <input type="password" name="pwd"><br><br>
            <label>Confirm Password :</label> <input type="password" name="Conpwd"><br><br>
    </fieldset>
    </fieldset>
    <br> <br> <br>
    <span >
    <input class="button"type="submit" value="เพิ่มข้อมูลลูกค้า" name="submit">
    <input class="button" type="button" value="ยกเลิก" onclick="window.location.href='Lab12_ShowCus.php';">
    </span>
    </form>
   

</div>

<div id="customPopup" style="display: <?php echo $errorMessage ? 'flex' : 'none'; ?>; box-shadow: None;">
    <div class="popup-box">
        <span id="popupClose" onclick="closePopup()">&times;</span>
        <p><?php echo $errorMessage; ?></p>
    </div>
</div>

<script>
    function closePopup() {
        document.getElementById("customPopup").style.display = "none";
    }
</script>

</body>
</html>
