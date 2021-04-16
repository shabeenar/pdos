<!-- Begin Page Content -->
<!-- container-fluid -->
<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url('welcome')?>">Dashboard</a></li>
        <li class="breadcrumb-item active">Patient Category Management</li>
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
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#patientcategory_modal">Add
                    Category
                </button>
            </div>
            <!--patient category table-->
            <table class="table table-bordered" id="patientcategory_table">
                <thead>
                <tr>
                    <th>Category Code</th>
                    <th>Category Name</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <!--display data on index-->
                <tbody>
                <?php foreach ($patientcategories as $patientcategory) { ?>
                    <tr>
                        <td class="text-right"><?php echo $patientcategory->category_code; ?></td>
                        <td><?php echo $patientcategory->category_name; ?></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-secondary" id="update_button" data-id="<?php echo $patientcategory->id; ?>"><i class="fas fa-pencil-alt"></i>
                            </button>
                            <button type="button" class="btn btn-warning btn-sm" id="delete_button" data-id="<?php echo $patientcategory->id; ?>"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!--add new Patient Category modal-->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="patientcategory_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    Add New Category
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--  add new form to modal-->
            <form action="<?php echo base_url('patient/patientcategory/create_patientcategory'); ?>" method="post" data-toggle="validator">
                <div class="modal-body">

                    <div class="alert alert-danger" id="alert-name">
                        Given patient category name is existing
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Code</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="category_code" name="category_code" required>
                            <div class="help-block with-errors"></div>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="category_name" name="category_name" required>
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

<!--Update Patient Category modal-->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="update_patientcategory_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    Update Category
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--  update new form to modal-->
            <form action="<?php echo base_url('patient/patientcategory/update_patientcategory'); ?>" method="post" data-toggle="validator">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Code</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="update_category_code" name="category_code" required>
                            <div class="help-block with-errors"></div>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="update_category_name" name="category_name" required>
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

<!--delete Patient Category modal-->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="delete_patientcategory_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    Delete Category
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--  delete new form to modal-->
            <form action="<?php echo base_url('patient/patientcategory/delete_patientcategory'); ?>" method="post">
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
        $('#alert-name').hide();

        $('#patientcategory_table').on('click', '#update_button', function() {
            var id = $(this).attr('data-id');

            $.ajax({
                type: 'post',
                url: base_url + 'patient/PatientCategory/get_patientcategory',
                async: false,
                dataType: 'json',
                data: {'id': id},
                success: function (response) {
                    $('#update_category_code').val(response[0]['category_code']);
                    $('#update_category_name').val(response[0]['category_name']);
                    $('#update_id').val(response[0]['id']);
                    $('#update_patientcategory_modal').modal('show');
                }
            })
        });

        $('#patientcategory_table').on('click', '#delete_button', function () {
            var id = $(this).attr('data-id');
            $('#delete_id').val(id);
            $('#delete_patientcategory_modal').modal('show');
        })

        $('#category_name').on('change',function(){

            var category_name = $(this).val();

            $.ajax({
                type: 'post',
                url: base_url + 'patient/PatientCategory/check_category_name',
                async: false,
                dataType: 'json',
                data: {'category_name': category_name},
                success: function (response) {
                    if(response == true) {
                        $('#alert-name').show();
                        $(':input[type="submit"]').prop('disabled', true)
                    }
                    else if(response == false) {
                        $('#alert-name').hide();
                        $(':input[type="submit"]').prop('disabled', false)

                    }
                }
            });
        });

    });
</script>




