<!--div style="height:500px;width:500px;border:1px solid red;"> 
<p>Salut </p-->
<?php
	
	$type="null";
	$mode="null";
	$luminosite="null";
	$etat="null";

	$tab_fichier=array();
	$nom_fichier ="fichiers/f_eclairage.csv";
	
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
			
		}
		
	else if($_GET["id"]=="salon")
		{
			//echo"<h3>l'affichage qui suit et dans la condition de salon</h3>";
		
			$etat=$_POST['etat_salon'];
			
			//echo " etat est $etat";
			
			$fichier = fopen($nom_fichier, "r");
			while ($donnee = fgetcsv($fichier, filesize($nom_fichier))) $tab_fichier[] = $donnee;
			fclose($fichier);
			
			if($etat=="Allumee" or $etat=="Eteinte")$tab_fichier[2][1]=Inver_mode($etat);
				
			$fichier = fopen($nom_fichier, "w");
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
				//echo "<p>la chaine = $chaine et la requette donne $ret</p>";
				$chaine="";
				
			}
			fclose($fichier);
			header('location:eclairage.php?id=depart');
			exit();
		}






	else if($_GET["id"]=="exterieur")
			{
				//echo"<h3>l'affichage qui suit et dans la condition exterieure</h3>";
			
				$etat=$_POST['etat_exterieur'];
				$mode=$_POST["mode"];
				
				//echo " etat est $etat";
				//echo "<p>etat_envoi = $etat et mode_envoi = $mode </p>";
				$fichier = fopen($nom_fichier, "r");
				while ($donnee = fgetcsv($fichier, filesize($nom_fichier))) $tab_fichier[] = $donnee;
				fclose($fichier);
				
				if($etat=="Allumee" or $etat=="Eteinte")$tab_fichier[3][1]=Inver_mode($etat);
				if($mode=="Automatique" or $mode=="Manuel")$tab_fichier[3][3]=Inver_mode($mode);
					
				$fichier = fopen($nom_fichier, "w");
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
					//echo "<p>la chaine = $chaine et la requette donne $ret</p>";
					$chaine="";
					
				}
				fclose($fichier);
				header('location:eclairage.php?id=depart');
				exit();
			}
		





	else if($_GET["id"]=="chambre")
		{
			//echo"<h3>l'affichage qui suit et dans la condition chambre</h3>";
		
			$etat_chambre=$_POST["etat"];
			$luminosite=$_POST["luminosite"];
			
			//echo " etat est $etat";
			//echo "<p>etat $etat</p>";
			$fichier = fopen($nom_fichier, "r");
			//echo "<p>Inver eta = ".Inver_mode($etat)." </p>";
			while ($donnee = fgetcsv($fichier, filesize($nom_fichier))) $tab_fichier[] = $donnee;
			fclose($fichier);
			
		
				
			if($etat_chambre=="Allumee" or $etat_chambre=="Eteinte")$tab_fichier[1][1]=Inver_mode($etat_chambre);
			if(isset ($luminosite)) $tab_fichier[1][2]=Enlever_pourcentage($luminosite);

			$fichier = fopen($nom_fichier, "w");
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
				//echo "<p>la chaine = $chaine et la requette donne $ret</p>";
				$chaine="";
				
			}
			fclose($fichier);
			header("location:eclairage.php?id=depart");
			exit();

		}

	?>

<!--/div-->









	
	
	<?xml version="1.0" encoding="iso-8859-1"?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-
	strict.dtd">
	
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr-FR" lang="fr-FR">
		<head>
		<meta http-equiv="refresh" content="2;url=eclairage.php?id=depart">
		 <link rel="stylesheet" href="eclairage.css" />
		 <title>Les lampes</title>
		 <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
		 <meta name="viewport" content="width=device-width, initial-scale=1.0">
		 
		
		
		
		</head>
		
		<body>
		<div id="body">
			<div class="tab"> 
				<h1> Les Lampes </h1> <br/>
				
				<!-- Ce formulaire concerne la gestion de l'éclairage pour le salon -->	
					<form method="post" action="eclairage.php?id=salon" 
					name="formulaire_salon" 	 
					class="salon">
					
						<fieldset>
							<legend>Lampes Salon</legend>
<?php foreach($tab_fichier as $ligne){ if($ligne[0]=='salon'){ $etat=$ligne[1];break;}} ?> 

								<div id="etiquette">
									<p>Etat de lampe du salon</p>
								</div>
								<div id="element">
									<input type="submit" id=<?php if($etat=="Allumee")echo "enmarche";else echo"stop";?> 		 name="etat_salon" value="<?php echo $etat;?>"/> 
								</div>
						</fieldset>

						</form>
						<br/>
						
						<!-- Ce formulaire concerne la gestion de l'éclairage pour 
						l'exterieur-->
						
						
						<form method="post" action="eclairage.php?id=exterieur" 
					name="formulaire_exterieur" 	 
					class="exterieur">
					
						<fieldset>
							<legend>Lampes Exterieures</legend>

<?php foreach($tab_fichier as $ligne){ if($ligne[0]=='exterieur'){ $etat=$ligne[1];$mode=$ligne[3];break;}} ?> 

								<div id="etat">
									<div id="label2">Etat --></div>
									<div id="element2">
										<input type="submit" 
											id=<?php if($etat=="Allumee")echo "enmarche";else echo"stop";?>
											name="etat_exterieur" value="<?php echo $etat;?>"/> 
									</div>
								</div>
								<div id="mode">
								<div id="label2">Mode --></div>
									<div id="element2">
											<input type="submit" 
											id="<?php if($mode=="Automatique")echo "enmarche";?>"
											name="mode" value="<?php echo $mode;?>" /> 
									</div>
								</div-->
								
									
								</div>
								<div id="moment">
									<div id="label2">Moment du jour --></div>
									<div id="element2" class="nuit">
										<p>NUIT</p> 
									</div>
								</div>
						</fieldset>

					</form>
					<br/>
					
						<!-- Ce formulaire concerne la gestion de l'éclairage pour la chambre-->
					<form method="post" action="eclairage.php?id=chambre" 
					name="formulaire_chambre" 	 
					class="chambre">
					
						<fieldset>
							<legend>Chambre</legend>
<?php foreach($tab_fichier as $lignee){ if($lignee[0]=='chambre'){$etatt=$lignee[1];$luminosite=$lignee[2];$type=$lignee[0];break;} } ?>
								<div id="etat">
										<div id="label3">Etat --></div>
										<div id="element3" >
											<input type="submit" id=<?php if($etatt=="Allumee") echo"enmarche"; else echo"stop";?>
 name="etat" value="<?php foreach($tab_fichier as $lignee){ if($lignee[0]=='chambre'){$etatt=$lignee[1];echo $etatt;}}?>"/> 
										</div>
								</div>
								
								<div id="titre">
									<p>Ajuster le luminosité</p>
								</div>
								
								<div id="luminosite">
									<input type="submit" class="luminosite" 
									id="<?php if($luminosite=='25') echo 'luminosite_selectionne'; ?>" name="luminosite" value="25%"/> 
									
									<input type="submit" class="luminosite"
									id="<?php if($luminosite=='50') echo 'luminosite_selectionne'; ?>"name="luminosite" value="50%"/> 

									<input type="submit" class="luminosite" 
									id="<?php if($luminosite=='75') echo 'luminosite_selectionne'; ?>" name="luminosite" value="75%"/> 

									<input type="submit" class="luminosite" 
									id="<?php if($luminosite=="100") echo "luminosite_selectionne"; ?>" name="luminosite" value="100%"/> 
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
		
	// Declaration de méthodes
		
		// Cette methode permet d'inversion en auto vers manuel ou vice versa
		
		function Inver_mode($mode)
		{
			if($mode=="Automatique") return "Manuel";
			else if($mode=="Manuel") return "Automatique";
			else if($mode=="Allumee") return "Eteinte";
			else if($mode=="Eteinte") return "Allumee";
		}
		function Enlever_pourcentage($pourcentage)
		{
			if($pourcentage=="25%") return 25;
			else if($pourcentage=="50%") return 50;
			else if($pourcentage=="75%")return 75;
			else if($pourcentage =="100%")return 100;
		}

		/*function Dest_Var()
		{
			unset($type);
			unset(mode);
			unset($luminosite);
			unset($etat);
		}*/
		
	?>
