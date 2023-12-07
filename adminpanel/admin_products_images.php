<?php
session_start();
// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
include_once("database.php");
if (!isset($_SESSION['id'])) {
    header("location:index.php");
}

$products_id = $_GET['id'];

$image_query = "select * from `product_images` where `product_id` = '$products_id'";
$product_query_run = mysqli_query($conn, $image_query);
include_once("header.php");
include_once("navbar.php");
include_once("sidebar.php");
?>

<!-- Content Wrapper. Contains page content -->
<?
include_once('content-header.php')
    ?>



<style>
    .action {
        color: #78dcf5;
    }
</style>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">User List <a
                            href="admin_products_images_listing.php?id=<?php echo $products_id; ?>">
                            <button type="button" class="btn btn-default btn-xs">ADD NEW</button> </a></h3>



                    <form class="card-tools" method="get" action="">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" value="<?= $_GET['user_search'] ?? '' ?>" name="user_search"
                                class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">hhh</button></a>

                                </button>
                                <div class="add-button">

                                </div>

                            </div>
                    </form>

                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th><a href="admin_category.php?field=id&mode=<?php echo $mode; ?>">Id</a></th>
                                <th><a href="admin_category.php?field=price&mode=<?php echo $mode; ?>">Image</a></th>
                                <th>Action</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?
                            while ($products_image = mysqli_fetch_assoc($product_query_run)) { ?>


                                <tr>
                                    <td>
                                        <?= $products_image['id'] ?>

                                    </td>
                                    <td>
                                        <img src="../img/<?= $products_image['image'] ?>" width=20% alt="">

                                    </td>
                                    <td>
                                        <a href="admin_products_images_update.php?id=<?php echo $products_image['id']; ?>"><button
                                                type="button" class="btn  btn-success btn-xs">update</button></a>
                                        <a href="admin_products_image_del.php?id=<?php echo $products_image['id']; ?>">
                                            <button type="button" class="btn  btn-secondary btn-xs">delete</button></a>
                                    </td>
                                    <td>

                                        <? if ($products_image['status'] == 1) { ?>
                                            <a href="admin_products_image_status.php?id=<?php echo $products_image['id']; ?>"><button
                                                    type="button" class="btn  btn-success btn-xs">Active</button></a>
                                        <? } else { ?>
                                            <a href="admin_products_image_status.php?id=<?php echo $products_image['id']; ?>"><button
                                                    type="button" class="btn  btn-success btn-xs"
                                                    style="background-color:red;">Inactive</button></a>
                                        <? } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <hr>
                    <div class="card-footer">
                        <a href="admin_products.php"> <button type="button" class="btn btn-default">Home</button></a>
                    </div>
                    <div class="action" style="text-align: center;">
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                <div>

                </div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?
include_once('main-footer.php')
    ?>