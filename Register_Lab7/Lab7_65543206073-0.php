<?php
session_start();

// Initialize error message variable
$errorMessage = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the form data
    $formData = array_map('trim', $_POST);

    // Validate form data and set error message if needed
    if (in_array("", $formData, true)) {
        $errorMessage = "กรุณากรอกข้อมูลให้ครบทุกช่อง";
    } elseif ($formData['pwd'] !== $formData['Conpwd']) {
        $errorMessage = "รหัสผ่านไม่ตรงกัน!!";
    } elseif (!isset($formData['AgreeCK'])) {
        $errorMessage = "กรุณายอมรับเงื่อนไข!!";
    } elseif (strtotime($formData['Birth']) >= strtotime(date('Y-m-d'))) {
        $errorMessage = "วันเกิดไม่ถูกต้อง!!";
    }

    // Store the error message in session for the next page load
    if ($errorMessage !== "") {
        $_SESSION['errorMessage'] = $errorMessage;
    }else {
        // If no error, clear the session error message
        unset($_SESSION['errorMessage']);
        $queryString = http_build_query($_POST);
        header("Location: Show_register.php?$queryString");
        exit;
    }
} else {
    // Retrieve error message from session if it exists
    $errorMessage = isset($_SESSION['errorMessage']) ? $_SESSION['errorMessage'] : "";
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

        div {
            width: 600px;
            padding: 40px;
            margin: 100px auto;
            background-color: rosybrown;
        }
        #stylized {
            border: 15px solid wheat;
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

        h2:first-letter {
            font-size: xx-large;
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
</head>

<body>



<div id="stylized">
    <fieldset>
        <legend>
            <h2>Personal Info</h2>
        </legend>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label>First Name :</label> <input type="text" name="Name"><br><br>
            <label>Last Name :</label> <input type="text" name="LName"><br><br>
            <label>Gender :</label>
            <label style="display:flex; width: 100px; "><input type="radio" name="Gender" value="Male">Male
            <input type="radio" name="Gender" value="Female">Female</label>
            <br><br>
            <label>Birth :</label> <input type="date" name="Birth">
    </fieldset>

    <fieldset>
        <legend>
            <h2>Account Info</h2>
        </legend>
            <label>Username :</label> <input type="text" name="User"><br><br>
            <label>Password :</label> <input type="password" name="pwd"><br><br>
            <label>Confirm Password :</label> <input type="password" name="Conpwd"><br><br>
            <label>Email :</label> <input type="text" name="Email"><br><br>
            <input style="width: 20px;" type="checkbox" name="AgreeCK" value="Agree"> I agree to the Terms of Service and Privacy Policy.
            <br><br><br><br>
            <input class="button" type="submit" value="Submit" name="submit">
        </form>
    </fieldset>
</div>


<div id="customPopup" style="display: <?php echo $errorMessage ? 'flex' : 'none'; ?>">
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

<a href= "../index.html"> BACK </a>
</body>
</html>
