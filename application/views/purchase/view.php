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


            <form action="<?php echo base_url('purchase/View/addtostock'); ?>" method="post">

                <div class="row">
                    <label class="col-sm-2 col-form-label">Supplier</label>
                    <div class="form-group col-sm-4">
                        <?php foreach ($purchases as $purchase) { ?>
                        <input type="text" class="form-control" id="supplier" name="supplier" value="<?php echo $purchase->supplier_name; ?>" readonly>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Purchase Order Date</label>
                    <div class="form-group col-sm-4">
                        <?php foreach ($purchases as $purchase) { ?>
                        <input type="text" class="form-control" id="date" name="date" value="<?php echo $purchase->date; ?>" readonly>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Confirm Order Date</label>
                    <div class="form-group col-sm-4">
                    <input type="date" class="form-control" id="confirm_order_date" name="confirm_order_date">
                    </div>
                </div>
                <table class="table table-bordered" id="purchase_table">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Unit of Measure</th>
                        <th>Sub Total</th>

                    </tr>
                    </thead>
                    <!--display data on index-->
                    <tbody>
                    <?php foreach ($purchase_lines as $purchase_line) { ?>
                        <tr>
                            <td><?php echo $purchase_line->item_name; ?></td>
                            <td><?php echo $purchase_line->price; ?></td>
                            <td><?php echo $purchase_line->quantity; ?></td>
                            <td><?php echo $purchase_line->unit_name; ?></td>
                            <td><?php echo $purchase_line->sub_total; ?></td>

                        </tr>
                    <?php } ?>
                    </tbody>
                </table>

                <div>
                    <div class="row">
                        <label class="text-right mb-4">Amount Total Rs.</label>
                        <div class="col-sm-4">
                            <?php foreach ($purchases as $purchase) { ?>
                            <input type="text" class="form-control" id="total_amount" name="total_amount" value="<?php echo $purchase->total_price; ?>" placeholder="0.00" readonly>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="text-right mb-4">
                    <button type="submit" class="btn btn-success">Add to Stock</button>
                </div>

            </form>


            <!--unit category table-->


        </div>
    </div>
</div>
<!-- /.container-fluid -->