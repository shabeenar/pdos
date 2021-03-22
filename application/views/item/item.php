<!-- Begin Page Content -->
<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url('welcome')?>">Dashboard</a></li>
        <li class="breadcrumb-item active">Item Management</li>
    </ol>

    <?php if ($this->session->flashdata('alert')) { ?>
        <script type="text/javascript">
            $(document).ready(function () {
                $.notify({
                        message: '<?php echo $this->session->flashdata('alert'),['message']?>'
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
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#item_modal">Add Item
                </button>
            </div>
            <!--item table-->
            <table class="table table-bordered" id="item_table">
                <thead>
                <tr>
                    <th>Category</th>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Unit</th>
                    <th>Price</th>
                    <th>Inventory Level</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <!--display data on index-->
                <tbody>
                <?php foreach ($items as $item) { ?>
                    <tr>

                        <td><?php echo $item->category_name; ?></td>
                        <td><?php echo $item->name; ?></td>
                        <td class="text-right"><?php echo $item->quantity; ?></td>
                        <td><?php echo $item->unit_name; ?></td>
                        <td class="text-right"><?php echo $item->price; ?></td>
                        <td>
                            <div class="progress">
                                <?php if (0 < $item->inventory_level && $item->inventory_level < 30) { ?>
                                    <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: <?php echo $item->inventory_level; ?>%" aria-valuenow="<?php echo $item->inventory_level; ?>>" aria-valuemin="0" aria-valuemax="100"></div>
                                <?php } ?>
                                <?php if (31 < $item->inventory_level && $item->inventory_level < 60) { ?>
                                    <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: <?php echo $item->inventory_level; ?>%" aria-valuenow="<?php echo $item->inventory_level; ?>>" aria-valuemin="0" aria-valuemax="100"></div>
                                <?php } ?>
                                <?php if (61 < $item->inventory_level && $item->inventory_level < 100) { ?>
                                    <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: <?php echo $item->inventory_level; ?>%" aria-valuenow="<?php echo $item->inventory_level; ?>>" aria-valuemin="0" aria-valuemax="100"></div>
                                <?php } ?>

                            </div>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-secondary" id="update_button" data-id="<?php echo $item->id; ?>"><i class="fas fa-pencil-alt"></i>
                            </button>
                            <button type="button" class="btn btn-warning btn-sm" id="delete_button" data-id="<?php echo $item->id; ?>"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!--add new item modal-->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="item_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    Add New Item
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('item/item/create_item'); ?>" method="post" id="item_create_form" data-toggle="validator" data-toggle="validator">
                <div class="modal-body">
                    <div class="row">
                        <div class="alert alert-danger form-group col-md-12" id="alert_id">
                            <strong>Invalid Quantity</strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Item Category</label>
                            <select class="form-control" name="category" required>
                                <option disabled selected value style="display:none;">Select Category</option>
                                <?php foreach ($categories as $category) { ?>
                                    <option value="<?php echo $category->id; ?>"> <?php echo $category->name; ?></option>
                                <?php } ?>
                            </select>
                            <div class="help-block with-errors"></div>

                        </div>
                        <div class="form-group col-md-6">
                            <label>Item Name</label>
                            <input type="text" class="form-control" name="name" required>
                            <div class="help-block with-errors"></div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Unit of Measure</label>
                            <select class="form-control" name="unit" id="unit_name" required>
                                <option disabled selected value style="display:none;">Select Unit</option>
                                <?php foreach ($units as $unit) { ?>
                                    <option value="<?php echo $unit->id; ?>"> <?php echo $unit->name; ?></option>
                                <?php } ?>
                            </select>
                            <div class="help-block with-errors"></div>

                        </div>
                        <div class="form-group col-md-6">
                            <label>Quantity</label>
                            <input type="text" class="form-control" name="quantity" id="quantity_name" required>
                            <div class="help-block with-errors"></div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Item Price</label>
                            <input type="number" class="form-control" name="price" pattern="\-?\d+\.\d+" required>
                            <div class="help-block with-errors"></div>

                        </div>
                        <div class="form-group col-md-6">
                            <label>Expire Date</label>
                            <input type="date" class="form-control" name="exp_date">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary" id="add_button">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--update item modal-->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="update_item_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    Update Item
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('item/item/update_item'); ?>" method="post" data-toggle="validator">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Item Category</label>
                            <select class="form-control" name="category" id="update_category" required>
                                <option disabled selected value style="display:none;">Select Category</option>
                                <?php foreach ($categories as $category) { ?>
                                    <option value="<?php echo $category->id; ?>"> <?php echo $category->name; ?></option>
                                <?php } ?>
                            </select>
                            <div class="help-block with-errors"></div>

                        </div>
                        <div class="form-group col-md-6">
                            <label>Item Name</label>
                            <input type="text" class="form-control" name="name" id="update_name" required>
                            <div class="help-block with-errors"></div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Quantity</label>
                            <input type="text" class="form-control" name="quantity" id="update_quantity" required>
                            <div class="help-block with-errors"></div>

                        </div>

                        <div class="form-group col-md-6">
                            <label>Unit of Measure</label>
                            <select class="form-control" name="unit" id="update_unit" required>
                                <option disabled selected value style="display:none;">Select Unit</option>
                                <?php foreach ($units as $unit) { ?>
                                    <option value="<?php echo $unit->id; ?>"> <?php echo $unit->name; ?></option>
                                <?php } ?>
                            </select>
                            <div class="help-block with-errors"></div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Item Price</label>
                            <input type="number" class="form-control" name="price" id="update_price" pattern="\-?\d+\.\d+" required>
                            <div class="help-block with-errors"></div>

                        </div>
                        <div class="form-group col-md-6">
                            <label>Expire Date</label>
                            <input type="date" class="form-control" name="exp_date" id="update_exp_date">
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

<!--delete item modal-->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="delete_item_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    Delete Item
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="<?php echo base_url('item/item/delete_item'); ?>" method="post">
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
        $('#alert_id').hide();
        $('#item_table').on('click', '#update_button', function () {
            var id = $(this).attr('data-id');

            $.ajax({
                type: 'post',
                url: base_url + 'item/Item/get_item',
                async: false,
                dataType: 'json',
                data: {'id': id},
                success: function (response) {
                    $('#update_category').val(response[0]['item_category_id']);
                    $('#update_name').val(response[0]['name']);
                    $('#update_quantity').val(response[0]['quantity']);
                    $('#update_unit').val(response[0]['unit_id']);
                    $('#update_price').val(response[0]['price']);
                    $('#update_exp_date').val(response[0]['exp_date']);
                    $('#update_id').val(response[0]['id']);
                    $('#update_item_modal').modal('show');
                }
            })
        });
        $('#item_table').on('click', '#delete_button', function () {
            var id = $(this).attr('data-id');
            $('#delete_id').val(id);
            $('#delete_item_modal').modal('show');
        })

        $('#quantity_name').on('change', function () {
            var uom = $('#unit_name').val();
            var quantity = $(this).val();
            $.ajax({
                type: 'post',
                url: base_url + 'item/Item/get_quantity',
                async: false,
                dataType: 'json',
                data: {'uom': uom},
                success: function (response) {
                    if (response[0]['is_float'] == false){
                        if (1 > quantity % 1 && 0 < quantity){
                            $('#alert_id').show();
                            $(':input[type="submit"]').prop('disabled', true)
                        }
                    }else{
                        $('#alert_id').hide();
                        $(':input[type="submit"]').prop('disabled', false)
                    }

                }
            })
        } )

        $('#unit_name').on('change', function () {
            var uom = $(this).val();
            var quantity = $('#quantity_name').val();
            $.ajax({
                type: 'post',
                url: base_url + 'item/Item/get_quantity',
                async: false,
                dataType: 'json',
                data: {'uom': uom},
                success: function (response) {
                    if (response[0]['is_float'] == false){
                        if (1 > quantity % 1 && 0 < quantity){
                            $('#alert_id').show();
                            $(':input[type="submit"]').prop('disabled', true)
                        }
                    }else{
                        $('#alert_id').hide();
                        $(':input[type="submit"]').prop('disabled', false)
                    }

                }
            })
        } )
    });

    // 08/01/2020 <= 09/01/2020

</script>





