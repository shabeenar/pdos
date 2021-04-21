<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url('welcome')?>">Dashboard</a></li>

    </ol>

    <!--add new ingredient-->
    <div class="row">
        <div class="col-md-12">

            <form action="<?php echo base_url('kitchen/ViewIngredients'); ?>" method="post">

                <div class="row">
                    <label class="col-sm-2 col-form-label text-right">Meal Name</label>
                    <div class="form-group col-sm-3">
                        <?php foreach ($ingredients as $ingredient) { ?>
                            <input type="text" class="form-control" id="meal_name" name="meal_name" value="<?php echo $ingredient->meal_name; ?>" readonly>
                            <input type="hidden"  name="meal_id"  id="meal_id"  value="<?php echo $ingredient->id; ?>">
                        <?php } ?>
                    </div>

                    <label class="col-sm-2 col-form-label text-right">Date</label>
                    <div class="form-group col-sm-3">
                        <input type="date" class="form-control" id="date" name="date" value="<?php echo $ingredient->date; ?>" readonly>
                    </div>

                </div>

                <table class="table table-bordered" id="add_ingredients_table">
                    <thead>
                    <tr>
                        <th>Item Category</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php foreach ($ingredient_lines as $ingredient_line) { ?>
                    <tr>
                        <td><?php echo $ingredient_line->category_name; ?></td>
                        <td><?php echo $ingredient_line->item_name; ?></td>
                        <td><?php echo $ingredient_line->quantity; ?></td>

                    </tr>
                    <?php } ?>
                    </tbody>
                </table>

                <input type="hidden" id="id" name="id" value="<?php echo $ingredients[0]->id; ?>">



            </form>
        </div>
    </div>
</div>
