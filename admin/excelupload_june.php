<?php


require('excel_reader.php');
require('library/SpreadsheetReader.php');
require('db_config.php');


if(isset($_POST['Submit'])){


  $mimes = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.oasis.opendocument.spreadsheet'];
 // if(in_array($_FILES["file"]["type"],$mimes)){


    $uploadFilePath = 'uploads/'.basename($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath);


    $Reader = new SpreadsheetReader($uploadFilePath);


    $totalSheet = count($Reader->sheets());


    echo "You have total ".$totalSheet." sheets".


    $html="<table border='1'>";
    $html.="<tr><th>sl</th><th>cname</th><th>description</th><th>Priority</th><th>Translation type</th><th>recev_dt</th><th>pages</th><th>due_dt</th>"
            . "</tr>";

            

    /* For Loop for all sheets */
    for($i=0;$i<$totalSheet;$i++){


      $Reader->ChangeSheet($i);

$st=0;
      foreach ($Reader as $Row)
      {
         if($st>0)
         {
        $html.="<tr>";
        $sl = isset($Row[0]) ? $Row[0] : '';
       $name = isset($Row[0]) ? $Row[0] : '';
        $des = isset($Row[3]) ? $Row[3] : '';
        
        $tr_type = isset($Row[4]) ? $Row[4] : '';
         $re_dt = isset($Row[5]) ? $Row[5] : '';
          $page=isset($Row[13]) ? $Row[13] : '';
          $due_dt = isset($Row[7]) ? $Row[7] : '';
          $amt = isset($Row[9]) ? $Row[9] : '';
          $paid=isset($Row[14]) ? $Row[14] : '';
          
          
          
        $html.="<td>".$sl."</td>";
        $html.="<td>".$name."</td>";
         $html.="<td>".$des."</td>";
          $html.="<td>---</td>";
        $html.="<td>".$tr_type."</td>";
        $html.="<td>".$re_dt."</td>";
        $html.="<td>".$page."</td>";
        $html.="<td>".$due_dt."</td>";
         $html.="<td>".$amt."</td>";
         $html.="<td>".$paid."</td>";
        $html.="</tr>";

  echo $html;
  $html="";
  $paid=strtolower($paid);
  $paid=str_replace(' ','', $paid);
          
          if($paid=='paid')
          {
  $str=100;
                  $bal=0;
  
          }
          else{
                $str=0;
                  $bal=$amt;
          }
        $pro=$mysqli->query("SELECT AUTO_INCREMENT FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'newerp' AND   TABLE_NAME = 'formdatas'");
$pro_id=mysqli_fetch_row($pro);

                                         
                 $nextId = ($pro_id[0])+1050;
                 //echo $Row[5];
                
                // $dt=strtotime($Row[5]);
                 // $dt1=date("d/m/Y", $dt);
                 // echo $dt;
               // $dt =date($dt);
               // $dt=date("dmY", $dt);
             // echo $dt;
                 
                  
//$ddd= strtotime($re_dt);  
//$d5=date('Y/m/d', $ddd);

$db_dt= explode('/', $re_dt);

 


 $db_dt_r=$db_dt[2]."/".$db_dt[1]."/".$db_dt[0];
 
 
 $db_dt= explode('/', $due_dt);
 $db_dt_d=$db_dt[2]."/".$db_dt[1]."/".$db_dt[0];
 
$dt=str_replace('/','', $re_dt);
               
           // echo $dt;

               $nextId="$dt"."$nextId";
               $nextId_t="NIT-TD".$nextId;
               
               
               $pro=$mysqli->query("SELECT AUTO_INCREMENT FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA ='newerp' AND   TABLE_NAME = 'invoices'");
$pro_id=mysqli_fetch_row($pro);

                                         
                 $nextId_ino = ($pro_id[0])+1050;
               
               $ino="NIT-IN".$dt.$nextId_ino;
               
                $p=$mysqli->query("SELECT * from clients where name='$name' ");
if((mysqli_num_rows($p))==0)
{
       $pro=$mysqli->query("SELECT AUTO_INCREMENT FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'newerp' AND   TABLE_NAME = 'clients'");
$pro_id=mysqli_fetch_row($pro);
$cl_no = ($pro_id[0])+1000;
               
               $cl_no="CL".$cl_no;
               
              

$query3 ="INSERT INTO `clients`( `client_no`, `name`, `address`, `phone`, `email`, `bank`, `SWIFT_BIC`, `IBAN`, `ac_no`, 
    `currency`, `b_address`) 
        VALUES('$cl_no','$name','---','000','0','0','0','0','0','0','0')";
 $mysqli->query($query3);
}
else
    {
    $f=mysqli_fetch_array($p);
    $cl_no=$f['client_no'];
}


       
//        $html.="<td>".$title."</td>";
//        $html.="<td>".$description.$nextId_t."</td>";
//        $html.="</tr>";

               
               

        $query = "insert into formdatas( `form_no`, `quotation_number`, `invoice_no`, `client_no`, `priority`, `target`,"
                . " `received_date`, `total_amount`, `vat`, `st`, `str`, `balance`)"
               // . " values('$nextId_t','0','$ino','0','normal','','$re_dt','$tot','0','0','0','$re_dt')";
                . " values('$nextId_t','0','$ino','$cl_no','normal','','$re_dt','$amt','0','0','$str','$bal')";
        $mysqli->query($query);
$pize_Per=$amt/$page;
$query1 = "INSERT INTO `works`(`quotation_no`, `invoice_no`, `form_no`, `client_no`, `type_form`, `type_to`, `no_of_page`, `prize_per_page`, `w_total_cost`, `delivery_dt`, `translation_type`, `discription`,`w_vat`, `w_st`) "
        . "VALUES('0','$ino','$nextId_t','$cl_no',"
        . "'---','---','$page','$pize_Per','$amt',"
        . "'$re_dt','$tr_type','$des','0','0')";
$mysqli->query($query1);
 //echo $query1;


$query2 ="INSERT INTO `invoices`(`id`, `invoice_no`, `quatation_no`, `client_no`, `total_amount`, `vat`, `received_date`) 
        VALUES('0','$ino','0','$cl_no','$amt','0','$re_dt')";


 
        
$paid=strtolower($paid);
$paid=str_replace(' ','', $paid);
        $mysqli->query($query2);
        if($paid=='paid')
        {
            
             $pro=$mysqli->query("SELECT AUTO_INCREMENT FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'newerp' AND   TABLE_NAME = 'receipts'");
$pro_id=mysqli_fetch_row($pro);
 
               $nextId_rno = ($pro_id[0])+1050;
               $r_no="NIT-RC".$dt.$nextId_rno;
               echo $page;
$query4 ="INSERT INTO `receipts`(`receipt_no`, `client_no`, `quotation_no`, `invoice_no`, `form_no`, `date`, `purpose`,
    `no_of_page`, `total_amount`,`st`,`transation_type`)
        VALUES('$r_no','$cl_no','0','$ino',"
        . "'$nextId_t','$re_dt','translation fee','$page','$amt','0','Cash')";
//echo"$query4";
        
       
        $mysqli->query($query4);
        mysqli_error($mysqli);
              
            
        }
        
        
       }
       $st++;
      }

    }


    $html="</table>";
    echo $html;
    echo "<br />Data Inserted in dababase";


// }else { 
    //die("<br/>Sorry, File type is not allowed. Only Excel file."); 
 // }


}


?>