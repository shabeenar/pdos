<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url('welcome')?>">Dashboard</a></li>
        <li class="breadcrumb-item active"> <a href="<?php echo base_url('report/patientreport')?>">Report Date Range</a></li>
        <li class="breadcrumb-item active">Patient Report</li>
    </ol>


    <div class="row">
        <div class="col-md-12">

            <table class="table table-bordered" id="user_report_table">
                <thead>
                <tr>
                    <th>In Date</th>
                    <th>Patient Name</th>
                    <th>Patient Category</th>
                    <th>Ward Name</th>
                    <th>Bed Number</th>
                    <th>Diet Category</th>

                </tr>
                </thead>
                <!--display data on index-->
                <tbody>
                <?php $sum = 0?>
                <?php foreach ($patients as $patient) {?>
                    <tr>
                        <td><?php echo $patient->in_date; ?></td>
                        <td><?php echo $patient->name; ?></td>
                        <td><?php echo $patient->patient_category; ?></td>
                        <td><?php echo $patient->ward_name; ?></td>
                        <td><?php echo $patient->bed; ?></td>
                        <td><?php echo $patient->diet_category; ?></td>
                        <?php $sum += $patient->total_patients;?>
                    </tr>
                <?php } ?>

                <tr>
                    <td colspan="3"><b>Total Patients</b></td>
                    <td><?php echo $sum;?></td>
                </tr>
                </tbody>
            </table>




        </div>
    </div>
</div>
<!-- /.container-fluid -->