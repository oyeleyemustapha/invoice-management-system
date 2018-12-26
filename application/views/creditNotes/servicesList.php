<?php

if($services){




                                      echo'
                                      <h3 class="text-center">'.$services[0]->NAME.'</h3>
                                      <h4 class="text-center">'.$services[0]->ACCOUNT_NO.'</h4>

                                        <table class="table table-hover">
                                       <thead>
                                         <tr>
                                           <th>ID</th>
                                           <th>SERVICE</th>
                                           <th>DESCRIPTION</th>
                                           <th>AMOUNT</th>
                                           
                                         </tr>
                                       </thead>
                                       <tbody>';
                                       $counter=1;
                                       foreach ($services as $service) {
                                         echo"
                                          <tr>
                                     <td>$counter</td>
                                     <td>
                                     <input type='hidden' class='form-control' name='account_no' value='$service->ACCOUNT_NO' required>
                                     <input type='text' class='form-control' name='service[]' value='$service->SERVICE' required></td>
                                     <td> <input type='text' class='form-control' name='description[]' value='$service->DESCRIPTION' required></td>
                                     <td>

                                  
                                     <input type='text' class='form-control' name='amount[]' required value='".number_format($service->AMOUNT)."'></td>
                                     

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