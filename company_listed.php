<!-- Vendor Start -->
<div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel vendor-carousel">
                <?
                $company_query = "select * from company_list";
                $company_query_run = mysqli_query($conn,$company_query);
                while($company_fetch = mysqli_fetch_assoc($company_query_run)){
                ?>
                    <div class="bg-light p-4">
                        <a href="<?= $company_fetch['image_link'] ?>">
                        <img src="img\<?= $company_fetch['image_name'];  ?>" height="150"  alt=""></a>
                    </div>
                    <? } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor End -->