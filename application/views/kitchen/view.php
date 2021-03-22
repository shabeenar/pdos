<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url('welcome')?>">Dashboard</a></li>
        <li class="breadcrumb-item active"> <a href="<?php echo base_url('kitchen/order')?>">Meal Order Management</a></li>
        <li class="breadcrumb-item active">View Meal Order</li>
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

            <form action="<?php echo base_url('kitchen/View'); ?>" method="post">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Order Date</label>
                        <?php foreach ($orders as $order) { ?>
                        <input type="date" class="form-control" name="date" id="order_date" value="<?php echo $order->order_date; ?>">
                        <?php } ?>
                    </div>
                </div>
                <table class="table table-bordered" id="order_table">
                    <thead>
                    <tr>
                        <th>Ward</th>
                        <th>Patient Category</th>
                        <th>Total Patients</th>
                        <th>Breakfast</th>
                        <th>Lunch</th>
                        <th>Dinner</th>
                    </tr>
                    </thead>
                    <!--display data on index-->
                    <tbody id="order_lines">
                    <?php foreach ($order_lines as $order_line) { ?>
                        <tr>
                            <td><?php echo $order_line->ward_name; ?></td>
                            <td><?php echo $order_line->patient_category_name; ?></td>
                            <td class="text-right"><?php echo $order_line->total_patients; ?></td>
                            <td><?php echo $order_line->breakfast; ?></td>
                            <td><?php echo $order_line->lunch; ?></td>
                            <td><?php echo $order_line->dinner; ?></td>
                        </tr>

                    <?php } ?>
                    </tbody>
                </table>


            </form>
        </div>
    </div>
</div>






