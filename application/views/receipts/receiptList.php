<?php

if($receipts){
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
                                         echo"
                                          <tr>
                                     <td>$counter</td>
                                     <td>$receipt->NAME</td>
                                     <td>$receipt->ACCOUNT_NO</td>
                                     <td>$receipt->RECIEPT_NUMBER</td>
                                     <td>".date('F d, Y', strtotime($receipt->DATE_CREATED))."</td>
                                     <td>

                                     <a href='".base_url()."receipt/".$receipt->RECIEPT_NUMBER."' class='btn btn-primary' target='_blank'>Generate Receipt</a>

                                     <button class='btn btn-danger deleteReceipt' id='$receipt->RECIEPT_NUMBER'>Delete</button>

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