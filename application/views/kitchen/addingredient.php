<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url('welcome')?>">Dashboard</a></li>
        <li class="breadcrumb-item active"> <a href="<?php echo base_url('kitchen/meals')?>">Meals Management</a></li>
        <li class="breadcrumb-item active">Add Ingredient</li>
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

    <!--add new ingredient-->
    <div class="row">
        <div class="col-md-12">

            <form action="<?php echo base_url('kitchen/AddIngredient/add_ingredient'); ?>" method="post">

                <div class="alert alert-danger" id="alert-quantity">
                    The Quantity entered is greater than the existing quantity
                </div>

            <div class="row">
                <label class="col-sm-2 col-form-label text-right">Meal Name</label>
                <div class="form-group col-sm-3">

                    <input type="text" class="form-control" id="meal_name" name="meal_name" value="<?php echo $ingredients[0]->meal_name; ?>" readonly>

                        <input type="hidden"  name="meal_id"  id="meal_id"  value="<?php echo $ingredients[0]->id; ?>">

                </div>

                <label class="col-sm-2 col-form-label text-right">Date</label>
                <div class="form-group col-sm-3">
                        <input type="date" class="form-control" id="date" name="date" value="<?php echo date('Y-m-d'); ?>">
                </div>

            </div>

                <table class="table table-bordered" id="add_ingredients_table">
                    <thead>
                    <tr>
                        <th>Item Category</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th class="text-center">
                            <button type="button" class="btn btn-success btn-sm" id="plus_button"><i
                                    class="fas fa-fw fa-plus"></i></button>
                        </th>
                    </tr>
                    </thead>
                    <!--display data on index-->
                    <tbody id="add_ingredients_lines">
                    </tbody>
                </table>



                <div class="text-right mb-6">
                    <button type="submit" class="btn btn-success">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#alert-quantity').hide();

        $(document).on('click', '#plus_button', function () {
            $.ajax({
                url: base_url + 'kitchen/AddIngredient/generate_ingredient_line',
                success: function (response) {
                    var options = response
                    var row = "";
                    row += '<tr>';
                    row += '<td><select name="ingredient_product_category[]" id="ingredient_product_category" class="form-control">' + options + '</select></td>';
                    row += '<td><select name="ingredient_product[]" id="ingredient_product" class="form-control"></select></td>';
                    row += '<td><input type="number" name="ingredient_qty[]" id="ingredient_qty" class="form-control" placeholder="0.00" required onKeyPress="return NumbersOnly(this, event,true)"/></td>';
                    row += '<td class="text-center"><button type="button" class="btn btn-danger btn-sm" id="remove_ingredient_line"><i class="fa fa-minus" aria-hidden="true"></i></button></td>';

                    $('#add_ingredients_lines').append(row);
                }
            })

        })

        $(document).on('click', '#remove_ingredient_line', function () {
            $(this).closest('tr').remove();
        })

        $('#add_ingredients_lines').on('change', '#ingredient_product_category', function () {
            var category_name = $(this).val();
            var items = ["<option disabled selected>Select Item</option>"];

            $.ajax({
                type: 'post',
                url: base_url + 'kitchen/AddIngredient/get_item_names',
                async: false,
                dataType: 'json',
                data: {'id': category_name},
                success: function (response) {
                    response.forEach((row) => {
                        items.push('<option value="' + row.category_id + '">' + row.category_name + '</option>');
                    })
                }
            })
            $(this).closest('tr').find('#ingredient_product option').remove();
            $(this).closest('tr').find('#ingredient_product').append(items);
        })

        $('#add_ingredients_table').on('change', '#ingredient_qty', function(){
            var id = $('#ingredient_product').val();
            var quantity = $(this).val();

            $.ajax({
                type: 'post',
                url: base_url + 'kitchen/AddIngredient/check_quantity',
                async: false,
                dataType: 'json',
                data: {'ingredient_product': id},
                success: function (response) {
                    if (parseInt(quantity) > parseInt(response[0]['quantity'])) {
                        $('#alert-quantity').show();
                        $(':input[type="submit"]').prop('disabled', true)

                    } else {
                        $('#alert-quantity').hide();
                        $(':input[type="submit"]').prop('disabled', false)

                    }
                }
            });
        });


    })
</script>