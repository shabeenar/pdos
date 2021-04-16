<!-- Begin Page Content -->
<!-- container-fluid -->
<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url('welcome')?>">Dashboard</a></li>
        <li class="breadcrumb-item active">Patient Management</li>
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
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#patient_modal">Add
                    Patient
                </button>
            </div>
            <!--patients table-->
            <table class="table table-bordered" id="patient_table">
                <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Age</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Ward</th>
                    <th>Bed Number</th>
                    <th lass="text-center">Status</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <!--display data on index-->
                <tbody>
                <?php foreach ($patients as $patient) { ?>
                    <tr>
                        <td><?php echo $patient->name; ?></td>
                        <td class="text-right"><?php echo $patient->age; ?></td>
                        <td>
                            <?php echo $patient->street.', '.$patient->street_two.','; ?><br>
                            <?php echo $patient->city_name.', '.$patient->district_name.','; ?><br>
                            <?php echo $patient->province_name; ?>
                        </td>
                        <td><?php echo $patient->phone; ?></td>
                        <td><?php echo $patient->ward_id.' - '.$patient->ward_name; ?></td>
                        <td class="text-right"><?php echo $patient->bed; ?></td>

                        <td class="text-right">
                            <?php if ($patient->active == 1) { ?>
                                <h5><span class="badge badge-success">Active</span></h5>

                            <?php } else { ?>
                                <h5><span class="badge badge-danger ">Inactivate</span></h5>

                            <?php } ?>
                        </td>

                        <td class="text-center">
                            <button type="button" class="btn btn-secondary btn-sm" id="update_button" data-id="<?php echo $patient->id; ?>"><i class="fas fa-pencil-alt"></i>
                            </button>

                            <?php if ($patient->active == 1){ ?>
                                <form action="<?php echo base_url('patient/patient/inactivate');?>" method="post" style="display: inline;">
                                    <input type="hidden" value="<?php echo $patient->id; ?>" name="id">
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
                                </form>
                            <?php }else{?>
                                <form action="<?php echo base_url('patient/patient/activate');?>" method="post" style="display: inline;">
                                    <input type="hidden" value="<?php echo $patient->id; ?>" name="id">
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-check"></i></button>
                                </form>

                            <?php } ?>

                            <button type="button" class="btn btn-warning btn-sm" id="delete_button" data-id="<?php echo $patient->id; ?>"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!--add new Patient modal-->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="patient_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    Add New Patient
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--  add new form to modal-->
            <form action="<?php echo base_url('patient/patient/create_patient'); ?>" method="post" id="commentForm" data-toggle="validator">
                <div class="modal-body">

                    <div class="alert alert-danger" id="alert-phone">
                        Given phone number is existing
                    </div>
                    <div class = "alert alert-danger" id = "alert-nic">
                        Given nic is existing
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Patient Category</label>
                            <select class="form-control" name="patient_category" required>
                                <option disabled selected value style="display:none;">Select Category</option>
                                <?php foreach ($patient_categories as $patient_category) { ?>
                                    <option value="<?php echo $patient_category->id;?>"><?php echo $patient_category->category_name;?></option>
                                <?php } ?>
                            </select>
                            <div class="help-block with-errors"></div>

                        </div>
                        <div class="form-group col-md-6">
                            <label>Patient Name</label>
                            <input type="text" class="form-control" name="name" required>
                            <div class="help-block with-errors"></div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Age</label>
                            <input type="text" class="form-control" name="age" maxlength="3" required>
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
                            <label>NIC</label>
                            <input type="text" class="form-control" name="nic" id="nic" pattern="[0-9]{9}[x|X|v|V]|[0-9]{11}[x|X|v|V]" required>
                            <div class="help-block with-errors"></div>

                        </div>
                        <div class="form-group col-md-6">
                            <label>Phone</label>
                            <input type="tel" class="form-control" name="phone" id="phone" maxlength="12" minlength="9" pattern="^[0-9]*$" required>
                            <div class="help-block with-errors"></div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Gender</label>
                                <select class="form-control" name="gender" required>
                                <option disabled selected value style="display:none;">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                </select>
                            <div class="help-block with-errors"></div>

                        </div>
                        <div class="form-group col-md-6">
                            <label>Street</label>
                            <input type="text" class="form-control" name="street" required>
                            <div class="help-block with-errors"></div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Street Two</label>
                            <input type="text" class="form-control" name="street_two">
                        </div>
                        <div class="form-group col-md-6">
                            <label>City</label>
                            <select class="form-control" name="city" id="city" required>
                                <option disabled selected value style="display:none;">Select City</option>
                                <?php foreach ($cities as $city) { ?>
                                    <option value="<?php echo $city->id;?>"><?php echo $city->name_en;?></option>
                                <?php } ?>
                            </select>
                            <div class="help-block with-errors"></div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>District</label>
                            <input class="form-control" type="text" id="district" name="district" readonly>
                            <input type="hidden"  name="district_id" id="district_id">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Province</label>
                            <input class="form-control" type="text" id="province" name="province" readonly>
                            <input type="hidden"  name="province_id" id="province_id">
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>In Date</label>
                            <input type="date" class="form-control" name="in_date" required>
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
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Bed Number</label>
                            <input type="text" class="form-control" name="bed" maxlength="4" required>
                            <div class="help-block with-errors"></div>

                        </div>
                        <div class="form-group col-md-6">
                            <label>Diet Category</label>
                            <select class="form-control" name="diet_category" required>
                                <option disabled selected value style="display:none;">Select Category</option>
                                <?php foreach ($diet_categories as $diet_category) { ?>
                                    <option value="<?php echo $diet_category->id;?>"><?php echo $diet_category->category_name;?></option>
                                <?php } ?>
                            </select>
                            <div class="help-block with-errors"></div>

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

<!--Update Patient modal-->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="update_patient_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    Update Patient
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--  update new form to modal-->
            <form action="<?php echo base_url('patient/patient/update_patient'); ?>" method="post" id="commentForm" data-toggle="validator">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Patient Category</label>
                            <select class="form-control" name="patient_category" id="update_patient_category" required>
                                <option disabled selected value style="display:none;">Select Category</option>
                                <?php foreach ($patient_categories as $patient_category) { ?>
                                    <option value="<?php echo $patient_category->id;?>"><?php echo $patient_category->category_name;?></option>
                                <?php } ?>
                            </select>
                            <div class="help-block with-errors"></div>

                        </div>
                        <div class="form-group col-md-6">
                            <label>Patient Name</label>
                            <input type="text" class="form-control" name="name" id="update_name" required>
                            <div class="help-block with-errors"></div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Age</label>
                            <input type="text" class="form-control" name="age" id="update_age" maxlength="3" required>
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
                            <label>Gender</label>
                            <select class="form-control" name="gender" id="update_gender" required>
                                <option disabled selected value style="display:none;">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            <div class="help-block with-errors"></div>

                        </div>
                        <div class="form-group col-md-6">
                            <label>Street</label>
                            <input type="text" class="form-control" name="street" id="update_street" required>
                            <div class="help-block with-errors"></div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Street Two</label>
                            <input type="text" class="form-control" name="street_two" id="update_street_two">
                        </div>
                        <div class="form-group col-md-6">
                            <label>City</label>
                            <select class="form-control" name="city" id="update_city" required>
                                <option disabled selected value style="display:none;">Select City</option>
                                <?php foreach ($cities as $city) { ?>
                                    <option value="<?php echo $city->id;?>"><?php echo $city->name_en;?></option>
                                <?php } ?>
                            </select>
                            <div class="help-block with-errors"></div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>District</label>
                            <input class="form-control" type="text" id="update_district" name="district" readonly>
                            <input type="hidden"  name="update_district_id" id="update_district_id">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Province</label>
                            <input class="form-control" type="text" id="update_province" name="province" readonly>
                            <input type="hidden"  name="update_province_id" id="update_province_id">
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>In Date</label>
                            <input type="date" class="form-control" name="in_date" id="update_in_date" required>
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
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Bed Number</label>
                            <input type="text" class="form-control" name="bed" id="update_bed" maxlength="4" required>
                            <div class="help-block with-errors"></div>

                        </div>
                        <div class="form-group col-md-6">
                            <label>Diet Category</label>
                            <select class="form-control" name="diet_category" id="update_diet_category" required>
                                <option disabled selected value style="display:none;">Select Category</option>
                                <?php foreach ($diet_categories as $diet_category) { ?>
                                    <option value="<?php echo $diet_category->id;?>"><?php echo $diet_category->category_name;?></option>
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

<!--delete Patient modal-->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="delete_patient_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    Delete Patient
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--  add new form to modal-->
            <form action="<?php echo base_url('patient/patient/delete_patient'); ?>" method="post" id="commentForm">
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
        $('#alert-phone').hide();
        $('#alert-nic').hide();


        $('#patient_table').on('click', '#update_button', function() {
            var id = $(this).attr('data-id');

            $.ajax({
                type: 'post',
                url: base_url + 'patient/Patient/get_patient',
                async: false,
                dataType: 'json',
                data: {'id': id},
                success: function (response) {
                    $('#update_patient_category').val(response[0]['patient_category_id']);
                    $('#update_name').val(response[0]['name']);
                    $('#update_age').val(response[0]['age']);
                    $('#update_birthday').val(response[0]['birthday']);
                    $('#update_nic').val(response[0]['nic']);
                    $('#update_phone').val(response[0]['phone']);
                    $('#update_gender').val(response[0]['gender']);
                    $('#update_street').val(response[0]['street']);
                    $('#update_street_two').val(response[0]['street_two']);
                    $('#update_city').val(response[0]['city_id']);
                    $('#update_district').val(response[0]['district_name']);
                    $('#update_province').val(response[0]['province_name']);
                    $('#update_in_date').val(response[0]['in_date']);
                    $('#update_ward').val(response[0]['ward_id']);
                    $('#update_bed').val(response[0]['bed']);
                    $('#update_diet_category').val(response[0]['diet_category_id']);
                    $('#update_id').val(response[0]['id']);
                    $('#update_patient_modal').modal('show');
                }
            })
        });

        $('#patient_table').on('click', '#delete_button', function () {
            var id = $(this).attr('data-id');
            $('#delete_id').val(id);
            $('#delete_patient_modal').modal('show');
        })

        $('#city').on('change', function () {
            var city = $(this).val();

            $.ajax({
                type: 'post',
                url: base_url + 'patient/Patient/get_city',
                async: false,
                dataType: 'json',
                data: {'city': city},
                success: function(response) {
                    $('#district').val(response[0]['district_name']);
                    $('#district_id').val(response[0]['district_id']);
                    $('#province').val(response[0]['province_name']);
                    $('#province_id').val(response[0]['province_id']);
                    $('#id').val(response[0]['city']);
                    $('#patient_modal').modal('show');
                }
            })
        })


        $('#update_city').on('change', function () {
            var city = $(this).val();

            $.ajax({
                type: 'post',
                url: base_url + 'patient/Patient/get_city',
                async: false,
                dataType: 'json',
                data: {'city': city},
                success: function(response) {
                    $('#update_district').val(response[0]['district_name']);
                    $('#update_district_id').val(response[0]['district_id']);
                    $('#update_province').val(response[0]['province_name']);
                    $('#update_province_id').val(response[0]['province_id']);
                    $('#update_id').val(response[0]['city']);
                    $('#update_patient_modal').modal('show');
                }
            })
        })

        $('#phone').on('change',function(){

            var phone = $(this).val();

            $.ajax({
                type: 'post',
                url: base_url + 'patient/Patient/check_phone',
                async: false,
                dataType: 'json',
                data: {'phone': phone},
                success: function (response) {
                    if(response == true) {
                        $('#alert-phone').show();
                        $(':input[type="submit"]').prop('disabled', true)
                    }
                    else if(response == false) {
                        $('#alert-phone').hide();
                        $(':input[type="submit"]').prop('disabled', false)

                    }
                }
            });
        });

        $('#nic').on('change',function(){

            var nic = $(this).val();

            $.ajax({
                type: 'post',
                url: base_url + 'patient/Patient/check_nic',
                async: false,
                dataType: 'json',
                data: {'nic': nic},
                success: function (response) {
                    if(response == true) {
                        $('#alert-nic').show();
                        $(':input[type="submit"]').prop('disabled', true)
                    }
                    else if(response == false) {
                        $('#alert-nic').hide();
                        $(':input[type="submit"]').prop('disabled', false)

                    }
                }
            });
        });


    });
</script>





