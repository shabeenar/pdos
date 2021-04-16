<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url('welcome')?>">Dashboard</a></li>
        <li class="breadcrumb-item active"> <a href="<?php echo base_url('report/userreport')?>">Report Date Range</a></li>
        <li class="breadcrumb-item active">User Report</li>
    </ol>


    <div class="row">
        <div class="col-md-12">

                <table class="table table-bordered" id="user_report_table">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>User Name</th>
                        <th>Role Name</th>

                    </tr>
                    </thead>
                    <!--display data on index-->
                    <tbody>
                    <?php foreach ($users as $user) {?>
                        <tr>
                            <td><?php echo $user->create_date; ?></td>
                            <td><?php echo $user->first_name.' '.$user->last_name; ?></td>
                            <td><?php echo $user->role_name; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>




        </div>
    </div>
</div>
<!-- /.container-fluid -->