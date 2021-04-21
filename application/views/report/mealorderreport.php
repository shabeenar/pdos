<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url('welcome')?>">Dashboard</a></li>
        <li class="breadcrumb-item active">Meal Order Report</li>

    </ol>


    <div class="card">
        <div class="card-body">

            <form action="<?php echo base_url('report/ViewMealOrderReport/add_report') ?>" method="post">
                <div class="row">

                    <div class="form-group col-md-6">
                        <label for="cus_address">From Date</label>
                        <input type="date" class="form-control" name="from" id="from">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="city">To Date</label>
                        <input type="date" class="form-control" name="to" id="to" value="<?php echo date('Y-m-d'); ?>" readonly>
                    </div>

                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-success">
                            Submit
                        </button>
                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
