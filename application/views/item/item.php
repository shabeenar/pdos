<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="text-right mb-4">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#item_modal">Add Item</button>
            </div>
            <dic class="card">
                <div class="card-header">
                    <div class="card-title">
                        Items
                    </div>
                </div>
                <div class="card-body">
                    <!--item table-->
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Brand Name</th>
                            <th>Category</th>
                            <th>Item Price</th>
                            <th>Quantity</th>
                            <th>Date</th>
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

<!--add new item modal-->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="item_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    Add New Item
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('item/item/create_item'); ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Category</label>
                            <select class="form-control" name="category">
                                <option>Select Category</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Brand Name</label>
                            <select class="form-control" name="brand">
                                <option>Select Brand</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Item Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Item Price</label>
                            <input type="number" class="form-control" name="price">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Quantity</label>
                            <input type="text" class="form-control" name="quantity">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Expire Date</label>
                            <input type="date" class="form-control" name="exp_date">
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





