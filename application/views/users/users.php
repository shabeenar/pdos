<!-- Begin Page Content -->
<!-- container-fluid -->
<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url('welcome')?>">Dashboard</a></li>
        <li class="breadcrumb-item active">User Management</li>
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

    <div class="row">
        <div class="col-md-12">
            <div class="text-right mb-4">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#user_modal">Add User
                </button>
            </div>
            <!--users table-->
            <table class="table table-bordered table-hover table-striped" id="users_table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>NIC</th>
                    <th>Role Name</th>
                    <th>Ward</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                <!--display data on index-->
                <?php foreach ($users as $user) { ?>
                    <tr>
                        <td><?php echo $user->first_name; ?></td>
                        <td><?php echo $user->phone; ?></td>
                        <td><?php echo $user->nic; ?></td>
                        <td><?php echo $user->role_name; ?></td>
                        <td><?php echo $user->id.' - '.$user->ward_name; ?></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-secondary" id="update_button" data-id="<?php echo $user->id; ?>"><i class="fas fa-pencil-alt"></i>
                            </button>

                            <?php if ($user->active == 1){ ?>
                                <form action="<?php echo base_url('users/users/inactivate');?>" method="post" style="display: inline;">
                                    <input type="hidden" value="<?php echo $user->id; ?>" name="id">
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
                                </form>
                            <?php }else{?>
                                <form action="<?php echo base_url('users/users/activate');?>" method="post" style="display: inline;">
                                    <input type="hidden" value="<?php echo $user->id; ?>" name="id">
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-check"></i></button>
                                </form>
                            <?php } ?>

                            <button type="button" class="btn btn-warning btn-sm" id="delete_button" data-id="<?php echo $user->id; ?>"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!--add new user modal-->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="user_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    Add New User
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
<!--  add new form to modal-->
            <form action="<?php echo base_url('users/users/create_user'); ?>" method="post" data-toggle="validator">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>First Name</label>
                            <input type="text" class="form-control" name="first_name" required>
                            <div class="help-block with-errors"></div>

                        </div>
                        <div class="form-group col-md-6">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="last_name" required>
                            <div class="help-block with-errors"></div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>NIC</label>
                            <input type="text" class="form-control" name="nic" pattern="[0-9]{9}[x|X|v|V]|[0-9]{11}[x|X|v|V]" required>
                            <div class="help-block with-errors"></div>

                        </div>
                        <div class="form-group col-md-6">
                            <label>Phone</label>
                            <input type="tel" class="form-control" name="phone" maxlength="12" minlength="9" pattern="^[0-9]*$" required>
                            <div class="help-block with-errors"></div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" pattern="^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$" required>
                            <div class="help-block with-errors"></div>

                        </div>
                        <div class="form-group col-md-6">
                            <label>Date of Birth</label>
                            <input type="date" class="form-control" name="birthday" required>
                            <div class="help-block with-errors"></div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Street</label>
                            <input type="text" class="form-control" name="street" required>
                            <div class="help-block with-errors"></div>

                        </div>
                        <div class="form-group col-md-6">
                            <label>Street Two</label>
                            <input type="text" class="form-control" name="street_two">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>City</label>
                            <select class="form-control" name="city" id="city" required>
                                <option disabled selected value style="display:none;">Select City</option>
                                <?php foreach ($cities as $city) { ?>
                                    <option value="<?php echo $city->id; ?>"><?php echo $city->name_en; ?></option>
                                <?php } ?>
                            </select>
                            <div class="help-block with-errors"></div>

                        </div>
                        <div class="form-group col-md-6">
                            <label>District</label>

                            <input class="form-control" type="text" id="district" name="district" readonly>
                            <input type="hidden"  name="district_id" id="district_id">
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Province</label>
                            <input class="form-control" type="text" id="province" name="province" readonly>
                            <input type="hidden"  name="province_id" id="province_id">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Gender</label>
                                <select class="form-control" name="gender" required>
                                <option disabled selected value style="display:none;">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                </select>
                            <div class="help-block with-errors"></div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Role Name</label>
                            <select class="form-control" name="role" required>
                                <option disabled selected value style="display:none;">Select Role</option>
                                <?php foreach ($roles as $role){ ?>
                                    <option value="<?php echo $role->id; ?>"><?php echo $role->role; ?></option>
                                <?php } ?>

                            </select>
                            <div class="help-block with-errors"></div>

                        </div>
                        <div class="form-group col-md-6">
                            <label>Ward</label>
                            <select class="form-control" name="ward" required>
                                <option disabled selected value style="display:none;">Select Ward</option>
                                <?php foreach ($wards as $ward) { ?>
                                    <option value="<?php echo $ward->id;?>"><?php echo $ward->number.' - '.$ward->name; ?></option>
                                <?php } ?>
                            </select>
                            <div class="help-block with-errors"></div>

                        </div>
                    </div>

                    <input type="hidden" id="id" name="id" value="">

                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Update user modal-->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="update_user_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    Update User
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--  update new form to modal-->
            <form action="<?php echo base_url('users/users/update_user'); ?>" method="post" data-toggle="validator">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>First Name</label>
                            <input type="text" class="form-control" name="first_name" id="update_first_name" required>
                            <div class="help-block with-errors"></div>

                        </div>
                        <div class="form-group col-md-6">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="last_name" id="update_last_name" required>
                            <div class="help-block with-errors"></div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>NIC</label>
                            <input type="text" class="form-control" name="nic" id="update_nic" pattern="[0-9]{9}[x|X|v|V]|[0-9]{11}[x|X|v|V]" required>
                            <div class="help-block with-errors"></div>

                        </div>
                        <div class="form-group col-md-6">
                            <label>Phone</label>
                            <input type="tel" class="form-control" name="phone" id="update_phone" maxlength="12" minlength="9" pattern="^[0-9]*$" required>
                            <div class="help-block with-errors"></div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" id="update_email" pattern="^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$" required>
                            <div class="help-block with-errors"></div>

                        </div>
                        <div class="form-group col-md-6">
                            <label>Date of Birth</label>
                            <input type="date" class="form-control" name="birthday" id="update_birthday" required>
                            <div class="help-block with-errors"></div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Street</label>
                            <input type="text" class="form-control" name="street" id="update_street" required>
                            <div class="help-block with-errors"></div>

                        </div>
                        <div class="form-group col-md-6">
                            <label>Street Two</label>
                            <input type="text" class="form-control" name="street_two" id="update_street_two">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>City</label>
                            <select class="form-control" name="city" id="update_city" required>
                                <option disabled selected value style="display:none;">Select City</option>
                                <?php foreach ($cities as $city) { ?>
                                    <option value="<?php echo $city->id; ?>"><?php echo $city->name_en; ?></option>
                                <?php } ?>
                            </select>
                            <div class="help-block with-errors"></div>

                        </div>
                        <div class="form-group col-md-6">
                            <label>District</label>

                            <input class="form-control" type="text" id="update_district" name="district" readonly>
                            <input type="hidden"  name="update_district_id" id="update_district_id">
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Province</label>

                            <input class="form-control" type="text" id="update_province" name="province" readonly>
                            <input type="hidden"  name="update_province_id" id="update_province_id">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Gender</label>
                            <select class="form-control" name="gender" id="update_gender" required>
                                <option disabled selected value style="display:none;">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            <div class="help-block with-errors"></div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Role Name</label>
                            <select class="form-control" name="role" id="update_role" required>
                                <option disabled selected value style="display:none;">Select Role</option>
                                <?php foreach ($roles as $role){ ?>
                                    <option value="<?php echo $role->id; ?>"><?php echo $role->role; ?></option>
                                <?php } ?>

                            </select>
                            <div class="help-block with-errors"></div>

                        </div>
                        <div class="form-group col-md-6">
                            <label>Ward</label>
                            <select class="form-control" name="ward" id="update_ward" required>
                                <option disabled selected value style="display:none;">Select Ward</option>
                                <?php foreach ($wards as $ward) { ?>
                                    <option value="<?php echo $ward->id;?>"><?php echo $ward->number.' - '.$ward->name; ?></option>
                                <?php } ?>
                            </select>
                            <div class="help-block with-errors"></div>

                        </div>
                    </div>
                    <input type="hidden" id="update_id" name="update_id" value="">

                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary" id="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--delete user modal-->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="delete_user_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    Delete User
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--  add new form to modal-->
            <form action="<?php echo base_url('users/users/delete_user'); ?>" method="post">
                <div class="modal-body">
                    <p>Are You Sure Want To Delete This?</p>
                    <input type="hidden" name="id" id="delete_id" value="">
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="submit">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $('#users_table').on('click', '#update_button', function() {
            var id = $(this).attr('data-id');

            $.ajax({
                type: 'post',
                url: base_url + 'users/Users/get_user',
                async: false,
                dataType: 'json',
                data: {'id': id},
                success: function(response) {
                    $('#update_first_name').val(response[0]['first_name']);
                    $('#update_last_name').val(response[0]['last_name']);
                    $('#update_nic').val(response[0]['nic']);
                    $('#update_phone').val(response[0]['phone']);
                    $('#update_email').val(response[0]['email']);
                    $('#update_birthday').val(response[0]['birthday']);
                    $('#update_street').val(response[0]['street']);
                    $('#update_street_two').val(response[0]['street_two']);
                    $('#update_city').val(response[0]['city_id']);
                    $('#update_district').val(response[0]['district_name']);
                    $('#update_province').val(response[0]['province_name']);
                    $('#update_gender').val(response[0]['gender']);
                    $('#update_role').val(response[0]['role_id']);
                    $('#update_ward').val(response[0]['ward_id']);
                    $('#update_id').val(response[0]['id']);
                    $('#update_user_modal').modal('show');
                }
            })
        });

        $('#users_table').on('click', '#delete_button', function () {
            var id = $(this).attr('data-id');
            $('#delete_id').val(id);
            $('#delete_user_modal').modal('show');
        })

        $('#city').on('change', function () {
            var city = $(this).val();

            $.ajax({
                type: 'post',
                url: base_url + 'users/Users/get_city',
                async: false,
                dataType: 'json',
                data: {'city': city},
                success: function(response) {
                    $('#district').val(response[0]['district_name']);
                    $('#district_id').val(response[0]['district_id']);
                    $('#province').val(response[0]['province_name']);
                    $('#province_id').val(response[0]['province_id']);
                    $('#id').val(response[0]['city']);
                    $('#user_modal').modal('show');
                }
            })
        })


        $('#update_city').on('change', function () {
            var city = $(this).val();

            $.ajax({
                type: 'post',
                url: base_url + 'users/Users/get_city',
                async: false,
                dataType: 'json',
                data: {'city': city},
                success: function(response) {
                    $('#update_district').val(response[0]['district_name']);
                    $('#update_district_id').val(response[0]['district_id']);
                    $('#update_province').val(response[0]['province_name']);
                    $('#update_province_id').val(response[0]['province_id']);
                    $('#update_id').val(response[0]['city']);
                    $('#update_user_modal').modal('show');
                }
            })
        })

    });

</script>




