    <div class="container-fluid bg-gradient-dark">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-9 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 bg-gradient-dark">
                        <h5 class="m-0 font-weight-bold text-primary" align="center">Profile</h5>
                    </div>
                    <div class="card-body bg-gradient-dark">
                        <div class="text-center">
                        <img class="img-profile rounded-circle" width="200px" height="200px" src="<?php echo $user['picture']?>">
                        </div>
                        <div class="form-group">
                            Name :
                            <input class="form-control" id="masukNama" type="text" value="<?php echo $user['name']?>">
                        </div>
                        <div class="form-group">
                            Email :
                            <input class="form-control" id="masukEmail" type="text" value="<?php echo $user['email']?>" disabled>
                        </div>
                        <div class="form-group">
                            Account Type :
                            <input class="form-control" id="masukTipe" type="text" value="<?php echo $user['role']?>" disabled>
                        </div>
                        <button type="button" class="btn btn-primary submitBtn" onclick="kirimProfilForm()">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>