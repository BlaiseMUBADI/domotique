	<!--div style="height:500px;width:500px;border:1px solid red;"--> 
<?php
	
	$type="null";
	$etat="null";

	$tab_fichier=array();
	$nom_fichier ="fichiers/f_ouvrants.csv";
	
	if($_GET["id"]=="depart")// Ici on traite les informations venant du fichier pour 
		{

			
			
			$fichier = fopen($nom_fichier, "r");
			while ($donnee = fgetcsv($fichier, filesize($nom_fichier))) 
			{
				$tab_fichier[] = $donnee;
				
			}
			echo "moi je reussi àouvrir le fichier voici le resultat de la reqette $fichier";
			fclose($fichier);
			
		}
		
	else if($_GET["id"]=="principale")
		{
			//echo"<h3>l'affichage qui suit et dans la condition de la porte principale </h3>";
		
			$etat_principale=$_POST['etat_principale'];
			
			//echo " etat est $etat_principale";
			
			$fichier = fopen($nom_fichier, "r");
			while ($donnee = fgetcsv($fichier, filesize($nom_fichier))) $tab_fichier[] = $donnee;
			fclose($fichier);
			
			if($etat_principale=="Ouverte" or $etat_principale=="Fermee")
				$tab_fichier[2][1]=Inver_mode($etat_principale);
			
			$fichier = fopen($nom_fichier, "w");
			foreach ($tab_fichier as $ligne)
			{
				$var++;
				for($i=0;$i<2;$i++)
				{
					if($i==1)$chaine.=$ligne[$i]; // Cette parti du code permet de faire la transcription des elements
					else $chaine.=$ligne[$i].",";// de la liste en une chaine 
				}
				$chaine.="\n";
				$ret=fwrite($fichier,$chaine);
				//echo "<p>la chaine = $chaine et la requette donne $ret</p>";
				$chaine="";
				
			}
			fclose($fichier);
			header('location:ouvrants.php?id=depart');
			exit();
		}






	else if($_GET["id"]=="garage")
			{
		
			$etat_garage=$_POST['etat_garage'];
			
	
			
			$fichier = fopen($nom_fichier, "r");
			while ($donnee = fgetcsv($fichier, filesize($nom_fichier))) $tab_fichier[] = $donnee;
			fclose($fichier);
			
			if($etat_garage=="Ouverte" or $etat_garage=="Fermee")$tab_fichier[1][1]=Inver_mode($etat_garage);
			
			$fichier = fopen($nom_fichier, "w");
			foreach ($tab_fichier as $ligne)
			{
				$var++;
				for($i=0;$i<2;$i++)
				{
					if($i==1)$chaine.=$ligne[$i]; // Cette parti du code permet de faire la transcription des elements
					else $chaine.=$ligne[$i].",";// de la liste en une chaine 
				}
				$chaine.="\n";
				$ret=fwrite($fichier,$chaine);
				//echo "<p>la chaine = $chaine et la requette donne $ret</p>";
				$chaine="";
				
			}
			fclose($fichier);
		  header('location:ouvrants.php?id=depart');
			exit();
			}
		

	?>

<!--/div-->











 	
		<?xml version="1.0" encoding="iso-8859-1"?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-
	strict.dtd">
	
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr-FR" lang="fr-FR">
		<head>
	 	 <meta http-equiv="refresh" content="2;url=ouvrants.php?id=depart">
		 <title>Les Ouvrants</title>
		 <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
		 <meta name="viewport" content="width=device-width, initial-scale=1.0">
		 
		 <link rel="stylesheet" href="css/ouvrants.css"  />
		 
		
		
		</head>
		
		<body>
		<div id="body">
			<div class="tab"> 
				<h1> Commander les ouvrants</h1> <br/>
				<p id="manipulation"> Apuyer sur un bouton correspondant à la porte voulue.</p><br/>
				<p id="nb"> <b>N.B: </b>la porte principale et du garage s'ouvrent automatiquement ou		
				manuellement.</p><br/>
				
				
					
					<!-- Ce formulaire concerne la gestion de la porte principale-->
						
						<form method="post" action="ouvrants.php?id=principale" 
							name="ouvrant_principal" 	class="ouvrant_principal">

<?php foreach($tab_fichier as $ligne){ if($ligne[0]=="Principale"){$etat_princi=$ligne[1];break;}}?>
					
						<fieldset >
							<legend><i>La porte principale</i></legend>
								<div id="label">
									<i>Etat : </i>
								</div>
								
								<div id="element">
<input type="submit" id="<?php if($etat_princi=="Ouverte")echo"allumer"; else echo"stop"; ?>" name="etat_principale"value="<?php echo $etat_princi; ?>" > 


								</div>
						</fieldset>
					</form>
					
					<br/>
					<!--Ce formulaire concerne la porte du garage-->
					
					<form method="post" action="ouvrants.php?id=garage" 
							name="ouvrant_garage" 	class="ouvrant_garage">
<?php foreach($tab_fichier as $ligne){ if($ligne[0]=="Garage"){$etat_garag=$ligne[1];break;}}?>
					
						<fieldset >
							<legend><i>La porte du garage</i></legend>
								<div id="label">
									<i>Etat : </i>
								</div>
								
								<div id="element">

<input type="submit" id="<?php if($etat_garag=="Ouverte")echo"allumer"; else echo"stop"; ?>" name="etat_garage"value="<?php echo $etat_garag; ?>" > 
								</div>
						</fieldset>
					</form>
					
					
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
	function Inver_mode($etat)
	{
		if($etat=="Ouverte")return "Fermee";
		else if( $etat=="Fermee") return "Ouverte";
	}



?>

