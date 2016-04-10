<?php
include_once('../model/AppModel.php');

$appModel = new AppModel;

switch ($_POST['action']) {
    case "ajax_supr_Centre_equestre":
    	$_POST['id'] = explode(",", $_POST['id']);
    	$retour['erreur'] = true;
    	$retour['msg'] = "Erreur lors de la suppression.";
        if($appModel->SuprCentreEquestre($_POST['id'])){
        	$retour['erreur'] = false;
        	$retour['msg'] = "Centre(s) equestre(s) supprimé(s).";
        }
        break;
        
	case "ajax_supr_Cheval":
		$_POST['id'] = explode(",", $_POST['id']);
		$retour['erreur'] = true;
		$retour['msg'] = "Erreur lors de la suppression.";
		if($appModel->SuprCheval($_POST['id'])){
			$retour['erreur'] = false;
			$retour['msg'] = "Cheval/Chevaux supprimé(s).";
		}
		break;
		
	case "ajax_supr_Club_hippique":
		$_POST['id'] = explode(",", $_POST['id']);
		$retour['erreur'] = true;
		$retour['msg'] = "Erreur lors de la suppression.";
		if($appModel->SuprClubHippique($_POST['id'])){
			$retour['erreur'] = false;
			$retour['msg'] = "Club(s) supprimé(s).";
		}
		break;
		
	case "ajax_supr_Concours":
		$_POST['id'] = explode(",", $_POST['id']);
		$retour['erreur'] = true;
		$retour['msg'] = "Erreur lors de la suppression.";
		if($appModel->SuprConcours($_POST['id'])){
			$retour['erreur'] = false;
			$retour['msg'] = "Concours supprimé(s).";
		}
		break;
		
	case "ajax_supr_Infrastructure":
		$_POST['id'] = explode(",", $_POST['id']);
		$retour['erreur'] = true;
		$retour['msg'] = "Erreur lors de la suppression.";
		if($appModel->SuprInfrastructure($_POST['id'])){
			$retour['erreur'] = false;
			$retour['msg'] = "Infrastructure(s) supprimée(s).";
		}
		break;
		
	case "ajax_supr_Item":
		$_POST['id'] = explode(",", $_POST['id']);
		$retour['erreur'] = true;
		$retour['msg'] = "Erreur lors de la suppression.";
		if($appModel->SuprItem($_POST['id'])){
			$retour['erreur'] = false;
			$retour['msg'] = "Item(s) supprimé(s).";
		}
		break;
		
	case "ajax_supr_Item_concours":
		$_POST['id'] = explode(",", $_POST['id']);
		$retour['erreur'] = true;
		$retour['msg'] = "Erreur lors de la suppression.";
		if($appModel->SuprItemConcours($_POST['id'])){
			$retour['erreur'] = false;
			$retour['msg'] = "Item_concours supprimé(s).";
		}
		break;
			
	case "ajax_supr_Journal":
		$_POST['id'] = explode(",", $_POST['id']);
		$retour['erreur'] = true;
		$retour['msg'] = "Erreur lors de la suppression.";
		if($appModel->SuprJournal($_POST['id'])){
			$retour['erreur'] = false;
			$retour['msg'] = "Journal/Journaux supprimé(s).";
		}
		break;
				
	case "ajax_supr_Tache":
		$_POST['id'] = explode(",", $_POST['id']);
		$retour['erreur'] = true;
		$retour['msg'] = "Erreur lors de la suppression.";
		if($appModel->SuprTache($_POST['id'])){
			$retour['erreur'] = false;
			$retour['msg'] = "Tache(s) supprimée(s).";
		}
		break;
		
	case "ajax_supr_Joueur":
		$_POST['id'] = explode(",", $_POST['id']);
		$retour['erreur'] = true;
		$retour['msg'] = "Erreur lors de la suppression.";
		if($appModel->SuprJoueur($_POST['id'])){
			$retour['erreur'] = false;
			$retour['msg'] = "Joueur(s) supprimé(s).";
		}
		break;
					
    default:
    	$retour['erreur'] = true;
    	$retour['msg'] = "action non reconnue";
    	break;   	
}

echo json_encode($retour);