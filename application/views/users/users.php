<!-- Begin Page Content -->
<!-- container-fluid -->
<div class="container-fluid">
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
                        <td><?php echo $user->role; ?></td>
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
            <form action="<?php echo base_url('users/users/create_user'); ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>First Name</label>
                            <input type="text" class="form-control" name="first_name">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="last_name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>NIC</label>
                            <input type="text" class="form-control" name="nic">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Phone</label>
                            <input type="tel" class="form-control" name="phone">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Date of Birth</label>
                            <input type="date" class="form-control" name="birthday">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Street</label>
                            <input type="text" class="form-control" name="street">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Street Two</label>
                            <input type="text" class="form-control" name="street_two">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>City</label>
                            <select class="form-control" name="city">
                                <option disabled selected value style="display:none;">Select City</option>
                                <?php foreach ($cities as $city) { ?>
                                    <option value="<?php echo $city->id; ?>"><?php echo $city->name_en; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>District</label>
                            <select class="form-control" name="district">
                                <option disabled selected value style="display:none;">Select District</option>
                                <?php foreach ($districts as $district) { ?>
                                    <option value="<?php echo $district->id; ?>"><?php echo $district->name_en; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Province</label>
                            <select class="form-control" name="province">
                                <option disabled selected value style="display:none;">Select Province</option>
                                <?php foreach ($provinces as $province) { ?>
                                    <option value="<?php echo $province->id; ?>"><?php echo $province->name_en; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Gender</label>
                                <select class="form-control" name="gender">
                                <option disabled selected value style="display:none;">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Role Name</label>
                            <select class="form-control" name="role">
                                <option disabled selected value style="display:none;">Select Role</option>
                                <?php foreach ($roles as $role){ ?>
                                    <option value="<?php echo $role->id; ?>"><?php echo $role->role; ?></option>
                                <?php } ?>

                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Ward</label>
                            <select class="form-control" name="ward">
                                <option disabled selected value style="display:none;">Select Ward</option>
                                <?php foreach ($wards as $ward) { ?>
                                    <option value="<?php echo $ward->id;?>"><?php echo $ward->number.' - '.$ward->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
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
            <!--  add new form to modal-->
            <form action="<?php echo base_url('users/users/update_user'); ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>First Name</label>
                            <input type="text" class="form-control" name="first_name" id="update_first_name">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="last_name" id="update_last_name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>NIC</label>
                            <input type="text" class="form-control" name="nic" id="update_nic">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Phone</label>
                            <input type="tel" class="form-control" name="phone" id="update_phone">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" id="update_email">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Date of Birth</label>
                            <input type="date" class="form-control" name="birthday" id="update_birthday">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Street</label>
                            <input type="text" class="form-control" name="street" id="update_street">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Street Two</label>
                            <input type="text" class="form-control" name="street_two" id="update_street_two">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>City</label>
                            <select class="form-control" name="city" id="update_city">
                                <option disabled selected value style="display:none;">Select City</option>
                                <?php foreach ($cities as $city) { ?>
                                    <option value="<?php echo $city->id; ?>"><?php echo $city->name_en; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>District</label>
                            <select class="form-control" name="district" id="update_district">
                                <option disabled selected value style="display:none;">Select District</option>
                                <?php foreach ($districts as $district) { ?>
                                    <option value="<?php echo $district->id; ?>"><?php echo $district->name_en; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Province</label>
                            <select class="form-control" name="province" id="update_province">
                                <option disabled selected value style="display:none;">Select Province</option>
                                <?php foreach ($provinces as $province) { ?>
                                    <option value="<?php echo $province->id; ?>"><?php echo $province->name_en; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Gender</label>
                            <select class="form-control" name="gender" id="update_gender">
                                <option disabled selected value style="display:none;">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Role Name</label>
                            <input type="text" class="form-control" name="role" id="update_role">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Ward</label>
                            <select class="form-control" name="ward" id="update_ward">
                                <option disabled selected value style="display:none;">Select Ward</option>
                                <?php foreach ($wards as $ward) { ?>
                                    <option value="<?php echo $ward->id;?>"><?php echo $ward->number.' - '.$ward->name; ?></option>
                                <?php } ?>
                            </select>
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
                    $('#update_district').val(response[0]['district_id']);
                    $('#update_province').val(response[0]['province_id']);
                    $('#update_gender').val(response[0]['gender']);
                    $('#update_role').val(response[0]['role']);
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
    });
</script>




