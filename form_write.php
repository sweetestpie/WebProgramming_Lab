<?php 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $NameWr = $_POST['Name_wr'];
    $SurnameWr = $_POST['SurName_wr'];

    $myfile = fopen("myfile.txt", "w") or die("Unable to open file!!");

    $txt = "My Name is $NameWr\n";
    fwrite($myfile, $txt);

    $txt = "My SurName is $SurnameWr\n";
    fwrite($myfile, $txt);

    fclose($myfile);

    $_SESSION["file_created"] = true;

    header("Location: form_write.php");
    exit();
}
?>
<script>
    window.onload = function() {
      
        <?php
        if (isset($_SESSION["file_created"])) {
            echo 'window.open("myfile.txt", "_blank");';
            unset($_SESSION["file_created"]); 
        }
        ?>
    }
</script>

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
            left: 50%;
            transform: translate(-50%, -50%);
            width: 30px;
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
    <h2>Form-Write</h2>
    <form method="post">
        <label>Name:</label> 
        <input type="text" name="Name_wr" required><br><br>
        <label>Surname:</label> 
        <input type="text" name="SurName_wr" required><br><br><br><br>
        <input class="button" type="submit" value="Save" >
    </form>
</div>


<a href= "index.html"> BACK </a>
</body>
</html>
