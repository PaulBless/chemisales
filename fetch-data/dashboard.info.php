<?php
## Fetch Records
// 1: Get Medicine Total
$sql_medicine = "SELECT * FROM `tbl_medicines`";
$medicine_query = $connect_db->query($sql_medicine);
$total_medicines = $medicine_query->num_rows;

// 2: Get Expired Medicine Total
$sql_expired = "SELECT * FROM `tbl_medicines` WHERE `medicine_expiry_date` < curdate()";
$expired_query = $connect_db->query($sql_expired);
$total_expired_medicines = $expired_query->num_rows;

// 3: Get Medicine Near Expiry Total
$stmt = "SELECT * FROM `tbl_medicines` WHERE `tbl_medicines`.`medicine_expiry_date` >= DATE(NOW()) AND `tbl_medicines`.`medicine_expiry_date` <= DATE_ADD(DATE(NOW()), INTERVAL 30 DAY)";

$sql_near_expiry = $stmt;
$near_expiry_query = $connect_db->query($sql_near_expiry);
$total_medicines_near_expiry = $near_expiry_query->num_rows;

// 4: Get Stock Shortage Total
$sql = "SELECT * FROM `tbl_medicines` INNER JOIN `tbl_temporary_stocks` ON `tbl_medicines`.`mid`=`tbl_temporary_stocks`.`medicine_id` WHERE `stock_level`='0'";
$stock_query = $connect_db->query($sql);
$total_shortage = $stock_query->num_rows;

// 5: Get Medicine Categories Total
$sql_cat = "SELECT * FROM `tbl_medicine_categories`";
$cat_query = $connect_db->query($sql_cat);
$total_medicine_categories = $cat_query->num_rows;

// 6: Get Generic Names Total
$sql_generic = "SELECT * FROM `tbl_generic_names`";
$query = $connect_db->query($sql_generic);
$total_generic_names = $query->num_rows;

// 7: Get Staff Total
$sql_users = "SELECT * FROM `tbl_users`";
$users_query = $connect_db->query($sql_users);
$total_staff_users = $users_query->num_rows;

// 8: Get Staff Total
$sql_suppliers = "SELECT * FROM `tbl_suppliers`";
$suppliers_query = $connect_db->query($sql_suppliers);
$total_suppliers = $suppliers_query->num_rows;

// Get Sales Today
$total_sale_today = 0;
$stmt_today_sale = "SELECT * FROM `tbl_special_sales` WHERE DATE(`sales_datetime`)=DATE(NOW())";
$fetch_ts = $connect_db->query($stmt_today_sale);
$sale_data = $fetch_ts->fetch_assoc();
$total_sale_today += $sale_data['sales_total'];

// Get Sales Yesterday
$total_sale_yesterday = 0;
$stmt_yesterday_sale = "SELECT * FROM `tbl_special_sales` WHERE sales_datetime > DATE_SUB(DATE(NOW()), INTERVAL 1 DAY)";
$fetch_ys = $connect_db->query($stmt_yesterday_sale);
$sale_day = $fetch_ys->fetch_assoc();
$total_sale_yesterday += $sale_day['sales_total'];

// Get Sales This Week
// $stmt_this_week_sale = "SELECT * FROM `tbl_special_sales` WHERE date(sales_datetime) > DATE_SUB(NOW(), INTERVAL 1 WEEK) AND MONTH(sales_datetime) = MONTH(CURDATE()) AND YEAR(sales_datetime) = YEAR(CURDATE())";
$stmt_this_week_sale = "SELECT SUM(sales_total) AS total FROM `tbl_special_sales` WHERE date(sales_datetime) > DATE_SUB(NOW(), INTERVAL 1 WEEK) AND MONTH(sales_datetime) = MONTH(CURDATE()) AND YEAR(sales_datetime) = YEAR(CURDATE())";
$fetch_tw = $connect_db->query($stmt_this_week_sale);
$sale_week = $fetch_tw->fetch_assoc();
$total_sale_week = $sale_week['total'];

// Get Sales This Month
// $stmt_this_month_sale = "SELECT * FROM `tbl_special_sales` WHERE date(sales_datetime) > DATE_SUB(NOW(), INTERVAL 1 MONTH) AND MONTH(sales_datetime) = MONTH(CURDATE()) AND YEAR(sales_datetime) = YEAR(CURDATE())";
$stmt_this_month_sale = "SELECT SUM(sales_total) AS total FROM `tbl_special_sales` WHERE date(sales_datetime) > DATE_SUB(NOW(), INTERVAL 1 MONTH) AND MONTH(sales_datetime) = MONTH(CURDATE()) AND YEAR(sales_datetime) = YEAR(CURDATE())";
$fetch_tm = $connect_db->query($stmt_this_month_sale);
$sale_month = $fetch_tm->fetch_assoc();
$total_sale_month = $sale_month['total'];

// -----------------------------

// Get Expense Today
$stmt_today_expense = "SELECT SUM(expense_amount) AS total FROM `tbl_expenses` WHERE DATE(`expense_date`)=DATE(NOW())";
$fetch_te = $connect_db->query($stmt_today_expense);
$expense_data = $fetch_te->fetch_assoc();
$total_expense_today = $expense_data['total'];

// Get Expense Yesterday
$stmt_yesterday = "SELECT SUM(expense_amount) AS total FROM `tbl_expenses` WHERE expense_date > DATE_SUB(DATE(NOW()), INTERVAL 1 DAY)";
$fetch_yest = $connect_db->query($stmt_yesterday);
$expense = $fetch_yest->fetch_assoc();
$total_expense_yesterday = $expense['total'];

// Get Expense This Week
$stmt_this_week = "SELECT SUM(expense_amount) AS total FROM `tbl_expenses` WHERE `expense_date` > DATE_SUB(DATE(NOW()), INTERVAL 1 WEEK)";
$fetch_week = $connect_db->query($stmt_this_week);
$expense_week = $fetch_week->fetch_assoc();
$total_expense_week = $expense_week['total'];

// Get Expense This Month
// $stmt_this_month = "SELECT SUM(expense_amount) AS total FROM `tbl_expenses` WHERE `expense_date` > DATE_SUB(DATE(NOW()), INTERVAL 1 MONTH)";
$stmt_this_month = "SELECT SUM(expense_amount) AS total FROM `tbl_expenses` WHERE date(expense_date) > DATE_SUB(NOW(), INTERVAL 1 WEEK) AND MONTH(expense_date) = MONTH(CURDATE()) AND YEAR(expense_date) = YEAR(CURDATE())";
$fetch_month = $connect_db->query($stmt_this_month);
$expense_month = $fetch_month->fetch_assoc();
$total_expense_month = $expense_month['total'];

?>