<?php
require("logincheck_A.php");
include("config.php");
?>
<!DOCTYPE html>

<html lang="en">

<head>

    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/styles.css">

</head>

<body>

<?php include 'nav & footer/adminNav.php' ?>

<header>

</header>

<div class="container features">
    <div class="row center">
        <div class="col-md-6">
            <h3 class="feature-title">Change Password</h3>
            <form method="post">
                <div class="form-group">Patient Number:
                    <input type="text" class="form-control"  name="pNO" required>
                </div>
                <div class="form-group"> NIC Number:
                    <input type="number" class="form-control"  name="pNIC" required>
                </div>
                <div class="form-group"> New password:
                    <input type="password" class="form-control"  name="pNPW" required>
                </div>
                <div class="form-group"> Reenter the new password:
                    <input type="password" class="form-control"  name="pRNPW" required>
                </div>
                <input type="submit" class="btn btn-secondary btn-block" value="Reset password" name="reset">
            </form>
        </div>
    </div>
</div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["reset"])) {
        try {
            $pNum=$_POST["pNO"];
            $conn = new PDO($db, $un, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = $query = "SELECT `PID`,`NIC` FROM `Patients` where `PID`=$pNum";
            $st = $conn->prepare($query);
            $st->execute();
            $result = $st->fetch();

            if($result [0] ==$_POST["pNO"] && $result [1] ==$_POST["pNIC"]){


                if ($_POST["pNPW"] == $_POST["pRNPW"]){

                    $conn = new PDO($db, $un, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $query = "UPDATE `Patients` SET `password`=? Where `PID`=$pNum";
                    $st = $conn->prepare($query);
                    $npw =md5($_POST["pNPW"]);
                    $st->bindValue(1, $npw, PDO::PARAM_STR);
                    $st->execute();
                    echo "<script> alert('Password updated Successfully!');</script>";
                }else{
                    echo "<script> alert('The reentered password dose not match to the new password! ');</script>";
                }


            }
            else{
                echo '<script>alert("Patient number & the NIC does not match!")</script>';

            }
//            $pw =md5($_POST["pOPW"]);
//
//            if($pw== $result[0])
//            {
//
//            }
//            else{
//                echo '<script>alert("Enter the correct old password")</script>';
//            }

        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }
}
?>


<img src="images/home.png" class="img-bg">
<?php include 'nav & footer/footer.php' ?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>


</body>

</html>