<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="text-right mb-4">
                <form action="<?php echo base_url('item/stock/search_stock'); ?>" method="post">
                    <input type="search" placeholder="Search.." name="search">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <!--stock table-->
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Item Category</th>
                    <th>Brand</th>
                    <th>Size</th>
                    <th>Received Quantity</th>
                    <th>Available Quantity</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->





