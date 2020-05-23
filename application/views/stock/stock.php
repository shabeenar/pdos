<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="text-right mb-4">
                <form action="<?php echo base_url('stock/stock/search_stock'); ?>" method="post">
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <dic class="card">
                <div class="card-header">
                    <div class="card-title">
                        Stock
                    </div>
                </div>
                <div class="card-body">
                    <!--stock table-->
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Item ID</th>
                            <th>Item Name</th>
                            <th>Item Category & Brand</th>
                            <th>Size</th>
                            <th>Received Quantity</th>
                            <th>Available Quantity</th>
                            <th></th>
                        </tr>
                        </thead>
                    </table>
                </div>
                <div class="card-footer"></div>
            </dic>
        </div>
    </div>
</div>
<!-- /.container-fluid -->





