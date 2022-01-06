<?php
    
    require_once 'db/db.php';

    // get settings currency_value
    $get_currency = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = '7'") or die(mysqli_error($connect_db));
    $get_currency_item = mysqli_fetch_array($get_currency);
    $currency = $get_currency_item['settings_ans'];

    // counter variables
    $subtotal_counter = 0;
    $find_cost_price = 0;
    $find_selling_price = 0;
    $cost_price_counter = 0;
    $selling_price_counter = 0;

    $profit_array = [];
    $sales_array = [];


    ## get january
    $current_year = date('Y');
    $january = $current_year.'-01';
    $january_subtotal = 0;
    $january_profit = 0;
    $fetch_january = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE `sales_datetime` LIKE '%$january%'") or die(mysqli_error($connect_db));
    if(!empty($fetch_january)) :
    while($data = mysqli_fetch_array($fetch_january)){
        $get_january_saleId = $data['sales_number'];
        $january_subtotal+= $data['sales_subtotal'];

        // now get january sales record 
        $get_sales = mysqli_query($connect_db,"SELECT * FROM tbl_sales WHERE `sales_id_number` = '$get_january_saleId'")or die(mysqli_error($connect_db));
        while($jan_sales = mysqli_fetch_array($get_sales))
        {
            $medicine_id = $jan_sales['medicineId'];
            $medicine_qty = $jan_sales['medicineQty'];

            // now get medicine prices
            $get_medicine_prices = mysqli_query($connect_db,"SELECT * FROM tbl_medicines WHERE mid = '$medicine_id'")or die(mysqli_error($connect_db));
            $medicine_details = mysqli_fetch_array($get_medicine_prices);
            $medicineCostPrice = $medicine_details['cost_price'];
            $medicineSellingPrice = $medicine_details['selling_price'];

             // calculate prices of cost & selling
            $find_cost_price = $medicineCostPrice*$medicine_qty;
            $find_selling_price = $medicineSellingPrice*$medicine_qty;

            $cost_price_counter+= $find_cost_price;
            $selling_price_counter += $find_selling_price;
        }
        // find profit
        $january_profit = $selling_price_counter - $cost_price_counter;
    }
    array_push($profit_array, $january_profit);
    array_push($sales_array, $january_subtotal);
    endif;

    // *************** 

    ## get february
    $current_year = date('Y');
    $february = $current_year.'-02';
    $february_subtotal = 0;
    $february_profit = 0;
    $fetch_february = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE `sales_datetime` LIKE '%$february%'") or die(mysqli_error($connect_db));
    if(!empty($fetch_february)) :
    while($data = mysqli_fetch_array($fetch_february)){
        $get_february_saleId = $data['sales_number'];
        $february_subtotal+= $data['sales_subtotal'];

        // now get february sales record 
        $get_sales = mysqli_query($connect_db,"SELECT * FROM tbl_sales WHERE `sales_id_number` = '$get_february_saleId'")or die(mysqli_error($connect_db));
        while($feb_sales = mysqli_fetch_array($get_sales))
        {
            $medicine_id = $feb_sales['medicineId'];
            $medicine_qty = $feb_sales['medicineQty'];

            // now get medicine prices
            $get_medicine_prices = mysqli_query($connect_db,"SELECT * FROM tbl_medicines WHERE mid = '$medicine_id'")or die(mysqli_error($connect_db));
            $medicine_details = mysqli_fetch_array($get_medicine_prices);
            $medicineCostPrice = $medicine_details['cost_price'];
            $medicineSellingPrice = $medicine_details['selling_price'];

             // calculate prices of cost & selling
            $find_cost_price = $medicineCostPrice*$medicine_qty;
            $find_selling_price = $medicineSellingPrice*$medicine_qty;

            $cost_price_counter+= $find_cost_price;
            $selling_price_counter += $find_selling_price;
        }
        // find profit
        $february_profit = $selling_price_counter - $cost_price_counter;
    }
    array_push($profit_array, $february_profit);
    array_push($sales_array, $february_subtotal);
    endif;
   
    // *****************


    ## get march
    $current_year = date('Y');
    $march = $current_year.'-03';
    $march_subtotal = 0;
    $march_profit = 0;
    $fetch_march = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE `sales_datetime` LIKE '%$march%'") or die(mysqli_error($connect_db));
    if(!empty($fetch_march)) :
    while($data = mysqli_fetch_array($fetch_march)){
        $get_march_saleId = $data['sales_number'];
        $march_subtotal+= $data['sales_subtotal'];

        // now get march sales record 
        $get_sales = mysqli_query($connect_db,"SELECT * FROM tbl_sales WHERE `sales_id_number` = '$get_march_saleId'")or die(mysqli_error($connect_db));
        while($march_sales = mysqli_fetch_array($get_sales))
        {
            $medicine_id = $march_sales['medicineId'];
            $medicine_qty = $march_sales['medicineQty'];

            // now get medicine prices
            $get_medicine_prices = mysqli_query($connect_db,"SELECT * FROM tbl_medicines WHERE mid = '$medicine_id'")or die(mysqli_error($connect_db));
            $medicine_details = mysqli_fetch_array($get_medicine_prices);
            $medicineCostPrice = $medicine_details['cost_price'];
            $medicineSellingPrice = $medicine_details['selling_price'];

             // calculate prices of cost & selling
            $find_cost_price = $medicineCostPrice*$medicine_qty;
            $find_selling_price = $medicineSellingPrice*$medicine_qty;

            $cost_price_counter+= $find_cost_price;
            $selling_price_counter += $find_selling_price;
        }
        // find profit
        $march_profit = $selling_price_counter - $cost_price_counter;
    }
    array_push($profit_array, $march_profit);
    array_push($sales_array, $march_subtotal);
    endif;

    // ***************************


    ## get april
    $current_year = date('Y');
    $april = $current_year.'-04';
    $april_subtotal = 0;
    $april_profit = 0;
    $fetch_april = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE `sales_datetime` LIKE '%$april%'") or die(mysqli_error($connect_db));
    if(!empty($fetch_april)) :
    while($data = mysqli_fetch_array($fetch_april)){
        $get_april_saleId = $data['sales_number'];
        $april_subtotal+= $data['sales_subtotal'];

        // now get april sales record 
        $get_sales = mysqli_query($connect_db,"SELECT * FROM tbl_sales WHERE `sales_id_number` = '$get_april_saleId'")or die(mysqli_error($connect_db));
        while($jan_sales = mysqli_fetch_array($get_sales))
        {
            $medicine_id = $jan_sales['medicineId'];
            $medicine_qty = $jan_sales['medicineQty'];

            // now get medicine prices
            $get_medicine_prices = mysqli_query($connect_db,"SELECT * FROM tbl_medicines WHERE mid = '$medicine_id'")or die(mysqli_error($connect_db));
            $medicine_details = mysqli_fetch_array($get_medicine_prices);
            $medicineCostPrice = $medicine_details['cost_price'];
            $medicineSellingPrice = $medicine_details['selling_price'];

             // calculate prices of cost & selling
            $find_cost_price = $medicineCostPrice*$medicine_qty;
            $find_selling_price = $medicineSellingPrice*$medicine_qty;

            $cost_price_counter+= $find_cost_price;
            $selling_price_counter += $find_selling_price;
        }
        // find profit
        $april_profit = $selling_price_counter - $cost_price_counter;
    }
    array_push($profit_array, $april_profit);
    array_push($sales_array, $april_subtotal);
    endif;

    // ******************

    
    ## get may
    $current_year = date('Y');
    $may = $current_year.'-05';
    $may_subtotal = 0;
    $may_profit = 0;
    $fetch_may = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE `sales_datetime` LIKE '%$may%'") or die(mysqli_error($connect_db));
    if(!empty($fetch_may)) :
    while($data = mysqli_fetch_array($fetch_may)){
        $get_may_saleId = $data['sales_number'];
        $may_subtotal+= $data['sales_subtotal'];

        // now get may sales record 
        $get_sales = mysqli_query($connect_db,"SELECT * FROM tbl_sales WHERE `sales_id_number` = '$get_may_saleId'")or die(mysqli_error($connect_db));
        while($may_sales = mysqli_fetch_array($get_sales))
        {
            $medicine_id = $may_sales['medicineId'];
            $medicine_qty = $may_sales['medicineQty'];

            // now get medicine prices
            $get_medicine_prices = mysqli_query($connect_db,"SELECT * FROM tbl_medicines WHERE mid = '$medicine_id'")or die(mysqli_error($connect_db));
            $medicine_details = mysqli_fetch_array($get_medicine_prices);
            $medicineCostPrice = $medicine_details['cost_price'];
            $medicineSellingPrice = $medicine_details['selling_price'];

             // calculate prices of cost & selling
            $find_cost_price = $medicineCostPrice*$medicine_qty;
            $find_selling_price = $medicineSellingPrice*$medicine_qty;

            $cost_price_counter+= $find_cost_price;
            $selling_price_counter += $find_selling_price;
        }
        // find profit
        $may_profit = $selling_price_counter - $cost_price_counter;
    }
    array_push($profit_array, $may_profit);
    array_push($sales_array, $may_subtotal);
    endif;


    // *****************

    
    ## get june
    $current_year = date('Y');
    $june = $current_year.'-06';
    $june_subtotal = 0;
    $june_profit = 0;
    // $fetch_june = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE `sales_datetime` LIKE '%$june%'") or die(mysqli_error($connect_db));
    $fetch_july = mysqli_query($connect_db,"SELECT * FROM tbl_special_sales WHERE MONTH(sales_datetime) = '06' AND YEAR(sales_datetime) = YEAR(CURDATE()) ORDER BY (sales_datetime)") or die(mysqli_error($connect_db));

    if(!empty($fetch_june)) :
    while($data = mysqli_fetch_array($fetch_june)){
        $get_june_saleId = $data['sales_number'];
        $june_subtotal+= $data['sales_subtotal'];

        // now get june sales record 
        $get_sales = mysqli_query($connect_db,"SELECT * FROM tbl_sales WHERE `sales_id_number` = '$get_june_saleId'")or die(mysqli_error($connect_db));
        while($june_sales = mysqli_fetch_array($get_sales))
        {
            $medicine_id = $june_sales['medicineId'];
            $medicine_qty = $june_sales['medicineQty'];

            // now get medicine prices
            $get_medicine_prices = mysqli_query($connect_db,"SELECT * FROM tbl_medicines WHERE mid = '$medicine_id'")or die(mysqli_error($connect_db));
            $medicine_details = mysqli_fetch_array($get_medicine_prices);
            $medicineCostPrice = $medicine_details['cost_price'];
            $medicineSellingPrice = $medicine_details['selling_price'];

             // calculate prices of cost & selling
            $find_cost_price = $medicineCostPrice*$medicine_qty;
            $find_selling_price = $medicineSellingPrice*$medicine_qty;

            $cost_price_counter+= $find_cost_price;
            $selling_price_counter += $find_selling_price;
        }
        // find profit
        $june_profit = $selling_price_counter - $cost_price_counter;
    }
    array_push($profit_array, $june_profit);
    array_push($sales_array, $june_subtotal);
    endif;

    // ****************************


    ## get july
    $current_year = date('Y');
    $july = $current_year.'-07';
    $july_subtotal = 0;
    $july_profit = 0;
    $medicine_total = 0;
    // $fetch_july = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE `sales_datetime` LIKE '%$july%' ") or die(mysqli_error($connect_db));
    $fetch_july = mysqli_query($connect_db,"SELECT * FROM tbl_special_sales WHERE MONTH(sales_datetime) = '07' AND YEAR(sales_datetime) = YEAR(CURDATE()) ORDER BY (sales_datetime)") or die(mysqli_error($connect_db));
    if(!empty($fetch_july)) :
    while($data = mysqli_fetch_array($fetch_july)){
        $get_july_saleId = $data['sales_number'];
        $july_subtotal+= $data['sales_subtotal'];

        // now get july sales record 
        $get_sales = mysqli_query($connect_db,"SELECT * FROM tbl_sales WHERE `sales_id_number` = '$get_july_saleId' ")or die(mysqli_error($connect_db));
        while($july_sales = mysqli_fetch_array($get_sales))
        {
            $medicine_id = $july_sales['medicineId'];
            $medicine_qty = $july_sales['medicineQty'];
            $medicine_total += $july_sales['profit'];

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
        $july_profit = $selling_price_counter - $cost_price_counter;
        // $july_profit= $medicine_total;
    }
    array_push($profit_array, $july_profit);
    array_push($sales_array, $july_subtotal);
    endif;

    // *******************


    ## get august
    $current_year = date('Y');
    $august = $current_year.'-08';
    $august_subtotal = 0;
    $august_profit = 0;
    $fetch_august = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE `sales_datetime` LIKE '%$august%'") or die(mysqli_error($connect_db));
    if(!empty($fetch_august)) :
    while($data = mysqli_fetch_array($fetch_august)){
        $get_august_saleId = $data['sales_number'];
        $august_subtotal+= $data['sales_subtotal'];

        // now get august sales record 
        $get_sales = mysqli_query($connect_db,"SELECT * FROM tbl_sales WHERE `sales_id_number` = '$get_august_saleId'")or die(mysqli_error($connect_db));
        while($august_sales = mysqli_fetch_array($get_sales))
        {
            $medicine_id = $august_sales['medicineId'];
            $medicine_qty = $august_sales['medicineQty'];

            // now get medicine prices
            $get_medicine_prices = mysqli_query($connect_db,"SELECT * FROM tbl_medicines WHERE mid = '$medicine_id'")or die(mysqli_error($connect_db));
            $medicine_details = mysqli_fetch_array($get_medicine_prices);
            $medicineCostPrice = $medicine_details['cost_price'];
            $medicineSellingPrice = $medicine_details['selling_price'];

             // calculate prices of cost & selling
            $find_cost_price = $medicineCostPrice*$medicine_qty;
            $find_selling_price = $medicineSellingPrice*$medicine_qty;

            $cost_price_counter+= $find_cost_price;
            $selling_price_counter += $find_selling_price;
        }
        // find profit
        $august_profit = $selling_price_counter - $cost_price_counter;
    }
    array_push($profit_array, $august_profit);
    array_push($sales_array, $august_subtotal);
    endif;


    // ******************


    ## get september
    $current_year = date('Y');
    $september = $current_year.'-09';
    $september_subtotal = 0;
    $september_profit = 0;
    $fetch_september = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE `sales_datetime` LIKE '%$september%'") or die(mysqli_error($connect_db));
    if(!empty($fetch_september)) :
    while($data = mysqli_fetch_array($fetch_september)){
        $get_september_saleId = $data['sales_number'];
        $september_subtotal+= $data['sales_subtotal'];

        // now get september sales record 
        $get_sales = mysqli_query($connect_db,"SELECT * FROM tbl_sales WHERE `sales_id_number` = '$get_september_saleId'")or die(mysqli_error($connect_db));
        while($jan_sales = mysqli_fetch_array($get_sales))
        {
            $medicine_id = $jan_sales['medicineId'];
            $medicine_qty = $jan_sales['medicineQty'];

            // now get medicine prices
            $get_medicine_prices = mysqli_query($connect_db,"SELECT * FROM tbl_medicines WHERE mid = '$medicine_id'")or die(mysqli_error($connect_db));
            $medicine_details = mysqli_fetch_array($get_medicine_prices);
            $medicineCostPrice = $medicine_details['cost_price'];
            $medicineSellingPrice = $medicine_details['selling_price'];

             // calculate prices of cost & selling
            $find_cost_price = $medicineCostPrice*$medicine_qty;
            $find_selling_price = $medicineSellingPrice*$medicine_qty;

            $cost_price_counter+= $find_cost_price;
            $selling_price_counter += $find_selling_price;
        }
        // find profit
        $september_profit = $selling_price_counter - $cost_price_counter;
    }
    array_push($profit_array, $september_profit);
    array_push($sales_array, $september_subtotal);
    endif;

    // *****************


    ## get october
    $current_year = date('Y');
    $october = $current_year.'-10';
    $october_subtotal = 0;
    $october_profit = 0;
    $fetch_october = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE `sales_datetime` LIKE '%$october%'") or die(mysqli_error($connect_db));
    if(!empty($fetch_october)) :
    while($data = mysqli_fetch_array($fetch_october)){
        $get_october_saleId = $data['sales_number'];
        $october_subtotal+= $data['sales_subtotal'];

        // now get october sales record 
        $get_sales = mysqli_query($connect_db,"SELECT * FROM tbl_sales WHERE `sales_id_number` = '$get_october_saleId'")or die(mysqli_error($connect_db));
        while($jan_sales = mysqli_fetch_array($get_sales))
        {
            $medicine_id = $jan_sales['medicineId'];
            $medicine_qty = $jan_sales['medicineQty'];

            // now get medicine prices
            $get_medicine_prices = mysqli_query($connect_db,"SELECT * FROM tbl_medicines WHERE mid = '$medicine_id'")or die(mysqli_error($connect_db));
            $medicine_details = mysqli_fetch_array($get_medicine_prices);
            $medicineCostPrice = $medicine_details['cost_price'];
            $medicineSellingPrice = $medicine_details['selling_price'];

             // calculate prices of cost & selling
            $find_cost_price = $medicineCostPrice*$medicine_qty;
            $find_selling_price = $medicineSellingPrice*$medicine_qty;

            $cost_price_counter+= $find_cost_price;
            $selling_price_counter += $find_selling_price;
        }
        // find profit
        $october_profit = $selling_price_counter - $cost_price_counter;
    }
    array_push($profit_array, $october_profit);
    array_push($sales_array, $october_subtotal);
    endif;

    // *****************

    
    ## get november
    $current_year = date('Y');
    $november = $current_year.'-11';
    $november_subtotal = 0;
    $november_profit = 0;
    $fetch_november = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE `sales_datetime` LIKE '%$november%'") or die(mysqli_error($connect_db));
    if(!empty($fetch_november)) :
    while($data = mysqli_fetch_array($fetch_november)){
        $get_november_saleId = $data['sales_number'];
        $november_subtotal+= $data['sales_subtotal'];

        // now get november sales record 
        $get_sales = mysqli_query($connect_db,"SELECT * FROM tbl_sales WHERE `sales_id_number` = '$get_november_saleId'")or die(mysqli_error($connect_db));
        while($jan_sales = mysqli_fetch_array($get_sales))
        {
            $medicine_id = $jan_sales['medicineId'];
            $medicine_qty = $jan_sales['medicineQty'];

            // now get medicine prices
            $get_medicine_prices = mysqli_query($connect_db,"SELECT * FROM tbl_medicines WHERE mid = '$medicine_id'")or die(mysqli_error($connect_db));
            $medicine_details = mysqli_fetch_array($get_medicine_prices);
            $medicineCostPrice = $medicine_details['cost_price'];
            $medicineSellingPrice = $medicine_details['selling_price'];

             // calculate prices of cost & selling
            $find_cost_price = $medicineCostPrice*$medicine_qty;
            $find_selling_price = $medicineSellingPrice*$medicine_qty;

            $cost_price_counter+= $find_cost_price;
            $selling_price_counter += $find_selling_price;
        }
        // find profit
        $november_profit = $selling_price_counter - $cost_price_counter;
    }
    array_push($profit_array, $november_profit);
    array_push($sales_array, $november_subtotal);
    endif;

    // *****************


    ## get december
    $current_year = date('Y');
    $december = $current_year.'-12';
    $december_subtotal = 0;
    $december_profit = 0;
    $fetch_december = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE `sales_datetime` LIKE '%$december%'") or die(mysqli_error($connect_db));
    if(!empty($fetch_december)) :
    while($data = mysqli_fetch_array($fetch_december)){
        $get_december_saleId = $data['sales_number'];
        $december_subtotal+= $data['sales_subtotal'];

        // now get december sales record 
        $get_sales = mysqli_query($connect_db,"SELECT * FROM tbl_sales WHERE `sales_id_number` = '$get_december_saleId'")or die(mysqli_error($connect_db));
        while($jan_sales = mysqli_fetch_array($get_sales))
        {
            $medicine_id = $jan_sales['medicineId'];
            $medicine_qty = $jan_sales['medicineQty'];

            // now get medicine prices
            $get_medicine_prices = mysqli_query($connect_db,"SELECT * FROM tbl_medicines WHERE mid = '$medicine_id'")or die(mysqli_error($connect_db));
            $medicine_details = mysqli_fetch_array($get_medicine_prices);
            $medicineCostPrice = $medicine_details['cost_price'];
            $medicineSellingPrice = $medicine_details['selling_price'];

             // calculate prices of cost & selling
            $find_cost_price = $medicineCostPrice*$medicine_qty;
            $find_selling_price = $medicineSellingPrice*$medicine_qty;

            $cost_price_counter+= $find_cost_price;
            $selling_price_counter += $find_selling_price;
        }
        // find profit
        $december_profit = $selling_price_counter - $cost_price_counter;
    }
    array_push($profit_array, $december_profit);
    array_push($sales_array, $december_subtotal);
    endif;
?>