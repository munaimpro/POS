<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card animated fadeIn w-100 p-3">
                <div class="card-body">
                    <h4>User Profile</h4>
                    <hr/>
                    <div class="container-fluid m-0 p-0">
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <label>Email Address</label>
                                <input readonly id="email" placeholder="User Email" class="form-control" type="email"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>First Name</label>
                                <input id="firstName" placeholder="First Name" class="form-control" type="text"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Last Name</label>
                                <input id="lastName" placeholder="Last Name" class="form-control" type="text"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Mobile Number</label>
                                <input id="mobile" placeholder="Mobile" class="form-control" type="mobile"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Password</label>
                                <input id="password" placeholder="User Password" class="form-control" type="password"/>
                            </div>
                        </div>
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <button onclick="onUpdate()" class="btn mt-3 w-100  bg-gradient-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    async function userProfile(){
        showLoader();
        let response = await axios.get('/user-profile');
        hideLoader();

        if(response.status === 200 && response.data['status'] === 'success'){
            document.getElementById('email').value = response.data.data['email'];
            document.getElementById('firstName').value = response.data.data['firstName'];
            document.getElementById('firstName').value = response.data.data['firstName'];
            document.getElementById('lastName').value = response.data.data['lastName'];
            document.getElementById('mobile').value = response.data.data['mobile'];
            document.getElementById('password').value = response.data.data['password'];
        } else{
            errorToast(response.data['message']);
        }
    }

    userProfile();

    async function onUpdate(){
        let firstName = document.getElementById('firstName').value;
        let lastName = document.getElementById('lastName').value;
        let mobile = document.getElementById('mobile').value;
        let password = document.getElementById('password').value;

        if(firstName.length === 0){
            errorToast('First name is required');
        } else if(lastName.length === 0){
            errorToast('Last name is required');
        } else if(mobile.length === 0){
            errorToast('Mobile number is required');
        } else if(password.length === 0){
            errorToast('Password is required');
        } else{
            showLoader();
            
            let response = await axios.post('/update-profile', {
                firstName:firstName,
                lastName:lastName,
                mobile:mobile,
                password:password
            });

            hideLoader();

            if(response.status === 200 && response.data['status'] === 'success'){
                successToast(response.data['message']);
                await userProfile();
            } else{
                errorToast(response.data['message']);
            }
        }
    }

</script>