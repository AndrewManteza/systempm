



<DOCTYPE html>

<?php
require_once('class/connectdb.php');
require_once('class/functions.php'); 
?>

<?php
// connect to database
$conn = mysqli_connect('localhost', 'root', '', 'account');

$sql = "SELECT * FROM files";
$result = mysqli_query($conn, $sql);

$files = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<html>

 <head>

   <title>Home</title>
   <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif;}
.w3-sidebar {
  z-index: 3;
  width: 250px;
  top: 43px;
  bottom: 0;
  height: inherit;
}

body {font-family: sans-serif;}
p {color: #666;}

h2 {
  font-size: 2em;
  color: #e74c3c;  
}
.centered {
    margin: 0 auto;
    padding: 0 1em;
}

@media screen and (min-width: 52em) {
    .centered {
        max-width: 52em;
    }
}

/*--------------------------------------------------------------
Header styles minus menu
--------------------------------------------------------------*/

.masthead {
    background: #4897E4;
  	box-shadow: 3px 3px 8px hsl(0, 0%, 70%);
}

.site-title {
    margin: 0 0 1em;
    padding: 1em 0;
    font-size: 2em;
    font-weight: 300;
    text-align: center;
    color: black;
}

@media screen and (min-width: 44.44em) {
    .site-title {
        font-size: 2em;
    }
}
    
@media screen and (min-width: 50em) {
    .site-title {
        font-size: 2.5em;
    }
}

.site-title a {
    color: hsl(5, 45%, 95%);
    text-decoration: none;
}

.site-title a:hover {
    text-decoration: underline;
}

/* Card Based Layout - Base styles */
body {
  background: #ecf0f1;
  line-height: 1.4;
}

.site-title {
	color: white;
}

.card {
	background: white;
	margin-bottom: 2em;	
}

.card a {
	color: black;
	text-decoration: none;
}

.card a:hover {
	box-shadow: 3px 3px 8px hsl(0, 0%, 70%);
}

.card-content {
	padding: 1.4em;
}

.card-content h2 {
	margin-top: 0;
	margin-bottom: .5em;
	font-weight: normal;
}

.card-content p {
	font-size: 95%;
}

img {
  width: 100%;
  height: auto;
}

/* Flexbox styles */
@media screen and (min-width: 40em) {  
  .cards {
    margin-top: -1em;
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
  }

  .card {
    margin-bottom: 1em;
    display: flex;
    flex: 0 1 calc(50% - 0.5em);
    /* width: calc(50% - 1em); */
  }
} /* mq 40em*/

@media screen and (min-width: 60em) {
  .cards {
    margin-top: inherit;
  }
  
  .card {
    margin-bottom: 2em;
    display: flex;
    flex: 0 1 calc(33% - 0.5em);
    /* width: calc(33% - 1em); */
  }
} /* mq 60em*/





</style>

 </head>

 <body>

<!-- Navbar -->


<!-- Sidebar -->
<nav class="w3-sidebar w3-bar-block w3-collapse w3-large w3-theme-l5 w3-animate-left" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-right w3-xlarge w3-padding-large w3-hover-black w3-hide-large" title="Close Menu">
    <i class="fa fa-remove"></i>
  </a>
  <h4 class="w3-bar-item"><b>Menu</b></h4>
  <a class="w3-bar-item w3-button w3-hover-black" href="home.php">Home</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="login.php">Login</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="register.php">Register</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="booking.php">Booking</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="schedules.php">Schedules</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="patientlist.php">Patient list</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="scheduletable.php">Scheduled Patient List</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="chart.php">chart</a>
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
<div class="w3-main" style="margin-left:250px">

  <div class="w3-row w3-padding-64">
   
   
  </div>
 
  
  <header class="masthead clear">
  <div class="centered">

    <div class="site-branding">
      <h1 class="site-title">Flexbox - Card Layout</h1>
    </div>
    <!-- .site-title -->
  </div>
  <!-- .centered -->
</header>
<!-- .masthead -->

<main class="main-area">

  <div class="centered">

    <section class="cards">

      <article class="card">
        <a href="#">
          <figure class="thumbnail">
          <img src="http://placekitten.com/810/610" alt="meow">
          </figure>
          <div class="card-content">
            <h2>Whiskey</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum explicabo consequatur consectetur fugit molestias perferendis, sint error iste ut, facilis sunt natus optio dolor nesciunt laboriosam obcaecati corporis numquam.</p>
          </div>
          <!-- .card-content -->
        </a>
      </article>
      <!-- .card -->
  <!-- Pagination -->
  <article class="card">
        <a href="#">
          <figure class="thumbnail">
            <img src="http://placekitten.com/800/610" alt="meow">
          </figure>
          <div class="card-content">
            <h2>Fluffy</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum explicabo consequatur consectetur fugit molestias perferendis, sint error iste ut, facilis sunt natus optio dolor nesciunt laboriosam obcaecati corporis numquam?</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum explicabo consequatur consectetur fugit molestias perferendis, sint error iste ut, facilis sunt natus optio dolor nesciunt laboriosam obcaecati corporis numquam?</p>
          </div>
          <!-- .card-content -->
        </a>
      </article>

<!-- END MAIN -->


<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>

</body>



</html>