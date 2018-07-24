<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
</head>
<?php
    session_start();
    if(!isset($_SESSION['adminName'])) {
        header("Location:login.php");
    }
    include 'dbConnection.php';
    $conn = getDatabaseConnection("ottermart");
    
    function displayAllProducts() {
        global $conn;
        $sql= "SELECT * FROM om_product ORDER BY productId";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $records = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        return $records;
    }
    
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
?>
<div class="container">
  <div class="row">
    <div class="col-sm-auto">
        <form action="addProduct.php">
            <input type="submit" class = 'btn btn-secondary' id = "beginning" name="addproduct" value="Add Product"/>
        </form>
    </div>
    <div class="col-sm-auto">
        <form action="logout.php">
            <input type=submit class = 'btn btn-secondary' id = "beginning" value="Logout"/>
        </form>
    </div>
  </div>
</div>
<?php
    $records=displayAllProducts();
    echo "<table class='table table-hover'>";
    echo "<thead>
            <tr>
                <th schope='col'>ID</th>
                <th schope='col'>Name</th>
                <th schope='col'>Description</th>
                <th schope='col'>Price</th>
                <th schope='col'>Update</th>
                <th schope='col'>Remove</th>
            </tr>
          </thead>";
    echo "<tbody>";
    foreach($records as $record) {
        echo "<tr>";
        echo "<td>" .$record['productId']."</td>";
        echo "<td>" .$record['productName']."</td>";
        echo "<td>" .$record['productDescription']."</td>";
        echo "<td>$" .$record['price']."</td>";
        echo "<td><a class='btn btn-primary' href='updateProduct.php?productId=". $record['productId']."'>Update</a></td>";
        
        echo "<form action='deleteProduct.php' onsubmit='return confirmDelete()'>";
        echo "<input type='hidden' name='productId' value= " . $record['productId'] . " />";
        echo "<td><input type='submit' class = 'btn btn-danger' value='Remove'></td>";
        echo "</form>";
        
    }
    
    echo "</tbody>";
    echo "</table>";
?>

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete the product?");
    }
</script>