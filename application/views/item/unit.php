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
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#unit_modal">Add Unit of
                    Measure
                </button>
            </div>
            <!--unit category table-->
            <table class="table table-bordered" id="unit_table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Unit</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <!--display data on index-->
                <tbody>
                <?php foreach ($units as $unit) { ?>
                    <tr>
                        <td><?php echo $unit->name; ?></td>
                        <td><?php echo $unit->unit; ?></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-secondary" id="update_button"
                                    data-id="<?php echo $unit->id; ?>"><i class="fas fa-pencil-alt"></i>
                            </button>
                            <button type="button" class="btn btn-warning btn-sm" id="delete_button"
                                    data-id="<?php echo $unit->id; ?>"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!--add new Unit Category modal-->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="unit_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    Add New Unit of Measure
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--  add new form to modal-->
            <form action="<?php echo base_url('item/unit/create_unit'); ?>" method="post" id="unit-form" data-toggle="validator">
                <div class="modal-body">
                    <div class="alert alert-danger" id="errors">

                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" data-error="Name is required" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Unit</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="unit" name="unit" data-error="SI Symbol is required" required>
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

<script>
    $('#errors').hide();
    function submitUnitsForm(){
        $.ajax({
            type: 'post',
            url: base_url + 'item/Unit/form_validations',
            async: false,
            dataType: 'json',
            data: {},
            success: function (response) {
                if(response.error == true) {
                    $('#errors').html(response.messages);
                    $('#errors').show();
                } else {
                    $('#errors').hide();
                }
            }
        });
    };
</script>

<!--update Unit modal-->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="update_unit_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    Update Unit of Measure
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--  add new form to modal-->
            <form action="<?php echo base_url('item/unit/update_unit'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="update_name" name="name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Unit</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="update_unit" name="unit">
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

<!--delete Unit modal-->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="delete_unit_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    Delete Unit of Measure
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--  add new form to modal-->
            <form action="<?php echo base_url('item/unit/delete_unit'); ?>" method="post">
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
        $('#unit_table').on('click', '#update_button', function () {
            var id = $(this).attr('data-id');

            $.ajax({
                type: 'post',
                url: base_url + 'item/Unit/get_unit',
                async: false,
                dataType: 'json',
                data: {'id': id},
                success: function (response) {
                    $('#update_name').val(response[0]['name']);
                    $('#update_unit').val(response[0]['unit']);
                    $('#update_id').val(response[0]['id']);
                    $('#update_unit_modal').modal('show');
                }
            })
        });

        $('#unit_table').on('click', '#delete_button', function () {
            var id = $(this).attr('data-id');
            $('#delete_id').val(id);
            $('#delete_unit_modal').modal('show');
        })
    });
</script>





