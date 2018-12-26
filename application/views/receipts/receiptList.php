<?php

if($receipts){

    function getOrdinalsuffix($batch){
  
        $lastChar=substr($batch, -1,1);
        switch ($lastChar) {
          case '1':
            return($batch==11) ? 'th' : 'st';
            break;
          case '2':
            return($batch==12) ? 'th' : 'nd';
            break;
          case '3':
            return($batch==13) ? 'th' : 'rd';
            break;
        }
        return 'th';
}

                                      echo'
                                        <table class="table table-hover receiptTable">
                                       <thead>
                                         <tr>
                                           <th>ID</th>
                                           <th>CLIENT</th>
                                           <th>ACCOUNT NUMBER</th>
                                           <th>RECIEPT NO</th>
                                           <th>DATE CREATED</th>
                                           <th></th>
                                         </tr>
                                       </thead>
                                       <tbody>';
                                       $counter=1;
                                       foreach ($receipts as $receipt) {
                                        $batch=$receipt->BATCH."<sup>".getOrdinalsuffix($receipt->BATCH)."</sup>";

                                        if($receipt->RECIEPT_TYPE=="Client"){
                                         $type= "<span class='badge badge-primary'>Non-VAT</span>";
                                        }
                                        else{
                                          $type="<span class='badge badge-info'>VAT</span>";
                                        }
                                         echo"
                                          <tr>
                                     <td>$counter</td>
                                     <td>$receipt->NAME</td>
                                     <td>$receipt->ACCOUNT_NO</td>
                                     <td>$receipt->RECIEPT_NUMBER <span class='badge badge-primary'>$batch Payment</span> $type</td>
                                     <td>".date('F d, Y', strtotime($receipt->DATE_CREATED))."</td>
                                     <td>

                                     <a href='".base_url()."receipt/".$receipt->RECIEPT_NUMBER."/$receipt->BATCH' class='btn btn-primary' target='_blank'>Generate Receipt</a>

                                     <button class='btn btn-danger deleteReceipt' data-receipt-no='$receipt->RECIEPT_NUMBER'  data-batch='$receipt->BATCH'>Delete</button>

                                     </td>
                                   </tr>



                                         ";
                                         $counter++;
                                       }
                                   
                                 echo'</tbody>
                               </table>';
}
else{
    echo "<div class='alert alert-info'><h2 class='text-center'>No Record found</h2></div>";
}



?>