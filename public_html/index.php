<h1>Hello !</h1>
<h4>Attempting MySQL connection from php...</h4>
<?php
$host = 'mysql';
$user = 'root';
$pass = 'rootpassword';
$database = 'myDB';
$conn = new mysqli($host, $user, $pass, $database);

if ($conn->connect_error) {
    $sql = "CREATE DATABASE myDB";
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully" . "<br>";
    } else {
        echo "Error creating database: " . $conn->error;
    }
}else {
    echo "Connected to MySQL successfully!" . "<br>";
}

$sql = "CREATE TABLE MyGuests (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    if (mysqli_query($conn, $sql)) {
        echo "Table MyGuests created successfully" . "<br>";
    } else {
        echo "Error creating table: " . $conn->error;
    }

$sql = "INSERT INTO MyGuests (firstname, lastname, email)
    VALUES ('John', 'Doe', 'john@example.com')";
    
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully" . "<br>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

$sql = "SELECT id, firstname, lastname FROM MyGuests";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();

?>