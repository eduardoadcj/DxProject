<?php

include_once 'Conexao.php';

class PublicoDao {
    
    public function salvar(Publico $p){
        
        try{
            
            $con = Conexao::get();
            $stmt = $con->prepare('INSERT INTO publico(nome,descricao) VALUES(?,?)');
            $stmt->bind_param('ss',$nome,$descricao);
            $nome = $p->getNome();
            $descricao = $p->getDescricao();
            $stmt->execute();
            $p->setId($con->insert_id);
        } catch (Exception $ex) {
            print($ex);
        }
        
        return $p;
        
    }
    
    public function listar(){
        
        $list = array();
        
        try{
            
            $con = Conexao::get();
            $result = $con->query('SELECT * FROM publico');
            while($row = $result->fetch_assoc()){
                $p = new Publico();
                $p->setId($row['id']);
                $p->setNome($row['nome']);
                $p->setDescricao($row['descricao']);
                array_push($list, $p);
            }
            
        } catch (Exception $ex) {
            print($ex);
        }
        
        return $list;
        
    }
    
}
