<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Gateaway</title>
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/paymentstyle.css">
    <link rel="icon" type="image/x-icon" href="/Mirol/favicon2.png" >
</head>
<body>

  <!--PHP-->
<?php
  if(isset($_POST['submit'])){

  $address=$_POST['address'];
  $email=$_POST['email'];
  $name=$_POST['name'];
  $city=$_POST['city'];
  $state=$_POST['state'];
  $zip=$_POST['zip'];


  }
?>



<!--Form-->
<div class="container">

    <form action="receipt.php" name="myForm" onsubmit="return validateForm()" method="POST">

        <div class="row">

            <div class="col">

                <h3 class="title">billing address</h3>

                <div class="inputBox">
                    <span>full name :</span>
                    <input type="text" placeholder="Amirul Syafiq" name="name">
                </div>
                <div class="inputBox">
                    <span>email :</span>
                    <input type="email" placeholder="example@example.com" name="email">
                </div>
                <div class="inputBox">
                    <span>address :</span>
                    <input type="text" placeholder="room - street - locality" name="address">
                </div>
                <div class="inputBox">
                    <span>city :</span>
                    <input type="text" placeholder="Seremban" name="city">
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>state :</span>
                        <input type="text" placeholder="Malaysia" name="state">
                    </div>
                    <div class="inputBox">
                        <span>zip code :</span>
                        <input type="text" placeholder="70450" name="zip">
                    </div>
                </div>

            </div>

            <div class="col">

                <h3 class="title">payment</h3>

                <div class="inputBox">
                    <span>cards accepted :</span>
                    <img src="/Mirol/images/card.png" alt="">
                </div>
                <div class="inputBox">
                    <span>name on card :</span>
                    <input type="text" placeholder="Amierul Syafiq" name="cardname">
                </div>
                <div class="inputBox">
                    <span>credit card number :</span>
                    <input type="number" placeholder="1111-2222-3333-4444" name="cardnumber">
                </div>
                <div class="inputBox">
                    <span>exp month :</span>
                    <input type="text" placeholder="October" name="expmonth">
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>exp year :</span>
                        <input type="number" placeholder="2022" name="expyear">
                    </div>
                    <div class="inputBox">
                        <span>CVV :</span>
                        <input type="text" placeholder="1234" name="cvv">
                    </div>
                </div>

            </div>
    
        </div>

        <input type="submit" value="Place Order" class="submit-btn" name=submit>

    </form>

</div> 

<!--Validate Form-->
<script>
function validateForm() {
  var x = document.forms["myForm"]["name"].value;
  if (x == "" || x == null) {
    alert("Name must be filled out");
    return false;
  }

  var x = document.forms["myForm"]["email"].value;
  if (x == "" || x == null) {
    alert("Email must be filled out");
    return false;
  }

  var x = document.forms["myForm"]["address"].value;
  if (x == "" || x == null) {
    alert("Address must be filled out");
    return false;
  }


  var x = document.forms["myForm"]["city"].value;
  if (x == "" || x == null) {
    alert("City must be filled out");
    return false;
  }

  var x = document.forms["myForm"]["state"].value;
  if (x == "" || x == null) {
    alert("State must be specified");
    return false;
  }

  var x = document.forms["myForm"]["zip"].value;
  if (x == "" || x == null) {
    alert("ZIP must be filled out");
    return false;
  }

  var x = document.forms["myForm"]["cardname"].value;
  if (x == "" || x == null) {
    alert("Card name must be filled out");
    return false;
  }

  var x = document.forms["myForm"]["cardnumber"].value;
  if (x == "" || x == null) {
    alert("Card number must be filled out");
    return false;
  }

  var x = document.forms["myForm"]["expmonth"].value;
  if (x == "" || x == null) {
    alert("Exp month must be filled out");
    return false;
  }

  var x = document.forms["myForm"]["expyear"].value;
  if (x == "" || x == null) {
    alert("Exp year must be filled out");
    return false;
  }

  var x = document.forms["myForm"]["cvv"].value;
  if (x == "" || x == null) {
    alert("Cvv must be filled out");
    return false;
  }
}
</script>
    
</body>
</html>