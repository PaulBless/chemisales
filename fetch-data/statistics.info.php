<?php
require_once 'db/db.php';
$today_date = date('Y-m-d');

$get_currency = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 7") or die(mysqli_error($connect_db));
$get_currency_item = mysqli_fetch_array($get_currency);
$currency = $get_currency_item['settings_ans'];

// Get sales number 

$get_sales_today = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE sales_datetime LIKE '%$today_date%'")or die(mysqli_error($connect_db));
$sales_counter = 0;
$expense_counter = 0;
$medicine_counter = 0;

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

// January
$counter_1 = 0;
$counter_1_1 = 0;
$current_year = date('Y');
$all_januaray = $current_year.'-01';

$get_january = mysqli_query($connect_db,"SELECT * FROM tbl_special_sales WHERE `sales_datetime` LIKE '%$all_januaray%'")or die(mysqli_error($connect_db));
while ($each_january = mysqli_fetch_array($get_january)) {
    $get_amount = $each_january['sales_total'];
    $counter_1+= $get_amount;
}
array_push($sales_array,$counter_1);


$get_january = mysqli_query($connect_db,"SELECT * FROM tbl_expenses WHERE `expense_date` LIKE '%$all_januaray%'")or die(mysqli_error($connect_db));
while ($each_january = mysqli_fetch_array($get_january)) {
    $get_amount = $each_january['expense_amount'];
    $counter_1_1+= $get_amount;
}
array_push($expenditure_array,$counter_1_1);

// February
$counter_2 = 0;
$counter_2_1 = 0;
$current_year = date('Y');
$all_february = $current_year.'-02';

$get_february = mysqli_query($connect_db,"SELECT * FROM tbl_special_sales WHERE `sales_datetime` LIKE '%$all_february%'")or die(mysqli_error($connect_db));
while ($each_february = mysqli_fetch_array($get_february)) {
    $get_amount = $each_february['sales_total'];
    $counter_2+= $get_amount;
}
array_push($sales_array,$counter_2);


$get_february = mysqli_query($connect_db,"SELECT * FROM tbl_expenses WHERE `expense_date` LIKE '%$all_february%'")or die(mysqli_error($connect_db));
while ($each_february = mysqli_fetch_array($get_february)) {
    $get_amount = $each_february['expense_amount'];
    $counter_2_1+= $get_amount;
}
array_push($expenditure_array,$counter_2_1);

// March
$counter_3 = 0;
$counter_3_1 = 0;
$current_year = date('Y');
$all_march = $current_year.'-03';

$get_march = mysqli_query($connect_db,"SELECT * FROM tbl_special_sales WHERE `sales_datetime` LIKE '%$all_march%'")or die(mysqli_error($connect_db));
while ($each_march = mysqli_fetch_array($get_march)) {
    $get_amount = $each_march['sales_total'];
    $counter_3+= $get_amount;
}
array_push($sales_array,$counter_3);

$get_march = mysqli_query($connect_db,"SELECT * FROM `tbl_expenses` WHERE `expense_date` LIKE '%$all_march%'")or die(mysqli_error($connect_db));
while ($each_march = mysqli_fetch_array($get_march)) {
    $get_amount = $each_march['expense_amount'];
    $counter_3_1+= $get_amount;
}
array_push($expenditure_array,$counter_3_1);

// April
$counter_4 = 0;
$counter_4_1 = 0;
$current_year = date('Y');
$all_april = $current_year.'-04';

$get_april = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE `sales_datetime` LIKE '%$all_april%'")or die(mysqli_error($connect_db));
while ($each_april = mysqli_fetch_array($get_april)) {
    $get_amount = $each_april['sales_total'];
    $counter_4+= $get_amount;
}
array_push($sales_array,$counter_4);


$get_april = mysqli_query($connect_db,"SELECT * FROM `tbl_expenses` WHERE `expense_date` LIKE '%$all_april%'")or die(mysqli_error($connect_db));
while ($each_april = mysqli_fetch_array($get_april)) {
    $get_amount = $each_april['expense_amount'];
    $counter_4_1+= $get_amount;
}
array_push($expenditure_array,$counter_4_1);

// May
$counter_5 = 0;
$counter_5_1 = 0;
$current_year = date('Y');
$all_may = $current_year.'-05';

$get_may = mysqli_query($connect_db,"SELECT * FROM tbl_special_sales WHERE `sales_datetime` LIKE '%$all_may%'")or die(mysqli_error($connect_db));
while ($each_may = mysqli_fetch_array($get_may)) {
    $get_amount = $each_may['sales_total'];
    $counter_5+= $get_amount;
}
array_push($sales_array,$counter_5);


$get_may = mysqli_query($connect_db,"SELECT * FROM tbl_expenses WHERE `expense_date` LIKE '%$all_may%'")or die(mysqli_error($connect_db));
while ($each_may = mysqli_fetch_array($get_may)) {
    $get_amount = $each_may['expense_amount'];
    $counter_5_1+= $get_amount;
}
array_push($expenditure_array,$counter_5_1);

// June
$counter_6 = 0;
$counter_6_1 = 0;
$current_year = date('Y');
$all_june = $current_year.'-06';

$get_june = mysqli_query($connect_db,"SELECT * FROM tbl_special_sales WHERE `sales_datetime` LIKE '%$all_june%'")or die(mysqli_error($connect_db));
while ($each_june = mysqli_fetch_array($get_june)) {
    $get_amount = $each_june['sales_total'];
    $counter_6+= $get_amount;
}
array_push($sales_array,$counter_6);


$get_june = mysqli_query($connect_db,"SELECT * FROM tbl_expenses WHERE `expense_date` LIKE '%$all_june%'")or die(mysqli_error($connect_db));
while ($each_june = mysqli_fetch_array($get_june)) {
    $get_amount = $each_june['expense_amount'];
    $counter_6_1+= $get_amount;
}
array_push($expenditure_array,$counter_6_1);

// July
$counter_7 = 0;
$counter_7_1 = 0;
$current_year = date('Y');
$all_july = $current_year.'-07';

$get_july = mysqli_query($connect_db,"SELECT * FROM tbl_special_sales WHERE `sales_datetime` LIKE '%$all_july%'")or die(mysqli_error($connect_db));
while ($each_july = mysqli_fetch_array($get_july)) {
    $get_amount = $each_july['sales_total'];
    $counter_7+= $get_amount;
}
array_push($sales_array,$counter_7);


$get_july = mysqli_query($connect_db,"SELECT * FROM tbl_expenses WHERE `expense_date` LIKE '%$all_july%'")or die(mysqli_error($connect_db));
while ($each_july = mysqli_fetch_array($get_july)) {
    $get_amount = $each_july['expense_amount'];
    $counter_7_1+= $get_amount;
}
array_push($expenditure_array,$counter_7_1);

// August
$counter_8 = 0;
$counter_8_1 = 0;
$current_year = date('Y');
$all_august = $current_year.'-08';

$get_august = mysqli_query($connect_db,"SELECT * FROM tbl_special_sales WHERE `sales_datetime` LIKE '%$all_august%'")or die(mysqli_error($connect_db));
while ($each_august = mysqli_fetch_array($get_august)) {
    $get_amount = $each_august['sales_total'];
    $counter_8+= $get_amount;
}
array_push($sales_array,$counter_8);


$get_august = mysqli_query($connect_db,"SELECT * FROM tbl_expenses WHERE `expense_date` LIKE '%$all_august%'")or die(mysqli_error($connect_db));
while ($each_august = mysqli_fetch_array($get_august)) {
    $get_amount = $each_august['expense_amount'];
    $counter_8_1+= $get_amount;
}
array_push($expenditure_array,$counter_8_1);


// September
$counter_9 = 0;
$counter_9_1 = 0;
$current_year = date('Y');
$all_september = $current_year.'-09';

$get_september = mysqli_query($connect_db,"SELECT * FROM tbl_special_sales WHERE `sales_datetime` LIKE '%$all_september%'")or die(mysqli_error($connect_db));
while ($each_september = mysqli_fetch_array($get_september)) {
    $get_amount = $each_september['sales_total'];
    $counter_9+= $get_amount;
}
array_push($sales_array,$counter_9);


$get_september = mysqli_query($connect_db,"SELECT * FROM tbl_expenses WHERE `expense_date` LIKE '%$all_september%'")or die(mysqli_error($connect_db));
while ($each_september = mysqli_fetch_array($get_september)) {
    $get_amount = $each_september['expense_amount'];
    $counter_9_1+= $get_amount;
}
array_push($expenditure_array,$counter_9_1);


// October
$counter_10 = 0;
$counter_10_1 = 0;
$current_year = date('Y');
$all_october = $current_year.'-10';

$get_october = mysqli_query($connect_db,"SELECT * FROM tbl_special_sales WHERE `sales_datetime` LIKE '%$all_october%'")or die(mysqli_error($connect_db));
while ($each_october = mysqli_fetch_array($get_october)) {
    $get_amount = $each_october['sales_total'];
    $counter_10+= $get_amount;
}
array_push($sales_array,$counter_10);


$get_october = mysqli_query($connect_db,"SELECT * FROM tbl_expenses WHERE `expense_date` LIKE '%$all_october%'")or die(mysqli_error($connect_db));
while ($each_october = mysqli_fetch_array($get_october)) {
    $get_amount = $each_october['expense_amount'];
    $counter_10_1+= $get_amount;
}
array_push($expenditure_array,$counter_10_1);


// November
$counter_11 = 0;
$counter_11_1 = 0;
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


// December
$counter_12 = 0;
$counter_12_1 = 0;
$current_year = date('Y');
$all_december = $current_year.'-12';

$get_december = mysqli_query($connect_db,"SELECT * FROM tbl_special_sales WHERE `sales_datetime` LIKE '%$all_december%'")or die(mysqli_error($connect_db));
while ($each_december = mysqli_fetch_array($get_december)) {
    $get_amount = $each_december['sales_total'];
    $counter_12+= $get_amount;
}
array_push($sales_array,$counter_12);


$get_december = mysqli_query($connect_db,"SELECT * FROM tbl_expenses WHERE `expense_date` LIKE '%$all_december%'")or die(mysqli_error($connect_db));
while ($each_december = mysqli_fetch_array($get_december)) {
    $get_amount = $each_december['expense_amount'];
    $counter_12_1+= $get_amount;
}
array_push($expenditure_array,$counter_12_1);


?>