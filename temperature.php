
<!--div style="height:500px;width:500px;border:1px solid red;"--> 
<?php
	
	$type="null";
	$mode="null";
	$vitesse="null";
	$etat="null";
	$tab_fichier=array();
	$nom_fichier = "fichiers/f_temperature.csv";
	
	if($_GET["id"]=="depart")// Ici on traite les informations venant du fichier pour 
		{
			//echo"<h3>l'affichage qui suit et dans la condition du départ </h3>";
			
			
			$fichier = fopen($nom_fichier, "r");
			//echo "le contenu du fichier est $fichier" ;
			while ($donnee = fgetcsv($fichier, filesize($nom_fichier))) 
			{
				$tab_fichier[] = $donnee;
				
			}
			fclose($fichier);
			
			$type=$tab_fichier[1][0];
			$vitesse=$tab_fichier[1][2];
			$mode=$tab_fichier[1][3];
			$etat=$tab_fichier[1][1];
			
			/*for($i=0;$i<2;$i++)
			{ 
				//echo " ligne $i";
				for($t=0;$t<4;$t++)
				{
				$var=$tab_fichier[$i][$t];
					echo "<p>$var</p>";
				}
			}*/
			
		
		}
		
	else if($_GET["id"]=="valide")
		{
			//echo"<h3>l'affichage qui suit et dans la condition de valide</h3>";
			$mode=$_POST['mode'];
			$etat=$_POST['etat'];
			
			//echo " etat est $etat";
			
			$fichier = fopen($nom_fichier, "r");
			while ($donnee = fgetcsv($fichier, filesize($nom_fichier))) 
			{
				$tab_fichier[] = $donnee;
			}
			
			if($mode=="Automatique" or $mode=="Manuel")
			{
				$tab_fichier[1][3]=Inver_mode($mode);
				//$var=Inver_mode($mode);
				//echo "<p> Mode = $mode et son inverse est $var</p>";
			}
			
			if($etat=="Allumer" or $etat=="Eteint")
			{
				$tab_fichier[1][1]=Inver_mode($etat);
				//$var=Inver_mode($etat);
				//echo "<p> Etat = $etat et l'inverse est $var </p>";
			}
			
			
			$fichier =fopen($nom_fichier, "w");
			$chaine="";
			foreach ($tab_fichier as $ligne)
			{
				$var++;
				for($i=0;$i<4;$i++)
				{
					if($i==3)$chaine.=$ligne[$i]; // Cette parti du code permet de faire la transcription des elements
					else $chaine.=$ligne[$i].",";// de la liste en une chaine 
				}
				$chaine.="\n";
				$ret=fwrite($fichier,$chaine);
				$chaine="";
				
			}
			fclose($fichier);
			header('location:temperature.php?id=depart');

			
		
		//////////////////////////////////
		
			$type=$tab_fichier[1][0];
			$vitesse=$tab_fichier[1][2];
			$mode=$tab_fichier[1][3];
			$etat=$tab_fichier[1][1];
			
			/*for($i=0;$i<2;$i++)
			{ echo " ligne $i";
				for($t=0;$t<4;$t++)
				{
				$var=$tab_fichier[$i][$t];
					echo "<p>$var</p>";
				}
			}*/
			
			
		}
		


	?>

</div>


<?xml version="1.0" encoding="iso-8859-1"?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-
	strict.dtd">
	
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr-FR" lang="fr-FR">
		<head>
		 <meta http-equiv="refresh" content="2;url=temperature.php?id=depart">
		 <title>Climatisation</title>
		 <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
		 <meta name="viewport" content="width=device-width, initial-scale=1.0">
		 
		 <link rel="stylesheet" href="css/tempe.css" />
		
		
		</head>
		
		<body>
		<div id="body">
	
			<div class="tab"> 
				
				<h1> La température à votre goût  </h1>
				<p id="nb"> <b>N.B: </b>Ce système demarre automatiquement lorsque la température ambiate de votre 
				habitat atteint 30°C. </p>
				<br/>
				<p id="manipulation"> La manipulion se fait en trois modes: </p>
					<ul>
					<i>
						<li><b>Automatique : </b>le système se déclenche à la condition dite ci-haut;</li>
						<li><b>Manuelle :</b> Le système demarre immédiatement;</li>
						<li><b>Stop :</b> Le système est eteint. </li>
					</i>
					</ul>
					<br/>
					
					<!-- Ce formulaire concerne la gestion de la température-->
						
						<form method="post" action="temperature.php?id=valide" 
							name="formulaire_temperature" 	class="temperature">
					
						<fieldset >
							<legend><i>Apuyer sur un bouton pour chaque mode</i></legend>
								<!--div>
									<input type="submit" id="<?php if($mode!="manuel") echo "id_bidon";else echo 
									"manuel" ?>" name="mode"value="Manuel"/> 
								</div-->
								
								<div>
									<input type="submit" id="<?php if($mode!="automatique") echo "id_bidon";else echo 
									"automatique" ?>" name="mode"value="<?php if($mode=="automatique") echo "Automatique"; 
									else echo"Manuel"; ?>"/> 
								</div>
								
								<div >
									<input type="submit" id="<?php if($etat=="Allumer") echo "enmarche"; else echo "stop"; ?>"  
									name="etat" value="<?php if($etat=="Allumer") echo "Allumer"; 
									else echo "Eteint"; ?>"/> 
								</div>
										
						
						</fieldset>
					</form><br/>
					
					<div id="commande">
						<div style="margin-left:10%;float:left;">
							<a href="deconnection.php" title="Voulez-vous vous deconnecter ?">Déconnection</a>
						</div>
						<div style="margin-right:10%;float:right;">
							<a href="menu.php"title="Retour au menu ">Retour au menu</a>
						</div>
					</div>
						
			</div>
		</div>
		
			
		</body>
	</html>
	
	
	<?php
		
	// Declaration de méthodes
		
		// Cette methode permet d'inversion en auto vers manuel ou vice versa
		
		function Inver_mode($mode)
		{
			if($mode=="Automatique") return "manuel";
			else if($mode=="Manuel") return "automatique";
			else if($mode=="Allumer") return "Eteint";
			else if($mode=="Eteint") return "Allumer";
		}
		
	?>
	
	
	
	
	
