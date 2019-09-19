<html>
<body>
<h1>Hello !</h1>
<h4>Attempting MySQL connection from php...</h4>
<?php
$dbhost = 'docker-testing.c0zph1cbtbhd.eu-west-1.rds.amazonaws.com';
$dbport = '3306';
$dbname = 'dbtest';
$charset = 'utf8' ;
$username = 'root';
$password = 'rootpassword';

$conn = new mysqli($dbhost, $username, $password, $dbname, $dbport);

    if ($conn->connect_error) {
        echo "Error connection to database: " . $conn->error;
    }else {
        echo "Connected to MySQL successfully!" . "<br><br><br>";
    }

$sql = "SELECT * FROM MyGuests";
$result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Information in <b>testdb</b>, <b>MyGuests</b> table:". "<br>";
        while($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. " " . $row["mail"]. " " . $row["reg_date"] . "<br>";
        }
    } else {
        echo "0 results";
    }

if(isset($_POST['save']))
{
    $sql = "INSERT INTO users (firstname, lastname, email)
    VALUES ('".$_POST["firstname"]."','".$_POST["lastname"]."','".$_POST["email"]."')";

    $result = mysqli_query($conn,$sql);
}

if(!$result) 
        { echo mysqli_error(); }
    else
    {
        echo "Successfully Inserted <br />";
    }

$conn->close();

?>

<form action="index.php" method="post"> 
<label id="first"> First name:</label><br/>
<input type="text" name="firstname"><br/>

<label id="first"> Last name:</label><br/>
<input type="text" name="lastname"><br/>

<label id="first">Email:</label><br/>
<input type="text" name="email"><br/>

<button type="submit" name="save">save</button>

</form>

</body>
</html>
