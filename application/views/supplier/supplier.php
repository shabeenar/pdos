<!-- Begin Page Content -->
<!-- container-fluid -->
<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url('welcome')?>">Dashboard</a></li>
        <li class="breadcrumb-item active">Supplier Management</li>
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
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#supplier_modal">Add Supplier</button>
            </div>

<!--            <div class="text-right mb-4">-->
<!--            <button type="button" class="btn btn-secondary" name="copy" id="copy" tabindex="0">Copy</button>-->
<!--            </div>-->

                    <!--supplier table-->
                    <table class="table table-bordered" id="supplier_table">
                        <thead>
                        <tr>
                            <th>Supplier Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <!--display data on index-->
                        <tbody>
                        <?php foreach ($suppliers as $supplier) { ?>
                            <tr>
                                <td><?php echo $supplier->name; ?></td>
                                <td><?php echo $supplier->phone; ?></td>
                                <td>
                                    <?php echo $supplier->street.', '.$supplier->street_two.','; ?><br>
                                    <?php echo $supplier->city_name.', '.$supplier->district_name,','; ?><br>
                                    <?php echo $supplier->province_name; ?>
                                </td>
                                <td><?php echo $supplier->email; ?></td>

                                <td class="text-center">
                                    <?php if ($supplier->active == 1) { ?>
                                        <h5><span class="badge badge-success">Active</span></h5>

                                    <?php } else { ?>
                                        <h5><span class="badge badge-danger ">Inactivate</span></h5>

                                    <?php } ?>
                                </td>

                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-secondary" id="update_button" data-id="<?php echo $supplier->id; ?>"><i class="fas fa-pencil-alt"></i>
                                    </button>

                                    <?php if ($supplier->active == 1){ ?>
                                        <form action="<?php echo base_url('supplier/supplier/inactivate');?>" method="post" style="display: inline;">
                                            <input type="hidden" value="<?php echo $supplier->id; ?>" name="id">
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
                                        </form>
                                    <?php }else{?>
                                        <form action="<?php echo base_url('supplier/supplier/activate');?>" method="post" style="display: inline;">
                                            <input type="hidden" value="<?php echo $supplier->id; ?>" name="id">
                                            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-check"></i></button>
                                        </form>
                                    <?php } ?>

                                    <button type="button" class="btn btn-warning btn-sm" id="delete_button" data-id="<?php echo $supplier->id; ?>"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!--add new Supplier modal-->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="supplier_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    Add New Supplier
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--  add new form to modal-->
            <form action="<?php echo base_url('supplier/supplier/create_supplier'); ?>" method="post" id="supplier-form" data-toggle="validator">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Supplier Name</label>
                            <input type="text" class="form-control" name="name" required>
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
                            <input type="email" class="form-control" name="email">

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
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Update Supplier modal-->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="update_supplier_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    Update Supplier
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--  update new form to modal-->
            <form action="<?php echo base_url('supplier/supplier/update_supplier'); ?>" method="post" data-toggle="validator">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Supplier Name</label>
                            <input type="text" class="form-control" name="name" id="update_name" required>
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
                            <input type="email" class="form-control" name="email" id="update_email">

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

<!--delete Supplier modal-->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="delete_supplier_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    Delete Supplier
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--  delete new form to modal-->
            <form action="<?php echo base_url('supplier/supplier/delete_supplier'); ?>" method="post">
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


        $('#supplier_table').on('click', '#update_button', function() {
            var id = $(this).attr('data-id');

            $.ajax({
                type: 'post',
                url: base_url + 'supplier/Supplier/get_supplier',
                async: false,
                dataType: 'json',
                data: {'id': id},
                success: function(response) {
                    $('#update_name').val(response[0]['name']);
                    $('#update_phone').val(response[0]['phone']);
                    $('#update_email').val(response[0]['email']);
                    $('#update_street').val(response[0]['street']);
                    $('#update_street_two').val(response[0]['street_two']);
                    $('#update_city').val(response[0]['city_id']);
                    $('#update_district').val(response[0]['district_name']);
                    $('#update_province').val(response[0]['province_name']);
                    $('#update_id').val(response[0]['id']);
                    $('#update_supplier_modal').modal('show');
                }
            })
        });

        $('#supplier_table').on('click', '#delete_button', function () {
            var id = $(this).attr('data-id');
            $('#delete_id').val(id);
            $('#delete_supplier_modal').modal('show');
        })

        $('#city').on('change', function () {
            var city = $(this).val();

            $.ajax({
                type: 'post',
                url: base_url + 'supplier/Supplier/get_city',
                async: false,
                dataType: 'json',
                data: {'city': city},
                success: function(response) {
                    $('#district').val(response[0]['district_name']);
                    $('#district_id').val(response[0]['district_id']);
                    $('#province').val(response[0]['province_name']);
                    $('#province_id').val(response[0]['province_id']);
                    $('#id').val(response[0]['city']);
                    $('#supplier_modal').modal('show');
                }
            })
        })

        $('#update_city').on('change', function () {
            var city = $(this).val();

            $.ajax({
                type: 'post',
                url: base_url + 'supplier/Supplier/get_city',
                async: false,
                dataType: 'json',
                data: {'city': city},
                success: function(response) {
                    $('#update_district').val(response[0]['district_name']);
                    $('#update_district_id').val(response[0]['district_id']);
                    $('#update_province').val(response[0]['province_name']);
                    $('#update_province_id').val(response[0]['province_id']);
                    $('#update_id').val(response[0]['city']);
                    $('#update_supplier_modal').modal('show');
                }
            })
        })

    });
</script>





