
<!DOCTYPE html>
<html>
<head>
  <title> <?php echo $header['tabTitle'] ?> </title>
  <link rel="icon" href= <?php echo $header['tabIcon'] ?> >

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href=<?php echo base_url("assets/css/bootstrap/dist/css/bootstrap.css")?>>
  <link rel="stylesheet" href=<?php echo base_url("assets/css/monotone/theme2.css")?>>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <style>
    * {
        box-sizing: border-box;
    }

    /* Create two equal columns that floats next to each other */
    .column {
        float: left;
        width: 50%;
        padding: 10px;
    }

    .col-col-1{
      background-color: #D3F0F2;
    }
    .col-col-2{
      background-color: #D8F0E3;
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }
    /* Style the buttons */
    .btn {
        border: none;
        outline: none;
        padding: 12px 16px;
        background-color: #F2FFFF;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #D0F1F2;
        color: gray;
    }

    .btn.active {
        background-color: #D0F1F2;
        color: black;
    }

    a{
			color: #4e4e4e;
			text-decoration: none;
		}
    a:hover{
			color: #4e4a56;
			text-decoration: none;
		}
    h2{
      font-weight: 300;
    }
    p{
      font-weight: lighter;
      font-style: italic;
    }
  </style>
</head>
<body>

  <div class="container">

    <div class="border border-success col-10 my-5 py-3 mx-auto shadow-lg">
    <h1 class="text-center my-4">Wait for us to come, in <br><b><a href="<?php echo base_url() ?>"> <?php echo $content['appName'] ?> </a></b> !</h1>
    <div id="btnContainer" class="row">
      <div class="col-sm input-group-append">
        <button class="btn active mx-1" onclick="gridView()"><i class="fa fa-th-large"></i> Grid</button>
        <button class="btn mx-1" onclick="listView()"><i class="fa fa-bars"></i> List</button>
      </div>
      <div class="mx-3 mt-2">
        <button onclick="location.href='<?php echo base_url(); ?>';"	class="btn rounded btn-md text-dark" name="" ><i class="fa fa-home"></i> Home</button>
      </div>
    </div>
    <br>
    <div class="container">
      <div class="row justify-content-center">
        <div class="column col-col-1 order-1">
          <h2>Custom URL</h2>
          <p>Customize your shortened link so you can easily remember them !</p>
        </div>
        <div class="column col-col-2 order-2">
          <h2>Click counter</h2>
          <p>Track how much your friends has visited your shortened link !</p>
        </div>
        <div class="column col-col-1 order-4">
          <h2>QR code generator</h2>
          <p>Generate a QR code for every single link you shortened ! <br>Generate, scan, done !</p>
        </div>
        <div class="column col-col-2 order-3">
          <h2>Whatsapp click to chat</h2>
          <p>Easily share your "Hi ! How is it going ?" to any number via our short link !</p>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="column col-col-1 order-1">
          <h2>Social media integration</h2>
          <p>Let the world knows your links via all of your friends !</p>
        </div>
        <div class="column col-col-2 order-2">
          <h2>Google and Facebook login</h2>
          <p>Simplify registration, so you can drink more coffee !</p>
        </div>
        <div class="column col-col-1 order-4">
          <h2>Etc.</h2>
          <p>Fun has just begin ! Wait for the others amazing features we offer !</p>
        </div>
        <div class="column col-col-2 order-3">
        <h2>Admin panel</h2>
        <p>Take full control of your account--also your link--with this powerful yet simple admin panel !</p>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-9">
          <center>
            <sub>
              Made with <small><i class="fa fa-heart"></i></small> and hundred of <small><i class="fa fa-coffee"></i></small> by me, myself, and i -
              <span>Copyright &copy;  <?php echo $content['appName'] ?> 2019-2020</span>
            </sub>
          </center>
        </div>
        <div class="col-1">
          <sub>01/08/18</sub>
        </div>
      </div>
    </div>
  </div>

<!-- end of div container -->
  </div>

  <script>
    // Get the elements with class="column"
    var elements = document.getElementsByClassName("column");

    // Declare a loop variable
    var i;

    // List View
    function listView() {
      for (i = 0; i < elements.length; i++) {
        elements[i].style.width = "100%";
      }
    }

    // Grid View
    function gridView() {
      for (i = 0; i < elements.length; i++) {
        elements[i].style.width = "50%";
      }
    }

    /* Optional: Add active class to the current button (highlight it) */
    var container = document.getElementById("btnContainer");
    var btns = container.getElementsByClassName("btn");
    for (var i = 0; i < btns.length; i++) {
      btns[i].addEventListener("click", function(){
        var current = document.getElementsByClassName("active");
        current[0].className = current[0].className.replace(" active", "");
        this.className += " active";
      });
    }
  </script>

</body>
</html>
