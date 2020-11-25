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


            <form action="<?php echo base_url('purchase/ViewPurchase'); ?>" method="post">

                <table class="table table-bordered" id="purchase_table">
                    <thead>
                    <tr>
                        <th>Supplier Name</th>
                        <th>Purchase Date</th>
                        <th>Amount Total</th>
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
                            <?php if ($purchase->status == 1){ ?>
                                    <a class="btn btn-warning btn-sm" href="<?php base_url()?>View?id=<?php echo $purchase->id; ?>">View</a>
                            <?php }else{ ?>
                                    <a class="btn btn-warning btn-sm" href="<?php base_url()?>View/?id=<?php echo $purchase->id; ?>">View</a>
                            <?php } ?>
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