<!-- Begin Page Content -->
<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url('welcome')?>">Dashboard</a></li>
        <li class="breadcrumb-item active">Meal Order Management</li>
    </ol>

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
                            <th>Ward</th>
                            <th>Total Patients</th>
                            <th>Date</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($orders as $order) { ?>
                            <tr>
                                <td class="text-right"><?php echo $order->id; ?></td>
                                <td><?php echo $order->ward_name; ?></td>
                                <td class="text-right"><?php echo $order->total_patients; ?></td>
                                <td><?php echo $order->order_date; ?></td>
                                <td class="text-center"><a class="btn btn-warning btn-sm" href="<?php base_url()?>View?id=<?php echo $order->id; ?>">View</a></td>
                            </tr>
                        <?php } ?>

                        </tbody>

                    </table>

        </div>
    </div>
</div>
<!-- /.container-fluid -->






