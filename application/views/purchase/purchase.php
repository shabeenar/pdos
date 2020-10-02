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


            <form action="<?php echo base_url('purchase/purchase/create_purchase'); ?>" method="post">

                <div class="row">
                    <label class="col-sm-2 col-form-label">Supplier</label>
                    <div class="form-group col-sm-4">
                    <select class="form-control" name="supplier" id="supplier">
                        <option disabled selected value style="display:none;">Select Supplier</option>
                        <?php foreach ($suppliers as $supplier) { ?>
                            <option value="<?php echo $supplier->id; ?>"> <?php echo $supplier->name; ?></option>
                        <?php } ?>
                    </select>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Purchase Order Date</label>
                    <div class="form-group col-sm-4">
                        <input type="date" class="form-control" id="date" name="date">
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
                        <th class="text-center"> <button type="button" class="btn btn-success btn-sm" id="plus_button"><i class="fas fa-fw fa-plus"></i></button></th>
                    </tr>
                    </thead>
                    <!--display data on index-->
                    <tbody id="purchase_lines">
                    </tbody>
                </table>
                <div class="row">
                    <label class="text-right mb-4">Amount Total Rs.</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="total_amount" name="total_amount" value="0.00">
                    </div>
                </div>
                <div class="text-right mb-4">
                    <button type="submit" class="btn btn-success">Create Purchase Order</button>
                </div>
            </form>

            <!--unit category table-->


        </div>
    </div>
</div>
<!-- /.container-fluid -->

<script>
    $(document).ready(function () {
        $(document).on('click','#plus_button',function () {
            $.ajax({
                url: base_url + 'purchase/Purchase/generate_purchase_line',
                success: function (response) {
                    var options = response
                    var row = "";
                    row += '<tr>';
                    row += '<td><select name="purchase_product[]" id="purchase_product" class="form-control">' + options + '</select></td>';
                    row += '<td><input type="text" name="purchase_price[]" id="purchase_price" class="form-control" required/></td>';
                    row += '<td><input type="text" name="purchase_qty[]" id="purchase_qty" class="form-control" placeholder="0.00" required/></td>';
                    row += '<td><input type="text" name="purchase_uom[]" id="purchase_uom" class="form-control" readonly/><input type="hidden" name="purchase_uom_id[]" id="purchase_uom_id" class="form-control"/></td>';
                    row += '<td><input type="text" name="purchase_total[]" id="purchase_total" class="form-control" readonly/></td>';
                    row += '<td class="text-center"><button type="button" class="btn btn-danger btn-sm" id="remove_purchase_line"><i class="fa fa-minus" aria-hidden="true"></i></button></td>';

                    $('#purchase_lines').append(row);
                }
            })
        })

        $(document).on('click', '#remove_purchase_line', function () {
            $(this).closest('tr').remove();
        })

        $('#purchase_lines').on('change', '#purchase_product', function () {
            var id = $(this).val();
            var unit_price = "";
            var unit_of_measure = "";
            $.ajax({
                type: 'post',
                url: base_url + 'purchase/Purchase/get_single_product',
                async: false,
                dataType: 'json',
                data: {'id': id},
                success: function (response) {
                   unit_price = response[0]['price'];
                   unit_of_measure = response[0]['unit_name'];

                }
            })
            $(this).closest('tr').find('#purchase_price').val(unit_price);
            $(this).closest('tr').find('#purchase_uom').val(unit_of_measure);
        })

        $('#purchase_lines').on('change', '#purchase_qty, #purchase_price', function () {
            var line_total = 0;
            var line_price = $(this).closest('tr').find('#purchase_price').val();
            var line_quantity = $(this).closest('tr').find('#purchase_qty').val();
            line_total = line_price * line_quantity;
            $(this).closest('tr').find('#purchase_total').val(line_total);
        })
    })
</script>







