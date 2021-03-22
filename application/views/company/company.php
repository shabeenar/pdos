<!-- Begin Page Content -->
<!-- container-fluid -->
<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url('welcome')?>">Dashboard</a></li>
        <li class="breadcrumb-item active">Company Details</li>
    </ol>

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


    <!--user profile form-->
    <div class="row">
        <div class="col-md-12">

            <form action="<?php echo base_url('company/company/update_company'); ?>" method="post">
                <?php foreach ($companies as $company) { ?>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Name</label>

                        <input type="text" class="form-control" name="name" value="<?php echo $company->name; ?>">

                    </div>
                    <div class="form-group col-md-6">
                        <label>Telephone Number</label>
                        <input type="tel" class="form-control" name="phone" value="<?php echo $company->phone; ?>">

                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Address</label>
                        <textarea type="text" class="form-control" name="address"><?php echo $company->address; ?></textarea>

                        <div class="help-block with-errors"></div>

                    </div>

                    <input type="hidden" id="update_id" name="update_id" value="">

                </div>
                <?php } ?>


                <div class="text-right">
                    <button type="submit" class="btn btn-primary" id="submit">Update</button>
                </div>


            </form>
        </div>
    </div>
</div>







