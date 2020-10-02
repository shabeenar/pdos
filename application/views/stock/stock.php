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
                    <th>Item Category</th>
                    <th>Item Name</th>
                    <th>Price</th>
                    <th>Unit</th>
                    <th>Received Quantity</th>
                    <th>Available Quantity</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($items as $item) { ?>
                    <tr>

                        <td><?php echo $item->category_name; ?></td>
                        <td><?php echo $item->name; ?></td>
                        <td><?php echo $item->price; ?></td>
                        <td><?php echo $item->unit_name; ?></td>
                        <td><?php echo $item->quantity; ?></td>
                        <td> </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-secondary" id="update_button" data-id="<?php echo $item->id; ?>"><i class="fas fa-pencil-alt"></i>
                            </button>
                            <button type="button" class="btn btn-warning btn-sm" id="delete_button" data-id="<?php echo $item->id; ?>"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->





