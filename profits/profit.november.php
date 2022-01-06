<?php 

    require_once 'db/db.php';

    // get settings currency_value
    // $get_currency = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = '7'") or die(mysqli_error($connect_db));
    // $get_currency_item = mysqli_fetch_array($get_currency);
    // $currency = $get_currency_item['settings_ans'];

    // counter variables
    $subtotal_counter = 0;
    $find_cost_price = 0;
    $find_selling_price = 0;
    $cost_price_counter = 0;
    $selling_price_counter = 0;

    $november_sales_array = [];
    $november_profit_array = [];

    ## get november
    $november_subtotal = 0;
    $november_profit = 0;
    $medicine_total = 0;
    $fetch_november = mysqli_query($connect_db,"SELECT * FROM tbl_special_sales WHERE MONTH(sales_datetime) = '11' AND YEAR(sales_datetime) = YEAR(CURDATE()) ORDER BY (sales_datetime)") or die(mysqli_error($connect_db));
    if(!empty($fetch_november)) :
    while($data = mysqli_fetch_array($fetch_november)){
        $get_november_saleId = $data['sales_number'];
        $november_subtotal+= $data['sales_subtotal'];

        // now get november sales record 
        $get_sales = mysqli_query($connect_db,"SELECT * FROM tbl_sales WHERE `sales_id_number` = '$get_november_saleId' ")or die(mysqli_error($connect_db));
        while($november_sales = mysqli_fetch_array($get_sales))
        {
            $medicine_id = $november_sales['medicineId'];
            $medicine_qty = $november_sales['medicineQty'];
            $medicine_total += $november_sales['profit'];

            // now get medicine prices
            $get_medicine_prices = mysqli_query($connect_db,"SELECT * FROM tbl_medicines WHERE mid = '$medicine_id' ")or die(mysqli_error($connect_db));
            $medicine_details = mysqli_fetch_assoc($get_medicine_prices);

                $medicineCostPrice = $medicine_details['cost_price'];
                $medicineSellingPrice = $medicine_details['selling_price']; 
                // calculate prices of cost & selling
                $find_cost_price = $medicineCostPrice*$medicine_qty;
                $find_selling_price = $medicineSellingPrice*$medicine_qty;

                $cost_price_counter+=$find_cost_price;
                $selling_price_counter+=$find_selling_price;

        }
        // find profit
        $november_profit = $selling_price_counter - $cost_price_counter;
        // $november_profit= $medicine_total;
    }
    array_push($november_profit_array, $november_profit);
    array_push($november_sales_array, $november_subtotal);
    endif;

    // *******************

?>