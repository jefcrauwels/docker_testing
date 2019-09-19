<h1>Hello !</h1>
<h4>Attempting MySQL connection from php...</h4>
<?php
$host = 'mysql';
$user = 'root';
$pass = 'rootpassword';
$database = 'dbtest';

$conn = new mysqli($host, $user, $pass, $database);
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

$conn->close();

?>