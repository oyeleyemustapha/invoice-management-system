<!DOCTYPE html>
<html>
<head>
  <title>Reports | <?php echo $date; ?></title>

<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css" />


<style type="text/css">
  
@media print{


  html, body{
    background: #fff;
  }

  .table>tbody>tr>td, .table>tfoot>tr>td, .table>thead>tr>td {
    padding: 3px;
    border: 1px solid #000 !important;
  }

  .table-bordered thead th {
    border-bottom-width: 2px;
    background: transparent !important;
    color: #000 !important;
    font-weight: 600 !important;
}

.table-bordered th {
    border: 1px solid #000 !important;
}
}


.reportTable{
  padding:2em;
}
</style>
</head>
<body>
  <div class="reportTable">


    <?php

      if($report){
        echo'

        <h1 class="text-center">Report for '.$date.'</h1>
           <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>CLIENT</th>
        <th>REF NO</th>
        <th>DATE CREATED</th>
        <th>SERVICE</th>
        <th>AMOUNT</th>
        <th>VAT</th>
        <th>TOTAL</th>
      </tr>
    </thead>
    <tbody>

        ';


        $counter=1;
        $total_amt=0;
        $total_vat=0;
        $overall_total=0;
        foreach ($report as $report) {
          $total_amt+=$report->AMOUNT;
          $VAT=(5/100)*$report->AMOUNT;
          $total=$VAT+$report->AMOUNT;
          $overall_total+=$total;
          $total_vat+=$VAT;

          echo"
          <tr>
        <td>$counter</td>
        <td>$report->NAME</td>
        <td>$report->REF_NO</td>
        <td>".date('M d, Y', strtotime($report->DATE_CREATED))."</td>

        <td>$report->SERVICE</td>
        <td>&#8358; ".number_format($report->AMOUNT)."</td>
        <td>&#8358; ".number_format($VAT)."</td>
        <td>&#8358; ".number_format($total)."</td>
      </tr>



          ";

          $counter++;
        }


        echo"
        <tr class='tablefooter'>
          <td colspan='5'></td>
          <td>&#8358;".number_format($total_amt)."</td>
          <td>&#8358;".number_format($total_vat)."</td>
          <td>&#8358;".number_format($overall_total)."</td>

        </tr>
        </tbody>
  </table>  


        ";
      }
      else{
        echo'

        <div class="alert alert-info">

          <h1 class="text-center">No Record Found</h1>



        </div>


        ';
      }


    ?>
   
      
    
  </div>

  

</body>
</html>