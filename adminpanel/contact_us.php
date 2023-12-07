<?php
session_start();
// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
include_once("database.php");
if (!isset($_SESSION['id'])) {
    header("location:index.php");
}

$field = "id";
$mode = "asc";

if (isset($_GET['field'])) {
    $field = $_GET['field'];
    $mode = $_GET['mode'];
}


if ($mode == "asc") {
    $mode = "desc";
} else {
    $mode = "asc";
}

include_once("header.php");

$where = '';
if ($_GET['user_search'] ?? 0) {
    $where = ' where id like "%' . $_GET['user_search'] . '%" or name like "%' . $_GET['user_search'] . '%"';
}

$query = "SELECT * FROM contact_us " . $where;
$result = mysqli_query($conn, $query);
$total_raws = mysqli_num_rows($result);
$limit = 5;
$total_pages = ceil($total_raws / $limit);
if (!isset($_GET['page'])) {
    $page_number = 1;
} else {
    $page_number = $_GET['page'];
}
$initial_page = ($page_number - 1) * $limit;
$getQuery = "SELECT * FROM contact_us " . $where . "  order by $field $mode LIMIT " . $initial_page . ',' . $limit;
$result = mysqli_query($conn, $getQuery);









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
                    
  

            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>SEARILS</th>
                            <th>Id</a></th>
                            <th>NAME</a></th>
                            <th>PHONE NUMBER</th>
                            <th>EMAIL</th>
                            <th>Subject</th>
                            <th>Action</th>


                        </tr>
                    </thead>
                    <tbody>

                        <?
                        $i = 1;
                        while ($data = mysqli_fetch_array($result)) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $i++; ?>
                                </td>
                                <td>
                                    <?php echo $data['id']; ?>
                                </td>
                                <td>
                                    <?php echo $data['name']; ?>
                                </td>
                                <td>
                                    <?php echo $data['phone_no']; ?>
                                </td>
                                <td>
                                    <?php echo $data['e-mail']; ?>
                                </td>
                                <td>
                                    <?php echo $data['subject']; ?>
                                </td>

                                <td>

                                    <a href="contact_us_deatils.php?id=<?php echo $data['id']; ?>"> <button type="button"
                                            class="btn  btn-primary btn-xs">details</button></a>
                                    <a href="contact_us-del.php?id=<?php echo $data['id']; ?>"> <button type="button"
                                            class="btn  btn-secondary btn-xs">delete</button></a>



                                </td>
                            </tr>
                        <?php } ?>


                    </tbody>
                </table>
                <hr>
                <div class="action" style="text-align: center;">

                    <?
                    for ($page_number1 = 1; $page_number1 <= $total_pages; $page_number1++) {

                        if ($page_number == $page_number1) {

                            echo '<a class="action" href = "user_listing.php?feild=' . $field . '&mode=' . $mode . '&page=' . $page_number . '">' . $page_number . ' </a>';
                        } else {

                            echo '<a href = "user_listing.php?feild=' . $field . '&mode=' . $mode . '&page=' . $page_number1 . '">' . $page_number1 . ' </a>';
                        }

                    } ?>

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