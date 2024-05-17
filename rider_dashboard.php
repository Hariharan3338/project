<?php
require 'conn.php';
?>
<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $rider_id = $_POST['rider_id'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $pickup = $_POST['pickup'];
  $date = $_POST['date'];
  $destination = $_POST['destination'];
  $rd_amount = $_POST['rd_amount'];


  $user_check_sql = "SELECT * FROM users WHERE username = '$username' AND rider_id = '$rider_id'";
  $user_result = $conn->query($user_check_sql);



  if ($user_result->num_rows > 0) {
    $sql = "INSERT INTO trips (rider_id, pickup,destination,date,rd_amount,username) VALUES ('$rider_id'.'$pickup','$destination','$date','$rd_amount','$$username')";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rider Dashboard</title>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@100&family=Inter:wght@200&family=Pacifico&family=Poppins:ital,wght@0,200;1,100&family=Sofia+Sans:wght@300&display=swap"
    rel="stylesheet">
  <style>
    :root {
      --primary-color: #f07900;
    }

    .dark-theme {
      --primary-color: #d35100;
    }

    body {
      margin: 0px;

    }

    .ride_detials h2 {
      color: var(--primary-color);
      font-family: "Poppins", sans-serif;
      font-style: bold;
      font-size: 28px;
      margin: 30px 30px;
    }
    .ride_detials  h4{
      font-size: 16px;
      text-align:left;
    }
    h1 {
      color: var(--primary-color);
      font-family: "Poppins", sans-serif;
      font-style: bold;

      text-align: center;
    }

    .update_ride {
      height: auto;
      width: 100%;
      display: flex;
      justify-content: center;
    }

    #updrd_form {
      background: var(--primary-color);
      height: 400px;
      width: 40%;
      display: grid;
      grid-template-columns: 50% 50%;

      border-radius: 10px;
      padding: 20px 20px;
    }

    #updrd_form label {
      margin: 40px 30px 10px;

      font-size: larger;
      color: white;
    }

    #updrd_form input {
      width: 210px;
      margin-left: 30px;
      margin: 10px 30px;
      border-radius: 10px;
      border: none;
      height: 22px;
      outline: none;
    }

    #updrd_form button {
      height: 40px;
      width: 93%;
      margin: 7px 10px;
      color: var(--primary-color);
      background-color: white;
      border: none;
      border-radius: 5px;
      font-size: larger;
    }

    #updrd_form button:hover {
      color: white;
      background-color: var(--primary-color);
      border: 1px solid white;
    }

    .ride_div {
      display: grid;
      grid-template-columns: 25% 25% 25%;
      gap:10%;
    }
   .ride_div  .ride_div_content{
     height:300px;
     width:70%;
     background-color:var(--primary-color) ;
     color:white;
     padding:10px 20px;
     border-radius:20px;
   }
    .ride_div 
  </style>
</head>

<body>
  <div class="ride_detials">

    <h2>Your Rides:<h2>
        <?php

        $result = mysqli_query($conn, "SELECT * FROM trips");
        if (mysqli_num_rows($result) == 0) {
          ?>
          <h1> No record Found</h1>
        <?php }
        ?>
        <div class="ride_div">
         
            <?php
            $result = mysqli_query($conn, "SELECT * FROM trips");
            if (mysqli_num_rows($result) > 0) {
              $i = 0;
              while ($row = mysqli_fetch_array($result)) {
                ?>
                 <div class="ride_div_content">
                 <h4>Trip <?php echo $i;?> </h4>
                <h4>Pickup Locotion   :
                  <?php echo $row["pickup"]; ?>
                </h4>
                <h4>Drop Locotion     :
                <?php echo $row["destination"]; ?>
              </h4>
              <h4>Trip Locotion       :
                <?php echo $row["date"]; ?>
              </h4>
              <h4>Amount of the ride  :
                <?php echo $row["rd_amount"]; ?>
              </h4>
              <h4 class="rd-accept">
              <h4>
              </div>
                <?php
                $i++;
              }
            }
            ?>

          </div>
        </div>
        <h1 style="text-align:left; margin-left:1%">Update Ride</h1>
        <div class="update_ride">
          <form id="updrd_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div>
              <label>Rider ID:</label><br>
              <input type="text" name="rider_id" required><br>
            </div>
            <div>
              <label>Usename: </label><br>
              <input type="text" name="username" required><br>
            </div>
            <div>
              <label>Password: </label><br>
              <input type="text" name="password" id="password_rd" required><br>
            </div>
            <div>
              <label>Pickup locotion: </label><br>
              <input type="text" name="pickup" id="pickup" required><br>
            </div>
            <div>
              <label>Destination: </label>
              <input type="text" name="desination" id="desination" required><br>
            </div>

            <div>
              <label>Date: </label><br>
              <input type="date" name="date" id="date"><br>
            </div>
            <div>
              <label>Amount for the Ride: </label><br>
              <input type="text" name="rd_amount" id="rd_amount"><br>
            </div>


            <button type="submit" class="sign_upbtn" value="Submit">UPDATE RIDE</button>

          </form>
        </div>



        <script src="script.js">
        </script>
</body>

</html>