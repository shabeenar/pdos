<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url('welcome')?>">Dashboard</a></li>
        <li class="breadcrumb-item active"> <a href="<?php echo base_url('kitchen/meals')?>">Meals Management</a></li>
        <li class="breadcrumb-item active">Meal Ingredients</li>
    </ol>

    <!-- meal ingredients-->
    <div class="row">
        <div class="col-md-12">
            <?php foreach ($meal_ingredients as $meal_ingredient) { ?>
            <div class="row">
                <label class="col-sm-2 col-form-label">Meal Name</label>
                <div class="form-group col-sm-4">

                    <input type="text" class="form-control" id="meal_name" name="meal_name" value="<?php echo $meal_ingredient->meal_name; ?>" readonly>

                </div>
            </div>

            <table class="table table-bordered" id="meal_ingredients_table">
                <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th class="text-center">Actions</th>

                </tr>
                </thead>
                <!--display data on index-->
                <tbody>

                    <tr>
                        <td><?php echo $meal_ingredient->item_name; ?></td>
                        <td><?php echo $meal_ingredient->quantity; ?></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-warning btn-sm" id="delete_button"
                                    data-id="<?php echo $meal_ingredient->id; ?>"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>

                </tbody>
            </table>

                <input type="hidden" id="id" name="id" value="<?php echo $meal_ingredient->id; ?>" >



            <div class="text-right mb-4">
<!--                <a type="button" class="btn btn-success" href="--><?php //echo base_url("kitchen/AddIngredient"); ?><!--">Add Ingredient</a>-->
                <a type="button" class="btn btn-success" href="<?php base_url()?>AddIngredient?id=<?php echo $meal_ingredient->id; ?>">Add Ingredient</a>

            </div>
            <?php } ?>
        </div>
    </div>

</div>







