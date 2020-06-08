<!-- Begin Page Content -->
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
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#item_modal">Add Item
                </button>
            </div>
            <!--item table-->
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Category</th>
                    <th>Item Name</th>
                    <th>Unit</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <!--display data on index-->
                <tbody>
                <?php foreach ($items as $item) { ?>
                    <tr>

                        <td><?php echo $item->category_name; ?></td>
                        <td><?php echo $item->name; ?></td>
                        <td><?php echo $item->unit_name; ?></td>
                        <td><?php echo $item->quantity; ?></td>
                        <td><?php echo $item->price; ?></td>
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
            <form action="<?php echo base_url('item/item/create_item'); ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Item Category</label>
                            <select class="form-control" name="category">
                                <option disabled selected value style="display:none;">--select category--</option>
                                <?php foreach ($categories as $category) { ?>
                                    <option value="<?php echo $category->id; ?>"> <?php echo $category->name; ?></option>
                                <?php } ?>

                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Item Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Unit of Measure</label>
                            <select class="form-control" name="unit">
                                <option disabled selected value style="display:none;">--select unit--</option>
                                <?php foreach ($units as $unit) { ?>
                                    <option value="<?php echo $unit->id; ?>"> <?php echo $unit->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Quantity</label>
                            <input type="text" class="form-control" name="quantity">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Item Price</label>
                            <input type="number" class="form-control" name="price">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Expire Date</label>
                            <input type="date" class="form-control" name="exp_date">
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





