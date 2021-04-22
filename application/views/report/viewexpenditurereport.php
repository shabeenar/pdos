<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url('welcome')?>">Dashboard</a></li>
        <li class="breadcrumb-item active"> <a href="<?php echo base_url('report/expenditurereport')?>">Report Date Range</a></li>
        <li class="breadcrumb-item active">Expenditure Report</li>
    </ol>


    <div class="row">
        <div class="col-md-12">

            <table class="table table-bordered" id="user_report_table">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Supplier Name</th>
                    <th>Ammount Total</th>

                </tr>
                </thead>
                <!--display data on index-->
                <tbody>
                <?php $sum = 0?>
                <?php foreach ($expenses as $expense) {?>
                    <tr>
                        <td><?php echo $expense->date; ?></td>
                        <td><?php echo $expense->supplier_name; ?></td>
                        <td><?php echo $expense->total_price; ?></td>
                        <?php $sum += $expense->total_price;?>

                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="2"><b>Total Sum</b></td>
                    <td><?php echo $sum;?></td>
                </tr>
                </tbody>
            </table>




        </div>
    </div>
</div>
<!-- /.container-fluid -->