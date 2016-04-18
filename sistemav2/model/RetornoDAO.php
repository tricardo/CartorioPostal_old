<?php
class RetornoDAO extends Database{
	
	
	public function selectPorId($id_retorno,$id_empresa){
		$this->sql = "SELECT r.* from vsites_retorno as r, vsites_user_usuario as uu 
				where r.id_retorno=? and r.id_usuario=uu.id_usuario and uu.id_empresa=? order by r.data desc";
		$this->values = array($id_retorno,$id_empresa);
		$ret = $this->fetch();
		return $ret[0];
	}
        
        public function inserir($id_cliente, $controle_id_usuario, $nomeArquivo){
            $this->sql = "insert into vsites_retorno (id_cliente,id_usuario,arquivo,data)
			values('".$id_cliente."','".$controle_id_usuario."','".$nomeArquivo."',NOW())";
            $this->exec();
        }
}