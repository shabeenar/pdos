<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-2">
        <li class="breadcrumb-item"><a href="<?php echo base_url('welcome')?>">Dashboard</a></li>
        <li class="breadcrumb-item active">Purchase Order Management</li>
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

    <div class="row">
        <div class="col-md-12">


            <form action="<?php echo base_url('purchase/ViewPurchase'); ?>" method="post">

                <div class="text-right mb-4">
                    <a type="button" class="btn btn-success" href="<?php echo base_url("purchase/purchase"); ?>">Create Purchase Order</a>
                </div>

                <table class="table table-bordered" id="purchase_table">
                    <thead>
                    <tr>
                        <th>Supplier Name</th>
                        <th>Purchase Date</th>
                        <th>Amount Total</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>

                    </tr>
                    </thead>
                    <!--display data on index-->
                    <tbody>
                    <?php foreach ($purchases as $purchase) {?>
                        <tr>
                        <td><?php echo $purchase->supplier_name; ?></td>
                        <td><?php echo $purchase->date; ?></td>
                        <td class="text-right"><?php echo $purchase->total_price; ?></td>

                        <td class="text-center">
                            <?php if ($purchase->status == 1) { ?>
                                <h5><span class="badge badge-secondary ">Draft</span></h5>

                            <?php } elseif ($purchase->status == 2) { ?>
                                <h5><span class="badge badge-success ">Added to Stock</span></h5>

                            <?php } elseif ($purchase->status == 0) { ?>
                                <h5><span class="badge badge-danger ">Canceled</span></h5>

                            <?php } ?>
                        </td>

                        <td class="text-center">
                            <a class="btn btn-warning btn-sm" href="<?php base_url()?>View?id=<?php echo $purchase->id; ?>">View</a>
                        </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>



            </form>



        </div>
    </div>
</div>
<!-- /.container-fluid -->