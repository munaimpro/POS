<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">


                                <label class="form-label">Category</label>
                                <select type="text" class="form-control form-select" id="productCategoryUpdate">
                                    <option value="">Select Category</option>
                                </select>

                                <label class="form-label mt-2">Name</label>
                                <input type="text" class="form-control" id="productNameUpdate">

                                <label class="form-label mt-2">Price</label>
                                <input type="text" class="form-control" id="productPriceUpdate">

                                <label class="form-label mt-2">Unit</label>
                                <input type="text" class="form-control" id="productUnitUpdate">
                                <br/>
                                <img class="w-15" id="oldImg" src="{{asset('images/default.jpg')}}"/>
                                <br/>
                                <label class="form-label mt-2">Image</label>
                                <input oninput="oldImg.src=window.URL.createObjectURL(this.files[0])"  type="file" class="form-control" id="productImgUpdate">

                                <input type="text" class="d-none" id="updateID">
                                <input type="text" class="d-none" id="filePath">


                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button id="update-modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="update()" id="update-btn" class="btn bg-gradient-success" >Update</button>
            </div>

        </div>
    </div>
</div>


<script>
    
    getCategoryList();

    async function getCategoryList(){
        let productCategory = $('#productCategoryUpdate');

        let response = await axios.get('/category-list');
        
        response.data.forEach(function(item, i){
            let option = `<option value="${item['id']}">${item['name']}</option>`;
            productCategory.append(option);
        });
    }

    async function getProductDetails(id, path){
        document.getElementById('updateID').value = id;
        document.getElementById('filePath').value = path;
        document.getElementById('oldImg').src = path;

        showLoader();
        let response = await axios.post('/product-by-id', {id:id});
        hideLoader();

        if(response.status === 200){
            document.getElementById('productNameUpdate').value = response.data['name'];
            document.getElementById('productPriceUpdate').value = response.data['price'];
            document.getElementById('productUnitUpdate').value = response.data['unit'];
            document.getElementById('productCategoryUpdate').value = response.data['category_id'];
        }
    }

    async function update(){
        let productNameUpdate = document.getElementById('productNameUpdate').value;
        let productPriceUpdate = document.getElementById('productPriceUpdate').value;
        let productUnitUpdate = document.getElementById('productUnitUpdate').value;
        let productCategoryUpdate = document.getElementById('productCategoryUpdate').value;
        let productImgUpdate = document.getElementById('productImgUpdate').files[0];
        let filePath = document.getElementById('filePath').value;
        let updateID = document.getElementById('updateID').value;

        if(productNameUpdate.length === 0){
            errorToast('Product name required!');
        } else if(productCategoryUpdate.length === 0){
            errorToast('Product category required!');
        } else if(productPriceUpdate.length === 0){
            errorToast('Product price required!');
        } else if(productUnitUpdate.length === 0){
            errorToast('Product unit required!');
        } else{
            document.getElementById('update-modal-close').click();

            let formData = new FormData();
            formData.append('img', productImgUpdate);
            formData.append('name', productNameUpdate);
            formData.append('price', productPriceUpdate);
            formData.append('unit', productUnitUpdate);
            formData.append('category_id', productCategoryUpdate);
            formData.append('file_path', filePath);
            formData.append('id', updateID);

            showLoader();
            let response = await axios.post('/product-update', formData, {
                headers:{'content-type':'multipart/form-data'}
            });
            hideLoader();

            if(response.data['status'] === 'success'){
                successToast(response.data['message']);
                document.getElementById('update-form').reset();
                getList();
            } else{
                errorToast(response.data['message']);
            }
        }
    }

</script>

