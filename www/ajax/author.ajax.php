<?php
session_start();

$ajax=true;
require_once '../../config/init.php';

require_once LIBRARIES.'author.class.php';
$A = new Author();

// If SQL is needed
if($_POST['sql']=='true'){
	require_once LIBRARIES.'SQL.class.php';
	$SQL = new SQLManager();
}

// Default JSON output
$ouput=['success'=>false];

// Reaction depending on action
switch($_POST['action']){

	case'suscribe':

		// more easy
		$P = $_POST;
		$D = $P['data'];
		/*
	  	["data"]=>
	  	{
		    ["TB_ticket_A"]=>"KJ5E"
		    ["TB_ticket_B"]=>"N76W"
		    ["TB_ticket_C"]=>"3AS6"
		    ["TB_ticket_D"]=>"XX"
		    ["TB_mail"]=>"nicolas.lolmede@gmail.com"
		    ["TB_pass"]=>"Polopopo42!"
		}
		*/

		// CHECK
		$errors = array();
		
		if( strlen($D['TB_ticket_A']) == 0)	{$errors['TB_ticket_A']=0;}
		if( strlen($D['TB_ticket_B']) == 0)	{$errors['TB_ticket_B']=0;}
		if( strlen($D['TB_ticket_C']) == 0)	{$errors['TB_ticket_C']=0;}
		if( strlen($D['TB_ticket_D']) == 0)	{$errors['TB_ticket_D']=0;}

		if( strlen($D['TB_ticket_A']) != 4)	{$errors['TB_ticket_A']=1;}
		if( strlen($D['TB_ticket_B']) != 4)	{$errors['TB_ticket_B']=1;}
		if( strlen($D['TB_ticket_C']) != 4)	{$errors['TB_ticket_C']=1;}
		if( strlen($D['TB_ticket_D']) != 2)	{$errors['TB_ticket_D']=1;}

		if(!$A->CheckInput('T4',$D['TB_ticket_A']))	{$errors['TB_ticket_A']=4;}
		if(!$A->CheckInput('T4',$D['TB_ticket_B']))	{$errors['TB_ticket_B']=4;}
		if(!$A->CheckInput('T4',$D['TB_ticket_C']))	{$errors['TB_ticket_C']=4;}
		if(!$A->CheckInput('T2',$D['TB_ticket_D']))	{$errors['TB_ticket_D']=4;}

		$mail = $D['TB_mail'];
		if(strlen($mail) == 0)				{$errors['TB_mail']=0;}
		if(!$A->CheckInput('M',$mail))		{$errors['TB_mail']=2;}

		$pass = $D['TB_pass'];
		if(strlen($pass) == 0)				{$errors['TB_pass']=0;}
		if(!$A->CheckInput('P',$pass))		{$errors['TB_pass']=3;}

		if(sizeof($errors)>0){
			$ouput['success']=false;
        	$ouput['message']='Certains champs sont erronés';
        	$ouput['errors']=$errors;
        	break;
		}

		$result = $A->Suscribe($D);
		switch($result){
			case'ok':
				$ouput['success']=true;
				break;
			case'unavailable':
				$ouput['success']=false;
				$ouput['message']='Ce ticket n\'est pas/plus valide';
				break;
			case'mailExists':
				$ouput['success']=false;
				$ouput['message']='Ce mail est déjà utilisé';
				break;
			case'unknowError':
				$ouput['success']=false;
				$ouput['message']='Erreur inconnue';
				break;
		}
		
        /*if($collection!=null){
        	foreach($collection as &$mesure){
        		$validated=false;
        		$badges = $C->GetBadgesOfMesure($mesure['MES_ID']);
        		if($badges!=null){
        			$mesure['BADGES']=$badges;
        			foreach($badges as $badge){
	        			if($badge['B_STATUS']==1){
	        				$validated=true;
	        				break;
	        			}
	        		}
        		} else {
        			$mesure['BADGES']=null;
        		}
        		$mesure['VALIDATED']=$validated;
        	}
        	$ouput['success']=true;
        	$ouput['mesures']=$collection;
        }else{
        	$ouput['success']=false;
        	$ouput['message']='SQL error';
        }*/
	break;

	case'login':
		$collection = $C->GetCollection($_POST['scheme'],$_POST['page']);
        if($collection!=null){
        	foreach($collection as &$mesure){
        		$validated=false;
        		$badges = $C->GetBadgesOfMesure($mesure['MES_ID']);
        		if($badges!=null){
        			$mesure['BADGES']=$badges;
        			foreach($badges as $badge){
	        			if($badge['B_STATUS']==1){
	        				$validated=true;
	        				break;
	        			}
	        		}
        		} else {
        			$mesure['BADGES']=null;
        		}
        		$mesure['VALIDATED']=$validated;
        	}
        	$ouput['success']=true;
        	$ouput['mesures']=$collection;
        }else{
        	$ouput['success']=false;
        	$ouput['message']='SQL error';
        }
	break;

	case'resetSession':
		$C->ResetSession();
		$ouput['success']=true;
	break;

	default:
		$output['success']=false;
		$output['message']='Opération inconnue';
	break;
}

// Ouputs the ouput
header("Content-type: text/json; Charset: UTF-8");
echo json_encode($ouput);
?>