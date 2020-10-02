<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Patient Category Chart</h5>
            <canvas id="pieChart" style="height:250px"></canvas>
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
            var PieData        = [{value:"2",color:"#fff6ee",highlight:"#b642e2",label:"Heart patients"},{value:"2",color:"#5a0144",highlight:"#8eb378",label:"Fever patients"},{value:"1",color:"#493cb2",highlight:"#e06b87",label:"Kidney patients"},{value:"1",color:"#a86515",highlight:"#ad97cb",label:"Influenza"},{value:"1",color:"#ed98f3",highlight:"#c324e7",label:"Norovirus"}];
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



        
