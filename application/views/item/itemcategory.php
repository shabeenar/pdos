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
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#itemcategory_modal">Add Category</button>
            </div>
            <!--item category table-->
            <table class="table table-bordered" id="itemcategory_table">
                <thead>
                <tr>
                    <th>Category Code</th>
                    <th>Category Name</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <!--display data on index-->
                <tbody>
                <?php foreach ($itemcategories as $itemcategory) { ?>
                    <tr>
                        <td class="text-right"><?php echo $itemcategory->code; ?></td>
                        <td><?php echo $itemcategory->name; ?></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-secondary" id="update_button" data-id="<?php echo $itemcategory->id; ?>"><i class="fas fa-pencil-alt"></i>
                            </button>
                            <button type="button" class="btn btn-warning btn-sm" id="delete_button" data-id="<?php echo $itemcategory->id; ?>"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!--add new Item Category modal-->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="itemcategory_modal">
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
            <form action="<?php echo base_url('item/itemcategory/create_itemcategory'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Code</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="category_code" name="code">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="category_name" name="name">
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

<!--Update Item Category modal-->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="update_itemcategory_modal">
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
            <!--  add new form to modal-->
            <form action="<?php echo base_url('item/itemcategory/update_itemcategory'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Code</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="update_category_code" name="code">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="update_category_name" name="name">
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

<!--delete Item Category modal-->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="delete_itemcategory_modal">
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
            <!--  add new form to modal-->
            <form action="<?php echo base_url('item/itemcategory/delete_itemcategory'); ?>" method="post">
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
        $('#itemcategory_table').on('click', '#update_button', function () {
            var id = $(this).attr('data-id');

            $.ajax({
                type: 'post',
                url: base_url + 'item/ItemCategory/get_itemcategory',
                async: false,
                dataType: 'json',
                data: {'id': id},
                success: function(response) {
                    $('#update_category_code').val(response[0]['code']);
                    $('#update_category_name').val(response[0]['name']);
                    $('#update_id').val(response[0]['id']);
                    $('#update_itemcategory_modal').modal('show');
                }
            })
        });

        $('#itemcategory_table').on('click', '#delete_button', function () {
            var id = $(this).attr('data-id');
            $('#delete_id').val(id);
            $('#delete_itemcategory_modal').modal('show');
        })
    });
</script>





