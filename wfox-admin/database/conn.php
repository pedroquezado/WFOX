<?php
include ( WFOX_ADMIN_DIR . '/database/config.php');

function conectar() {
	try {
		$pdo = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER , DBPASS );
	} catch(PDOException $e) {
		echo $e->getMessage();
	}
	return $pdo;
}

$pdo = conectar();

function getConnection() {
	global $pdo;

	return $pdo;
}
if(!$pdo){
	// ALTERAÇÃO INSTALL
	$postInstall['WFOX_INSTALL_STATUS']  = 'FALSE';
	$fileInstall = './install.php';
	$dataInstall = file($fileInstall);
	$lineInstall = 0;
	$sizeInstall = count($dataInstall);

	foreach ($postInstall as $k => $v) {
	    while ($lineInstall < $sizeInstall) {
	        if (strstr($dataInstall[$lineInstall], '\''.$k.'\'') !== false) {
	            $arr = explode('\'', $dataInstall[$lineInstall]);
	            $arr[3] = $v;

	            $dataInstall[$lineInstall] = implode('\'', $arr);
	            break;
	        }
	        $lineInstall++;
	    }
	}

	file_put_contents($fileInstall, implode('', $dataInstall));


	// ALTERAÇÃO DEFINE
	$postDefine['WFOX_SITE_URL']  = '';
	$postDefine['WFOX_SITE_NAME']  = '';
	$postDefine['WFOX_SITE_RESUMO']  = '';
	$postDefine['WFOX_SITE_IDIOMA']  = 'pt-br';
	$fileDefine = './define_log.php';
	$dataDefine = file($fileDefine);
	$lineDefine = 0;
	$sizeDefine = count($dataDefine);

	foreach ($postDefine as $k => $v) {
	    while ($lineDefine < $sizeDefine) {
	        if (strstr($dataDefine[$lineDefine], '\''.$k.'\'') !== false) {
	            $arr = explode('\'', $dataDefine[$lineDefine]);
	            $arr[3] = $v;

	            $dataDefine[$lineDefine] = implode('\'', $arr);
	            break;
	        }
	        $lineDefine++;
	    }
	}

	file_put_contents($fileDefine, implode('', $dataDefine));

	header("Location: ./install.php");
}