<?php


$rollStart= $_SESSION['rollStart'];
$rollEnd= $_SESSION['rollEnd '];
$course=$_SESSION['course'] ;

$datatable ="attendance";
       

$days = ['Saturday','Sunday','Monday','Tuesday' ,'Wednesday'];
global $id,$con;

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
    <title>Result sheet</title>

    
</head>
<body>



<div class="list">
        <h3 style="text-align: center;">Attendance Sheet</h3>
        <h5 style="text-align: center;">Course Code : <?php echo $dv['ccode']?></h5>
              <h5 style="text-align: center;">Course Name : <?php echo $dv['cname'] ?></h5>
        <h5 style="text-align: center;">Roll range : <?php echo $rollStart ?> to <?php echo $rollEnd ?></h5>
    </div>

        <div class="outer-wrapper" width=100% >
            <div class="table-wrapper"  width=100%>
            <table class="table table-striped table-bordered"  width=100% style="margin: 10px;">
                <tr>
                    <td><h5>Roll</h5></td>
                    <?php 
                    for($j=1;$j<=15;$j++)
                    {
                        foreach($days as $k)
                        {
                            $s10 = "select * from $datatable where day='$k' && cycle='$j' && cid='$course' && roll>='$rollStart' && roll<='$rollEnd'";
                            $result10 = mysqli_query($con,$s10);
                            $num10 = mysqli_num_rows($result10);

                            if( $num10 != 0)
                            {echo "<td ><h5>$j $k[0]$k[1]$k[2]</h5></td>"; }
                            
                        }


                    } 
                    ?>
                
                    <td><h5>Present</h5></td>
                    <td><h5>Percentage</h5></td>
                </tr>

        <?php
        for($i=$rollStart;$i<=$rollEnd;$i++)
        {
            echo "<tr>";
            echo "<td><h5>$i</h5></td>";

            $total=0;
            $prsnt=0;

            for($j=1;$j<=15;$j++)
            {
                $zz=0;
                foreach($days as $k)
                { 
                    $s10 = "select * from $datatable where day='$k' && cycle='$j' && cid='$course' && roll>='$rollStart' && roll<='$rollEnd'";
                    $result10 = mysqli_query($con,$s10);
                    $num10 = mysqli_num_rows($result10);
                    
                    if($num10 != 0)
                    {
                                    
                    $s = "select * from $datatable where day='$k' && cycle='$j' && cid='$course' && roll='$i'  ORDER BY id DESC";
                    $result = mysqli_query($con,$s);
                    $num = mysqli_num_rows($result);
                    $ans=0;

                    $total++;
                    if($num==0)
                    {
                        echo "<td></td>";
                        continue;
                    }
                  
                    
                    $var = mysqli_fetch_assoc($result);
                    $ans=$var['attendance'];
                    $tcrName=$var['teacher'];
    
                    
                    if($ans==1)
                    {
                        $prsnt++;
                    }
                    echo "<td title='$tcrName'>$ans</td>";

                    }
                    
                    
                } 
    
            }
            //echo "<td>$total</td>";
            echo "<td>$prsnt</td>";
            if($total==0)
            {
                $percentage=0;
            }
            else
            {
                $percentage=round(($prsnt/$total)*100,2);
            }
            echo "<td>$percentage%</td>";
            echo "</tr>";
            
        }

        ?></table>
        </div>
        </div>
        






</body>
</html>