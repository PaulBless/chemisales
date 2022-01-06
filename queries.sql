-- sql-queries

--

SELECT `mid`, medicine_name, SUM(medicineQty) AS `qty_sold`, SUM(medicineTotal) AS `price` FROM tbl_medicines m INNER JOIN `tbl_sales` s ON m.mid = s.medicineId GROUP BY `medicineId` ORDER BY `qty_sold` DESC



-- 1: get temporary stocks on hand 
select mid,selling_price,medicine_name,stock_level from tbl_medicines p inner join tbl_temporary_stocks ts on p.mid=ts.medicine_id order by medicine_name; 

-- 2: get  inventory list 
select * from `tbl_medicines` m inner join `tbl_stocks` s on m.mid=s.stock_medicine_id order by medicine_name, stock_date asc;

-- 3: Filter Records with Parameters
select * from tbl_medicines m inner join tbl_medicine_categories mc on m.category_id=mc.mcid inner join tbl_generic_names gn on m.generic_id=gn.genericid;

-- 4: Filter Records By Today's date
 -- 4.1 
 SELECT * FROM `tbl_special_sales` WHERE YEAR(sales_datetime) = YEAR(NOW()) AND MONTH(sales_datetime) = MONTH(NOW()) AND DAY(sales_datetime) = DAY(NOW());
 -- 4.2 
 SELECT * FROM `tbl_special_sales` WHERE DATE(`sales_datetime`)=DATE(NOW()) ORDER BY `sales_datetime` DESC;
-- 4.3 
SELECT * FROM `tbl_special_sales` WHERE DATE(`sales_datetime`)=DATE(NOW()) ORDER BY `sales_datetime` DESC;
-- ---------
-- End Search by Today's Date 

-- 5: Filter Records By Yesterday's Date
SELECT * FROM `tbl_special_sales` WHERE sales_datetime >= DATE_SUB(NOW(), INTERVAL 1 DAY) ORDER BY `sales_datetime` DESC;
-- 6: Filter Records by 2 Weeks
SELECT * FROM tbl_medicines WHERE tbl_medicines.medicine_expiry_date >= DATE(now()) AND tbl_medicines.medicine_expiry_date <= DATE_ADD(DATE(now()), INTERVAL 2 WEEK);

-- 7: Filter Records by 1 Month
SELECT * FROM `tbl_medicines` WHERE `tbl_medicines`.`medicine_expiry_date` >= DATE(NOW()) AND `tbl_medicines`.`medicine_expiry_date` <= DATE_ADD(DATE(NOW()), INTERVAL 30 DAY);

-- Get Record For Last Week
SELECT * FROM tbl_special_sales WHERE YEARWEEK(sales_datetime)=YEARWEEK(DATE_SUB(CURRENT_DATE(), INTERVAL 1 WEEK));

-- Get Current Week Data/Records
SELECT * FROM `tbl_sales_orders` WHERE YEARWEEK(column_name)=YEARWEEK(CURRENT_DATE());

-- Weekly Records Filter
SELECT * FROM table_name WHERE WEEKOFYEAR(column_name)=WEEEKOFYEAR(NOW());

-- Monthly Records Filter
SELECT * FROM table_name WHERE MONTH(column_name)=MONTH(NOW());

-- Yearly Records Filter
SELECT * FROM table_name WHERE YEAR(column_name)=YEAR(NOW());

-- Other Dates Filters
SELECT * FROM `tbl_medicines` WHERE `medicine_expiry_date`> DATE_SUB(DATE(NOW()), INTERVAL 1 DAY);

SELECT * FROM `tbl_medicines` WHERE `medicine_expiry_date`> DATE_SUB(DATE(NOW()), INTERVAL 1 WEEK);

SELECT * FROM `tbl_medicines` WHERE `medicine_expiry_date`> DATE_SUB(DATE(NOW()), INTERVAL 1 MONTH);

-- another dayname function for specific year
SELECT DATE(sales_datetime) as Date, DAYNAME(sales_datetime) as 'Day Name', COUNT(sales_number) as Count, SUM(sales_subtotal) as subtotal FROM tbl_special_sales WHERE date(sales_datetime) > DATE_SUB(NOW(), INTERVAL 1 WEEK) AND MONTH(sales_datetime) = MONTH(CURDATE()) AND YEAR(sales_datetime) = YEAR(CURDATE()) GROUP BY DAYNAME(sales_datetime) ORDER BY (sales_datetime)

-- week day
-- NB Week 1 = 0, Week 2 = 1, Week 3 = 2, Week 4 = 5
SELECT sum(sales_subtotal), COUNT(ssid) as tot, WEEKDAY(sales_datetime) FROM tbl_special_sales WHERE sales_datetime LIKE '%2021-07%' AND WEEKDAY(sales_datetime) > 0 AND WEEKDAY(sales_datetime) < 6

SELECT sum(sales_subtotal), COUNT(ssid) as tot, DAYNAME(sales_datetime) as dayname FROM tbl_special_sales WHERE sales_datetime LIKE '%2021-07%' AND WEEKDAY(sales_datetime) >= 0 AND WEEKDAY(sales_datetime) <= 6

-- day name of week
-- NB 1=Sunday, 2=Monday, 3=Tuesday, 4=Wednesday, 5=Thursday, 6=Friday, 7=Saturday
SELECT SUM(`sales_subtotal`), COUNT(`ssid`) as `tot`, DAYNAME(`sales_datetime`) AS `dayname` FROM tbl_special_sales WHERE sales_datetime LIKE '%2021-07%' AND WEEKDAY(sales_datetime) = '1'

SELECT SUM(sales_total) AS total FROM `tbl_special_sales` WHERE `sales_datetime` > DATE_SUB(DATE(NOW()), INTERVAL 1 WEEK);

SELECT SUM(sales_subtotal) AS total FROM `tbl_special_sales` WHERE sales_datetime > DATE_SUB(DATE(NOW()), INTERVAL 1 DAY);

SELECT SUM(sales_total) AS total FROM `tbl_special_sales` WHERE `sales_datetime` > DATE_SUB(DATE(NOW()), INTERVAL 1 MONTH);

-- week day : NB: will get all friday
SELECT SUM(sales_subtotal) AS total FROM tbl_special_sales WHERE DATE(sales_datetime) > DATE_SUB(NOW(), INTERVAL 1 WEEK) AND MONTH(sales_datetime) = MONTH(CURDATE()) AND YEAR(sales_datetime) = YEAR(CURDATE())  AND DAYNAME(sales_datetime)='Friday'


SELECT SUM(`sales_subtotal`) AS `amt_total`, `sales_datetime` as `sale_date` FROM `tbl_special_sales` 
WHERE YEARWEEK(`sales_datetime`) = YEARWEEK(NOW()) ORDER BY `sales_datetime` DESC

-- Get Current Date Monday Sales
SELECT sales_subtotal FROM tbl_special_sales WHERE DATE(sales_datetime) = DATE_ADD(CURDATE(), INTERVAL - WEEKDAY(CURDATE()) DAY)

-- get specific date of current week of year
SELECT sales_subtotal FROM tbl_special_sales WHERE DATE(sales_datetime) = DATE_ADD(( SELECT DATE_ADD(CURDATE(), INTERVAL - WEEKDAY(CURDATE()) DAY)), INTERVAL 1 DAY)

-- filter records for most sold items
SELECT `medicineId`, COUNT(*) AS `total_sold`, SUM(medicineTotal) AS `price` FROM `tbl_sales` GROUP BY `medicineId` ORDER BY `total_sold` DESC

-- get total quantities of items sold and total amount earned
SELECT `medicineId`, SUM(`medicineQty`) AS `qty_sold`, SUM(`medicineTotal`) AS `price` FROM `tbl_sales` GROUP BY `medicineId` ORDER BY `qty_sold` DESC
-- -------- End ---------


-- php/mysqli
$check = "SELECT * FROM `departments` WHERE `dept_name`='$deptname'";
$run = $connect_db->query($check);
if($run->num_rows === 0){

}else{
    
}

