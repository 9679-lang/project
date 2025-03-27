<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROJECT</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
     <div class="container my-5">
        <h2>List of members</h2>
        <a class="btn btn-primary" href="/project/create.php" role="button">New member</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>membership_id</th>
                    <th>name</th>
                    <th>email</th>
                    <th>phone</th>
                    <th>address</th>
                    <th>membership</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username ="root";
                $password = "";
                $database = "project";

                //create connection
                $connection = new mysqli($servername, $username, $password, $database);

                //check  connection
                if ($connection->connection_error)
                {
                    die ("connection failed:" . $connection->connect_error);
                }

                //read all row from database table
                $sql = "SELECT * FROM workers";
                $result = $connection->query($sql);

                if (!$result){
                    die("invalid query:" . $connection->error);
                }

                //read data of each row
                while($row=$result->fetch_assoc()){
                    echo"
                    <tr>
                        <td>$row[membership_id]</td>
                        <td>$row[name]</td>
                        <td>$row[email]</td>
                        <td>$row[phone]</td>
                        <td>$row[address]</td>
                        <td>$row[membership]</td>
                        <td>
                             <a class='btn btn-primary btn-sm' href='/project/edit.php?membership_id=$row[membership_id]'>Edit</a>
                             <a class='btn btn-danger btn-sm' href='/project/delete.php?membership_id=$row[membership_id]'>Delete</a>
                        </td>
                    </tr>
                    ";
                }
                ?>
                
             </tbody>
        </table>
    </div>
</body>
</html>