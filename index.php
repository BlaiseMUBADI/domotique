	
	
	<?xml version="1.0" encoding="iso-8859-1"?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-
	strict.dtd">
	
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr-FR" lang="fr-FR">
		<head>
		
		 <title>Authentification</title>
		 <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
		 <meta name="viewport" content="width=device-width, initial-scale=1.0">
		 
		 <link rel="stylesheet" href="css/index.css"  />
		
		
		</head>
		
		<body>
		<div id="body">
			<div class="tab"> 
				<h1> Authentification ! </h1>
				<h2> Ouvrez une session avec votre login et pass word </h2> <br/>
				
					
					<form method="post" action="authentification_tes.php" name="login_form" 	 
					class="formulaire">
						<fieldset>
							<legend>Informations obligatoire</legend>
								<div id="etiquettes">
									<p>Login</p><br/>
									<p>Mot de passe</p>
								</div>
								<div id="elements">
									<input type="text" id="login" name="login"
									value="login" required="required"/>  <br/><br/>
									<input type="password" id="pass" name="passe" 
									required="required" />
								</div>
								<div id="commande">
									<input type="submit"value="Connection"/>
								</div>
						</fieldset>
						</form>
			</div>
		</div>
		
			
		</body>
	</html>
