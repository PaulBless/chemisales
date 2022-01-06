<?php

require_once '../../db/db.php';

$get_currency = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 7") or die(mysqli_error($connect_db));
$get_currency_item = mysqli_fetch_array($get_currency);
$currency = $get_currency_item['settings_ans'];

	if ($_POST['category_id']) {
		
		$pid = intval($_POST['category_id']);
		$query = mysqli_query($connect_db,"SELECT * FROM `tbl_products` WHERE `tbl_products`.`product_category` = '$pid'") or die(mysqli_error($connect_db));

        $selling_price ="";
        $selling_note="";
        $quantity_available="";
        $avail_note="";

		while ($each_product = mysqli_fetch_array($query)) { 
            $get_id = $each_product['tbl_products_id'];
            $get_name = $each_product['product_name'];
            $get_selling_price_pcs = $each_product['selling_price_pcs'];
            $get_selling_price_box = $each_product['selling_price_box'];
            $get_quantity_avail_pcs = $each_product['quantity_available_pcs'];
            $get_quantity_avail_box = $each_product['quantity_available_box'];

          
            
            ?>
            <div class="col-md-4">
		<figure class="card card-product-grid" id="<?php echo $get_id;  ?>">
			
			<figcaption class="info-wrap d-flex align-items-center text-center justify-content-center">
				<div class="fix-height">
					<a href="javascript:void(0)" class="title fs-20'"><?php echo $get_name; ?></a>
					<div class="price-wrap mt-2 mb-2">
						<span class="price h4"><?php echo $currency.' '.$get_selling_price_pcs; ?></span>
					</div> <!-- price-wrap.// -->
                    <div>Avail: <?php echo $get_quantity_avail_pcs;  ?></div>
				</div>
			</figcaption>
		</figure>
	</div> <!-- col.// -->
     <?php   }}   ?>