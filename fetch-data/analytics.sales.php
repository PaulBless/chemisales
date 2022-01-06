<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'db/db.php';

$today_date = date('Y-m-d');
$this_year = date('Y');

$get_currency = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 7") or die(mysqli_error($connect_db));
$get_currency_item = mysqli_fetch_array($get_currency);
$currency = $get_currency_item['settings_ans'];

// Get sales number 

$get_sales_today = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE sales_datetime LIKE '%$today_date%'")or die(mysqli_error($connect_db));
$sales_counter = 0;
$expense_counter = 0;
$medicine_counter = 0;
$purchase_counter = 0;
$profit_counter = 0;

while ($get_sales = mysqli_fetch_array($get_sales_today)) {
    $sales_subtotal = $get_sales['sales_total'];
    $sales_counter+= $sales_subtotal;
}

// Get Expense number 

$get_expense_today = mysqli_query($connect_db,"SELECT * FROM `tbl_expenses` WHERE expense_date LIKE '%$today_date%'")or die(mysqli_error($connect_db));
$expense_counter = 0;

while ($get_expense = mysqli_fetch_array($get_expense_today)) {
    $expense_total = $get_expense['expense_amount'];
    $expense_counter+= $expense_total;
}

// Get Purchase number
$get_purchase_today = mysqli_query($connect_db,"SELECT * FROM `tbl_purchases` WHERE purchase_date LIKE '%$today_date%'")or die(mysqli_error($connect_db));
$purchase_counter = 0;

while ($get_purchase = mysqli_fetch_array($get_expense_today)) {
    $purchase_total = $get_purchase['purchase_amount'];
    $purchase_counter+= $purchase_total;
}


// Get medicine number

// $get_total_medicine = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines`")or die(mysqli_error($connect_db));
$get_total_medicine = mysqli_query($connect_db,"SELECT * FROM `tbl_temporary_stocks`")or die(mysqli_error($connect_db));

while ($get_medicine = mysqli_fetch_array($get_total_medicine)) {
    $medicine_quantity = $get_medicine['stock_level'];
    $medicine_counter+= $medicine_quantity;
}


// Get Users number
$get_total_users = mysqli_query($connect_db,"SELECT * FROM `tbl_users`")or die(mysqli_error($connect_db));
$user_counter = 0;

while ($get_users = mysqli_fetch_array($get_total_users)) {
    $user_counter++;
}

//Getting values for chart
$sales_array = [];
$expenditure_array = [];
$profit_array = [];
$purchase_array = [];

## January Begins Here 
## ---------------------

// January
$counter_1 = 0;
$counter_1_1 = 0;
$counter_1_1_2 = 0;
$current_year = date('Y');
$all_january = $current_year.'-01';

// fetch january sales
$get_january = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE `sales_datetime` LIKE '%$all_january%'")or die(mysqli_error($connect_db));
while ($each_january = mysqli_fetch_array($get_january)) {
    $get_amount = $each_january['sales_total'];
    $get_sales_number = $each_january['sales_number'];
    $counter_1+= $get_amount;

    // get profit for month
    $get_jan_profit = mysqli_query($connect_db,"SELECT * FROM `tbl_sales` WHERE `sales_datetime` LIKE '%all_january%'")or die(mysqli_error($connect_db));
    

}
array_push($sales_array,$counter_1);

// fetch january expenses
$get_january = mysqli_query($connect_db,"SELECT * FROM tbl_expenses WHERE `expense_date` LIKE '%$all_january%'")or die(mysqli_error($connect_db));
while ($each_january = mysqli_fetch_array($get_january)) {
    $get_amount = $each_january['expense_amount'];
    $counter_1_1+= $get_amount;
}
array_push($expenditure_array,$counter_1_1);

// fetch january purchase
$get_january = mysqli_query($connect_db,"SELECT * FROM `tbl_purchases` WHERE `purchase_date` LIKE '%all_january%'")or die(mysqli_error($connect_db));
while ($each_january = mysqli_fetch_array($get_january)){
    $get_amount = $each_january['purchase_amount'];
    $counter_1_1_2+= $get_amount;
}
array_push($purchase_array,$counter_1_1_2);

## --------------------------
## January Ends Here


## February Begins here
## --------------------

// February
$counter_2 = 0;
$counter_2_1 = 0;
$counter_2_1_2 = 0;
$current_year = date('Y');
$all_february = $current_year.'-02';

// fetch february sales
$get_february = mysqli_query($connect_db,"SELECT * FROM tbl_special_sales WHERE `sales_datetime` LIKE '%$all_february%'")or die(mysqli_error($connect_db));
while ($each_february = mysqli_fetch_array($get_february)) {
    $get_amount = $each_february['sales_total'];
    $counter_2+= $get_amount;
}
array_push($sales_array,$counter_2);

// fetch february expense
$get_february = mysqli_query($connect_db,"SELECT * FROM tbl_expenses WHERE `expense_date` LIKE '%$all_february%'")or die(mysqli_error($connect_db));
while ($each_february = mysqli_fetch_array($get_february)) {
    $get_amount = $each_february['expense_amount'];
    $counter_2_1+= $get_amount;
}
array_push($expenditure_array,$counter_2_1);

// fetch february purchase
$get_february  = mysqli_query($connect_db,"SELECT * FROM `tbl_purchases` WHERE `purchase_date` LIKE '%$all_february%'")or die(mysqli_error($connect_db));
while($each_february = mysqli_fetch_array($get_february)) {
    $get_amount = $each_february['purchase_amount'];
    $counter_2_1_2+=$get_amount;
}
array_push($purchase_array,$counter_2_1_2);

## ------------------------------------
## February Ends here


// March Begins Here
// ---------------------
$counter_3 = 0;
$counter_3_1 = 0;
$counter_3_1_2 = 0;
$current_year = date('Y');
$all_march = $current_year.'-03';

// fetch march sales
$get_march = mysqli_query($connect_db,"SELECT * FROM tbl_special_sales WHERE `sales_datetime` LIKE '%$all_march%'")or die(mysqli_error($connect_db));
while ($each_march = mysqli_fetch_array($get_march)) {
    $get_amount = $each_march['sales_total'];
    $counter_3+= $get_amount;
}
array_push($sales_array,$counter_3);

// fetch march expenses
$get_march = mysqli_query($connect_db,"SELECT * FROM `tbl_expenses` WHERE `expense_date` LIKE '%$all_march%'")or die(mysqli_error($connect_db));
while ($each_march = mysqli_fetch_array($get_march)) {
    $get_amount = $each_march['expense_amount'];
    $counter_3_1+= $get_amount;
}
array_push($expenditure_array,$counter_3_1);

// fetch march purchases
$get_march = mysqli_query($connect_db,"SELECT * FROM `tbl_purchases` WHERE `purchase_date` LIKE '%all_march%'") or die(mysqli_error($connect_db));
while($each_march = mysqli_fetch_array($get_march)) {
    $get_amount = $each_march['purchase_amount'];
    $counter_3_1_2+= $get_amount;
}
array_push($purchase_array,$counter_3_1_2);

## March Ends Here 


// April Begins 
$counter_4 = 0;
$counter_4_1 = 0;
$counter_4_1_2 = 0;
$current_year = date('Y');
$all_april = $current_year.'-04';

// fetch april sales 
$get_april = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE `sales_datetime` LIKE '%$all_april%'")or die(mysqli_error($connect_db));
while ($each_april = mysqli_fetch_array($get_april)) {
    $get_amount = $each_april['sales_total'];
    $counter_4+= $get_amount;
}
array_push($sales_array,$counter_4);

// fetch april expenses
$get_april = mysqli_query($connect_db,"SELECT * FROM `tbl_expenses` WHERE `expense_date` LIKE '%$all_april%'")or die(mysqli_error($connect_db));
while ($each_april = mysqli_fetch_array($get_april)) {
    $get_amount = $each_april['expense_amount'];
    $counter_4_1+= $get_amount;
}
array_push($expenditure_array,$counter_4_1);

// fetch april purchases
$get_april = mysqli_query($connect_db,"SELECT * FROM `tbl_purchases` WHERE `purchase_date` LIKE '%all_april%'") or die(mysqli_error($connect_db));
while($each_april = mysqli_fetch_array($get_april)) {
    $get_amount = $each_april['purchase_amount'];
    $counter_4_1_2+= $get_amount;
}
array_push($purchase_array,$counter_4_1_2);

## April End Here 


// May Begins
$counter_5 = 0;
$counter_5_1 = 0;
$counter_5_1_2 = 0;
$current_year = date('Y');
$all_may = $current_year.'-05';

// fetch may sales 
$get_may = mysqli_query($connect_db,"SELECT * FROM tbl_special_sales WHERE `sales_datetime` LIKE '%$all_may%'")or die(mysqli_error($connect_db));
while ($each_may = mysqli_fetch_array($get_may)) {
    $get_amount = $each_may['sales_total'];
    $counter_5+= $get_amount;
}
array_push($sales_array,$counter_5);

// fetch may expenses
$get_may = mysqli_query($connect_db,"SELECT * FROM tbl_expenses WHERE `expense_date` LIKE '%$all_may%'")or die(mysqli_error($connect_db));
while ($each_may = mysqli_fetch_array($get_may)) {
    $get_amount = $each_may['expense_amount'];
    $counter_5_1+= $get_amount;
}
array_push($expenditure_array,$counter_5_1);

// fetch may purchases 
$get_may = mysqli_query($connect_db,"SELECT * FROM `tbl_purchases` WHERE `purchase_date` LIKE '%all_may%'") or die(mysqli_error($connect_db));
while($each_may = mysqli_fetch_array($get_may)) {
    $get_amount = $each_may['purchase_amount'];
    $counter_5_1_2+= $get_amount;
}
array_push($purchase_array,$counter_5_1_2);

## May Ends Here


// June Begins 
$counter_6 = 0;
$counter_6_1 = 0;
$counter_6_1_2 = 0;
$current_year = date('Y');
$all_june = $current_year.'-06';

// fetch june sales 
$get_june = mysqli_query($connect_db,"SELECT * FROM tbl_special_sales WHERE `sales_datetime` LIKE '%$all_june%'")or die(mysqli_error($connect_db));
while ($each_june = mysqli_fetch_array($get_june)) {
    $get_amount = $each_june['sales_total'];
    $counter_6+= $get_amount;
}
array_push($sales_array,$counter_6);

// fetch june expenses 
$get_june = mysqli_query($connect_db,"SELECT * FROM tbl_expenses WHERE `expense_date` LIKE '%$all_june%'")or die(mysqli_error($connect_db));
while ($each_june = mysqli_fetch_array($get_june)) {
    $get_amount = $each_june['expense_amount'];
    $counter_6_1+= $get_amount;
}
array_push($expenditure_array,$counter_6_1);

// fetch june purchases
$get_june = mysqli_query($connect_db,"SELECT * FROM `tbl_purchases` WHERE `purchase_date` LIKE '%all_june%'") or die(mysqli_error($connect_db));
while($each_june = mysqli_fetch_array($get_june)) {
    $get_amount = $each_june['purchase_amount'];
    $counter_6_1_2+= $get_amount;
}
array_push($purchase_array,$counter_6_1_2);

## June Ends Here


// July Begins
$counter_7 = 0;
$counter_7_1 = 0;
$counter_7_1_2 = 0;
$current_year = date('Y');
$all_july = $current_year.'-07';

// fetch july sales 
$get_july = mysqli_query($connect_db,"SELECT * FROM tbl_special_sales WHERE `sales_datetime` LIKE '%$all_july%'")or die(mysqli_error($connect_db));
while ($each_july = mysqli_fetch_array($get_july)) {
    $get_amount = $each_july['sales_total'];
    $counter_7+= $get_amount;
}
array_push($sales_array,$counter_7);

// fetch july expenses
$get_july = mysqli_query($connect_db,"SELECT * FROM tbl_expenses WHERE `expense_date` LIKE '%$all_july%'")or die(mysqli_error($connect_db));
while ($each_july = mysqli_fetch_array($get_july)) {
    $get_amount = $each_july['expense_amount'];
    $counter_7_1+= $get_amount;
}
array_push($expenditure_array,$counter_7_1);

// fetch july purchases
$get_july = mysqli_query($connect_db,"SELECT * FROM `tbl_purchases` WHERE `purchase_date` LIKE '%all_july%'") or die(mysqli_error($connect_db));
while($each_july = mysqli_fetch_array($get_july)) {
    $get_amount = $each_july['purchase_amount'];
    $counter_7_1_2+= $get_amount;
}
array_push($purchase_array,$counter_7_1_2);

## July Ends Here


// August Begins
$counter_8 = 0;
$counter_8_1 = 0;
$counter_8_1_2 = 0;
$current_year = date('Y');
$all_august = $current_year.'-08';

// fetch sales 
$get_august = mysqli_query($connect_db,"SELECT * FROM tbl_special_sales WHERE `sales_datetime` LIKE '%$all_august%'")or die(mysqli_error($connect_db));
while ($each_august = mysqli_fetch_array($get_august)) {
    $get_amount = $each_august['sales_total'];
    $counter_8+= $get_amount;
}
array_push($sales_array,$counter_8);

// fetch expenses
$get_august = mysqli_query($connect_db,"SELECT * FROM tbl_expenses WHERE `expense_date` LIKE '%$all_august%'")or die(mysqli_error($connect_db));
while ($each_august = mysqli_fetch_array($get_august)) {
    $get_amount = $each_august['expense_amount'];
    $counter_8_1+= $get_amount;
}
array_push($expenditure_array,$counter_8_1);

// fetch august purchases
$get_august = mysqli_query($connect_db,"SELECT * FROM `tbl_purchases` WHERE `purchase_date` LIKE '%all_august%'") or die(mysqli_error($connect_db));
while($each_august = mysqli_fetch_array($get_august)) {
    $get_amount = $each_august['purchase_amount'];
    $counter_8_1_2+= $get_amount;
}
array_push($purchase_array,$counter_8_1_2);

## August Ends Here


// September
$counter_9 = 0;
$counter_9_1 = 0;
$counter_9_1_2 = 0;
$current_year = date('Y');
$all_september = $current_year.'-09';

// fetch sales 
$get_september = mysqli_query($connect_db,"SELECT * FROM tbl_special_sales WHERE `sales_datetime` LIKE '%$all_september%'")or die(mysqli_error($connect_db));
while ($each_september = mysqli_fetch_array($get_september)) {
    $get_amount = $each_september['sales_total'];
    $counter_9+= $get_amount;
}
array_push($sales_array,$counter_9);

// fetch expenses 
$get_september = mysqli_query($connect_db,"SELECT * FROM tbl_expenses WHERE `expense_date` LIKE '%$all_september%'")or die(mysqli_error($connect_db));
while ($each_september = mysqli_fetch_array($get_september)) {
    $get_amount = $each_september['expense_amount'];
    $counter_9_1+= $get_amount;
}
array_push($expenditure_array,$counter_9_1);

// fetch september purchases
$get_september = mysqli_query($connect_db,"SELECT * FROM `tbl_purchases` WHERE `purchase_date` LIKE '%all_september%'") or die(mysqli_error($connect_db));
while($each_september = mysqli_fetch_array($get_september)) {
    $get_amount = $each_september['purchase_amount'];
    $counter_9_1_2+= $get_amount;
}
array_push($purchase_array,$counter_9_1_2);

## September Ends Here


// October
$counter_10 = 0;
$counter_10_1 = 0;
$counter_10_1_2 = 0;
$current_year = date('Y');
$all_october = $current_year.'-10';

// fetch sales 
$get_october = mysqli_query($connect_db,"SELECT * FROM tbl_special_sales WHERE `sales_datetime` LIKE '%$all_october%'")or die(mysqli_error($connect_db));
while ($each_october = mysqli_fetch_array($get_october)) {
    $get_amount = $each_october['sales_total'];
    $counter_10+= $get_amount;
}
array_push($sales_array,$counter_10);

// fetch expenses
$get_october = mysqli_query($connect_db,"SELECT * FROM tbl_expenses WHERE `expense_date` LIKE '%$all_october%'")or die(mysqli_error($connect_db));
while ($each_october = mysqli_fetch_array($get_october)) {
    $get_amount = $each_october['expense_amount'];
    $counter_10_1+= $get_amount;
}
array_push($expenditure_array,$counter_10_1);

// fetch october purchases
$get_october = mysqli_query($connect_db,"SELECT * FROM `tbl_purchases` WHERE `purchase_date` LIKE '%all_october%'") or die(mysqli_error($connect_db));
while($each_october = mysqli_fetch_array($get_october)) {
    $get_amount = $each_october['purchase_amount'];
    $counter_10_1_2+= $get_amount;
}
array_push($purchase_array,$counter_10_1_2);

## October Ends Here


// November Begins 
$counter_11 = 0;
$counter_11_1 = 0;
$counter_11_1_2 = 0;
$current_year = date('Y');
$all_november = $current_year.'-11';

$get_november = mysqli_query($connect_db,"SELECT * FROM tbl_special_sales WHERE `sales_datetime` LIKE '%$all_november%'")or die(mysqli_error($connect_db));
while ($each_november = mysqli_fetch_array($get_november)) {
    $get_amount = $each_november['sales_total'];
    $counter_11+= $get_amount;
}
array_push($sales_array,$counter_11);

$get_november = mysqli_query($connect_db,"SELECT * FROM tbl_expenses WHERE `expense_date` LIKE '%$all_november%'")or die(mysqli_error($connect_db));
while ($each_november = mysqli_fetch_array($get_november)) {
    $get_amount = $each_november['expense_amount'];
    $counter_11_1+= $get_amount;
}
array_push($expenditure_array,$counter_11_1);

// fetch november purchases
$get_november = mysqli_query($connect_db,"SELECT * FROM `tbl_purchases` WHERE `purchase_date` LIKE '%all_november%'") or die(mysqli_error($connect_db));
while($each_november = mysqli_fetch_array($get_november)) {
    $get_amount = $each_november['purchase_amount'];
    $counter_11_1_2+= $get_amount;
}
array_push($purchase_array,$counter_11_1_2);

## November Ends Here


// December
$counter_12 = 0;
$counter_12_1 = 0;
$counter_12_1_2 = 0;
$current_year = date('Y');
$all_december = $current_year.'-12';

// fetch december sales 
$get_december = mysqli_query($connect_db,"SELECT * FROM tbl_special_sales WHERE `sales_datetime` LIKE '%$all_december%'")or die(mysqli_error($connect_db));
while ($each_december = mysqli_fetch_array($get_december)) {
    $get_amount = $each_december['sales_total'];
    $counter_12+= $get_amount;
}
array_push($sales_array,$counter_12);

// fetch december expenses
$get_december = mysqli_query($connect_db,"SELECT * FROM tbl_expenses WHERE `expense_date` LIKE '%$all_december%'")or die(mysqli_error($connect_db));
while ($each_december = mysqli_fetch_array($get_december)) {
    $get_amount = $each_december['expense_amount'];
    $counter_12_1+= $get_amount;
}
array_push($expenditure_array,$counter_12_1);


// fetch december purchases
$get_december = mysqli_query($connect_db,"SELECT * FROM `tbl_purchases` WHERE `purchase_date` LIKE '%all_december%'") or die(mysqli_error($connect_db));
while($each_december = mysqli_fetch_array($get_december)) {
    $get_amount = $each_december['purchase_amount'];
    $counter_12_1_2+= $get_amount;
}
array_push($purchase_array,$counter_12_1_2);

## December Ends Here

// ---------------- //


## Sales by Staff 
    $user_sale_array = [];
    $seller_name_array = [];

    $cnt = 1;
    $curr_year = date('Y');
    $each_user_saleAmount = 0;
    $each_user_saleCount = 0;
    $seller_id = 0;
    $sale_seller_name = "";
    //get count of sales
    $s_sql = "SELECT * FROM `tbl_special_sales` WHERE Year(sales_datetime)='$curr_year' GROUP BY `sales_seller_id` ORDER BY `sales_subtotal` DESC";
    $query = mysqli_query($connect_db,$s_sql) or die(mysqli_error($connect_db));
        while($row = mysqli_fetch_array($query)){
            $sales = $row['sales_subtotal'];
            $each_user_saleAmount += $sales;

            // $saleCount = $row['total_made'];
            // $each_user_saleCount += $saleCount;

            $seller_id = $row['sales_seller_id'];
                

            // get name of sales seller 
            $sql = "SELECT * FROM `tbl_users` WHERE `uid` = '".$row['sales_seller_id']."' ";
            $query = mysqli_query($connect_db, $sql) or die(mysqli_error($connect_db));
            while($user_details = mysqli_fetch_assoc($query)){
                $firstname = $user_details['user_firstname']; 
                $lastname = $user_details['user_lastname']; 
                $sale_seller_name = $firstname.' '.$lastname; 

                array_push($seller_name_array, $sale_seller_name);
            }

            array_push($user_sale_array, $each_user_saleAmount);
        }

## end 


## Following Code Will Fetch Weekly Sales Analytics
$day_sales_array = [];
$get_amount = 0;


// fetch monday sales 
$monday_counter = 0;
$get_monday = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE DATe(sales_datetime) = DATE_ADD(CURDATE(), INTERVAL - WEEKDAY(CURDATE()) DAY)")or die(mysqli_error($connect_db));
while ($each_monday = mysqli_fetch_array($get_monday)) {
    $get_amount = $each_monday['sales_total'];
    $monday_counter+= $get_amount;
}
array_push($day_sales_array,$monday_counter);

// fetch tuesday sales 
$tuesday_counter = 0;
$get_tuesday = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE DATE(sales_datetime) = DATE_ADD(( SELECT DATE_ADD(CURDATE(), INTERVAL - WEEKDAY(CURDATE()) DAY)), INTERVAL 1 DAY)")or die(mysqli_error($connect_db));
while ($each_tuesday = mysqli_fetch_array($get_tuesday)) {
    $get_amount = $each_tuesday['sales_total'];
    $tuesday_counter+= $get_amount;
}
array_push($day_sales_array,$tuesday_counter);

// fetch wednesday sales 
$wednesday_counter = 0;
$get_wednesday = mysqli_query($connect_db,"SELECT * FROM tbl_special_sales WHERE DATE(sales_datetime) = DATE_ADD(( SELECT DATE_ADD(CURDATE(), INTERVAL - WEEKDAY(CURDATE()) DAY)), INTERVAL 2 DAY)")or die(mysqli_error($connect_db));
while ($each_wednesday = mysqli_fetch_array($get_wednesday)) {
    $get_amount = $each_wednesday['sales_total'];
    $wednesday_counter+= $get_amount;
}
array_push($day_sales_array,$wednesday_counter);

// fetch thursday sales 
$thursday_counter = 0;
$get_thursday = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE DATE(sales_datetime) = DATE_ADD(( SELECT DATE_ADD(CURDATE(), INTERVAL - WEEKDAY(CURDATE()) DAY)), INTERVAL 3 DAY)")or die(mysqli_error($connect_db));
while ($each_thursday = mysqli_fetch_array($get_thursday)) {
    $get_amount = $each_thursday['sales_total'];
    $thursday_counter+= $get_amount;
}
array_push($day_sales_array,$thursday_counter);

// fetch friday sales 
$friday_counter = 0;
$get_friday = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE DATE(sales_datetime) = DATE_ADD(( SELECT DATE_ADD(CURDATE(), INTERVAL - WEEKDAY(CURDATE()) DAY)), INTERVAL 4 DAY)")or die(mysqli_error($connect_db));
while ($each_friday = mysqli_fetch_array($get_friday)) {
    $get_amount = $each_friday['sales_total'];
    $friday_counter+= $get_amount;
}

array_push($day_sales_array,$friday_counter);

// fetch saturday sales 
$saturday_counter = 0;
$get_saturday = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE DATE(sales_datetime) = DATE_ADD(( SELECT DATE_ADD(CURDATE(), INTERVAL - WEEKDAY(CURDATE()) DAY)), INTERVAL 5 DAY)")or die(mysqli_error($connect_db));
while ($each_saturday = mysqli_fetch_array($get_saturday)) {
    $get_amount = $each_saturday['sales_total'];
    $saturday_counter+= $get_amount;
}
array_push($day_sales_array,$saturday_counter);


// fetch sunday sales 
$sunday_counter = 0;
$get_sunday = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE DATE(sales_datetime) = DATE_ADD(( SELECT DATE_ADD(CURDATE(), INTERVAL - WEEKDAY(CURDATE()) DAY)), INTERVAL 6 DAY)")or die(mysqli_error($connect_db));
while ($each_sunday = mysqli_fetch_array($get_sunday)) {
    $get_amount = $each_sunday['sales_total'];
    $sunday_counter+= $get_amount;
}
array_push($day_sales_array,$sunday_counter);

// ------------ End ------------------



// sql query to db
$sql = mysqli_query($connect_db,"SELECT SUM(`sales_subtotal`), COUNT(`ssid`) as `tot`, DAYNAME(`sales_datetime`) AS `dayname` FROM tbl_special_sales WHERE sales_datetime LIKE '%2021-07%' AND WEEKDAY(sales_datetime) = '0'
")or die(mysqli_error($connect_db));







?>