<?php
session_start();
session_destroy(); // ทำลายเซสชันทั้งหมด

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

        .hover-link {
            text-decoration: underline;
            text-align: right;
            color: #831b1b;
            font-weight: bold;
            transition: color 0.3s ease-in-out;
        }
        .hover-link:hover {
    color:rgb(75, 107, 148); /* เปลี่ยนเป็นสีแดงเมื่อเอาเมาส์ไปชี้ */
}

    </style>
</head>

<body>

<div id="stylized">
    <b>ออกจากระบบ!!</b>
    <b class="hover-link" onclick="window.location.href='Lab12_Login.php';">ลงชื่อเข้าใช้อีกครั้ง</b>
</div>


</body>
</html>
