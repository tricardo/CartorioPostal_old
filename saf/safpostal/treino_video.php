<?
require "../includes/topo.php";
pt_register("GET","busca");
?>
<table width="920" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td colspan="3" height="2"></td>
  </tr>
  <tr>
    <td width="150" align="left" valign="top">
    <table width="150" border="0" cellspacing="0" cellpadding="0" align="left">
      <tr>
        <td><? require "menu_lateral.php"; ?></td>
      </tr>
    </table>
    </td>
    <td width="2"></td>
    <td align="left" valign="top"><table width="768" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="764" align="center" valign="top" background="../images/paginas/index/barra_de_titulo1.png"><table width="768" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="345" height="20" align="left" valign="middle"><strong>V�deos de Treinamento</strong></td>
            <td width="415" align="left" valign="middle"><span style="font-weight: bold">Franquia: <? echo $safpostal_fantasia ?></span></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>
        <div id="conteudo_forum_list">
		
        <div id="titulo_forum_list"><strong>
        <table border="0" width="100%" cellpadding="0" cellspacing="0">
        <tr>
        <td width="60%" align="left" valign="middle">V�deo de Treinamento</td>
        </tr>
        </table>
         </strong></div>
<table border="0" width="100%" cellpadding="0" cellspacing="0" id="alter">		 
<?
$onde ="";

if($safpostal_id_empresa!='1') $onde .= " n.status='1' ";
else $onde .= " n.status!='2' ";
if($busca<>''){$onde .= " and (f.titulo like '%$busca%'";}

$condicao = "FROM saf_treinamento as n WHERE " . $onde . " ORDER BY titulo DESC ";

$campo = " n.*, date_format(n.data, '%d/%m/%y') as data_c ";

pt_register('GET','pagina');
$url_busca = $_SERVER['REQUEST_URI'];
$url_busca_pos = strpos($_SERVER['REQUEST_URI'],'.php');
$url_busca = substr(str_replace('pagina='.$pagina.'&','',$url_busca),$url_busca_pos+5);
$query = $objQuery->paginacao( $campo , $condicao, $pagina , $url_busca);
$p_valor = "";

while($res = mysql_fetch_array($query)){ 
		$p_valor .= '
		<tr>
		<td align="left" valign="middle" height="25"><a href="treino_video_edit.php?id=' . $res['id_treinamento'] . '" style="display:block" title="Clique aqui"><b>' . invert($res['data'],'/','PHP') . '</b> - ' . $res['titulo'] . '</a></td>
		<tr>';
}
echo $p_valor;
?>
</table>
</table>
    </td>
  </tr>
</table>
</td>
      </tr>
    </table>
   </td>
  </tr>
</table>

<?
require "../includes/rodape.php";
?>