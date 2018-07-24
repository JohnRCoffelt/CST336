<!DOCTYPE html>
<?php
    session_start();
    if(!isset($_SESSION['adminName'])) {
        header("Location:login.php");
    }
    include 'dbConnection.php';
    $conn = getDatabaseConnection("ottermart");

    function getCategories() {
        global $conn;
        $sql = "SELECT catId, catName FROM om_category ORDER BY catName";
        
        $statement = $conn->prepare($sql);
        $statement->execute();
        $records = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($records as $record) {
            echo "<option value='".$record["catId"] ."'>" . $record['catName'] ." </option>";
        }
    }
    
    if(isset($_GET['submitProduct'])) {
        $productName = $_GET['productName'];
        $productDescription = $_GET['description'];
        $productImage = $_GET['productImage'];
        $productPrice = $_GET['price'];
        $catId = $_GET['catId'];
        
        $sql = "INSERT INTO om_product
                ( productName, productDescription, productImage, price, catId)
                VALUES ( :productName, :productDescription, :productImage, :price, :catId)";
        
        $namedParameters = array();
        $namedParameters[':productName'] = $productName;
        $namedParameters[':productDescription'] = $productDescription;
        $namedParameters[':productImage'] = $productImage;
        $namedParameters[':price'] = $productPrice;
        $namedParameters[':catId'] = $catId;
        
        $statement = $conn->prepare($sql);
        $statement->execute($namedParameters);
        
        echo "Product Added Successfully!";
    }
?>
<head>
    <link href="css/login.css" rel="stylesheet" type="text/css" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<html>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-offset-5 col-lg-auto">
                    <form>
                        <strong>Product name</strong> <input type="text" class="form-control" name="productName">
                        <strong>Description</strong> <textarea name="description" class="form-control" cols = 50 rows = 4></textarea>
                        <strong>Price</strong> <input type="text" class="form-control" name="price">
                        <strong>Category</strong> <select name="catId" class="form-control">
                            <option value="">Select One</option>
                            <?php getCategories(); ?>
                        </select>
                        <strong>Set Image Url</strong> <input type="text" name="productImage" class="form-control"><br>
                        <input type="submit" name="submitProduct" class='btn btn-primary' value="Add Product">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>