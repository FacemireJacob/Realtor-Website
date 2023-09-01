<?php
    session_start();
	$id = $_SESSION['user'];

	if($id == null)
	{
		header("location:redir.php");
	}
?>

<!DOCTYPE HTML>

<head>

<title>
Real Estate Home Page
</title>

<link rel="stylesheet" type="text/css" href="../CSS/home.css">
</head>

<body>

<div id="container">	
	<div class = box style="width : auto; margin-top : 20%; align-items: center; margin-bottom: 0;">
	<!--Sets up Class for JS Effect. Pulled from: https://tobiasahlin.com/moving-letters/#7-->
	<h1 class="ml7">
		<span class="text-wrapper">
			<span class="letters">Welcome Home, <?php echo($id); ?></span>
		</span>
	</h1>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
	</div>
</div>

<div id = "container">

	<div class = "box" style =  "text-align: right;">
		<p>State: </p><p>City: </p>
	</div>

	<div class="box" style = "text-align: left;" >
		<form method="POST" action="resultsLoggedIn.php">

			<p><select name = "state" id = "state" style="font-size: 24px">
				<option value="AL">AL</option>
				<option value="AK">AK</option>
				<option value="AR">AR</option>
				<option value="AZ">AZ</option>
				<option value="CA">CA</option>
				<option value="CO">CO</option>
				<option value="CT">CT</option>
				<option value="DC">DC</option>
				<option value="DE">DE</option>
				<option value="FL">FL</option>
				<option value="GA">GA</option>
				<option value="HI">HI</option>
				<option value="IA">IA</option>
				<option value="ID">ID</option>
				<option value="IL">IL</option>
				<option value="IN">IN</option>
				<option value="KS">KS</option>
				<option value="KY">KY</option>
				<option value="LA">LA</option>
				<option value="MA">MA</option>
				<option value="MD">MD</option>
				<option value="ME">ME</option>
				<option value="MI">MI</option>
				<option value="MN">MN</option>
				<option value="MO">MO</option>
				<option value="MS">MS</option>
				<option value="MT">MT</option>
				<option value="NC">NC</option>
				<option value="NE">NE</option>
				<option value="NH">NH</option>
				<option value="NJ">NJ</option>
				<option value="NM">NM</option>
				<option value="NV">NV</option>
				<option value="NY">NY</option>
				<option value="ND">ND</option>
				<option value="OH">OH</option>
				<option value="OK">OK</option>
				<option value="OR">OR</option>
				<option value="PA">PA</option>
				<option value="RI">RI</option>
				<option value="SC">SC</option>
				<option value="SD">SD</option>
				<option value="TN">TN</option>
				<option value="TX">TX</option>
				<option value="UT">UT</option>
				<option value="VT">VT</option>
				<option value="VA">VA</option>
				<option value="WA">WA</option>
				<option value="WI">WI</option>
				<option value="WV">WV</option>
				<option value="WY">WY</option>
			</select></p>
			<p><input name="city" type="text" style="font-size: 24px"></p>

	</div> <!--Close Box-->

</div> <!--Close Container-->

<div id="container">
<input type = "submit" name = "submit" value = "Search" style = "font-size: 20px"></input></form>
</div>

<div id="container">
<div class="box">
<p style="font-size: 20px;">Looking to Log Out? <a href="../redir.php">Click Here!</a></p>
</div>
</div>

<div id = "container">
	<div id = box>
		<a href = "savedSearches.php" style = "font-size: 20px")>Show Saved Searches</a>
	</div>
</div>

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

</html>