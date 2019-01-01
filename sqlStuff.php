<?php
  $serverName = "sql1.njit.edu";
  $userName = "ma895";
  $password = "mSwMX8YJ";
  $dBName = 'ma895';
  
  //This creates a new connection
  $conn = new mysqli($serverName, $userName, $password,$dBName);
  
  //Checks to see if the connnection failed 
  if ($conn->connect_error){
    die("Connection failed: " . $conn->error);  
  }
  //echo "The connection was successful\n";  
   
  $fakeName = 'ab123';    //Test Variables 
  $fakePass = 'Manch786329';
  
  $fakeNameStudent1 = 'Ma123';
  $fakePassS1 = 'jeb411';
  
  $fakeNameStudent2 = 'Na123';
  $fakePassS2 = 'jake511';
  
  $hashedPass = protect($conn,md5($fakePass));  //Hashing the password and protecting from injections
  $hashedPassS1 = protect($conn,md5($fakePassS1));
  $hashedPassS2 = protect($conn,md5($fakePassS2));
  
  
  
  $sql = "INSERT into StudentTable(UsernameS,PasswordS) VALUES ('$fakeNameStudent1','$hashedPassS1'), ('$fakeNameStudent2','$hashedPassS2')";
  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
  
  function protect($conn,$string){
    $string = mysqli_real_escape_string($conn,trim(strip_tags($string)));  //This is to protect against of injections and other hazards
    return $string;
  } 
 
  $conn->close();
  
?>