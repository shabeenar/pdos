<!-- Begin Page Content -->
<!-- container-fluid -->
<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url('welcome')?>">Dashboard</a></li>
        <li class="breadcrumb-item active">User Profile</li>
    </ol>



<!--user profile form-->
<div class="row">
    <div class="col-md-12">



                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="<?php echo $this->session->userdata('name');?>" readonly>

                        </div>
                        <div class="form-group col-md-6">
                            <label>NIC</label>
                            <input type="text" class="form-control" name="nic" value="<?php echo $this->session->userdata('nic');?>" readonly>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Phone</label>
                            <input type="tel" class="form-control" name="phone" value="<?php echo $this->session->userdata('phone');?>" readonly>

                        </div>
                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="<?php echo $this->session->userdata('email');?>" readonly>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Date of Birth</label>
                            <input type="date" class="form-control" name="birthday" value="<?php echo $this->session->userdata('birthday');?>" readonly>

                        </div>
                        <div class="form-group col-md-6">
                            <label>Street</label>
                            <input type="text" class="form-control" name="street" value="<?php echo $this->session->userdata('street');?>" readonly>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Street Two</label>
                            <input type="text" class="form-control"  name="street_two" value="<?php echo $this->session->userdata('street_two');?>" readonly>

                        </div>
                        <div class="form-group col-md-6">
                            <label>City</label>
                            <input type="text" class="form-control"  name="street_two" value="<?php echo $this->session->userdata('city');?>" readonly>
                        </div>
                    </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>District</label>
                        <input type="text" class="form-control"  name="street_two" value="<?php echo $this->session->userdata('district');?>" readonly>

                    </div>
                    <div class="form-group col-md-6">
                        <label>Province</label>
                        <input type="text" class="form-control"  name="street_two" value="<?php echo $this->session->userdata('province');?>" readonly>

                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Gender</label>
                        <input type="text" class="form-control"  name="street_two" value="<?php echo $this->session->userdata('gender');?>" readonly>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Role Name</label>
                        <input type="text" class="form-control"  name="street_two" value="<?php echo $this->session->userdata('role');?>" readonly>

                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Ward</label>
                        <input type="text" class="form-control"  name="street_two" value="<?php echo $this->session->userdata('ward');?>" readonly>

                    </div>
                </div>


</div>
</div>







