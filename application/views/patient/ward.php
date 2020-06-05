<!-- Begin Page Content -->
<!-- container-fluid -->
<div class="container-fluid">
    <?php if ($this->session->flashdata('alert')) { ?>
        <script type="text/javascript">
            $(document).ready(function () {
                $.notify({
                        message: '<?php echo $this->session->flashdata('alert')['message']?>'
                    },
                    {
                        type: '<?php echo $this->session->flashdata('alert')['type']?>',
                        placement: {
                            from: "bottom",
                            align: "right"
                        },
                        animate: {
                            enter: 'animated fadeInDown',
                            exit: 'animated fadeOutUp'
                        },
                    });
            });
        </script>
    <?php } ?>

    <div class="row">
        <div class="col-md-12">
            <div class="text-right mb-4">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ward_modal">Add
                    Ward
                </button>
            </div>
            <!--ward category table-->
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Ward Number</th>
                    <th>Ward Name</th>
                    <th>Ward Gender</th>
                </tr>
                </thead>
                <!--display data on index-->
                <tbody>
                <?php foreach ($wards as $ward) { ?>
                    <tr>
                        <td><?php echo $ward->number; ?></td>
                        <td><?php echo $ward->name; ?></td>
                        <td><?php echo $ward->gender; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!--add new Ward modal-->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="ward_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    Add New Ward
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--  add new form to modal-->
            <form action="<?php echo base_url('patient/ward/create_ward'); ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Ward Number</label>
                            <input type="text" class="form-control" name="number">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Ward Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Ward Gender</label>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="radio-inline"><input type="radio" name="gender"
                                                                       value="male">Male</label>
                                    <label class="radio-inline"><input type="radio" name="gender" value="female">Female</label>
                                    <label class="radio-inline"><input type="radio" name="gender" value="female">Children</label>
                                </div>
                            </div>
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





