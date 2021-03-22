<!-- Begin Page Content -->
<!-- container-fluid -->
<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url('welcome')?>">Dashboard</a></li>
        <li class="breadcrumb-item active">Ward Management</li>
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
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ward_modal">Add
                    Ward
                </button>
            </div>
            <!--ward category table-->
            <table class="table table-bordered" id="ward_table">
                <thead>
                <tr>
                    <th>Ward Number</th>
                    <th>Ward Name</th>
                    <th>Ward Gender</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <!--display data on index-->
                <tbody>
                <?php foreach ($wards as $ward) { ?>
                    <tr>
                        <td class="text-right"><?php echo $ward->number; ?></td>
                        <td><?php echo $ward->name; ?></td>
                        <td><?php echo $ward->gender; ?></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-secondary" id="update_button" data-id="<?php echo $ward->id; ?>"><i class="fas fa-pencil-alt"></i>
                            </button>
                            <button type="button" class="btn btn-warning btn-sm" id="delete_button" data-id="<?php echo $ward->id; ?>"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!--add new Ward modal-->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="ward_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    Add New Ward
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--  add new form to modal-->
            <form action="<?php echo base_url('patient/ward/create_ward'); ?>" method="post" data-toggle="validator">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Ward Number</label>
                            <input type="text" class="form-control" name="number" required>
                            <div class="help-block with-errors"></div>

                        </div>
                        <div class="form-group col-md-6">
                            <label>Ward Name</label>
                            <input type="text" class="form-control" name="name" required>
                            <div class="help-block with-errors"></div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Ward Gender</label>
                            <select class="form-control" name="gender">
                                <option disabled selected value style="display:none;">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="children">Children</option>
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

<!--Update Ward modal-->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="update_ward_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    Update Ward
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--  update new form to modal-->
            <form action="<?php echo base_url('patient/ward/update_ward'); ?>" method="post" data-toggle="validator">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Ward Number</label>
                            <input type="text" class="form-control" name="number" id="update_number" required>
                            <div class="help-block with-errors"></div>

                        </div>
                        <div class="form-group col-md-6">
                            <label>Ward Name</label>
                            <input type="text" class="form-control" name="name" id="update_name" required>
                            <div class="help-block with-errors"></div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Ward Gender</label>
                            <select class="form-control" name="gender" id="update_gender">
                                <option disabled selected value style="display:none;">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="children">Children</option>
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

<!--delete Ward modal-->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="delete_ward_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    Delete Ward
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--  delete new form to modal-->
            <form action="<?php echo base_url('patient/ward/delete_ward'); ?>" method="post">
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
        $('#ward_table').on('click', '#update_button', function() {
            var id = $(this).attr('data-id');

            $.ajax({
                type: 'post',
                url: base_url + 'patient/Ward/get_ward',
                async: false,
                dataType: 'json',
                data: {'id': id},
                success: function (response) {
                    $('#update_number').val(response[0]['number']);
                    $('#update_name').val(response[0]['name']);
                    $('#update_gender').val(response[0]['gender']);
                    $('#update_id').val(response[0]['id']);
                    $('#update_ward_modal').modal('show');
                }
            })
        });

        $('#ward_table').on('click', '#delete_button', function () {
            var id = $(this).attr('data-id');
            $('#delete_id').val(id);
            $('#delete_ward_modal').modal('show');
        })
    });
</script>




