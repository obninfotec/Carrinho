<?php

/**
 * Description of Query
 * @author Osvaldo
 */

namespace App\Lucas\Inc;

class Query extends ConectaBD {

    private $Row = NULL;
    
    public function __construct() {
	parent::__construct();
	$this->Row = NULL;
    }

    private function Criptografar($Senha) {
	return md5($Senha);
    }

// Criptografar

    private function ExisteUsuario($Email) {
	$Selecionar = self::Conn()->prepare("SELECT * FROM `usuarios` WHERE email = '$Email'");
	$Selecionar->execute();

	if ($selecionar->rowCount() >= 1) {
	    return true;
	} else {
	    return false;
	}
    }

// function ExisteUsuario($Email)

    public function CadastraUser($Dados = array()) {
	if ($this->ExisteUsuario($Dados[2])) {
	    return false;
	} else {
	    $Dados[4] = $this->Criptografar($Dados[4]);
	    $SqlInserir = "INSERT INTO `usuarios` (id,nome,email,site,senha,descricao,status) VALUES (?,?,?,?,?,?,?)";
	    $Stmt = self::Conn()->prepare($SqlInserir);
	    if ($Stmt->execute($Dados)) {
		return true;
	    } else {
		return false;
	    }
	}
    }

// CadastrarUser

    public function RegistraVisitas($Dadovisita = array()) {
	$SqlInserirVis = "INSERT INTO `visitas` SET datahora = NOW(),usuario = ?,sessao = ?,val_ip = ?,val_host = ?,status = ?";
	$Cadastrar_vis = self::Conn()->prepare($SqlInserirVis);
	if ($Cadastrar_vis->execute($Dadovisita)) {
	    return true;
	} else {
	    return false;
	}
    }

// fim do cadastro de visitas

    public function NumOrdServ($Token, $Numeros = array()) {
	if ($Token == "ler") {
	    $Pega_osatual = self::Conn()->prepare("SELECT osatual, ordem FROM cfgfcb WHERE id='1'");
	    $Pega_osatual->execute();
	    $this->Row = $Pega_osatual->fetch(); // PDO::FETCH_ASSOC
	    $NumOsAtual = $Row['osatual'];
	    $Ordem = $Row['ordem'];

	    if ($NumOsAtual != "") {
		$_SESSION['NumOsAtual'] = $NumOsAtual;
		return true;
	    } else {
		$_SESSION['NumOsAtual'] = "NEGATIVO";
		return false;  // false;
	    }
	} elseif ($Token == "gravar") {
	    $Pega_osatual = self::Conn()->prepare("UPDATE `cfgfcb` SET datahora = NOW(),oslast = ?,osatual = ? WHERE id='1'");
	    $Pega_osatual->execute($Numeros);
	    return true;
	} else {
	    return false;
	}// return true;
    }

// function NumOrdServ($Token,$Numeros = array())

    public function PegaMenu($Menu) {
	$Pega_menu = self::Conn()->prepare("SELECT * FROM menuprin ORDER BY id ASC");
	$Pega_menu->execute();
	$Menu_dt = $Pega_menu->fetchAll(PDO::FETCH_ASSOC); // PDO::FETCH_ASSOC

	if ($Menu_dt != "") {
	    $_SESSION['menu'] = $Menu_dt;
	    //$enviaOs = "9001"; //$NumOsAtual;
	    return true;
	} else {
	    $_SESSION['menu'] = "NEGATIVO";
	    return false;  // false;
	}
	// return true; 
    }

// Fim da function PegaMenu($Menu)

    public function CadastrarOs($Dados = array()) {
	$SqlInserir = "INSERT INTO `entradaos` SET datacad = NOW(),orserv = ?,especie = ?,nome = ?,endereco = ?,cep = ? ,telefone = ?,aparelho = ?,marca = ?,modelo = ?,serie = ?,condaparelho = ?,defeitorec = ?,acessorios =  ?, dataorcamento = ?,status = ?,codautentico = ?,observacao = ?";
	$Cadastrar_new = self::Conn()->prepare($SqlInserir);
	if ($Cadastrar_new->execute($Dados)) {
	    return true;
	} else {
	    return false;
	}
    }

// cadastrarFicha
}
