<?php

if($invoice){
  

  if($invoice[0]->STATUS=="PAID"){
    $status="Paid";
  }
  else{
     $status="Not Paid";
  }



    echo'
    <div class="pull-left"><button class="btn btn-primary addItems"><i class="fa fa-plus fa-fw"></i> Add Item</button></div>


    <div class="pull-right invoiceInfodetails">
      <p>CLIENT : <span>'.$invoice[0]->NAME.'</span></p>
      <p>REFERENCE NO : <span>'.$invoice[0]->REF_NO.'</span></p>
      
      <form method="post" id="invoicemetainfo">

           <input type="hidden" value="'.$invoice[0]->REF_NO.'" name="ref_no" required>
           <input type="hidden" value="'.$invoice[0]->TYPE.'" name="type" required>

           <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon">Due Created</div>
           <input type="text" class="form-control date" name="date_created" required="" value="'.date('F d, Y', strtotime($invoice[0]->DATE_CREATED)).'">
        </div>
      </div>


      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon">Due Date</div>
           <input type="text" class="form-control date" name="due_date" required="" value="'.date('F d, Y', strtotime($invoice[0]->DUE_DATE)).'">
        </div>
      </div>
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon">Status</div>
            <select name="status" required>
            <option value="'.$invoice[0]->STATUS.'" selected>'.$status.'</option>
            <option value="NOT PAID">Not Paid</option>
            <option value="PAID">Paid</option>
            </select>
        </div>
      </div>

       <button class="btn btn-primary">Update</button>
      </form>


    </div>
     <form method="post" id="updateInvoiceform">
      <input type="hidden" value="'.$invoice[0]->TYPE.'" name="type" required>

     <input type="hidden" value="'.$invoice[0]->REF_NO.'" name="ref_no" required>
     <input type="hidden" value="'.$invoice[0]->DATE_CREATED.'" name="date_created" required>
     <input type="hidden" value="'.$invoice[0]->CUSTOMER_ID.'" name="customer_id" required>
     <input type="hidden" value="'.$invoice[0]->STATUS.'" name="status" required>
     <input type="hidden" value="'.$invoice[0]->DUE_DATE.'" name="due_date" required>
    <table class="table table-hover invoiceTable">
   
  <thead>
    <tr>
  
      <th>SERVICE</th>
      <th>DESCRIPTION</th>
      <th>AMOUNT</th>
    </tr>
  </thead>
  <tbody>


    ';

    $counter=1;
  

  foreach ($invoice as $invoice) {
   
    echo"
      <tr>
     
      <td><input type='hidden' class='form-control' name='invoice_id[]' value='$invoice->INVOICE_ID'><input type='text' class='form-control' name='item[]' required value='$invoice->SERVICE'></td>
      <td><input type='text' class='form-control' name='description[]' required value='$invoice->DESCRIPTION'></td>
      <td style='width:15%;'><input type='text' class='form-control' name='amount[]' required value='$invoice->AMOUNT'></td>
    </tr>
  


    ";


    $counter++;
  }


 

  echo'</tbody></table>

<button class="btn btn-primary">Update</button>
  </form>';
       
    
}



?>


    