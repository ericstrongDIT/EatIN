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
$id = $_SESSION['id'];
//to get the customer
//query
$editProfile = "SELECT * FROM `customers` where email = '$id' ";
$result = $mysqli->query($editProfile);

if ($result = $mysqli->query($editProfile))
{

    while ($row = mysqli_fetch_array($result))
    {
        $proId = $row['id'];
        $firstname = $row['first_name'];
        $lastname = $row['last_name'];
        $email = $row['email'];
        $password = $row['password'];
        //$address = $row['address'];

    } //end query results
    $result->close();
} //if there is an entry

?>

  <?php
// if($_POST){

if (isset($_POST['editdone']))
{
    //get id
    $pid = $_POST['customerId'];
    $eFirst = $_POST['firstname'];
    $eLast = $_POST['lastname'];
    $eEmail = $_POST['email'];
    $ePassword = $_POST['password'];
    // $eAddress = $_POST['address'];
    //create the update queries
    $update = "UPDATE `customers` SET `first_name` = '$eFirst' WHERE `customers`.`id` = $proId";
    $update2 = "UPDATE `customers` SET `last_name` = '$eLast' WHERE `customers`.`id` = $proId";
    $update3 = "UPDATE `customers` SET `email` = '$eEmail' WHERE `customers`.`id` = $proId";
    $update4 = "UPDATE `customers` SET `password` = '$ePassword' WHERE `customers`.`id` = $proId";
    //do the query
    $result2 = $mysqli->query($update);
    $mysqli->query($update2);
    $mysqli->query($update3);
    $mysqli->query($update4);
    header('Location: index.php');
} //end if

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <script src="js/myscripts.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <title>edit profile</title>


  </head>
  <body >

    <div   <div id="container2">


          <form action="editProfile.php?id=<?php echo $id; ?>" method="post">

            <table  id="tableImage" align="center" width="900" border="2" bgcolor="white">


              <tr align="center" height="200">
                      <td colspan="8" align="right"><h1>Edit User Profile</h1></td>
              </tr>

              <tr>
                    <td><b>Customer id</b></td>
                    <td><input type="text" name="customerId"
                      value="<?php
echo $proId; ?>"
                      ></td>

              </tr>

              <tr>
                    <td><b>First Name</b></td>
                    <td><input type="text" name="firstname"
                      value="<?php
echo $firstname; ?>"
                      ></td>

              </tr>

              <tr>
                    <td><b>Last Name</b></td>
                    <td><input type="text" name="lastname"  value="<?php
echo $lastname; ?>"required></td>

              </tr>

              <tr>
                    <td><b>Email</b></td>
                    <td><input type="email" name="email"
                      value="<?php
echo $email; ?>"
                      required></td>

              </tr>

              <tr>
                    <td><b>Password</b></td>
                    <td><input type="password" name="password"
                      value="<?php
echo $password; ?>"
                      required></td>

              </tr>

              <!-- <tr>
                    <td><b>Address</b></td>
                    <td><textarea type="text" name="address"
                      value="<?php
echo $address; ?>"
                      required></td>

              </tr> -->






              <tr align="center">

                    <td colspan="8" >
                      <input type="submit" value="Update Profile" name="editdone" onclick=" profileUpdated();">
                      <input type="submit" value="Cancel" name="cancel"/>
                    </td>


              </tr>

            </table>

          </form>

            </div>

  </body>
</html>

<?php

if (isset($_POST['cancel']))
{
    header('Location: index.php');
}
?>
