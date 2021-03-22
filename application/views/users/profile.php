<!-- Begin Page Content -->
<!-- container-fluid -->
<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url('welcome')?>">Dashboard</a></li>
        <li class="breadcrumb-item active">User Profile</li>
    </ol>

    <?php if ($this->session->flashdata('alert')) { ?>
        <script type="text/javascript">
            $(document).ready(function () {
                $.notify({
                        message: '<?php echo $this->session->flashdata('alert')['message']?>'
                    },
                    {
                        type: '<?php echo $this->session->flashdata('alert')['type']?>',
                        placement: {
                            from: "bottom",
                            align: "right"
                        },
                        animate: {
                            enter: 'animated fadeInDown',
                            exit: 'animated fadeOutUp'
                        },
                    });
            });
        </script>
    <?php } ?>


<!--user profile form-->
<div class="row">
    <div class="col-md-12">

            <form action="<?php echo base_url('users/profile'); ?>" method="post" data-toggle="validator">

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="<?php echo $this->session->userdata('name');?>" required>

                        </div>
                        <div class="form-group col-md-6">
                            <label>NIC</label>
                            <input type="text" class="form-control" name="nic" value="<?php echo $this->session->userdata('nic');?>" pattern="[0-9]{9}[x|X|v|V]|[0-9]{11}[x|X|v|V]" required>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Phone</label>
                            <input type="tel" class="form-control" name="phone" value="<?php echo $this->session->userdata('phone');?>" maxlength="12" minlength="9" pattern="^[0-9]*$" required>

                        </div>
                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="<?php echo $this->session->userdata('email');?>" pattern="^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$" required>
                            <div class="help-block with-errors"></div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Date of Birth</label>
                            <input type="date" class="form-control" name="birthday" value="<?php echo $this->session->userdata('birthday');?>" required>
                            <div class="help-block with-errors"></div>

                        </div>
                        <div class="form-group col-md-6">
                            <label>Street</label>
                            <input type="text" class="form-control" name="street" value="<?php echo $this->session->userdata('street');?>" required>
                            <div class="help-block with-errors"></div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Street Two</label>
                            <input type="text" class="form-control" value="<?php echo $this->session->userdata('street_two');?>" name="street_two">

                        </div>
                        <div class="form-group col-md-6">
                            <label>City</label>
                            <select class="form-control" name="city"  required>
                                <option disabled selected value style="display:none;"><?php echo $this->session->userdata('city');?></option>
                                <?php foreach ($cities as $city) { ?>
                                    <option value="<?php echo $city->id; ?>"><?php echo $city->name_en; ?></option>
                                <?php } ?>
                            </select>
                            <div class="help-block with-errors"></div>

                        </div>
                    </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>District</label>
                        <select class="form-control" name="district">
                            <option disabled selected value style="display:none;"><?php echo $this->session->userdata('district');?></option>
                            <?php foreach ($districts as $district) { ?>
                                <option value="<?php echo $district->id; ?>"><?php echo $district->name_en; ?></option>
                            <?php } ?>
                        </select>

                    </div>
                    <div class="form-group col-md-6">
                        <label>Province</label>
                        <select class="form-control" name="province">
                            <option disabled selected value style="display:none;"> <?php echo $this->session->userdata('province');?></option>
                            <?php foreach ($provinces as $province) { ?>
                                <option value="<?php echo $province->id; ?>"><?php echo $province->name_en; ?></option>
                            <?php } ?>
                        </select>

                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Gender</label>
                        <select class="form-control" name="gender" required>
                            <option disabled selected value style="display:none;"><?php echo $this->session->userdata('gender');?></option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <div class="help-block with-errors"></div>

                    </div>
                    <div class="form-group col-md-6">
                        <label>Role Name</label>
                        <select class="form-control" name="role" required>
                            <option disabled selected value style="display:none;"><?php echo $this->session->userdata('role');?></option>
                            <?php foreach ($roles as $role){ ?>
                                <option value="<?php echo $role->id; ?>"><?php echo $role->role; ?></option>
                            <?php } ?>

                        </select>
                        <div class="help-block with-errors"></div>

                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Ward</label>
                        <select class="form-control" name="ward" required>
                            <option disabled selected value style="display:none;"><?php echo $this->session->userdata('ward');?></option>
                            <?php foreach ($wards as $ward) { ?>
                                <option value="<?php echo $ward->id;?>"><?php echo $ward->number.' - '.$ward->name; ?></option>
                            <?php } ?>
                        </select>
                        <div class="help-block with-errors"></div>

                    </div>
                </div>

                <div class="text-right">
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary" id="submit">Update</button>
                </div>

            </form>
</div>
</div>
</div>







