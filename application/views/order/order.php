<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="text-right mb-4">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#order_modal">Place Orders</button>
            </div>
            <dic class="card">
                <div class="card-header">
                    <div class="card-title">
                        Orders
                    </div>
                </div>
                <div class="card-body">
                    <!--orders table-->
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Patient Name</th>
                            <th>Ward</th>
                            <th>Bed</th>
                            <th>Order Status</th>
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

<!--add new order modal-->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="order_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    Place New Order
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('order/order/create_order'); ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Order Date</label>
                            <input type="date" class="form-control" name="date">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Patient Name</label>
                            <input type="text" class="form-control" name="patient_name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Ward</label>
                            <select class="form-control" name="ward">
                                <option>Select Ward</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Bed</label>
                            <input type="text" class="form-control" name="bed">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Patient Category</label>
                            <select class="form-control" name="patient_category">
                                <option>Select Category</option>
                            </select>
                        </div>
                        <div class="form-group col-md-1">
                            <label>Menu</label>
                        </div>
                        <div class="form-group col-md-1">
                            <label for="dinner"> Dinner</label>
                            <input type="checkbox" name=dinner">
                            <label for="breakfast"> Breakfast</label>
                            <input type="checkbox" name="breakfast">
                            <label for="lunch"> Lunch</label>
                            <input type="checkbox" name="lunch">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>






