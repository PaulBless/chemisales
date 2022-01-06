<?php



require_once 'db/db.php'; 


if(isset($_POST["submit"]))
{

             
          $file = $_FILES['file']['tmp_name'];
          $handle = fopen($file, "r");
          $c = 0;
          while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
          
          
                    {
          $product_name = $filesop[0];
          $product_category = $filesop[1];
          
          $sql = "INSERT INTO `tbl_medicines` (`mid`, `medicine_code`, `medicine_name`, `category_id`, `selling_price`, `cost_price`, `medicine_expiry_date`, `quantity_available`) VALUES (NULL, '0', '$medicine_name', '$category_id', '0', '0', '0', '0')";
          $stmt = mysqli_query($connect_db,$sql);
         

         $c = $c + 1;
           }

            if($stmt){
               echo "success";
             } 
		 else
		 {
            echo "Sorry! Unable to import file contents.";
          }

}
?>
<!DOCTYPE html>
<html>
<body>
<form enctype="multipart/form-data" method="post" role="form">
    <div class="form-group">
        <label for="exampleInputFile">File Upload</label>
        <input type="file" name="file" id="file" size="150">
        <p class="help-block">Only Excel/CSV File Import.</p>
    </div>
    <button type="submit" class="btn btn-default" name="submit" value="submit">Upload</button>
</form>
</body>
</html>

