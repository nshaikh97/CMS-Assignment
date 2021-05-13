<?php

add_action(' wp_enqueue_scripts', 'enqueue_styles' );
function my_theme_enqueue_styles() {
wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

function results_function() {
  ob_start();?>
  <html>
   <body>
           <?php
		   $servername = "localhost";
		   $username = "root";
		   $password = "";
		   $dbname = "ha_database";
		   $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, 
		       $password, array(
		   PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		   ));
		   
		   $search=$_POST['search'];
		   $query1 = $pdo->prepare("SELECT * FROM results WHERE 'AWAY TEAM' LIKE
		       '%$search%' LIMIT 0 , 30");
		   $query1->bindValue(1, "%$search%", PDO::PARAM_STR);
		   $query1->execute();
		   $query = $pdo->prepare("SELECT * FROM results WHERE 'HOME TEAM' LIKE
		       '%$search%' LIMIT 0 , 30");
		   $query->bindValue(1, "%$search%", PDO::PARAM_STR);
		   $query->execute();
		   
		   if(!$query->rowCount() == 0) {
			       echo "<table class='w3-table-all'>";
				   echo "<tr class='w3-red'><h2>HOME GAMES</h2><th>ID</th><th
				       >Date</th><th>Home Team</th><th>Away Team </th><th>Home
					   Goals </th><th>Away Goals</th><th>Result</th></tr>";
			   while ($results = $query->fetch()) {
				   echo "<tr><td>";
				   echo $results['ID'];
				   echo "<td></td>";
				   echo $results['DATE'];
				   echo "<td></td>";
				   echo $results['HOME TEAM'];
				   echo "<td></td>";
				   echo $results['AWAY TEAM'];
				   echo "<td></td>";
				   echo $results['HOME GOALS'];
				   echo "<td></td>";
				   echo $results['AWAY GOALS'];
				   echo "<td></td>";
				   echo $results['RESULT'];
				   echo "<td></td>";
			   }
				   echo "</table>";
		       }else {
				   echo 'No Data Found';
			   }
			   if(!$query1->rowCount()== 0) {
				       echo "<table class='w3-table-all'>";
					   echo "<tr class='w3-red'><h2>AWAY GAMES</h2><th>ID</th><th
					       >Date</th><th>Home Team</th><th>Away Team </th><th>Home
						   Goals </th><th>Away Goals</th><th>Result</th></tr>";
			       while ($results = $query1->fetch()) {
					   echo "<tr><td>";
					   echo $results['ID'];
					   echo "<td></td>";
					   echo $results['DATE'];
					   echo "<td></td>";
					   echo $results['HOME TEAM'];
					   echo "<td></td>";
					   echo $results['AWAY TEAM'];
					   echo "<td></td>";
					   echo $results['HOME GOALS'];
					   echo "<td></td>";
					   echo $results['AWAY GOALS'];
					   echo "<td></td>";
					   echo $results['RESULT'];
					   echo "<td></td>";
				   }
				       echo "</table>";
			       }else {
					   echo 'No Data Found';
			   }
		?>
		
		</body>
		</html><?php
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
    }	
	add_shortcode('resultssdata', 'results_function' );
	
	
function arsenalpost(){
	return "<p>Arsenal are rumored to be preparing a £43 million bid to sign Moroccan full-back Achraf Hakimi from Inter Milan this summer. However, the Gunners will have to sell some players to raise funds for any potential signings 
	and are now reportedly open to selling Matteo Guendouzi to Hertha Berlin.According to AS, Arsenal will be looking to sign Achraf Hakimi as a potential replacement for Hector Bellerin, who is widely tipped to leave the
	Emirates for Barcelona in the summer.Achraf Hakimi rose to prominence during his two-year loan spell with Borussia Dortmund. The 22-year-old developed into one of Europe's most exciting 
	young wing-backs during his time with the Bundesliga outfit. He made 73 appearances and scored 12 goals for the club before returning to Real Madrid last summer.Despite being highly rated by the club's hierarchy, 
	the defender was deemed surplus to requirements by Real Madrid boss Zinedine Zidane and was sold to Inter Milan for £40 million last summer.Achraf Hakimi has been in scintillating form for Inter Milan this season, 
	scoring 6 goals and providing 6 assists in 35 appearances in all competitions. His consistent performances have caught the eye of a number of Europe's top clubs.Inter Milan are reportedly willing to listen to offers 
	for the former Real Madrid defender as they look to cope with the financial implications of the coronavirus pandemic.Arsenal have also been negatively affected by the pandemic and will have to sell some players if they are 
	to sign Achraf Hakimi. Matteo Guendouzi has now emerged as the player who could be sold this summer to raise funds for the signing.</p>";

}
add_shortcode('arsenal','arsenalpost');
	
function headerwebsite () {
	return "<header><h1 style-text;color:black;>All products can be found here</h1></header>";
}
add_shortcode('heading', 'headerwebsite');

function messipic(){
	return '<img src="https://cdn.cnn.com/cnnnext/dam/assets/200206110200-messi-angry-crop-super-tease.jpg";/>';
}
add_shortcode('messi', 'messipic');

function follow_insta( $atts, $content = null) {
	return '<a href="https://twitter.com/premierleague?lang=en" target="blank" <button type="button" class="btn btn-tw"><i class="fab fa-twitter pr-1"></i> Follow for updated premier league news !</button>' . $content . '</a>';
}
add_shortcode('follow', 'follow_insta');

function vid_sc($atts, $content=null) {
    extract(
        shortcode_atts(array(
            'site' => 'youtube',
            'id' => '',
            'w' => '682',
            'h' => '400'
        ), $atts)
    );
    if ( $site == "youtube" ) { $src = 'https://www.youtube-nocookie.com/embed/' .$id; }
	    if ( $id != '' ) {
            return '<iframe width="'.$w.'" height="'.$h.'" src="'.$src.'" class="vid iframe-'.$site.'"></iframe>';
        }
    }
add_shortcode('vid', 'vid_sc');

function table_function(){
	return '<br/>
	<table style = "width:100%">
	<tr>
	<th>Player Name</th>
	<th>Position</th>
	<th>Award Month</th>
	</tr>
	<tr>
	<td>Kelechi Iheanacho</th>
	<td>Forward</td>
	<td>March</td>
	</tr>
	<tr>
	<td>Ilkay Gündogan</th>
	<td>Midfield</td>
	<td>February</td>
	</tr>
	<tr>
	<td>Bruno Fernandes</th>
	<td>Midfield</td>
	<td>January</td>
	</tr>
	</table>';
}
add_shortcode('table','table_function');

function follow_POTM( $atts, $content = null) {
	return '<a href="https://twitter.com/67Kelechi" target="blank" <button type="button" class="btn btn-tw"><i class="fab fa-twitter pr-1"></i> Follow the latest POTM !</button>' . $content . '</a>';
}
add_shortcode('POTMfollow', 'follow_POTM');