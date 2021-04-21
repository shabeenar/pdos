<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url('welcome')?>">Dashboard</a></li>
        <li class="breadcrumb-item active"> <a href="<?php echo base_url('kitchen/order')?>">Meal Order Management</a></li>
        <li class="breadcrumb-item active">Place Meal Order</li>
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

    <!--add new order-->
    <div class="row">
        <div class="col-md-12">

            <form action="<?php echo base_url('kitchen/CreateOrder/create_mealorder'); ?>" method="post">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Order Date</label>
                        <input type="date" class="form-control" name="date" id="order_date" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                </div>
                <table class="table table-bordered" id="order_table">
                    <thead>
                    <tr>
                        <th>Ward</th>
                        <th>Patient Category</th>
                        <th>Diet Category</th>
                        <th>Total Patients</th>
                        <th>Breakfast</th>
                        <th>Lunch</th>
                        <th>Dinner</th>
                        <th class="text-center">
                            <button type="button" class="btn btn-success btn-sm" id="plus_button"><i
                                        class="fas fa-fw fa-plus"></i></button>
                        </th>
                    </tr>
                    </thead>
                    <!--display data on index-->
                    <tbody id="order_lines">
                    </tbody>
                </table>


                <div class="text-right mb-6">
                    <button type="submit" class="btn btn-success">Place Order</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        var breakfast = "";
        var lunch = "";
        var dinner = "";
        $.ajax({
            url: base_url + 'kitchen/CreateOrder/get_breakfast',
            success: function (response) {
                breakfast = response;
            }
        })

        $.ajax({
            url: base_url + 'kitchen/CreateOrder/get_lunch',
            success: function (response) {
                lunch = response;
            }
        })

        $.ajax({
            url: base_url + 'kitchen/CreateOrder/get_dinner',
            success: function (response) {
                dinner = response;
            }
        })
        $(document).on('click', '#plus_button', function () {
            $.ajax({
                url: base_url + 'kitchen/CreateOrder/generate_order_line',
                success: function (response) {
                    var options = response
                    var row = "";
                    row += '<tr>';
                    row += '<td><select name="order_patient_ward[]" id="order_patient_ward" class="form-control">' + options + '</select></td>';
                    row += '<td><select name="order_patient_category[]" id="order_patient_category" class="form-control"></select></td>';
                    row += '<td><select name="order_diet_category[]" id="order_diet_category" class="form-control"></select></td>';
                    row += '<td><input name="order_total_patient[]" id="order_total_patient" class="form-control" readonly></td>';
                    row += '<td><select name="order_breakfast[]" id="order_breakfast" class="form-control">' + breakfast + '</select></td>';
                    row += '<td><select name="order_lunch[]" id="order_lunch" class="form-control">' + lunch + '</select></td>';
                    row += '<td><select name="order_dinner[]" id="order_dinner" class="form-control">' + dinner + '</select></td>';
                    row += '<td class="text-center"><button type="button" class="btn btn-danger btn-sm" id="remove_order_line"><i class="fa fa-minus" aria-hidden="true"></i></button></td>';

                    $('#order_lines').append(row);
                }
            })
        })


        $(document).on('click', '#remove_order_line', function () {
            $(this).closest('tr').remove();
        })

        $('#order_lines').on('change', '#order_patient_ward', function () {
            var ward_name = $(this).val();
            var categories = ["<option disabled selected>Select Category</option>"];

            $.ajax({
                type: 'post',
                url: base_url + 'kitchen/CreateOrder/get_ward_categories',
                async: false,
                dataType: 'json',
                data: {'id': ward_name},
                success: function (response) {
                    response.forEach((row) => {
                        categories.push('<option value="' + row.category_id + '">' + row.category_name + '</option>');
                    })
                }
            })
            $(this).closest('tr').find('#order_patient_category option').remove();
            $(this).closest('tr').find('#order_patient_category').append(categories);
        })

        // new

        $('#order_lines').on('change', '#order_patient_category', function () {
            var patient_category = $(this).val();
            var diet_category = ["<option disabled selected>Select Category</option>"];

            $.ajax({
                type: 'post',
                url: base_url + 'kitchen/CreateOrder/get_patient_categories',
                async: false,
                dataType: 'json',
                data: {'id': patient_category},
                success: function (response) {
                    response.forEach((row) => {
                        diet_category.push('<option value="' + row.category_id + '">' + row.category_name + '</option>');
                    })
                }
            })
            $(this).closest('tr').find('#order_diet_category option').remove();
            $(this).closest('tr').find('#order_diet_category').append(diet_category);
        })


        $('#order_lines').on('change', '#order_diet_category',function () {
            var diet_category = $(this).val();
            var ward = $('#order_patient_ward').val();
            var patient_category = $('#order_patient_category').val();
            var total = "";

            $.ajax({
                type: 'post',
                url: base_url + 'kitchen/CreateOrder/get_total_patients',
                async: false,
                dataType: 'json',
                data: {'id': diet_category,  'ward_id':ward, 'patient_category_id':patient_category},
                success: function (response) {
                    total = response;

                }

            })
            $(this).closest('tr').find('#order_total_patient').val(total);

        })


    })

</script>





