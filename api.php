<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<link rel="stylesheet" type="text/css" media="all" href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.2/cosmo/bootstrap.min.css">
<?php

// ==============================
$_VO['registraAuto'] = true;       // Registra os visitantes automaticamente?
$_VO['conectaMySQL'] = true;       // Abre uma conexão com o servidor MySQL?
 
$_VO['cookieTempo'] = 20;          // Quantos minutos a visita dura
$_VO['cookieNome'] = 'VisOnline';  // Nome do cookie usado para identificar o visitante
 
$_VO['servidor'] = 'localhost';    // Servidor MySQL
$_VO['usuario'] = 'root';          // Usuário MySQL
$_VO['senha'] = '';                // Senha MySQL
$_VO['banco'] = 'contador_visita';            // Banco de dados MySQL 
$_VO['tabela_v'] = 'visitas_online'; // Tabela onde os visitantes online serão salvos

// ==============================
 
// ======================================
//   ~ Não edite a partir deste ponto ~
// ======================================
 
// Verifica se precisa fazer a conexão com o MySQL
if ($_VO['conectaMySQL'] == true) {
	$_VO['link'] = mysql_connect($_VO['servidor'], $_VO['usuario'], $_VO['senha']) or die("MySQL: Não foi possível conectar-se ao servidor [".$_VO['servidor']."].");
	mysql_select_db($_VO['banco'], $_VO['link']) or die("MySQL: Não foi possível conectar-se ao banco de dados [".$_VO['banco']."].");
}
 
/**
* Gera o identificador do visitante baseado no IP e na hora
*/
function geraIdentificador() {
	global $_VO;
 
	return sha1($_VO['cookieNome'].$_SERVER["REMOTE_ADDR"].microtime());

}
 
/**
* Registra uma visita e/ou pageview para o visitante
*  Esta funçaõ será chamada automaticamente dependendo de $_VO['registraAuto']
*/
function registraVisita() {

	$siteID  = $_GET['siteID'];

	global $_VO;
 
	// Verifica se os headers já foram enviados. Caso tenham, é gerada uma mensagem de erro
	if (headers_sent()) {
		trigger_error("[VisitantesOnline] Por favor, insira o arquivo antes de qualquer HTML", E_USER_ERROR);
		return false;
	}
 
	// Verifica se é um visitante que já está no site (se o Cookie existe)
	if (isset($_COOKIE[$_VO['cookieNome']])) {
		$novo = false;
		$identificador = $_COOKIE[$_VO['cookieNome']];
	} else {
		$novo = true;
		$identificador = geraIdentificador();
	}
 
	// Se o visitante não é novo, tenta atualizar o registro dele na tabela
	if (!$novo) {
		$query = "UPDATE `".$_VO['tabela_v']."` SET `hora` = NOW() WHERE `identificador` = '".$identificador."' LIMIT 1";
		$resultado = mysql_query($query);
		$atualizado = (bool)(@mysql_affected_rows($resultado) == 1);
	}
 
	// Se o visitante é novo OU se o registro dele ele não foi atualizado, insere um novo registro na tabela
	if ($novo OR !$atualizado) {
		$query = "INSERT INTO `".$_VO['tabela_v']."` VALUES (NULL,'".$siteID."', '".$_SERVER["REMOTE_ADDR"]."', '".$identificador."', NOW()) ";
		mysql_query($query);
	}
 
		
 
	// Atualiza o cookie com o identificador do visitante
	setcookie($_VO['cookieNome'], $identificador, time() + ($_VO['cookieTempo'] * 60), '');
	return true;
}
 
/**
* Função que retorna o total de visitantes online
*/
function visitantesOnline() {
	global $_VO;
 $siteID  = $_GET['siteID'];
	// Faz a consulta no MySQL em função dos argumentos
	$sql = "SELECT COUNT(*) FROM `".$_VO['tabela_v']."` WHERE siteID = '$siteID' ";
	$query = mysql_query($sql);
	$resultado = mysql_fetch_row($query);
 
	// Retorna o valor encontrado ou zero
	return (!empty($resultado)) ? (int)$resultado[0] : 0;
}

 
if ($_VO['registraAuto'] == true) { registraVisita(); }
echo "Total de visualizações: <b>".visitantesOnline(). "</b>";
?>


