<!-- Modal -->
<div class="modal animated zoomIn" id="details-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Invoice</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="invoice" class="modal-body p-3">
                    <div class="container-fluid">
                        <br/>
                        <div class="row">
                            <div class="col-8">
                                <span class="text-bold text-dark">BILLED TO </span>
                                <p class="text-xs mx-0 my-1">Name:  <span id="CName"></span> </p>
                                <p class="text-xs mx-0 my-1">Email:  <span id="CEmail"></span></p>
                                <p class="text-xs mx-0 my-1">User ID:  <span id="CId"></span> </p>
                            </div>
                            <div class="col-4">
                                <img class="w-40" src="{{"images/logo.png"}}">
                                <p class="text-bold mx-0 my-1 text-dark">Invoice  </p>
                                <p class="text-xs mx-0 my-1">Date: {{ date('Y-m-d') }} </p>
                            </div>
                        </div>
                        <hr class="mx-0 my-2 p-0 bg-secondary"/>
                        <div class="row">
                            <div class="col-12">
                                <table class="table w-100" id="invoiceTable">
                                    <thead class="w-100">
                                    <tr class="text-xs text-bold">
                                        <td>Name</td>
                                        <td>Qty</td>
                                        <td>Total</td>
                                    </tr>
                                    </thead>
                                    <tbody  class="w-100" id="invoiceList">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr class="mx-0 my-2 p-0 bg-secondary"/>
                        <div class="row">
                            <div class="col-12">
                                <p class="text-bold text-xs my-1 text-dark"> TOTAL: <i class="bi bi-currency-dollar"></i> <span id="total"></span></p>
                                <p class="text-bold text-xs my-2 text-dark"> PAYABLE: <i class="bi bi-currency-dollar"></i>  <span id="payable"></span></p>
                                <p class="text-bold text-xs my-1 text-dark"> VAT(5%): <i class="bi bi-currency-dollar"></i>  <span id="vat"></span></p>
                                <p class="text-bold text-xs my-1 text-dark"> Discount: <i class="bi bi-currency-dollar"></i>  <span id="discount"></span></p>
                            </div>

                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-primary" data-bs-dismiss="modal">Close</button>
                <button onclick="PrintPage()" class="btn bg-gradient-success">Print</button>
            </div>
        </div>
    </div>
</div>


<script>

    async function InvoiceDetails(inv_id, cus_id) {
        showLoader();
        let response = await axios.post('/invoice-details', {inv_id:inv_id, cus_id:cus_id});
        hideLoader();

        console.log(response.data['product']);

        document.getElementById('CName').innerText = response.data['customer']['name'];
        document.getElementById('CEmail').innerText = response.data['customer']['email'];
        document.getElementById('CId').innerText = response.data['customer']['id'];
        document.getElementById('total').innerText = response.data['invoice']['total'];
        document.getElementById('payable').innerText = response.data['invoice']['payable'];
        document.getElementById('vat').innerText = response.data['invoice']['vat'];
        document.getElementById('discount').innerText = response.data['invoice']['discount'];

        let invoiceList = $('#invoiceList');

        invoiceList.empty();

        response.data['product'].forEach(function(item, index){
            let row = `<tr class="text-xs">
                            <td>${item['product']['name']}</td>
                            <td>${item['qty']}</td>
                            <td>${item['sale_price']}</td>
                      </tr>`
            invoiceList.append(row);
        });

        $('#details-modal').modal('show');
    }

    function PrintPage(){
        let originalContent = document.body.innerHTML;
        let invoiceContent = document.getElementById('invoice').innerHTML;
        document.body.innerHTML = invoiceContent;
        window.print();
        document.body.innerHTML = originalContent;
        setTimeout(() => {
            location.reload();
        }, 1000);
    }

</script>
