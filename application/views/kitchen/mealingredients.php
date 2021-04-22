<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url('welcome')?>">Dashboard</a></li>
        <li class="breadcrumb-item active"> <a href="<?php echo base_url('kitchen/meals')?>">Meals Management</a></li>
        <li class="breadcrumb-item active">Meal Ingredients</li>
    </ol>


    <!-- meal ingredients-->

    <div class="text-right mb-4">

<?php if ($orders) { ?>
        <a type="button" class="btn btn-success" href="<?php base_url()?>AddIngredient?id=<?php echo $orders[0]->id; ?>">Add Ingredients</a>
<?php } else { ?>
        <a type="button" class="btn btn-success" href="<?php base_url()?>AddIngredient?id=<?php echo $orders[0]->id; ?>">Add Ingredients</a>
<?php } ?>

    </div>




    <div class="row">

        <div class="col-md-12">

            <div class="row">
                <label class="col-sm-2 col-form-label">Meal Name</label>
                <div class="form-group col-sm-4">

                    <input type="text" class="form-control" id="meal" name="meal" value="<?php echo $orders[0]->meal_name; ?>" readonly>


<!--                    <input type="hidden" name="meal_id" id="meal_id" value="--><?php //echo $meals[0]->id; ?><!--">-->

                </div>
            </div>

            <?php if ($orders) { ?>

            <table class="table table-bordered" id="meal_ingredients_table">
                <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Actions</th>

                </tr>
                </thead>
                <!--display data on index-->
                <tbody>
                <?php foreach ($orders as $order) { ?>
                    <tr>

                        <td><?php echo $order->id; ?></td>
                        <td><?php echo $order->date; ?></td>

                        <td class="text-center">
                            <?php if ($order->status == 2) { ?>
                                <h5><span class="badge badge-success">Proceeded</span></h5>

                            <?php } else { ?>
                                <h5><span class="badge badge-danger ">Draft</span></h5>

                            <?php } ?>
                        </td>

                        <td class="text-center">
                            <a class="btn btn-warning btn-sm" href="<?php base_url()?>ViewIngredients?id=<?php echo $order->id; ?>">View Ingredients</a>

                            <form action="<?php echo base_url('kitchen/ViewIngredients/confirm_ingredients'); ?>" method="post">

                                <?php if ($order->status == 1) { ?>
                                    <input type="hidden" id="id" name="id" value="<?php echo $order->id; ?>">
                                    <button class="btn btn-success btn-sm" type="submit">Proceed</button>


                                <?php } ?>

                            </form>

                        </td>
                    </tr>

                <?php } ?>
                </tbody>
            </table>




        </div>
    </div>



    <?php } ?>

</div>







