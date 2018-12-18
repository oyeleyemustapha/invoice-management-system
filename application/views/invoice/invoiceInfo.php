<?php

if($invoice){
  

  if($invoice[0]->STATUS=="PAID"){
    $status="<span class='badge badge-primary'>PAID</span>";
  }
  else{
     $status="<span class='badge badge-warning'>NOT PAID</span>";
  }



    echo'
<div class="pull-left">

<img src="assets/images/fra.png">
</div>

    <div class="pull-right invoiceInfodetails">
      <p>CLIENT : <span>'.$invoice[0]->NAME.'</span></p>
      <p>REFERENCE NO : <span>'.$invoice[0]->REF_NO.'</span></p>
      <p>DATE CREATED : <span>'.date('F d, Y',strtotime($invoice[0]->DATE_CREATED)).'</span></p>
      <p>DUE DATE : <span>'.date('F d, Y',strtotime($invoice[0]->DUE_DATE)).'</span></p>
      <p>STATUS : '.$status.'</p>


    </div>
    <table class="table table-hover">
  <thead>
    <tr>
      <th>ID</th>
      <th>SERVICE</th>
      <th>DESCRIPTION</th>
      <th>AMOUNT</th>
    </tr>
  </thead>
  <tbody>


    ';

    $counter=1;
    $total=0;

  foreach ($invoice as $invoice) {
    $total+=$invoice->AMOUNT;
    echo"
      <tr>
      <td>$counter</td>
      <td>$invoice->SERVICE</td>
      <td>$invoice->DESCRIPTION</td>
      <td>&#8358; ".number_format($invoice->AMOUNT, 2)."</td>
    </tr>
  


    ";


    $counter++;
  }


  echo "<tr class='total'>
  <td colspan=2>TOTAL<td>
  <td>&#8358; ".number_format($total, 2)."</td>

  <tr>";

  echo'</tbody></table>';
       
    
}



?>


    