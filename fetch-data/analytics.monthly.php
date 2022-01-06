<?php

require_once 'db/db.php';

$this_year = date('Y');

$selling_price_counter = 0;
$cost_price_counter = 0;
$get_cp = 0;
$get_sp = 0;

## Fetch All Monthly Sales & Profits Analytics
$monthly_sales_array = [];
$monthly_profit_array = [];

// january month
$jan_date = $this_year.'-01';
$jan_counter_sale = 0;
$jan_counter_profit = 0;

$stmt_january = "SELECT * FROM `tbl_special_sales` WHERE `sales_datetime` LIKE '%$jan_date%'";
$fetch_jan = mysqli_query($connect_db, $stmt_january)or die(mysqli_error($connect_db));
while( $sales_jan = mysqli_fetch_array($fetch_jan) ) {
    $jan_sales_numbers = $sales_jan['sales_number'];
    $amount = $sales_jan['sales_subtotal'];
    $jan_counter_sale+=$amount;

        // get profit for the date
        $query = mysqli_query($connect_db,"SELECT * FROM `tbl_sales` WHERE sales_id_number='$jan_sales_numbers'")or die(mysqli_error($connect_db));
        while($record = mysqli_fetch_array($query)) {
            $each_medicine_id = $record['medicineId'];
            $each_medicine_qty = $record['medicineQty'];

            // now get medicine details
            $get_products = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines` WHERE mid='$each_medicine_id'")or die(mysqli_error($connect_db));
            $each_product = mysqli_fetch_array($get_products);
            $costPrice = $each_product['cost_price'];
            $sellingPrice = $each_product['selling_price'];
                
            // calculate cost & selling prices
            $get_cp = $costPrice*$each_medicine_qty;
            $get_sp = $sellingPrice*$each_medicine_qty;
            // get total prices 
            $cost_price_counter+= $get_cp;
            $selling_price_counter += $get_sp;

        }
        $jan_counter_profit = $selling_price_counter - $cost_price_counter;
}
array_push($monthly_sales_array,$jan_counter_sale);
array_push($monthly_profit_array,$jan_counter_profit);

// end here


// february month
$feb_date = $this_year.'-02';
$feb_counter_sale = 0;
$feb_counter_profit = 0;

$stmt_feb = "SELECT * FROM `tbl_special_sales` WHERE `sales_datetime` LIKE '%$feb_date%'";
$fetch_feb = mysqli_query($connect_db, $stmt_feb)or die(mysqli_error($connect_db));
while( $sales_feb = mysqli_fetch_array($fetch_feb) ) {
    $feb_sales_numbers = $sales_feb['sales_number'];
    $amount = $sales_feb['sales_subtotal'];
    $feb_counter_sale+=$amount;

        // get profit for the date
        $query = mysqli_query($connect_db,"SELECT * FROM `tbl_sales` WHERE sales_id_number='$feb_sales_numbers'")or die(mysqli_error($connect_db));
        while($record = mysqli_fetch_array($query)) {
            $each_medicine_id = $record['medicineId'];
            $each_medicine_qty = $record['medicineQty'];

            // now get medicine details
            $get_products = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines` WHERE mid='$each_medicine_id'")or die(mysqli_error($connect_db));
            $each_product = mysqli_fetch_array($get_products);
            $costPrice = $each_product['cost_price'];
            $sellingPrice = $each_product['selling_price'];
                
            // calculate cost & selling prices
            $get_cp = $costPrice*$each_medicine_qty;
            $get_sp = $sellingPrice*$each_medicine_qty;
            // get total selling prices 
            $cost_price_counter+= $get_cp;
            $selling_price_counter += $get_sp;

        }
        $feb_counter_profit = $selling_price_counter - $cost_price_counter;
}
array_push($monthly_sales_array,$feb_counter_sale);
array_push($monthly_profit_array,$feb_counter_profit);

// end here 


// march month
$march_date = $this_year.'-03';
$march_counter_sale = 0;
$march_counter_profit = 0;

$stmt_march = "SELECT * FROM `tbl_special_sales` WHERE `sales_datetime` LIKE '%$march_date%'";
$fetch_march = mysqli_query($connect_db, $stmt_march)or die(mysqli_error($connect_db));
while( $sales_march = mysqli_fetch_array($fetch_march) ) {
    $march_sales_numbers = $sales_march['sales_number'];
    $amount = $sales_march['sales_subtotal'];
    $march_counter_sale+=$amount;

        // get profit for the date
        $query = mysqli_query($connect_db,"SELECT * FROM `tbl_sales` WHERE sales_id_number='$march_sales_numbers'")or die(mysqli_error($connect_db));
        while($record = mysqli_fetch_array($query)) {
            $each_medicine_id = $record['medicineId'];
            $each_medicine_qty = $record['medicineQty'];

            // now get medicine details
            $get_products = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines` WHERE mid='$each_medicine_id'")or die(mysqli_error($connect_db));
            $each_product = mysqli_fetch_array($get_products);
            $costPrice = $each_product['cost_price'];
            $sellingPrice = $each_product['selling_price'];
                
            // calculate cost & selling prices
            $get_cp = $costPrice*$each_medicine_qty;
            $get_sp = $sellingPrice*$each_medicine_qty;
            // get total selling prices 
            $cost_price_counter+= $get_cp;
            $selling_price_counter += $get_sp;

        }
        $march_counter_profit = $selling_price_counter - $cost_price_counter;
}
array_push($monthly_sales_array,$march_counter_sale);
array_push($monthly_profit_array,$march_counter_profit);

// end here 


// april month
$april_date = $this_year.'-04';
$april_counter_sale = 0;
$april_counter_profit = 0;

$stmt_april = "SELECT * FROM `tbl_special_sales` WHERE `sales_datetime` LIKE '%$april_date%'";
$fetch_april = mysqli_query($connect_db, $stmt_april)or die(mysqli_error($connect_db));
while( $sales_april = mysqli_fetch_array($fetch_april) ) {
    $april_sales_numbers = $sales_april['sales_number'];
    $amount = $sales_april['sales_subtotal'];
    $april_counter_sale+=$amount;

        // get profit for the date
        $query = mysqli_query($connect_db,"SELECT * FROM `tbl_sales` WHERE sales_id_number='$april_sales_numbers' LIMIT 1")or die(mysqli_error($connect_db));
        while($record = mysqli_fetch_array($query)) {
            $each_medicine_id = $record['medicineId'];
            $each_medicine_qty = $record['medicineQty'];

            // now get medicine details
            $get_products = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines` WHERE mid='$each_medicine_id'")or die(mysqli_error($connect_db));
            $each_product = mysqli_fetch_array($get_products);
            $costPrice = $each_product['cost_price'];
            $sellingPrice = $each_product['selling_price'];
                
            // calculate cost & selling prices
            $get_cp = $costPrice*$each_medicine_qty;
            $get_sp = $sellingPrice*$each_medicine_qty;
            // get total selling prices 
            $cost_price_counter+= $get_cp;
            $selling_price_counter += $get_sp;

        }
        $april_counter_profit = $selling_price_counter - $cost_price_counter;
}
array_push($monthly_sales_array,$april_counter_sale);
array_push($monthly_profit_array,$april_counter_profit);

// end here 


// may month
$may_date = $this_year.'-05';
$may_counter_sale = 0;
$may_counter_profit = 0;

$stmt_may = "SELECT * FROM `tbl_special_sales` WHERE `sales_datetime` LIKE '%$may_date%'";
$fetch_may = mysqli_query($connect_db, $stmt_may)or die(mysqli_error($connect_db));
while( $sales_may = mysqli_fetch_array($fetch_may) ) {
    $may_sales_numbers = $sales_may['sales_number'];
    $amount = $sales_may['sales_subtotal'];
    $may_counter_sale+=$amount;

        // get profit for the date
        $query = mysqli_query($connect_db,"SELECT * FROM `tbl_sales` WHERE sales_id_number='$may_sales_numbers' LIMIT 1")or die(mysqli_error($connect_db));
        while($record = mysqli_fetch_array($query)) {
            $each_medicine_id = $record['medicineId'];
            $each_medicine_qty = $record['medicineQty'];

            // now get medicine details
            $get_products = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines` WHERE mid='$each_medicine_id'")or die(mysqli_error($connect_db));
            $each_product = mysqli_fetch_array($get_products);
            $costPrice = $each_product['cost_price'];
            $sellingPrice = $each_product['selling_price'];
                
            // calculate cost & selling prices
            $get_cp = $costPrice*$each_medicine_qty;
            $get_sp = $sellingPrice*$each_medicine_qty;
            // get total selling prices 
            $cost_price_counter+= $get_cp;
            $selling_price_counter += $get_sp;

        }
        $may_counter_profit = $selling_price_counter - $cost_price_counter;
}
array_push($monthly_sales_array,$may_counter_sale);
array_push($monthly_profit_array,$may_counter_profit);

// end here


// june month
$june_date = $this_year.'-06';
$june_counter_sale = 0;
$june_counter_profit = 0;
$june_cp = 0;
$june_sp = 0;

$stmt_june = "SELECT * FROM `tbl_special_sales` WHERE `sales_datetime` LIKE '%$june_date%' ";
$fetch_june = mysqli_query($connect_db, $stmt_june)or die(mysqli_error($connect_db));
while( $sales_june = mysqli_fetch_array($fetch_june) ) {
    $june_sales_numbers = $sales_june['sales_number'];
    $amount = $sales_june['sales_subtotal'];
    $june_counter_sale+=$amount;

        // get profit for the date
        $query = mysqli_query($connect_db,"SELECT * FROM `tbl_sales` WHERE sales_id_number='$june_sales_numbers' LIMIT 1")or die(mysqli_error($connect_db));
        while($record = mysqli_fetch_array($query)) {
            $each_medicine_id = $record['medicineId'];
            $each_medicine_qty = $record['medicineQty'];

            // now get medicine details
            $get_products = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines` WHERE mid='$each_medicine_id'")or die(mysqli_error($connect_db));
            $each_product = mysqli_fetch_array($get_products);
            $costPrice = $each_product['cost_price'];
            $sellingPrice = $each_product['selling_price'];
                
            // calculate cost & selling prices
            $get_cp = $costPrice*$each_medicine_qty;
            $get_sp = $sellingPrice*$each_medicine_qty;
            // get total selling prices 
            $cost_price_counter+= $get_cp;
            $selling_price_counter += $get_sp;

        }
        $june_counter_profit = $selling_price_counter - $cost_price_counter;
}
array_push($monthly_sales_array,$june_counter_sale);
array_push($monthly_profit_array,$june_counter_profit);

// end here 


// july month
$july_date = $this_year.'-07';
$july_counter_sale = 0;
$july_counter_profit = 0;

// $stmt_july = "SELECT * FROM `tbl_special_sales` WHERE `sales_datetime` LIKE '%$july_date%' ";
$stmt_july = "SELECT * FROM `tbl_special_sales` WHERE YEAR(`sales_datetime`)=YEAR(CURDATE()) AND MONTH(sales_datetime) = MONTH(CURDATE()) ";
$fetch_july = mysqli_query($connect_db, $stmt_july)or die(mysqli_error($connect_db));
while( $sales_july = mysqli_fetch_array($fetch_july) ) {
    $july_sales_numbers = $sales_july['sales_number'];
    $amount = $sales_july['sales_subtotal'];
    $july_counter_sale+=$amount;

        // get profit for the date
        $query = mysqli_query($connect_db,"SELECT * FROM `tbl_sales` WHERE sales_id_number='$july_sales_numbers' ")or die(mysqli_error($connect_db));
        while($record = mysqli_fetch_array($query)) {
            $each_medicine_id = $record['medicineId'];
            $each_medicine_qty = $record['medicineQty'];
            $each_medicine_profit = $record['profit'];

            // now get medicine details
            $get_products = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines` WHERE mid='$each_medicine_id' ")or die(mysqli_error($connect_db));
            $each_product = mysqli_fetch_array($get_products);
            $costPrice = $each_product['cost_price'];
            $sellingPrice = $each_product['selling_price'];
                
            // calculate cost & selling prices
            $get_cp = $costPrice*$each_medicine_qty;
            $get_sp = $sellingPrice*$each_medicine_qty;
            // $get_sp += $each_medicine_total;
            // get total selling prices 
            $cost_price_counter+= $get_cp;
            $selling_price_counter+= $get_sp;

        }
        $july_counter_profit = $selling_price_counter - $cost_price_counter;
}
array_push($monthly_sales_array,$july_counter_sale);
array_push($monthly_profit_array,$july_counter_profit);

// end here 


// august month
$aug_date = $this_year.'-08';
$aug_counter_sale = 0;
$aug_counter_profit = 0;

$stmt_aug = "SELECT * FROM `tbl_special_sales` WHERE `sales_datetime` LIKE '%$aug_date%'";
$fetch_aug = mysqli_query($connect_db, $stmt_aug)or die(mysqli_error($connect_db));
while( $sales_aug = mysqli_fetch_array($fetch_aug) ) {
    $aug_sales_numbers = $sales_aug['sales_number'];
    $amount = $sales_aug['sales_subtotal'];
    $aug_counter_sale+=$amount;

        // get profit for the date
        $query = mysqli_query($connect_db,"SELECT * FROM `tbl_sales` WHERE sales_id_number='$aug_sales_numbers'")or die(mysqli_error($connect_db));
        while($record = mysqli_fetch_array($query)) {
            $each_medicine_id = $record['medicineId'];
            $each_medicine_qty = $record['medicineQty'];

            // now get medicine details
            $get_products = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines` WHERE mid='$each_medicine_id'")or die(mysqli_error($connect_db));
            $each_product = mysqli_fetch_array($get_products);
            $costPrice = $each_product['cost_price'];
            $sellingPrice = $each_product['selling_price'];
                
            // calculate cost & selling prices
            $get_cp = $costPrice*$each_medicine_qty;
            $get_sp = $sellingPrice*$each_medicine_qty;
            // get total selling prices 
            $cost_price_counter+= $get_cp;
            $selling_price_counter += $get_sp;

        }
        $aug_counter_profit = $selling_price_counter - $cost_price_counter;
}
array_push($monthly_sales_array,$aug_counter_sale);
array_push($monthly_profit_array,$aug_counter_profit);

// end here 


// september month
$sep_date = $this_year.'-09';
$sep_counter_sale = 0;
$sep_counter_profit = 0;

$stmt_sep = "SELECT * FROM `tbl_special_sales` WHERE `sales_datetime` LIKE '%$sep_date%'";
$fetch_sep = mysqli_query($connect_db, $stmt_sep)or die(mysqli_error($connect_db));
while( $sales_sep = mysqli_fetch_array($fetch_sep) ) {
    $sep_sales_numbers = $sales_sep['sales_number'];
    $amount = $sales_sep['sales_subtotal'];
    $sep_counter_sale+=$amount;

        // get profit for the date
        $query = mysqli_query($connect_db,"SELECT * FROM `tbl_sales` WHERE sales_id_number='$sep_sales_numbers'")or die(mysqli_error($connect_db));
        while($record = mysqli_fetch_array($query)) {
            $each_medicine_id = $record['medicineId'];
            $each_medicine_qty = $record['medicineQty'];

            // now get medicine details
            $get_products = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines` WHERE mid='$each_medicine_id'")or die(mysqli_error($connect_db));
            $each_product = mysqli_fetch_array($get_products);
            $costPrice = $each_product['cost_price'];
            $sellingPrice = $each_product['selling_price'];
                
            // calculate cost & selling prices
            $get_cp = $costPrice*$each_medicine_qty;
            $get_sp = $sellingPrice*$each_medicine_qty;
            // get total selling prices 
            $cost_price_counter+= $get_cp;
            $selling_price_counter += $get_sp;

        }
        $sep_counter_profit = $selling_price_counter - $cost_price_counter;
}
array_push($monthly_sales_array,$sep_counter_sale);
array_push($monthly_profit_array,$sep_counter_profit);

// end here 


// october month
$oct_date = $this_year.'-10';
$oct_counter_sale = 0;
$oct_counter_profit = 0;

$stmt_oct = "SELECT * FROM `tbl_special_sales` WHERE `sales_datetime` LIKE '%$oct_date%'";
$fetch_oct = mysqli_query($connect_db, $stmt_oct)or die(mysqli_error($connect_db));
while( $sales_oct = mysqli_fetch_array($fetch_oct) ) {
    $oct_sales_numbers = $sales_oct['sales_number'];
    $amount = $sales_oct['sales_subtotal'];
    $oct_counter_sale+=$amount;

        // get profit for the date
        $query = mysqli_query($connect_db,"SELECT * FROM `tbl_sales` WHERE sales_id_number='$oct_sales_numbers'")or die(mysqli_error($connect_db));
        while($record = mysqli_fetch_array($query)) {
            $each_medicine_id = $record['medicineId'];
            $each_medicine_qty = $record['medicineQty'];

            // now get medicine details
            $get_products = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines` WHERE mid='$each_medicine_id'")or die(mysqli_error($connect_db));
            $each_product = mysqli_fetch_array($get_products);
            $costPrice = $each_product['cost_price'];
            $sellingPrice = $each_product['selling_price'];
                
            // calculate cost & selling prices
            $get_cp = $costPrice*$each_medicine_qty;
            $get_sp = $sellingPrice*$each_medicine_qty;
            // get total selling prices 
            $cost_price_counter+= $get_cp;
            $selling_price_counter += $get_sp;

        }
        $oct_counter_profit = $selling_price_counter - $cost_price_counter;
}
array_push($monthly_sales_array,$oct_counter_sale);
array_push($monthly_profit_array,$oct_counter_profit);

// end here 


// november month
$nov_date = $this_year.'-11';
$nov_counter_sale = 0;
$nov_counter_profit = 0;

$stmt_nov = "SELECT * FROM `tbl_special_sales` WHERE `sales_datetime` LIKE '%$nov_date%'";
$fetch_nov = mysqli_query($connect_db, $stmt_nov)or die(mysqli_error($connect_db));
while( $sales_nov = mysqli_fetch_array($fetch_nov) ) {
    $nov_sales_numbers = $sales_nov['sales_number'];
    $amount = $sales_nov['sales_subtotal'];
    $nov_counter_sale+=$amount;

        // get profit for the date
        $query = mysqli_query($connect_db,"SELECT * FROM `tbl_sales` WHERE sales_id_number='$nov_sales_numbers'")or die(mysqli_error($connect_db));
        while($record = mysqli_fetch_array($query)) {
            $each_medicine_id = $record['medicineId'];
            $each_medicine_qty = $record['medicineQty'];

            // now get medicine details
            $get_products = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines` WHERE mid='$each_medicine_id'")or die(mysqli_error($connect_db));
            $each_product = mysqli_fetch_array($get_products);
            $costPrice = $each_product['cost_price'];
            $sellingPrice = $each_product['selling_price'];
                
            // calculate cost & selling prices
            $get_cp = $costPrice*$each_medicine_qty;
            $get_sp = $sellingPrice*$each_medicine_qty;
            // get total selling prices 
            $cost_price_counter+= $get_cp;
            $selling_price_counter += $get_sp;

        }
        $nov_counter_profit = $selling_price_counter - $cost_price_counter;
}
array_push($monthly_sales_array,$nov_counter_sale);
array_push($monthly_profit_array,$nov_counter_profit);

// end here 


// december month
$dec_date = $this_year.'-12';
$dec_counter_sale = 0;
$dec_counter_profit = 0;

$stmt_dec = "SELECT * FROM `tbl_special_sales` WHERE `sales_datetime` LIKE '%$dec_date%'";
$fetch_dec = mysqli_query($connect_db, $stmt_dec)or die(mysqli_error($connect_db));
while( $sales_dec = mysqli_fetch_array($fetch_dec) ) {
    $dec_sales_numbers = $sales_dec['sales_number'];
    $amount = $sales_dec['sales_subtotal'];
    $dec_counter_sale+=$amount;

        // get profit for the date
        $query = mysqli_query($connect_db,"SELECT * FROM `tbl_sales` WHERE sales_id_number='$dec_sales_numbers' ")or die(mysqli_error($connect_db));
        while($record = mysqli_fetch_array($query)) {
            $each_medicine_id = $record['medicineId'];
            $each_medicine_qty = $record['medicineQty'];

            // now get medicine details
            $get_products = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines` WHERE mid='$each_medicine_id'")or die(mysqli_error($connect_db));
            $each_product = mysqli_fetch_array($get_products);
            $costPrice = $each_product['cost_price'];
            $sellingPrice = $each_product['selling_price'];
                
            // calculate cost & selling prices
            $get_cp = $costPrice*$each_medicine_qty;
            $get_sp = $sellingPrice*$each_medicine_qty;
            // get total selling prices 
            $cost_price_counter+= $get_cp;
            $selling_price_counter += $get_sp;

        }
        $dec_counter_profit = $selling_price_counter - $cost_price_counter;
}
array_push($monthly_sales_array,$dec_counter_sale);
array_push($monthly_profit_array,$dec_counter_profit);

// end here 




?>