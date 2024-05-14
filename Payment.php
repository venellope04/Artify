<?php

if(isset($_POST['insert']))
{
    $conn=mysql_connect("localhost","root","");
    mysql_select_db("artify");
    // echo "Connected"."</br>";
    

    $ufname=$_POST['fname'];
    $uaddr=$_POST['addr'];
    $uemail=$_POST['email'];
    $uphone=$_POST['phone'];

    
    // echo $utype,$uname,$usecans,$upass;
    $sql="INSERT INTO `payment`(`Ufname`, `UAddr`, `UEmail`, `UPhone`) VALUES ('$ufname','$uaddr','$uemail','$uphone')";
    
     if(mysql_query($sql,$conn))
    {
        echo "<script>alert('Information added successful');</script>";
        echo ("<script LANGUAGE='JavaScript'>window. location. href='Card.html';</script>");
    }
    else
    {
        echo "<script>alert('Something is wrong please enter again');</script>";
        echo ("<script LANGUAGE='JavaScript'>window. location. href='Payment.html';</script>");
    }
}
mysql_close($conn);

?>