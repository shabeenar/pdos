<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url('welcome')?>">Dashboard</a></li>
        <li class="breadcrumb-item active"> <a href="<?php echo base_url('report/mealorderreport')?>">Report Date Range</a></li>
        <li class="breadcrumb-item active">Meal Order Report</li>
    </ol>


    <div class="row">
        <div class="col-md-12">

            <table class="table table-bordered" id="user_report_table">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Ward Name</th>
                    <th>Patient Category</th>
                    <th>Total Patient</th>

                </tr>
                </thead>
                <!--display data on index-->
                <tbody>
                <?php foreach ($orders as $order) {?>
                    <tr>
                        <td><?php echo $order->order_date; ?></td>
                        <td><?php echo $order->ward_name; ?></td>
                        <td><?php echo $order->patient_category_name; ?></td>
                        <td><?php echo $order->total_patients; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>




        </div>
    </div>
</div>
<!-- /.container-fluid -->