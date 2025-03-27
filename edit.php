<?php

$servername = "localhost";
$username = "root";
$password ="";
$database = "project";

$connection = new mysqli ($servername, $username, $password, $database);

$membership_id="";
$name = "";
$email = "";
$phone = "";
$address = "";

$errorMessage="";
$sucessMessage="";

if ($_SERVER['REUEST_METHOD']=='GET'){
    //GET method :Show the data of the member
    if (!isset($GET["membership_id"])){
        header("location:/project/index.php");
        exit;
    }

    $membership_id=$_GET["membership_id"];

    $sql = "SELECT * FROM workers WHERE membership_id=$membership_id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if(!row){
        header("location:/project/index.php");
        exit;

        $name = $row["name"];
        $email = $row["email"];
        $phone = $row["phone"];
        $address = $row["address"];

    }
}
else{
    //POST method : Update the data of the member
    $membership_id = $_POST["membership_id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    do{
        if(empty($membership_id)||empty($name)|| empty($email)||empty($phone)||empty($address)){
            $errorMessage = "All the fields are required";
            break;

    }while(false);

    $sql = "UPDATE workers" . "SET name = '$name', email='$email', phone='$phone', address='$address'" . "WHERE membership_id = $membership_id";
    $result = $connection->query($sql);

    if(!$result){
        $errorMessage = "Invalid query:" . $connection->error;
        break;
    }

    $sucessMessage = "Client updated correctly";

    header("location: /project/index.php");
    exit;

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>project</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>new member</h2>
        
        <?php
        if(!empty($errorMessage)){
            echo"
            <div class ='alert alert-warning alert-dismissible fade show' role='alert'>
                 <strong>$errorMessage</strong>
                 <button type="button" class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }

        ?>

        <form method="post">
            <input type="hidden" name="membership_id" value="<?php echo $membership_id;?>">
            <div class="row mb-3">
                <label class="col-sm-6 col-form-label">name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-6 col-form-label">email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-6 col-form-label">phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-6 col-form-label">address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $address;?>">
                </div>
            </div>

            <?php
            if(!empty($sucessMessage)){
                echo"
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class ='alert alert-warning alert-dismissible fade show' role='alert'>
                            <strong>$sucessMessage</strong>
                            <button type="button" class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                 </div>
                 ";

            }
           ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/project/index.php" role="button">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>