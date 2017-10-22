<?php
session_start();
$ajax=0;
require_once '../config/init.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="fr-FR">
	<head>
		<title>Macron-o-mètre - Rédaction</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<meta name="description" content="private area for writers" />
		<meta name="author" content="Un Insoumis" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="shortcut icon" href="./design/macronometre.ico" />
		<!-- CSS -->
		<link rel="stylesheet" href="./css/login.css?r=<?=rand(0,9999)?>" />
		<link rel="stylesheet" href="./css/redaction.css?r=<?=rand(0,9999)?>" />
		<!-- JS -->
		<script src="./js/jquery-3.2.0.min.js"></script>
		<script src="./js/form.class.js"></script>
		<?php if(!isset($_SESSION['author'])){ ?>
		<script src="./js/loading.js"></script>
		<script src="./js/form.login.js"></script>
		<?php } ?>
		<?php if(isset($_SESSION['author'])){ ?>
		<script src="./js/redaction.class.js?r=<?=rand(0,9999)?>"></script>
		<script src="./js/redaction.main.js?r=<?=rand(0,9999)?>"></script>
		<?php } ?>
	</head>
	<body>

		<!-- TOP -->
		<div id="top">
		</div>

		<!-- MAIN AREA -->
		<div id="center">
		
			<!-- The Ground -->
			<div id="RealGround"></div>
			
			<!-- CONTENT -->
			<div id="content">
				
				<!-- -->
				
			</div>
		</div>
		
		<!--<div id="modal_screen" class="">
			<div class="modal_window">
				<div class="laec_title"></div>
				<div class="laec_text_label">Que nous propose l'avenir en commun ?</div>
				<div class="laec_text"></div>
				<div class="laec_link ico_laec">Voir les détails</div>
				<div class="modal_close">X</div>
			</div>
		</div>-->

		<!-- HEADER (FI) -->
		<div id="header">

			<!-- MENU CENTERED AREA -->
			<div class="center_menu">
				<!-- MENU -->
				<div id="userMenu">
					<div id="Schemes">
						<?php
							require_once LIBRARIES.'content.class.php';
							$C = new Content();
							$usedSchemes = $C->Get_UsedSchemes();
							foreach($usedSchemes as $scheme){
								echo '<div class="scheme ico_'.$scheme['T_TYPE_CODE'].'" rel="'.$scheme['T_ID'].'" title="'.$scheme['T_TYPE_CODE'].'">'.
										ucfirst(preg_replace('/(?!^)([[:upper:]][[:lower:]]+)/',' $0',$scheme['T_TYPE_NAME'])).' ('.$scheme['MCOUNT'].')'.
									 '</div>';
							}
						?>
						<div class="scheme allSchemes" rel="*">Tous</div>
					</div>
				</div>
				<!-- MENU BUTTON -->
				<div id="userMenuButton" class="ico_menuA">Choix du thème</div>
			</div>

			<!-- MAIN CENTERED AREA -->
			<div class="center">
				<!-- LOGO -->
				<div class="logo"></div>
				<!-- DISCORD -->
				<div class="discord">
					<div class="discord_line1">supporté par</div>
					<div class="discord_line2">Discord Insoumis</div>
				</div>
			</div>
		</div>

		<!-- LOADING SCENE -->
		<?php if(!isset($_SESSION['author'])){ ?>
		<div id="loadingPanel">

			<!-- MAIN BOXES -->
			<div id="mainBoxes">

				<!-- ALIGN BOXES CENTERED -->
				<div id="mainBoxesAlign">

					<!-- TICKET BOX -->
					<div id="ticketBox" class="mainBox">
						<div class="title">Je n'ai pas encore de compte...</div>
						<form name="ticketForm" action="#" method="POST">
							<p>
								<ins>Mon n° de ticket :
									<span>reçu par mail ou donné par un insoumis</span>
								</ins>
								<del>
									<input type="text" name="TB_ticket_A" value="" size="4" maxlength="4" placeholder="X1X2"/> - 
									<input type="text" name="TB_ticket_B" value="" size="4" maxlength="4" placeholder="Y3Y4"/> - 
									<input type="text" name="TB_ticket_C" value="" size="4" maxlength="4" placeholder="Z5Z6"/> - 
									<input type="text" name="TB_ticket_D" value="" size="2" maxlength="2" placeholder="AB"/>
								</del>
							</p>
							<p>
								<ins>Mon mail :
									<span>sera utilisé comme identifiant</span>
								</ins>
								<del><input type="text" name="TB_mail" value="" maxlength="50"  placeholder="xxx@yyy.zz"/></del>
							</p>
							<p>
								<ins>Mot de passe :
									<span>sera utilisé pour sécuriser mon compte</span>
								</ins>
								<del><input type="password" name="TB_pass" value="" /></del>
							</p>
							<p>
								<del><input type="button" name="TB_submit" value="Créer mon compte" /></del>
							</p>
						</form>
					</div>

					<!-- LOGIN BOX -->
					<div id="loginBox" class="mainBox">
						<div class="title">J'ai un compte !</div>
						<form name="loginForm" action="#" method="POST">
							<p>
								<ins>Mail :</ins>
								<del><input type="text" name="LB_mail" value="" maxlength="50" placeholder="xxx@yyy.zz"/></del>
							</p>
							<p>
								<ins>Mot de passe :</ins>
								<del><input type="password" name="LB_pass" value=""/></del>
							</p>
							<p>&nbsp;<del>&nbsp;</del></p>
							<p>
								<del><input type="button" name="LB_submit" value="Connexion" /></del>
							</p>
						</form>
					</div>

				</div>

			</div>

			<!-- LOADING ANIM -->
			<div id="loadingAnim">
				<div class="loadingAnimDot lad1"></div>
				<div class="loadingAnimDot lad2"></div>
				<div class="loadingAnimDot lad3"></div>
				<div class="loadingAnimDot lad4"></div>
				<div class="loadingAnimDot lad5"></div>
				<div class="loadingAnimDot lad6"></div>
				<div class="loadingAnimDot lad7"></div>
				<div class="loadingAnimDot lad8"></div>
			</div>

		</div>
		<?php } ?>

	</body>
</html>
<?php

function getUserIP() {
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];
    if(filter_var($client, FILTER_VALIDATE_IP)){
        $ip = $client;
    }elseif(filter_var($forward, FILTER_VALIDATE_IP)){
        $ip = $forward;
    }else{
        $ip = $remote;
    }
    return $ip;
}

$ip = getUserIP();
if($ip!='109.190.220.12') {
	$file = 'log.txt';
	// Open the file to get existing content
	$current = file_get_contents($file);
	// Append a new person to the file
	$current .= date('Y-m-d H:i:s')." New visit (".$ip.")\n";
	// Write the contents back to the file
	file_put_contents($file, $current);
}
?>