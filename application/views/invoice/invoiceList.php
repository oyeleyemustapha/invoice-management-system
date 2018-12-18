<?php

if($invoices){
    echo'

        <table class="table table-bordered table-condensed table-hover invoiceList">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>REFERENCE NO</th>
                                            <th>CLIENT</th>
                                            <th>SERVICES</th>
                                            <th>DATE CREATED</th> 
                                            <th>STATUS</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                    $counter=1;
                                    foreach ($invoices as $invoice) {
                                        echo"
                                            <tr>
                                                <td>$counter</td>
                                                <td><a href='#' data-refNo='$invoice->REF_NO' class='getInfo'>$invoice->REF_NO</a></td>
                                                <td>$invoice->NAME</td>
                                                <td>$invoice->SERVICE</td>
                                                <td>".date('M d, Y', strtotime($invoice->DATE_CREATED))."</td>
                                                <td>$invoice->STATUS</td>
                                                <td>

                                                    <a href='".base_url()."generateInvoice/$invoice->REF_NO' class='btn btn-info btn-sm' target='_blank'>Generate Invoice</a>
                                                    <button class='btn btn-primary btn-sm editInvoice' data-refNo='$invoice->REF_NO'>Edit</button>
                                                    <button class='btn btn-danger btn-sm deleteInvoiceItem' id='$invoice->INVOICE_ID'>Delete</button>
                                                </td>
                                            </tr>
                                        ";
                                        $counter++;
                                    }

                                    
                                        
                                    echo'</tbody>
                                </table>



    ';
}
else{
    echo "<div class='alert alert-info'><h2 class='text-center'>No Record found</h2></div>";
}



?>