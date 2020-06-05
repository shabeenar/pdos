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
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#patient_modal">Add
                    Patient
                </button>
            </div>
            <!--patients table-->
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Age</th>
                    <th>Phone</th>
                    <th>Ward</th>
                    <th>Bed</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <!--display data on index-->
                <tbody>
                <?php foreach ($patients as $patient) { ?>
                    <tr>
                        <td><?php echo $patient->name; ?></td>
                        <td><?php echo $patient->age; ?></td>
                        <td><?php echo $patient->phone; ?></td>
                        <td><?php echo $patient->ward_id; ?></td>
                        <td><?php echo $patient->bed; ?></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-secondary"><i class="fas fa-pencil-alt"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
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
            <form action="<?php echo base_url('patient/patient/create_patient'); ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Patient Category</label>
                            <select class="form-control" name="patient_category">
                                <option disabled selected value style="display:none;">--select category--</option>
                                <?php foreach ($patient_categories as $patient_category) { ?>
                                    <option><?php echo $patient_category->category_name;?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Patient Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Age</label>
                            <input type="text" class="form-control" name="age">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Date of Birth</label>
                            <input type="date" class="form-control" name="birthday">
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
                            <label>Gender</label>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="radio-inline"><input type="radio" name="gender"
                                                                       value="male">Male</label>
                                    <label class="radio-inline"><input type="radio" name="gender" value="female">Female</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Street</label>
                            <input type="text" class="form-control" name="street">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Street Two</label>
                            <input type="text" class="form-control" name="street_two">
                        </div>
                        <div class="form-group col-md-6">
                            <label>City</label>
                            <select class="form-control" name="city">
                                <option disabled selected value style="display:none;">--select city--</option>
                                <option >Data 1</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>District</label>
                            <select class="form-control" name="district">
                                <option disabled selected value style="display:none;">--select district--</option>
                                <option >Data 1</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Province</label>
                            <select class="form-control" name="province">
                                <option disabled selected value style="display:none;">--select province--</option>
                                <option >Data 1</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>In Date</label>
                            <input type="date" class="form-control" name="in_date">
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
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Bed</label>
                            <input type="text" class="form-control" name="bed">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Diet Category</label>
                            <select class="form-control" name="diet_category">
                                <option disabled selected value style="display:none;">--select category--</option>
                                <?php foreach ($diet_categories as $diet_category) { ?>
                                    <option><?php echo $diet_category->category_name;?></option>
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





