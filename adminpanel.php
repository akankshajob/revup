<?php
    require("Connection.php");
    session_start();
    session_regenerate_id(true);
    if(!isset($_SESSION['AdminLoginId'])){
        header("Location: adminlogin.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body{
            margin: 0;

        }
        div.header{
            color:white;
            font family:poppins;
            background-color:black;
            display:flex;
            flex-direction:row;
            align-items:centre;
            justify-content:space-between;
            padding: 0 60px;
            
        }
        div.header button{
            background-color: white;
            font: size 16px;
            font-weight:550;
            padding:8px 12px;
            border:2px solid black:
            border-radius:5px;
        }
        </style>
</head>
<body>
    <div class="header">
        <h1>ADMIN PANEL-<?php echo $_SESSION['AdminLoginId']?></h1>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
         <button type="submit" name="Logout"><a href="adminlogin.php">LOG OUT</a></button>
         </form>
</div>
<div class="container mt-10">
    <div class="row">
        <div class="col-lg-12">
<table class="table text-center">
  <thead>
    <tr>
      <th scope="col">Order ID</th>
      <th scope="col">Customer Name</th>
      <th scope="col">Phone No</th>
      <th scope="col">Address</th>
      <th scope="col">Pay mode</th>
      <th scope="col">Order</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $query="SELECT * FROM `order_manager`";
        $user_result=mysqli_query($con,$query);
        while($user_fetch= mysqli_fetch_assoc($user_result))
        {
          echo "
            <tr>
               <td>$user_fetch[Order_Id]</td>
               <td>$user_fetch[Full_Name]</td>
                <td>$user_fetch[Phone_No]</td>
                <td>$user_fetch[Address]</td>
                <td>$user_fetch[Pay_Mode]</td>
                <td>
                  <table class='table text-center table-dark'>
                      <thead>
                        <tr>
                          <th scope='col'>Item Name</th>
                          <th scope='col'>Price</th>
                          <th scope='col'>Quantity</th>
                        </tr>
                      </thead>
                      <tbody> 
                  ";
                    $order_query="SELECT * FROM `user_orders` WHERE `Order_Id`='$user_fetch[Order_Id]'";
                    $order_result=mysqli_query($con,$order_query);
                    while($order_fetch=mysqli_fetch_assoc($order_result))
                    {
                      echo"
                         <tr>
                            <td>$order_fetch[Item_Name]</td>
                            <td>$order_fetch[Price]</td>
                            <td>$order_fetch[Quantity]</td>
              </tr>
            ";
          }
        echo"
               </tbody>
            </table>
          </td>
        </tr>
      ";
    }
?>
      
  </tbody>
</table>
        </div>
    </div>
</div>
</body>
</html>