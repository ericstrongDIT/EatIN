<?php include ('includes/db.php'); ?>
<?php
$ID = 0;
session_start();
// admin session to ensure someone is signed in

if (!isset($_SESSION['id']))
{
    $ID = 100;
} //end if

?>


<?php

if ($ID == 100)
{
    echo "<script>alert('You must log in first')</script>";
    session_destroy();
    echo "<script>window.open('login.php','_self')</script>";
}
?>

<?php
//display the product by its id
$id = $_GET['id'];
//query
$editProduct = "SELECT * FROM `products` where id = $id";
$result = $mysqli->query($editProduct);

if ($result = $mysqli->query($editProduct))
{

    while ($row = mysqli_fetch_array($result))
    {
        $id = $row['id'];
        $name = $row['name'];
        $price = $row['price'];
        $catagory = $row['catagory'];
        $image = $row['image'];
        // echo "<option value='$id'>$name</option>";

    } //end query results
    $result->close();
} //if there is an entry

?>

  <?php
// if($_POST){

if (isset($_POST['editdone']))
{
    //get id
    $pid = $_POST['productId'];
    $pname = $_POST['productName'];
    $pprice = $_POST['productPrice'];
    $pcatagory = $_POST['productCatagory'];
    $pimage = $_POST['productImage'];
    //create the update queries
    $update = "UPDATE `products` SET `name` = '$pname' WHERE `products`.`id` = $pid";
    $update2 = "UPDATE `products` SET `image` = '$pimage' WHERE `products`.`id` = $pid";
    $update3 = "UPDATE `products` SET `price` = '$pprice' WHERE `products`.`id` = $pid";
    $update4 = "UPDATE `products` SET `catagory` = '$pcatagory' WHERE `products`.`id` = $pid";
    //do the query
    $result2 = $mysqli->query($update);
    $mysqli->query($update2);
    $mysqli->query($update3);
    $mysqli->query($update4);
    //$outputmsg = "Product Update";
    header('Location: editRemoveProductResults.php');
} //end if

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <script src="js/myscripts.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <title>admin - editproduct page</title>


  </head>
  <body >

    <div   <div id="container2">


          <form action="editProduct.php?id=<?php echo $id; ?>" method="post">

            <table  id="tableImage" align="center" width="900" border="2" bgcolor="white">


              <tr align="center" height="200">
                      <td colspan="8" align="right"><h1>Edit Item</h1></td>
              </tr>

              <tr>
                    <td><b>Product id</b></td>
                    <td><input type="text" name="productId"
                      value="<?php
echo $id; ?>"
                      ></td>

              </tr>

              <tr>
                    <td><b>Product Name</b></td>
                    <td><input type="text" name="productName"  value="<?php
echo $name; ?>"required></td>

              </tr>

              <tr>
                    <td><b>Product Price</b></td>
                    <td><input type="text" name="productPrice"
                      value="<?php
echo $price; ?>"
                      required></td>

              </tr>

              <tr>
                    <td><b>Product Catagory</b></td>
                    <td>
                          <select name="productCatagory">
                            <option value="<?php echo $catagory; ?>">
                              <?php
//display all catagories
$catagories = "SELECT * FROM `products_catagory` ";
$result = $mysqli->query($catagories);

while ($row = mysqli_fetch_array($result))
{
    $id = $row['id'];
    $name = $row['name'];
    echo "<option value='$id'>$name</option>";
} //end query results

?>
                            </option>


                            </select>



                    </td>

              </tr>

              <tr>
                    <td><b>Product Image</b></td>


                      <td>
                      <select name="productImage">
                        <option value="<?php echo $image; ?>">
                          <?php
//display all catagories
$images = "SELECT DISTINCT image FROM `products` ";
$result = $mysqli->query($images);

while ($row = mysqli_fetch_array($result))
{
    $name = $row['image'];
    echo "<option>$name</option>";
} //end query results

?>
                        </option>


                        </select>
                          </td>


              </tr>

              <tr align="center">

                    <td colspan="8" ><input type="submit" value="Update Item" name="editdone" onclick=" itemUpdated();"></td>

              </tr>

            </table>

          </form>

            </div>

  </body>
</html>
