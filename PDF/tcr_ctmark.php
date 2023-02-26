
<?php

$rollStart= $_SESSION['rollStart'];
$rollEnd= $_SESSION['rollEnd '];
$course=$_SESSION['course'] ;


$datatable='marks';
$ds = "SELECT * From courselist WHERE cid=$course";
$dr = mysqli_query($con,$ds);
$dv = mysqli_fetch_assoc($dr);





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  text-align: center;
}

    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CT marks sheet</title>

    
</head>
<body>


              <h3 style="text-align: center;">CT marks</h3>
              <h5 style="text-align: center;">Course Code : <?php echo $dv['ccode']?></h5>
              <h5 style="text-align: center;">Course Name : <?php echo $dv['cname'] ?></h5>
              <table width=100% >
                <tr>
                    <td>Roll</td>
                    <?php 
                    for($j=1;$j<=4;$j++)
                    {
                        
                        echo "<td >CT-$j </td>"; 
                        
                    } 
                    ?>
                    <td>best of three avg.</td>
                </tr>

        <?php
        for($i=$rollStart;$i<=$rollEnd;$i++)
        {
            echo "<tr>";
            echo "<td>$i</td>";

            $marksList=array(6);
            for($j=0;$j<=5;$j++)
            {
                $marksList[$j]=0;
            }
            
            for($j=1;$j<=4;$j++)
            {
                $ans=0;              
                    $s = "select * from $datatable where ctNo='$j' && cid='$course' && roll='$i' ORDER BY id DESC ";
                    $result = mysqli_query($con,$s);
                    $num = mysqli_num_rows($result);
                    

                    if($num==0)
                    {
                        echo "<td></td>";
                        continue;
                    }
    
                    else
                    {
                        $var = mysqli_fetch_assoc($result);
                        
                        $ans=$var['marks'];
                        $tcrName=$var['teacher'];
                        echo "<td title='$tcrName'>$ans</td>";  
                        if($ans=='A')
                        {
                            $ans=0;
                        }
                        
                    }
                     
                    $marksList[$j]=$ans;     
    
            }


            rsort($marksList);
            $ans=$marksList[0]+$marksList[1]+$marksList[2];

            $m=ceil($ans/3);
            echo "<td>$m</td>";
            echo "</tr>";
            
        }


        
        $_SESSION['rollStart']= $rollStart;
        $_SESSION['rollEnd ']= $rollEnd ;
        $_SESSION['course']= $course;
        $_SESSION['pdf']='tcr_ctmark.php';

        ?></table>
             
     
    






</body>
</html>