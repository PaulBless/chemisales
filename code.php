<?php




foreach($_POST['product_id'] as $row => $value){

    $product=$_POST['product_id'][$row];
    $quantity=$_POST['quantity'][$row];

    $update = "UPDATE `tbl_temporary_stocks` SET `stock_level`='stock_level + {$quantity}' WHERE medicine_id='{$product}'";

    if (mysqli_query($connect_db, $sql)) {
            echo "stocked";
    } else {
        echo "error";
    }
} // end foreach loo


//Working with database
$sql= "SELECT id, Quantity FROM products WHERE id IN ('$query_filter');";
$result = mysqli_query($connect, $sql);
while($product = mysqli_fetch_assoc($result))
{
    $storeQty = $product['Quantity'];
    $cartQty = $cart[$product['id']]['qty'];
    // Verify $cartQty is valid ...
    $newQ = $storeQty - $cartQty;
    echo "ID: $product[id] Store: $storeQty Cart: $cartQty Remaining  $newQ<br />";
    // Update products table ...
}


$sql_check = mysqli_query($connect_db, "SELECT * FROM `tbl_temporary_stocks` WHERE tbl_temporary_stocks.medicine_id='$drug_id' LIMIT 1")OR DIE(mysqli_error($connect_db));
if(mysqli_num_rows($sql_check) > 0){
    $db_info = mysqli_fetch_array($sql_check);
    $quantity_left =  $db_info['stock_level'];

    $new_quantity = $quantity_left + $qty;

    // update stock_level
    // $update_stocks = mysqli_query($connect_db, "UPDATE `tbl_temporary_stocks` SET `stock_level`=stock_level + '{$qty}' WHERE `medicine_id`='$drug_id')")OR DIE(mysqli_error($connect_db));

}else{
    // add new stock_level
    $add_stocks = mysqli_query($connect_db, "INSERT INTO `tbl_temporary_stocks`(`medicine_id`, `stock_level`) VALUES ('$drug_id','$qty')")OR DIE(mysqli_error($connect_db));
}


    // get quantity available
    $get_product_quantity_avail = mysqli_query($connect_db,"SELECT * FROM tbl_temporary_stocks WHERE medicine_id = $set_medicine_name");
    $get_quantity_avail = mysqli_fetch_array($get_product_quantity_avail);
    $quantity_available = $get_quantity_avail['stock_level'];



$check = "SELECT * FROM `departments` WHERE `dept_name`='$deptname'";
$run = $connect_db->query($check);
if($run->num_rows === 0){

}else{
    
}

// // query update temporary-stock
$sql_check = mysqli_query($connect_db, "SELECT * FROM `tbl_temporary_stocks` WHERE tbl_temporary_stocks.medicine_id='$set_medicine_name' LIMIT 1")OR DIE(mysqli_error($connect_db));
if(mysqli_num_rows($sql_check) > 0){
    $db_info = mysqli_fetch_array($sql_check);
    $quantity_left =  $db_info['stock_level'];

    $new_quantity = $quantity_left + $qty_entered;

   

    // update stock_level
    // $update_stocks = mysqli_query($connect_db, "UPDATE `tbl_temporary_stocks` SET `stock_level`=stock_level + '{$qty_entered}' WHERE `medicine_id`='$set_medicine_name')")OR DIE(mysqli_error($connect_db));

}else{
    // add new stock_level
    $add_stocks = mysqli_query($connect_db, "INSERT INTO `tbl_temporary_stocks`(`medicine_id`, `stock_level`) VALUES ('$set_medicine_name','$qty_entered')")OR DIE(mysqli_error($connect_db));
}



    // query update temporary-stock
    $sql_check = mysqli_query($connect_db, "SELECT * FROM `tbl_temporary_stocks` WHERE `medicine_id`='$drug_id'");
    if(mysqli_num_rows($sql_check) > 0){
        $db_info = mysqli_fetch_array($sql_check);
        $db_qty_left =  $db_info['stock_level'];

        $new_quantity = $db_qty_left + $qty;

        // update stock_level
        $update_stocks = mysqli_query($connect_db, "UPDATE `tbl_temporary_stocks` SET `stock_level`='$new_quantity' WHERE `medicine_id`='$drug_id')")OR DIE(mysqli_error($connect_db));
    }else{
        // add new stock_level
        $add_stocks = mysqli_query($connect_db, "INSERT INTO `tbl_temporary_stocks`(`medicine_id`, `stock_level`) VALUES ('$drug_id','$new_quantity')")OR DIE(mysqli_error($connect_db));
    }


?>

<?php
    $product_array = mysqli_query($connect_db,"SELECT * FROM product ORDER BY id ASC");
    if (!empty($product_array)) { 
        foreach($product_array as $key=>$value){
    ?>
    
        <!-- get and set drugs info / details -->
            <form method="post" action="index.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
                <!-- <div class="col-md-3 d-"> -->
                    <input value="<?php echo $product_array[$key]["price"]; ?>" type="text" name="price" id="price" class="form-control border-secondary">
                    <input value="<?php echo $product_array[$key]["name"]; ?>" type="text" name="name" id="name" class="form-control border-secondary">
                    <input value="<?php echo $product_array[$key]["id"]; ?>" type="text" name="drugid" id="drugid" class="form-control border-secondary">
                    <input value="<?php echo $product_array[$key]["code"]; ?>" type="text" name="code" id="code" class="form-control border-secondary">
                <!-- </div> -->
                <!-- drug or medicine name dropdown -->
                <select name="drug" class="each-drug-name select-custom border-secondary" required placeholder="">
                    <!-- <option value="" selected hidden disabled></option> -->
                    <option value="<?php echo $product_array[$key]['id'];?>"> 
                        <?php echo $product_array[$key]['code']; ?> - <?php echo $product_array[$key]['name']; ?> - <?php echo $product_array[$key]['price']; ?>
                    </option>
                </select>
            </form>
        </div>
    <?php
        }
    }
?>

 <form action="" method="post" name="frmdrug">
    <div class="row">

        <div class="col-md-8 pt-1">
            <select name="single_drug" class="each-drug select-custom border-secondary" id="each_drug" required>
                <option value="" selected hidden>Select Medicine or Drug Name</option>
                <?php
                    $get_all_drugs = mysqli_query($connect_db,"SELECT * FROM `product` ORDER BY `name` ASC")or die(mysqli_error($connect_db));
                    // for($i=0; $row = mysqli_num_rows($result); $i++){
                    while($row = mysqli_fetch_array($get_all_drugs)){
                ?>
                    <option value="<?php echo $row['id'];?>"><?php echo $row['code']; ?> - <?php echo $row['name']; ?> | Price: <?php echo $row['price']; ?></option>
                    <!-- // get & set drug info -->
                <?php
                        }
                    ?>
            </select>
        </div>

        <div class="col-md-2">
            <button class="btn btn-success add-to-cart" type="submit" name="addpos" id="add-to-cart"><i class="fe-plus"></i> </button>
        </div>
    </div>
</form>

<div class="table-responsive">
                            <?php
                                if(isset($_SESSION["cart_item"])){
                                $total_quantity = 0;
                                $total_price = 0;
                                ?>
                                <table class="table table-hover tbl-products">
                                    <thead class="bg-primary text-white">
                                        <tr style="font-weight:bold">
                                            <td width="15%">Code</td>
                                            <td width="55%">Medicine Name</td>
                                            <td width="10%">Price</td>
                                            <td wdth="5%">Qty</td>
                                            <td width="15%">Total</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody> 
                               	
                                    <?php		
                                        // force the cart array item
                                        $dArray = is_array($_SESSION['cart_item']) ? $_SESSION['cart_item'] : array($_SESSION['cart_item']);
                                        foreach($dArray as $item){
                                        // foreach($_SESSION["cart_item"] as $item){
                                            $item_price = $item["quantity"]*$item["price"];
                                            ?>
                                            <tr>
                                            <td style="text-align: left;"><?php echo $item["code"]; ?></td>
                                            <td style="text-align: left;"><?php echo $item["name"]; ?></td>
                                            <td style="text-align: right;"><?php echo $item["quantity"]; ?></td>
                                            <td style="text-align: right;"><?php echo $item["price"]; ?></td>
                                            <td style="text-align: right;"><?php echo number_format($item_price,2); ?></td>
                                            <td style="text-align: center;"><a href="pos.test.php?action=remove&code=<?php echo $item["code"]; ?>" class="btn btn-outline-danger"> X </a></td>
                                            </tr>
                                            <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                                <?php
                                 echo "<div class='text-danger text-center'>No medicines added yet!</div>";                                                                
                                    } 
                                ?>
                            </div> <!-- table-responsive .end// -->


<script>
    // function to get departments list
function getDrugRow(id){
  $.ajax({
    type: 'POST',
    url: 'api_calls/sales_api/fetch.drug.details.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.id').val(response.did);
      $('#edit_deptname').val(response.dept_name);
      $('#edit_desc').val(response.description);
      $('#edit_desc').html(response.description);
      $('.fullname').html(response.dept_name);
      $('#desc').html(response.description);
    }
  });
}

   // triggers to add the drug-details to cart
   $("#add-to-cart").on("click", function(){
        // get drugs info
        var price = $("#price").val();
        var id = $("#id").val();
        var name = $("#name").val();
        var quantity = $("#quantity").val();
        var total = quantity * price;

        numRows = $("tr").length;
        for(var i=1 ; i<numRows ; i++){
            var code = $("tr:nth-child(" + i + ") td:nth-child(2)").html();
            var qty = $("tr:nth-child(" + i + ") td:nth-child(3)").html();
            
            if(code == $("#code").val()){
                $("tr:nth-child(" + i + ") td:nth-child(3)").html(parseInt(qty) + 1);
                return true;
            }
        }
    
        $("tbody").append("<tr><td>" + numRows + "</td><td>" + $("#code").val() + "</td><td>1</td></tr>");

        // $("tbody").append("<tr><td>" + numRows + "</td><td>" + $("#name").val() + "</td><td>"+ $("#price").val() +"</td><td>"+ $("#"),val() "</td><td>"+ total +"</td></tr>");
        return true;
    })

    $(document).ready(function() {
    var found = false;

        if($("#tbl-products tr").legth > 0)
        {
            alert("row exists");
        }

    $("input#btnSubmit").on("click", function() {
        var search_val = $("input#code").val();

        $("tr").each(function() {
            var obj = $(this);

            obj.find("td").each(function() {
                if(parseInt($(this).html()) == parseInt(search_val))
                {
                    obj.find("td:nth-of-type(3)").html(parseInt(obj.find("td:nth-of-type(3)").html()) + 1);
                    found = true;
                }
            });
        })

        if(found == false)
        {
            $("table").append("<tr><td>"+($("tr").length)+"</td><td>"+search_val+"</td><td>1</td></tr>");
        }

        found = false;
    });
});

// triggers to add the drug-details to cart
$("#add-to-cart").on("click", function(){
        // get drugs info
        var price = $("#price").val();
        var id = $("#id").val();
        var name = $("#name").val();
        var quantity = $("#quantity").val();
        var total = quantity * price;

    
        $("#tbl-products tr").each(function() {
            var obj = $(this);
            var dn = this.cells[0].innerHTML;
            var dp = this.cells[1].innerHTML;
            var dq = this.cells[2].innerHTML;

            // if(dn == $("#name").val() && dp == $("#price")){
            //     dq = dq + quantity;
            // }

            var code = $("tr:nth-child(" + i + ") td:nth-child(2)").html();
            var qty = $("tr:nth-child(" + i + ") td:nth-child(3)").html();
            
            if(code == $("#name").val()){
                $("tr:nth-child(" + i + ") td:nth-child(3)").html(parseInt(qty) + $("#quantity").val());

                return true;
            }
                
        })

        // add new drug item to cart
        $("table").append("<tr><td>"+ name +"</td><td>"+ price +"</td><td>" + quantity +"</td><td>"+ total +"</td><td><a href='#' class='btn btn-outline-danger removeRows'>X</a></td></tr>");

    })

    if(("#tbl-products tr").legth > 0)
        {
            // addNewDrug(name,price,quantity,total,id);
            changeQty(quantity);
        }else{
            addNewDrug(name,price,quantity,total,id);
        }
        
        })
    }

    // update quantity function
function changeQty(qty){
    var newQty = $("#quantity").val();
    $("#tbl-products tr").each(function(){
        var obj = $(this);
        // var dn = this.cells[0].innerHTML;
        var dn = this.cells[0].val();
        var dp = this.cells[1].val();
        qty = this.cells[2].val();

        if(dn == $("#name").val()){
            qty = qty + quantity;
        }
    });


    // $("#drugName_1").get(0).selectedIndex = 0;
            // $('#drugName_1 option:eq(0)').attr('selected', 'selected');
}


$("[id^='quantity_']").each(function() {
        var qty = $(this).val();    
        var available = $('#available').val();
        if(qty > available){
            $(this).focus();
            Swal.fire(
                'Error',
                'Quantity: ' + qty + ' Is More Than Medicine Available: ' + available + ' ..... Please Check',
                'error'
            );
        }
        });
        
//add drug to cart function
function addNewDrug(drugName,drugPrice,quantity,total,drug_id){
        var htmlRows = '';
    htmlRows += '<tr>';
    htmlRows +=
    '<td><input type="text" readonly required="required" name="name[]" id="name_' +
    count + '" class="form-control available" autocomplete="off" value="'+drugName+'"><input type="hidden" readonly name="product_id[]" id="product_id_' +
    count + '" class="form-control available" autocomplete="off" value="'+drug_id+'"></td>';


    htmlRows +=
    '<td><input type="text" readonly required="required" name="price[]" id="price_' +
    count + '" class="form-control available" autocomplete="off" value="'+drugPrice+'"></td>';

    htmlRows +=
    '<td><input type="number" required="required" name="quantity[]" id="quantity_' +
    count + '"  class="form-control available" autocomplete="off" value="'+quantity+'"></td>';

    htmlRows +=
    '<td><input type="text" readonly required="required" name="total[]" id="total_' +
    count + '" class="form-control available" autocomplete="off" value="'+total+'"></td>';

    htmlRows +=
    '<td width="5"> <a href="#" class="btn btn-outline-danger removeRows">x</a></td>';

     htmlRows += '</tr>';

    $('.tbl-products').append(htmlRows);

    calculateTotal();

    count++
}

function checkSpecificTableCellValue(){
    var table = document.getElementById("tbl-products");
    for (var i=0; i<table.children[o].childElementCount; i++)
    {
        var tableRow = table.children[0].children[i];
        for( var j=0; j<tableRow.children.childElementCount; j++)
        {
            var tableColumn = tablerow.children[j];
            console.log('Cell ['+i+', '+j+'] value: '+tableColumn.innerText);
        }
    }
}

function showAlert(){
    var uname = "username";
        var password = "password";
        swal.fire({
            title: "User Created Successfully",
            html: "Login Details </br><span class='text-info'> Username: </span>" + uname + " <span class='text-info'>Password: </span>" + password,
            type: "info",
            allowOutsideClick: false
        });

}

if(user_action == 'edit'){
                $.ajax({
                    url:'api_calls/suppliers_api/edit.category.php',
                    type: 'POST',
			       	data: formdata,
                    success:function(res){
                        Swal.fire(
                        'Success!',
                        'Category changes applied successfully',
                        'success'
                        ).then(function(){readSuppliers()});
                      
                        $('#category-modal').modal('hide');
                        $('#category_id').val('');
                        $('#name').val('');
                        $('#description').val('');

                        
                        },
                        error:function(res){
                            console.log(res);
                        }

                    });
           }
           
// triggers to add the drug-details to cart
$("#add-to-cart").on("click", function(){

        // get drugs info
        var cart = document.getElementById("tbl-products");
        var price = $("#price").val();
        var id = $("#drug_id").val();
        var name = $("#name").val();
        var quantity = $("#quantity").val();
        var total = quantity * price;

        // check the count of rows, to see if cart is empty or has atleast a single record
        if($("#tbl-products tr").length > 0){
            alert("row");
            // loop table to find & get specific row cell value to update it qty
            for(var i=0; i<cart.rows.length;i++){
                var qtyCell = cart.rows.cells[2].innerText;
                alert(qtyCell);
            }
            $(".select-custom").val(null).trigger("change");  //reset dropdown
        }else{
            alert("no row");
            // now rows in table (cart), add new drug item to cart
            addDrugToCart(name,price,quantity,total,id);
            $('.select-custom').val(null).trigger("change");  // reset dropdown
            $("#add-to-cart").prop('disabled', true);
        }

})

// if($action_status == 'reset'){
    //     ## hash the password
    //     ## before saving into db in query statement
    //     $encrypt_pwd = password_hash($entered_pwd, PASSWORD_DEFAULT);
        
    //     $reset_user_passcode = mysqli_query($connect_db,"UPDATE `tbl_users` SET `user_passcode` = '$encrypt_pwd' WHERE `tbl_users`.`uid` = '$get_users_id'") or die(mysqli_error($connect_db));
        
    //     if($reset_user_passcode){
    //         echo "reset";
    //     }
    // }


    // sql-queries
// 1: get temporary stocks on hand 
"select mid,selling_price,medicine_name,stock_level from tbl_medicines p inner join tbl_temporary_stocks ts on p.mid=ts.medicine_id order by medicine_name" 

// 2: get  inventory list 
"select * from `tbl_medicines` m inner join `tbl_stocks` s on m.mid=s.stock_medicine_id order by medicine_name, stock_date asc"

//3: get 
"select * from tbl_medicines m inner join tbl_medicine_categories mc on m.category_id=mc.mcid inner join tbl_generic_names gn on m.generic_id=gn.genericid"

// today's date
$sql_get_each_sale = "SELECT * FROM `tbl_special_sales` WHERE YEAR(sales_datetime) = YEAR(NOW()) AND MONTH(sales_datetime) = MONTH(NOW()) AND DAY(sales_datetime) = DAY(NOW())";
$sql = "SELECT * FROM `tbl_special_sales` WHERE DATE(`sales_datetime`)=DATE(NOW()) ORDER BY `sales_datetime` DESC";
 $sql_get_each_sale = "SELECT * FROM `tbl_special_sales` WHERE DATE(`sales_datetime`)=DATE(NOW()) ORDER BY `sales_datetime` DESC";

// --------------------

// yesterday's date 
$sql = "SELECT * FROM `tbl_special_sales` WHERE sales_datetime >= DATE_SUB(NOW), INTERVAL 1 DAY ORDER BY `sales_datetime` DESC";

SELECT * FROM tbl_medicines WHERE tbl_medicines.medicine_expiry_date >= DATE(now()) AND tbl_medicines.medicine_expiry_date <= DATE_ADD(DATE(now()), INTERVAL 2 WEEK)
</script>
        


