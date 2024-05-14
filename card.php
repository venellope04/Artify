<?php

if(isset($_POST['insert']))
{
    $conn=mysql_connect("localhost","root","");
    mysql_select_db("artify");
    // echo "Connected"."</br>";
    
    $cdno=$_POST['Card number'];
    $mmyy=$_POST['MM/YY'];
    $cvv=$_POST['CVV'];
    $uemail=$_POST['email'];
    
    // echo $utype,$uname,$usecans,$upass;
    $sql="INSERT INTO `card`(`cdno`, `mmyy`, `cvv`, `email`) VALUES ('$cdno','$mmyy','$cvv','$uemail')";
    
     if(mysql_query($sql,$conn))
    {
        echo "<script>alert('Payment successful');</script>";
        echo ("<script LANGUAGE='JavaScript'>window. location. href='index.html';</script>");
    }
    else
    {
        echo "<script>alert('Something is wrong please register again');</script>";
        echo ("<script LANGUAGE='JavaScript'>window. location. href='Registration.html';</script>");
    }
}
mysql_close($conn);

?>