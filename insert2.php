<?php
$name='name';
$sql = "INSERT INTO tbl_chat (Name)
VALUES ('name')";

if ($conn->query($sql) === TRUE) {
    echo "Welcome,.$name.,to fitbot";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>