<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">
            <div class="row justify-content-between ">
                <div class="align-items-center col">
                    <h4>Product</h4>
                </div>
                <div class="align-items-center col">
                    <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end btn m-0  bg-gradient-primary">Create</button>
                </div>
            </div>
            <hr class="bg-dark "/>
            <table class="table" id="tableData">
                <thead>
                <tr class="bg-light">
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Unit</th>
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

    getList();

    async function getList(){
        let tableData = $('#tableData');
        
        let tableList = $('#tableList');

        tableData.DataTable().destroy();

        tableList.empty();

        showLoader();
        let response = await axios.get('/product-list');
        hideLoader();

        response.data.forEach(function(item, index){
            let row = `<tr>
                            <td><img class="w-15 h-auto" src="${item['img_url']}"/></td>
                            <td>${item['name']}</td>
                            <td>${item['price']}</td>
                            <td>${item['unit']}</td>
                            <td>
                                <button data-path=${item['img_url']} data-id=${item.id} data-bs-toggle="modal" data-bs-target="#update-modal" class="editBtn btn btn-sm btn-outline-success">Edit</button>
                                <button data-path=${item['img_url']} data-id=${item.id} data-bs-toggle="modal" data-bs-target="#delete-modal" class="deleteBtn btn btn-sm btn-outline-danger">Delete</button>   
                            </td>
                       </tr>`
            tableList.append(row);
        });

        $('.deleteBtn').on('click', function(){
            $('#deleteID').val($(this).data('id'));
            $('#deleteFilePath').val($(this).data('path'));
        });

        $('.editBtn').on('click', function(){
            let id = $(this).data('id');
            let path = $(this).data('path');
            getProductDetails(id, path);
        });

        new DataTable('#tableData');
    }

</script>
