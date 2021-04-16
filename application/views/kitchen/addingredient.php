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


            <div class="row">
                <label class="col-sm-2 col-form-label">Meal Name</label>

                <div class="form-group col-sm-4">
                    <?php foreach ($meal_ingredients as $meal_ingredient) { ?>
                    <input type="text" class="form-control" id="meal_name" name="meal_name" value="<?php echo $meal_ingredient->meal_name; ?>" readonly>
                    <?php } ?>
                </div>

            </div>

            <form action="<?php echo base_url('kitchen/AddIngredient/add_ingredient'); ?>" method="post">

                <table class="table table-bordered" id="add_ingredients_table">
                    <thead>
                    <tr>
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

        $(document).on('click', '#plus_button', function () {
            $.ajax({
                url: base_url + 'kitchen/AddIngredient/generate_ingredient_line',
                success: function (response) {
                    var options = response
                    var row = "";
                    row += '<tr>';
                    row += '<td><select name="ingredient_product[]" id="ingredient_product" class="form-control">' + options + '</select></td>';
                    row += '<td><input type="text" name="ingredient_qty[]" id="ingredient_qty" class="form-control" placeholder="0.00" required onKeyPress="return NumbersOnly(this, event,true)"/></td>';
                    row += '<td class="text-center"><button type="button" class="btn btn-danger btn-sm" id="remove_ingredient_line"><i class="fa fa-minus" aria-hidden="true"></i></button></td>';

                    $('#add_ingredients_lines').append(row);
                }
            })

        })

        $(document).on('click', '#remove_ingredient_line', function () {
            $(this).closest('tr').remove();
        })



    })


</script>