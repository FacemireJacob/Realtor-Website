<!DOCTYPE html>

<HTML>

<head>
    <title>Realty Login Page</title>
    <link rel="stylesheet" type="text/css" href="../CSS/home.css">
</head>

<body>

<div id="container">	
<div class = box style="width : 55%; margin-top : 25%">

<!--Sets up Class for JS Effect. Pulled from: https://tobiasahlin.com/moving-letters/#7-->
<h1 class="ml7">
  <span class="text-wrapper">
    <span class="letters">Discover Home.</span>
  </span>
</h1>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
</div>

	<div class = "box" style =  "text-align: right;  margin-top : 30%">
		<p>User ID: </p><p>Password: </p>
	</div>

	<div class="box" style = "text-align: left;  margin-top : 30%" >
        <form action="registrationHandler.php" method="POST">
            <p><input type="text" name="id"></input></p>
            <p><input type="password" name="pass"></input></p>

	</div> <!--Close Box-->

</div> <!--Close Container-->

<div id="container">
    <input type = "submit" name = "submit" value = "Register" style = "font-size: 20px"></input>
    </form> <!--End Form-->
</div> <!--Close Container-->

<div class="box">
<p style="font-size: 20px;">Already Registered? <a href="login.php">Click Here</a></p>
<script>
//JS Script to make Text effect work. Pulled from https://tobiasahlin.com/moving-letters/#7
// Wrap every letter in a span
var textWrapper = document.querySelector('.ml7 .letters');
textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

anime.timeline({loop: false})
  .add({
    targets: '.ml7 .letter',
    translateY: ["1.1em", 0],
    translateX: ["0.55em", 0],
    translateZ: 0,
    rotateZ: [180, 0],
    duration: 750,
    easing: "easeOutExpo",
    delay: (el, i) => 50 * i
  })

</script>

</body>

</HTML>