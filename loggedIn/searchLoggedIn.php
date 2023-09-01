<!DOCTYPE HTML>

<head>

<title>
Real Estate Home Page
</title>

<link rel="stylesheet" type="text/css" href="CSS/home.css">
</head>

<body>

<!--Put Javascript for Into  Text Here-->


<div id="container">
<div class="box">

	<form method="POST" action="resultsLoggedIn.php">
		<!--I Copied an example I found online because I didn't want to type all 51 Lines-->
		<p>State <select name = "state" id = "state">
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

		<!--Use Text as Zip codes have leading 0's number formats will truncate, Pattern function forces only numbers can be typed in I learned this from css-tricks.com-->
		<p>Zip Code:<input name="zip" type="text" pattern="[0-9]*"></p>

		<input type="submit" name="Submit">
	</form>

<div id="container">
<div class="box">

</body>