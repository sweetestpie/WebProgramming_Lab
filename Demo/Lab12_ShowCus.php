<?php

session_start();

// เชื่อมต่อฐานข้อมูล
$mysqli = new mysqli("localhost", "root", "1234", "mystore");

// ตรวจสอบการเชื่อมต่อ
if ($mysqli->connect_errno) {
    die("Failed to connect: " . $mysqli->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare statement for deletion
    $stmt = $mysqli->prepare("DELETE FROM Customer WHERE Customer_id = ?");
    $stmt->bind_param("s", $id);
    
    if ($stmt->execute()) {
        echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว'); window.location='Lab12_ShowCus.php';</script>";
        exit(); // หยุดการทำงานหลังจากลบเสร็จ
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดในการลบข้อมูล');</script>";
    }

    $stmt->close();
}

// ดึงข้อมูลลูกค้าจากฐานข้อมูล
$query = "SELECT * FROM Customer";
$result = $mysqli->query($query);

// ตรวจสอบผู้ใช้ล็อกอิน
if (isset($_SESSION['username'])) {
    // หากล็อกอินแล้ว แสดงชื่อผู้ใช้จาก session
    $username = $_SESSION['Customer_Name'] . " " . $_SESSION['Customer_Lastname'];
}

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

        #stylized {
            width: 600px;
            padding: 40px;
            margin: 100px auto;
            background-color: rosybrown;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        h2 {
            color: #831b1b;
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        .edit-btn, .delete-btn {
            cursor: pointer;
            padding: 5px 10px;
            background-color: #ffcc00;
            border: none;
            border-radius: 5px;
        }

        .delete-btn {
            background-color: #ff5555;
            color: white;
        }

        .user-container {
            display: flex;
            justify-content: space-between;  /* จัดให้อยู่ซ้าย-ขวา */
            align-items: center;  /* จัดให้อยู่ตรงกลางแนวตั้ง */
            width: 100%;
            margin-bottom: 10px;
        }

        .NameUser {
            color:#831b1b;
            cursor: pointer;
        }

        .add-link {
            color: #831b1b;
            text-decoration: underline;
            cursor: pointer;
        }

    </style>
</head>
<body>

<div id="stylized">
    
<div class="user-container">
    <b class="NameUser">ชื่อผู้ใช้ : <?php echo htmlspecialchars($username); ?></b>
    <b class="add-link" onclick="window.location.href='Lab12_Logout.php';">Logout</b>
</div>

 
    <h2>ข้อมูลลูกค้า</h2>
    <p style="text-align: right;"class="add-link" onclick="window.location.href='Lab12_add_customer.php';">เพิ่มข้อมูลลูกค้า</p>
    <table>
        <tr>
            <th>ID</th>
            <th>ชื่อ - สกุล</th>
            <th>จังหวัด</th>
            <th>โทรศัพท์</th>
            <th>แก้ไข</th>
            <th>ลบ</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['Customer_id']; ?></td>
                <td><?php echo $row['Customer_Name'] . " " . $row['Customer_Lastname']; ?></td>
                <td><?php echo $row['Province']; ?></td>
                <td><?php echo $row['Telephone']; ?></td>
                <td><button class="edit-btn" onclick="window.location.href='Lab12_Edit.php?id=<?php echo $row['Customer_id']; ?>'">แก้ไข</button></td>
                <td><button class="delete-btn" onclick="confirmDelete(<?php echo $row['Customer_id']; ?>)">ลบ</button></td>
            </tr>
        <?php } ?>

    </table>
</div>

<script>
    function confirmDelete(id) {
        if (confirm("คุณต้องการลบข้อมูลนี้ใช่หรือไม่?")) {
            window.location.href = "Lab12_ShowCus.php?id=" + id;
        }
    }
</script>

</body>
</html>

<?php
$mysqli->close();
?>
