<?php
//laravel: framework
session_start();
require_once 'login_db.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <title>Hello, world!</title>
  </head>

  <!-- Login pop up window -->

  <body class="bg-light">
    <nav class="navbar navbar-expand-lg bg-dark py-3" style="height: 65px">
      <div class="container-fluid">
        <a href="index.php" class="navbar-brand"
          ><img src="image/checkout.png" style="width: 70px"
        /></a>
        <ul class="navbar-nav">
          <li class="nav-item">
            <div class="container">
              <?php
            if ($_SESSION['status'] == 0) { ?>
              <button id="login" class="btn btn-primary p-2">Login</button>
              <script>
                document
                  .getElementById("login")
                  .addEventListener("click", myFunction);

                function myFunction() {
                  window.location.href =
                    "http://localhost:8888/payment_gateway/login.php";
                }
              </script>
              <?php } elseif ($_SESSION['status'] == 1) { ?>

              <button id="admin" class="btn btn-primary p-2">Logout</button>
              <script>
                document
                  .getElementById("admin")
                  .addEventListener("click", myFunction);

                function myFunction() {
                  window.location.href =
                    "http://localhost:8888/payment_gateway";
                }
              </script>

              <?php } elseif ($_SESSION['status'] == 2) { ?>
              <button id="admin" class="btn btn-primary p-2">Dashboard</button>
              <script>
                document
                  .getElementById("admin")
                  .addEventListener("click", myFunction);

                function myFunction() {
                  window.location.href =
                    "http://localhost:8888/payment_gateway/admin.php";
                }
              </script>
              <button id="admin" class="btn btn-primary p-2">Logout</button>
              <script>
                document
                  .getElementById("admin")
                  .addEventListener("click", myFunction);

                function myFunction() {
                  window.location.href =
                    "http://localhost:8888/payment_gateway/login.php";
                }
              </script>
              <?php } ?>
            </div>
          </li>
        </ul>
      </div>
    </nav>

    <div class="py-5 text-center">
      <img
        class="mb-1 d-block mx-auto"
        src="image/checkout.png"
        width="90"
        height="90"
      />
      <h2>Checkout form</h2>
      <p class="lead">Payment page</p>
    </div>
    <div
      class="container rounded-1 col-md-6 offset-md-3 text-center bg-secondary"
    >
      <p class="lead p-3 text-white">Your shopping cart</p>
      <table class="table table-hover">
        <thead>
          <tr class="bg-dark text-white">
            <th scope="col">Product</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price/pcs</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">Hamburger(M)</th>
            <td>1</td>
            <td>200 THB</td>
          </tr>
          <tr>
            <th scope="row">Pizza(M)</th>
            <td>2</td>
            <td>600 THB</td>
          </tr>
          <tr class="bg-dark text-light">
            <th scope="row">Total(M)</th>
            <td></td>
            <td>800 THB</td>
          </tr>
        </tbody>
      </table>
      <!-- <button type="submit" class="btn btn-primary mt-2 mb-2" onclick="document.location='login.php'">Login</button> -->
      <?php
    if ($_SESSION['status'] == 0) { ?>
      <button id="myBtn" class="btn btn-primary mb-4">Login</button>
      <script>
        document.getElementById("myBtn").addEventListener("click", myFunction);

        function myFunction() {
          window.location.href =
            "http://localhost:8888/payment_gateway/login.php";
        }
      </script>
      <?php } elseif ($_SESSION['status'] == 1) { ?>
      <!-- Modal -->
      <div
        class="modal fade"
        id="staticBackdrop"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        aria-labelledby="staticBackdropLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">
                Select payment method
              </h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <?php $total = 800; ?>
              <div class="container p-5 text-center">
                <h2 class="lead text-body">Select Payment Method</h2>
                <h3 class="text-body">
                  Total price:
                  <?php echo $total;?>
                  THB
                </h3>

                <form name="paynow" method="POST" action="checkout_omise.php">
                  <!-- create checkout.php -->
                  <button type="button" class="btn btn-primary text-light">
                    Pay with Card
                  </button>
                  <script
                    type="text/javascript"
                    src="https://cdn.omise.co/omise.js"
                    data-key="pkey_test_5qdm3u89k7hwufspgzk"
                    data-image="http://bit.ly/customer_image"
                    data-frame-label="THUNX"
                    data-button-label="Card payment"
                    data-submit-label="Pay"
                    data-location="no"
                    data-amount="<?php echo $total; ?>"
                    data-currency="thb"
                  ></script>

                  <!-- <script src="omiseButton.js"></script> -->
                  <script src="https://www.paypal.com/sdk/js?client-id=AVUsK0n4CNKNqOlKMg7ntsb5jJUfJjOBvyPzBq4a4TdYi9M8u7PAFm6KilH4bUJv9-qFYdKjMZmhCruh&disable-funding=credit,card&currency=THB&vault=true"></script>
                  <script src="paypalButton.js"></script>

                  <input
                    type="hidden"
                    name="total"
                    id="total"
                    value="<?php echo $total;?>00"
                  />
                  <!-- create paypalbutton -->
                </form>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
              >
                Close
              </button>
    
            </div>
          </div>
        </div>
      </div>
      <button
        type="button"
        id="myBtn3"
        class="btn btn-primary mb-2"
        data-bs-toggle="modal"
        data-bs-target="#staticBackdrop"
      >
        Paynow
      </button>
      <script>
        document.getElementById("myBtn3").addEventListener("click", myFunction);

        function myFunction() {
          document.getElementById("staticBackdrop");
        }
      </script>

      <?php $_SESSION['status'] = 0; ?>

      <!--hijupyter@gmail.com -->
      <?php } ?>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
