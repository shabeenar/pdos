<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="text-right mb-4">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#supplier_modal">Add Supplier</button>
            </div>
            <dic class="card">
                <div class="card-header">
                    <div class="card-title">
                        Supplier
                    </div>
                </div>
                <div class="card-body">
                    <!--supplier table-->
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Supplier Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
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

<!--add new Supplier modal-->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="supplier_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    Add New Supplier
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('supplier/supplier/create_supplier'); ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Supplier Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Phone</label>
                            <input type="tel" class="form-control" name="phone">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Address</label>
                            <textarea type="text" class="form-control" name="address" rows="3"></textarea>
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





