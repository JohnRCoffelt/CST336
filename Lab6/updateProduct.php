<!DOCTYPE html>
<?php
    session_start();
    if(!isset($_SESSION['adminName'])) {
        header("Location:login.php");
    }
    include 'dbConnection.php';
    $conn = getDatabaseConnection("ottermart");

    function getProductInfo() {
        global $conn;
        $sql = "SELECT * FROM om_product WHERE productID = " . $_GET['productId'];
        
        $statement = $conn->prepare($sql);
        $statement->execute();
        $record = $statement->fetch(PDO::FETCH_ASSOC);
        
        return $record;
    }
    
    function getCategories($catId) {
        global $conn;
        $sql = "SELECT catId, catName FROM om_category ORDER BY catName";
        
        $statement = $conn->prepare($sql);
        $statement->execute();
        $records = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($records as $record) {
            echo "<option ";
            echo ($record["catId"] == $catId)? "selected": "";
            echo " value='" .$record["catId"] ."'>". $record['catName'] ." </option>";
        }
    }
    
    if(isset($_GET['productId'])) {
        $product = getProductInfo();
    }
    
    if(isset($_GET['updateProduct'])) {
        $sql = "UPDATE om_product
                SET productName = :productName,
                    productDescription = :productDescription,
                    productImage = :productImage,
                    price = :price,
                    catId = :catId
                WHERE productId = :productId";
        
        $np = array();
        $np[":productName"] = $_GET['productName'];
        $np[":productDescription"] = $_GET['productDescription'];
        $np[":productImage"] = $_GET['productImage'];
        $np[":price"] = $_GET['price'];
        $np[":catId"] = $_GET['catId'];
        $np[":productId"] = $_GET['productId'];
        
        $statement = $conn->prepare($sql);
        $statement->execute($np);
        echo "Product has been updated!";
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
                        <input type="hidden" name="productId" value= "<?=$product['productId']?>"/>
                        <strong>Product name</strong> <input type="text"  class="form-control" value= "<?=$product['productName']?>" name="productName"><br>
                        <strong>Description</strong> <textarea name="productDescription"  class="form-control" cols = 50 rows = 4><?=$product['productDescription']?></textarea><br>
                        <strong>Price</strong> <input type="text" class="form-control" name="price" value= "<?=$product['price']?>"><br>
                        <strong>Category</strong> <select name="catId" class="form-control">
                            <option value="">Select One</option>
                            <?php getCategories( $product['catId'] ); ?>
                        </select> <br />
                        <strong>Set Image Url</strong> <input type="text" name="productImage" class="form-control" value= "<?=$product['productImage']?>"><br>
                        <input type="submit" name="updateProduct" class='btn btn-primary' value="Update Product">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>