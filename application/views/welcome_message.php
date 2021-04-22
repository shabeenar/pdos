<!-- Begin Page Content -->
<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-2">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>

    <div class="card">

        <div class="card-body">

            <div class="row">
                <div class="col-sm-3">
                    <div class="row card text-white bg-success mb-3" style="max-width: 18rem;">

                        <div class="card-body">

                            <h5 class="card-title"><?php echo $patients[0]->total_patient; ?></h5>

                            <p class="card-text">Total Patients</p>
                            <a href="<?php echo base_url("patient/patient"); ?>" class="btn btn-dark  ">View Patients</a>
                        </div>

                     </div>
                </div>

                <div class="col-sm-3">
                    <div class="row card text-white bg-warning mb-3" style="max-width: 18rem;">

                        <div class="card-body">

                            <h5 class="card-title"><?php echo $meal_orders[0]->total_order; ?></h5>

                            <p class="card-text">Total Meal Orders</p>
                            <a href="<?php echo base_url("kitchen/order"); ?>" class="btn btn-dark  ">View Meal Orders</a>
                        </div>

                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="row card text-white bg-primary  mb-3" style="max-width: 18rem;">

                        <div class="card-body">

                            <h5 class="card-title"><?php echo $purchases[0]->total_purchase; ?></h5>

                            <p class="card-text">Total Purchase Orders</p>
                            <a href="<?php echo base_url("purchase/viewpurchase"); ?>" class="btn btn-dark  ">View Purchases</a>
                        </div>

                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="row card text-white bg-secondary  mb-3" style="max-width: 18rem;">

                        <div class="card-body">

                            <h5 class="card-title"><?php echo $items[0]->total_item; ?></h5>

                            <p class="card-text">Total Food Items</p>
                            <a href="<?php echo base_url("item/item"); ?>" class="btn btn-dark  ">View Items</a>
                        </div>

                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-sm-6">
                    <h5 class="card-title">Patient Category Chart</h5>
                    <canvas id="pieChart" style="height:250px" ></canvas>
                </div>



                <div class="col-sm-6">
            <h5 class="card-title">Users</h5>

                    <table class="table table-bordered table-hover table-striped table-primary" id="users_table">
                        <thead class="table-info">
                        <tr>
                            <th>User Name</th>
                            <th>Role Name</th>
                            <th>Ward</th>

                        </tr>
                        </thead>
                        <!--display data on index-->
                        <tbody>
                        <?php foreach ($users as $user) { ?>
                            <tr>
                                <td><?php echo $user->first_name.' '.$user->last_name; ?></td>
                                <td><?php echo $user->role_name; ?></td>
                                <td><?php echo $user->ward_name; ?></td>

                            </tr>
                        <?php } ?>
                        </tbody>


                    </table>

                </div>

            </div>



        </div>

    </div>



</div>

<!-- /.container-fluid -->

<script>
    $(document).ready(function(){
        $(function () {
            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */

            //-------------
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
            var pieChart       = new Chart(pieChartCanvas);

            var PieData        = <?php if ($piedata){echo $piedata;}?>

            var pieOptions     = {
                //Boolean - Whether we should show a stroke on each segment
                segmentShowStroke    : true,
                //String - The colour of each segment stroke
                segmentStrokeColor   : '#fff',
                //Number - The width of each segment stroke
                segmentStrokeWidth   : 2,
                //Number - The percentage of the chart that we cut out of the middle
                percentageInnerCutout: 50, // This is 0 for Pie charts
                //Number - Amount of animation steps
                animationSteps       : 100,
                //String - Animation easing effect
                animationEasing      : 'easeOutBounce',
                //Boolean - Whether we animate the rotation of the Doughnut
                animateRotate        : true,
                //Boolean - Whether we animate scaling the Doughnut from the centre
                animateScale         : false,
                //Boolean - whether to make the chart responsive to window resizing
                responsive           : true,
                // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                maintainAspectRatio  : true,
                //String - A legend template
                legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            pieChart.Doughnut(PieData, pieOptions)
        })
    })

</script>



        
