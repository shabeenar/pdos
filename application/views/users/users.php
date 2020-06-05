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
            <table class="table table-bordered table-hover table-striped">
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
                        <td><?php echo $user->ward_id; ?></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-secondary"><i class="fas fa-pencil-alt"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
                            <button type="button" class="btn btn-success btn-sm"><i class="fas fa-check"></i></button>
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
                                <option disabled selected value style="display:none;">--select city--</option>
                                <option >Data 1</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>District</label>
                            <select class="form-control" name="district">
                                <option disabled selected value style="display:none;">--select district--</option>
                                <option >Data 1</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Province</label>
                            <select class="form-control" name="province">
                                <option disabled selected value style="display:none;">--select province--</option>
                                <option >Data 1</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Gender</label>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="radio-inline"><input type="radio" name="gender"
                                                                       value="male">Male</label>
                                    <label class="radio-inline"><input type="radio" name="gender" value="female">Female</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Role Name</label>
                            <input type="text" class="form-control" name="role">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Ward</label>
                            <select class="form-control" name="ward">
                                <option disabled selected value style="display:none;">--select ward--</option>
                                <?php foreach ($wards as $ward) { ?>
                                    <option><?php echo $ward->number;?></option>
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




