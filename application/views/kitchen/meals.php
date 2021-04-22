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
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#meal_modal">Add Meals
                </button>
            </div>
            <!--Meals category table-->
            <table class="table table-bordered" id="meals_table">
                <thead>
                <tr>
                    <th>Code</th>
                    <th>Meal Name</th>
                    <th>Breakfast</th>
                    <th>Lunch</th>
                    <th>Dinner</th>
<!--                    <th class="text-center">Meal Ingredients</th>-->
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <!--display data on index-->
                <tbody>
                <?php foreach ($meals as $meal) { ?>

                    <tr>
                        <td class="text-right"><?php echo $meal->code; ?></td>
                        <td><?php echo $meal->meal_name; ?></td>
                        <td class="text-center"><input type="radio" <?php if($meal->breakfast == 1) { echo "checked"; }?>/></td>
                        <td class="text-center"><input type="radio" <?php if($meal->lunch == 1) { echo "checked"; }?>/></td>
                        <td class="text-center"><input type="radio" <?php if($meal->dinner == 1) { echo "checked"; }?>/></td>
<!--                        <td class="text-center"><a class="btn btn-warning btn-sm" href="--><?php //base_url()?><!--MealIngredients?id=--><?php //echo $meal->id; ?><!--">View</a></td>-->
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-secondary" id="update_button"
                                    data-id="<?php echo $meal->id; ?>"><i class="fas fa-pencil-alt"></i>
                            </button>
                            <button type="button" class="btn btn-warning btn-sm" id="delete_button"
                                    data-id="<?php echo $meal->id; ?>"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!--add new Meals modal-->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="meal_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    Add New Meals
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--  add new form to modal-->
            <form action="<?php echo base_url('kitchen/meals/create_meal'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Code</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="code" name="code">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Meal Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="meal_name" name="meal_name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Meal Type</label>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="breakfast" id="breakfast" value="1">
                                <label class="form-check-label" for="inlineCheckbox1">Breakfast</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="lunch" id="lunch" value="1">
                                <label class="form-check-label" for="inlineCheckbox2">Lunch</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="dinner" id="dinner" value="1">
                                <label class="form-check-label" for="inlineCheckbox3">Dinner</label>
                            </div>
                        </div>
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary" id="submit">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--update Meals modal-->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="update_meal_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    Update Meals
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--  add new form to modal-->
            <form action="<?php echo base_url('kitchen/Meals/update_meal'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Code</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="update_code" name="update_code">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Meal Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="update_meal_name" name="update_meal_name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Meal Type</label>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="update_breakfast" id="update_breakfast" value="1>
                                <label class="form-check-label" for="inlineCheckbox1">Breakfast</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="update_lunch" id="update_lunch" value="1">
                                <label class="form-check-label" for="inlineCheckbox2">Lunch</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="update_dinner" id="update_dinner" value="1">
                                <label class="form-check-label" for="inlineCheckbox3">Dinner</label>
                            </div>
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

<!--delete Meals modal-->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="delete_meal_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    Delete Meals
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--  add new form to modal-->
            <form action="<?php echo base_url('kitchen/Meals/delete_meal'); ?>" method="post">
                <div class="modal-body">
                    <p>Are You Sure Want To Delete This?</p>

                    <input type="hidden" id="delete_id" name="delete_id" value="">
                </div>

                <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="submit">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--view page script-->



<script>

    $(document).ready(function () {
        $('#meals_table').on('click', '#update_button', function () {
            var id = $(this).attr('data-id');

            $.ajax({
                type: 'post',
                url: base_url + 'kitchen/Meals/get_meal',
                async: false,
                dataType: 'json',
                data: {'id': id},
                success: function (response) {
                    $('#update_code').val(response[0]['code']);
                    $('#update_meal_name').val(response[0]['meal_name']);

                    if (response[0]['breakfast']){
                    $('#update_breakfast').prop('checked',true);
                    } else {
                        $('#update_breakfast').prop('checked',false);
                    }

                    if (response[0]['lunch']){
                        $('#update_lunch').prop('checked',true);
                    } else {
                        $('#update_lunch').prop('checked',false);
                    }

                    if (response[0]['dinner']){
                        $('#update_dinner').prop('checked',true);
                    } else {
                        $('#update_dinner').prop('checked',false);
                    }

                    $('#update_id').val(response[0]['id']);
                    $('#update_meal_modal').modal('show');
                }
            })
        });

        $('#meals_table').on('click', '#delete_button', function () {
            var id = $(this).attr('data-id');
            $('#delete_id').val(id);
            $('#delete_meal_modal').modal('show');
        })
    });


</script>
