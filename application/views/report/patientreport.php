<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url('welcome')?>">Dashboard</a></li>
        <li class="breadcrumb-item active">Report Date Range</li>

    </ol>


    <div class="card">
        <div class="card-body">

            <form action="<?php echo base_url('report/ViewPatientReport/add_report') ?>" method="post">

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>In Date</label>
                        <input type="date" class="form-control" name="from" id="from">
                    </div>

                    <div class="form-group col-md-6">
                        <label>To Date</label>
                        <input type="date" class="form-control" name="to" id="to" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Ward Name</label>
                        <select class="form-control" name="ward" id="ward">
                            <option disabled selected value style="display:none;">Select Ward</option>
                            <?php foreach ($wards as $ward) { ?>
                                <option value="<?php echo $ward->id; ?>"> <?php echo $ward->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Patient Category</label>
                        <select class="form-control" name="patient_category" id="patient_category">
                            <option disabled selected value style="display:none;">Select Category</option>
                            <?php foreach ($patient_categories as $patient_category) { ?>
                                <option value="<?php echo $patient_category->id; ?>"> <?php echo $patient_category->category_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Diet Category</label>
                        <select class="form-control" name="diet_category" id="diet_category">
                            <option disabled selected value style="display:none;">Select Category</option>
                            <?php foreach ($diet_categories as $diet_category) { ?>
                                <option value="<?php echo $diet_category->id; ?>"> <?php echo $diet_category->category_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>


            </form>

        </div>

    </div>

</div>
