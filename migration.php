<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flip";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // sql to create table
    $sql = "CREATE TABLE disbursement (
			  id varchar(25) NOT NULL PRIMARY KEY,
			  amount int(11) NOT NULL,
			  status varchar(20) DEFAULT NULL,
			  bank_code varchar(10) NOT NULL,
			  account_number varchar(25) NOT NULL,
			  beneficiary_name varchar(50) DEFAULT NULL,
			  remark varchar(50) NOT NULL,
			  receipt varchar(255) DEFAULT NULL,
			  time_served datetime DEFAULT NULL,
			  fee int(11) DEFAULT NULL,
			  created_at datetime DEFAULT CURRENT_TIMESTAMP
			)";

    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Table disbursement created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;