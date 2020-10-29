 	<!--div style="height:500px;width:500px;border:1px solid red;"--> 
<?php
	
	$type="null";
	$etat="null";

	$tab_fichier=array();
	$nom_fichier ="fichiers/f_securiter.csv";
	
	if($_GET["id"]=="depart")// Ici on traite les informations venant du fichier pour 
		{

			
			
			$fichier = fopen($nom_fichier, "r");
			while ($donnee = fgetcsv($fichier, filesize($nom_fichier))) 
			{
				$tab_fichier[] = $donnee;
				<meta http-equiv="refresh" content="2;url=ouvrants.php?id=depart">
			}
			fclose($fichier);
			
		}
		
	else if($_GET["id"]=="alarme")
		{
			//echo"<h3>l'affichage qui suit et dans la condition de salon</h3>";
		
			$etat=$_POST['etat_alarme'];
			
			//echo " etat est $etat";
			
			$fichier = fopen($nom_fichier, "r");
			while ($donnee = fgetcsv($fichier, filesize($nom_fichier))) $tab_fichier[] = $donnee;
			fclose($fichier);
			
			if($etat=="Actif" or $etat=="Non actif"){echo " je suis ok ";$tab_fichier[1][1]=Inver_mode($etat);}
			
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
			header('location:securite.php?id=depart');
			exit();
		}






	else if($_GET["id"]=="prise")
			{
		
			$etat_prise=$_POST['etat_prise'];
			
	
			
			$fichier = fopen($nom_fichier, "r");
			while ($donnee = fgetcsv($fichier, filesize($nom_fichier))) $tab_fichier[] = $donnee;
			fclose($fichier);
			
			if($etat_prise=="Actif" or $etat_prise=="Non actif")$tab_fichier[2][1]=Inver_mode($etat_prise);
			
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
		  header('location:securite.php?id=depart');
			exit();
			}
		

	?>

<!--/div-->









	
	
<?xml version="1.0" encoding="iso-8859-1"?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-
	strict.dtd">
	
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr-FR" lang="fr-FR">
		<head>
		 <title>La sécurité </title>
		 <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
		 <meta name="viewport" content="width=device-width, initial-scale=1.0">
		 
		 <link rel="stylesheet" href="css/securite.css"  />
		
		
		</head>
		
		<body>
		<div id="body">
			<div class="tab"> 
				<h1> Sécuriser votre maison </h1> <br/>
				<p id="manipulation"> Appuyer sur un bouton pour <b>Activer/Desactiver</b> un élément.</p><br/>
				<br/>
				
				
					
					<!-- Ce formulaire concerne la gestion de la porte principale-->
						
						<form method="post" action="securite.php?id=alarme" 
							name="alarme" 	class="alarme">
<?php foreach($tab_fichier as $ligne){ if($ligne[0]=="Alarme"){$etat_al=$ligne[1];break;}}?>
					
						<fieldset >
							<legend><i>Alarme</i></legend>
								<div id="label">
									<i>Etat : </i>
								</div>
								
								<div id="element">
									<input type="submit" id="<?php if($etat_al=="Actif")echo"allumer"; else echo"stop"; ?>" name="etat_alarme"value="<?php echo $etat_al; ?>" > 
								</div>
						</fieldset>
					</form>
					
					<br/>





					<!--Ce formulaire concerne lesprise du courant delamaison-->
					
					<form method="post" action="securite.php?id=prise" 
							name="prise" 	class="prise">

<?php foreach($tab_fichier as $ligne){ if($ligne[0]=="Prise"){$etat_prises=$ligne[1];break;}}?>
					
						<fieldset >
							<legend><i>Prises</i></legend>
								<div id="label">
									<i>Etat : </i>
								</div>
								
								<div id="element">
									<input type="submit" id="<?php if($etat_prises=="Actif")echo"allumer"; else echo"stop"; ?>" name="etat_prise"value="<?php echo $etat_prises; ?>"> 
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
		if($etat=="Actif")return "Non actif";
		else if( $etat=="Non actif") return "Actif";
	}



?>

