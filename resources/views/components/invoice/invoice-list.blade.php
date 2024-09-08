<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">
            <div class="row justify-content-between ">
                <div class="align-items-center col">
                    <h5>Invoices</h5>
                </div>
                <div class="align-items-center col">
                    <a    href="{{url("/salePage")}}" class="float-end btn m-0 bg-gradient-primary">Create Sale</a>
                </div>
            </div>
            <hr class="bg-dark "/>
            <table class="table" id="tableData">
                <thead>
                <tr class="bg-light">
                    <th>No</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Total</th>
                    <th>Vat</th>
                    <th>Discount</th>
                    <th>Payable</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="tableList">

                </tbody>
            </table>
        </div>
    </div>
</div>
</div>


<script>
    getInvoiceList();

    async function getInvoiceList(){
        let tableData = $('#tableData');
        let tableList = $('#tableList');
        tableData.DataTable().destroy();
        tableList.empty();

        showLoader();
        let response = await axios.get('/invoice-select');
        hideLoader();

        response.data.forEach(function(item, index){
            let row = `<tr>
                    <td>${index + 1}</td>
                    <td>${item['customer']['name']}</td>
                    <td>${item['customer']['mobile']}</td>
                    <td>${item['total']}</td>
                    <td>${item['vat']}</td>
                    <td>${item['discount']}</td>
                    <td>${item['payable']}</td>
                    <td>
                        <button data-cus=${item['customer']['id']} data-id=${item.id} data-bs-toggle="modal" data-bs-target="#update-modal" class="viewBtn btn btn-sm btn-outline-dark text-sm text-sm m-0 px-3 py-1">View</button>
                        <button data-cus=${item['customer']['id']} data-id=${item.id} data-bs-toggle="modal" data-bs-target="#delete-modal" class="deleteBtn btn btn-sm btn-outline-dark text-sm text-sm m-0 px-3 py-1">Delete</button>   
                    </td>
                </tr>`;
                tableList.append(row);

            $('.deleteBtn').on('click', function(){
                $('#deleteID').val($(this).data('id'));
            });

            $('.viewBtn').on('click', function(){
                let id = $(this).data('id');
                let cus = $(this).data('cus');
                InvoiceDetails(id, cus);
            });
        });

        new DataTable('#tableData');
    }

</script>
