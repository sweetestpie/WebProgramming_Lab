<?php
session_start();
$mysqli = new mysqli("localhost", "root", "1234", "mystore");

// ตรวจสอบการเชื่อมต่อ
if ($mysqli->connect_errno) {
    die("Failed to connect: " . $mysqli->connect_error);
}

// ตรวจสอบว่ามีการส่งค่าจากฟอร์มหรือไม่
if (isset($_POST["username"])) {
    $inputUsername = $_POST["username"];
    $inputPassword = $_POST["password"];

    // **ตรวจสอบว่า SQL Prepare สำเร็จหรือไม่**
    $stmt = $mysqli->prepare("SELECT * FROM customer WHERE username = ? AND password = ?");
    if (!$stmt) {
        die("SQL Error: " . $mysqli->error);  // 🛑 แสดงข้อผิดพลาดของ SQL
    }

    // Bind ค่าให้กับ SQL
    $stmt->bind_param("ss", $inputUsername, $inputPassword);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

       $_SESSION['Customer_Name'] = $row['Customer_Name'];
        $_SESSION['Customer_Lastname'] = $row['Customer_Lastname'];
        $_SESSION['username'] = $row['username'];
        header("Location: Lab12_ShowCus.php");
        exit();
    } else {
        $_SESSION['errorMessage'] = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง!";
        echo "<script>alert('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง!!'); window.location='login.php';</script>";
        exit();
    }

    $stmt->close();
}

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
            width: 30-0px;
            height: 30px;
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, 0.3);
            margin: 10px;
        }
        .button:hover {
            background-color:rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>

<div id="stylized">
    <h2>เข้าสู่ระบบ</h2>
    <form method="post" action="Lab12_Login.php">
        <label>Username:</label> 
        <input type="text" name="username" required><br><br>
        <label>Password:</label> 
        <input type="password" name="password" required><br><br><br><br>
        <input class="button" type="submit" value="Login" >
        <input class="button" type="button" value="Cancel" >
    </form>
</div>


</body>
</html>
