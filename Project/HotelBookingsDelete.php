<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="" />

	<title>HOTELBOOKINGS</title>
     <link rel="stylesheet" type="text/css" href="css.css" />
    <style>
.button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 10px 28px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
</style>



  <style>
  body {
    background-image: url('bg1.jpg');
    background-repeat: no-repeat;
    background-attachment: fixed; 
    background-size: 100% 100%;
  }
  </style>
  

</head>

<body bgcolor="">
<center>

<marquee><h1 class="impact"style="color:black;"><b><i>MEDTOUR</i></b></h1></marquee>

<h1 class="impact" style="color:black;"><b>HOTELBOOKINGS INFORMATION</b></h1>
<h1 class="impact" style="color:black;"><b>Show Data</b></h1>

<table align="center" cellpadding="10" bgcolor="white" style="border:1px solid black" bordercolor="#D7DF01">
<tr> 
<td><a href='index.html'><h1>Home</h1></a></td>
</tr>
<tr>

<th>Package Code</th>
<th>Patient Id</th>
<th>Hospital Code</th>
<th>Book From</th>
<th>Book To</th>
<th>Actions</th>
</tr>


<?php

/**
 * @author lolkittens
 * @copyright 2023
 */

$con=mysql_connect("localhost","root","");
if($con)
{
   // echo "Connected to MySQL"."<br/>";
}
mysql_selectdb("medtour");
$sql="select * from hotelbookings";
$result=mysql_query($sql,$con);

while($row=mysql_fetch_array($result))
{
   
    $DB_PackageCode=$row['pcode'];
    $DB_PatientId=$row['paid'];
    $DB_HospitalCode=$row['HCode'];
    $DB_BookFrom=$row['bkfrom'];
    $DB_BookTo=$row['bkto'];
    
?>

<tr>

<tr>
<tr>
<tr>
<td><?php echo $DB_PackageCode;?></td>
<td><?php echo $DB_PatientId;?></td>
<td><?php echo $DB_HospitalCode;?></td>
<td><?php echo $DB_BookFrom;?></td>
<td><?php echo $DB_BookTo;?></td>
<td><a href="HotelbookingsDeleteDetails.php?paid=<?php echo $DB_PatientId;?>">Delete</a></td>
</tr>

<?php
}
mysql_close($con);
?>

</table>
</center>
</body>
</html>
