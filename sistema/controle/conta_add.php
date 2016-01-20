<?
require('header.php');

$permissao = verifica_permissao('Conta',$controle_id_departamento_p,$controle_id_departamento_s);
if($permissao == 'FALSE'){
	echo '<br><br><strong>Voc� n�o tem permiss�o para acessar essa p�gina</strong>';
	exit;
}
?>

<div id="topo">
<h1 class="tit"><img src="../images/tit/tit_conta.png" alt="T�tulo" />Conta</h1>
<hr class="tit" />
</div>
<div id="meio"><?
$bancoDAO = new BancoDAO();
$bancos = $bancoDAO->listar();
pt_register('POST','submit');
if ($submit) {//check for errors
	$errors=array();
	$done=false;
	$error="<b>Ocorreram os seguintes erros:</b><ul>";
	pt_register('POST','id_banco');
	pt_register('POST','conta');
	pt_register('POST','agencia');
	pt_register('POST','status');
	pt_register('POST','sigla');

	$con = new stdClass();
	$con->id_empresa=trim($controle_id_empresa);
	$con->id_banco = trim($id_banco);
	$con->agencia = trim($agencia);
	$con->conta = trim($conta);
	$con->sigla = trim($sigla);
	$con->status = trim($status);

	if($con->id_banco=='' || $con->conta=='' || $con->agencia=='' || $con->status=='' || $con->sigla==''){
		$error.="<li><b>Os campos com * s�o obrigat�rios.</b></li>";
		if($con->id_banco=='') $errors['id_banco']=1;
		if($con->conta=='') $errors['conta']=1;
		if($con->agencia=='') $errors['agencia']=1;
		if($con->status=='') $errors['status']=1;
		if($con->sigla=='') $errors['sigla']=1;
	}

	if(count($errors)==0) {
		$contaDAO = new ContaDAO();
		$id=$contaDAO->inserir($con);
		$done=1;
	}else{?>
<div class="erro"><?=$error; ?></div>
	<? }
	if ($done) { 
		 //alterado 01/04/2011
		$titulo = 'Adicionar Conta';
		$perg   = 'Novo registro adicionado com sucesso!\nAdicionar outro?';
		$resp1  = 'conta_add.php';
		$resp2  = 'conta.php';
		$funcJs = "openConfirmBox('".$titulo."','".$perg."','".$resp1."','".$resp2."');";
		echo '<img src="../images/null.gif" class="nulo" onload="'.$funcJs.'" />';
	}
}
?> <?	if (!$done) { ?>

<table width="100%" border="0" cellpadding="10" cellspacing="0">
	<tr>
		<td valign="top" align="center">

		<blockquote>
		<form enctype="multipart/form-data" action="" method="post"
			name="conta_add">
		<table width="650" class="tabela">
			<tr>
				<td colspan="4" class="tabela_tit">Dados da Conta</td>
			</tr>
			<tr>
				<td width="100">
				<div align="right"><strong>Status:</strong></div>
				</td>
				<td width="243"><select name="status" class="form_estilo"
					style="width: 150px">
					<option value="Ativo"
					<? if($status=='Ativo') echo 'selected="selected"'; ?>>Ativo</option>
					<option value="Inativo"
					<? if($status=='Inativo') echo 'selected="selected"'; ?>>Inativo</option>
					<option value="Cancelado"
					<? if($status=='Cancelado') echo 'selected="selected"'; ?>>Cancelado</option>
				</select></td>

			</tr>
			<tr>
				<td>
				<div align="right"><strong>Banco:</strong></div>
				</td>
				<td colspan="3"><select name="id_banco"
					class="form_estilo <?=(isset($errors['id_banco']))?'form_estilo_erro':''; ?>">
					<option></option>
					<?php foreach($bancos as $banco){ ?>
					<option value="<?=$banco->id_banco;?>"
					<?=($con->id_banco==$banco->id_banco)?'selected="selected"':''?>>
						<?=$banco->banco; ?></option>
						<?php }?>
				</select> <font color="#FF0000">*</font></td>
			</tr>
			<tr>
				<td>
				<div align="right"><strong>Sigla:</strong></div>
				</td>
				<td colspan="3"><input type="text" name="sigla" value="<?=$sigla?>"
					style="width: 150px"
					class="form_estilo <?=(isset($errors['sigla']))?'form_estilo_erro':''; ?>" /><font
					color="#FF0000">*</font></td>
			</tr>
			<tr>
				<td>
				<div align="right"><strong>Ag&ecirc;ncia: </strong></div>
				</td>
				<td><input type="text" name="agencia" value="<?=$agencia ?>"
					style="width: 150px"
					class="form_estilo <?=(isset($errors['agencia']))?'form_estilo_erro':''; ?>">
				<font color="#FF0000">*</font></td>
				<td>
				<div align="right"><strong>Conta: </strong></div>
				</td>
				<td width="219"><input type="text" name="conta"
					value="<?= $conta ?>" style="width: 150px"
					class="form_estilo <?=(isset($errors['conta']))?'form_estilo_erro':''; ?>" />
				<font color="#FF0000">*</font></td>
			</tr>

			<tr>
				<td colspan="4">
				<div align="center"><input type="submit" name="submit"
					value="Adicionar" class="button_busca" />&nbsp; <input
					type="submit" name="cancelar" value="Cancelar"
					onclick="document.conta_add.action='conta.php'"
					class="button_busca" /></div>
				</td>
			</tr>
		</table>
		<div id="resgata_endereco"></div>
		</form>
		</blockquote>
		</td>
	</tr>
</table>
</div>
						<?php
}
require('footer.php');
?>