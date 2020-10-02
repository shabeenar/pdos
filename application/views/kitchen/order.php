<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="text-right mb-4">
                <a type="button" class="btn btn-success" href="<?php echo base_url("kitchen/createorder"); ?>">Place Meal Orders</a>
            </div>
                    <!--orders table-->
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Patient Category</th>
                            <th>Ward</th>
                            <th>Order Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($orders as $order) { ?>
                            <tr>
                                <td><?php echo $order->id; ?></td>
                                <td><?php echo $order->patient_category; ?></td>
                                <td><?php echo $order->ward; ?></td>
                                <td></td>
                            </tr>
                        <?php } ?>

                        </tbody>
                    </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->






