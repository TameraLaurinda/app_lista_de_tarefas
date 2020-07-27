<?php
    session_start();

    class Usuario{

        private $email;
        private $senha;
        private $nome;
        private $id;

        /*public function __construct($user, $pass){
            $this->email = $user;
            $this->senha = $pass;
        }*/
   

        public function __set($atributo, $valor){

            $this->$atributo = $valor;
        }

        public function __get($atributo){

            return $this->$atributo; 
        }

       /* public function validarUser(Conexao $conexao){

            $query="
            SELECT * as usuario_bd
            FROM 
                `tb_usuarios` 
            WHERE
                email = :email";

            $stmt = $conexao->prepare($query);
            $stmt->bindValue(':email', $this->email);
            $stmt->execute();

            return $stmt->fetch(PDO::FECHT_OBJ)->usuario_bd;
        }*/

    }

    class Tarefa{

        public $id;
        public $id_status;
        public $tarefa;
        public $data_cadastro;

        public function __get($atributo){

            return $this->$atributo;
        }

        public function __set($atributo, $valor){
            
            $this->$atributo = $valor;
        }
    }

   class Conexao{

        private $dbname = 'db_tarefas';
        private $pass = 'root';
        private $user = 'root';
        private $host = 'localhost';

        public function conectar(){

            try{

                    $conexao = new PDO("mysql:host=$this->host; dbname=$this->dbname",
                    "$this->user",
                    "$this->pass");
                    $conexao->exec('set charset set utf8');

                    return $conexao;

            }catch(PDOExceotion $erro){

                echo '<p>' .$erro->getMessage(). '</p>';
            }
        }
    }

    class DBServise {

        public $conexao;
        public $usuario;
        public $tarefa;

        public function __set($atributo, $valor){

            $this->$atributo = $valor;
        }

        public function __get($atributo){

            return $this->$atributo; 
        }

        public function validarAcesso(){
            
            $query = "SELECT *
                FROM
                    tb_usuarios 
                WHERE 
                    email = :email";

           $stmt = $this->conexao->prepare($query);
           $stmt->bindValue(':email', $this->usuario->__get('email'));   
           $stmt->execute();

            return $stmt->fetch(PDO::FETCH_OBJ);

        }

        public function cadastrarTarefa(){

            $query = " insert into tb_tarefas (tarefa, id_usuario) values (:tarefa, :id)";

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
            $stmt->bindValue(':id', $this->usuario->__get('id'));
            return $stmt->execute();

        } 

          public function deletarTarefa($id){

            $query ='delete
            from 
                tb_tarefas
            where
                id = :id';
            
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id', $id);
            return $stmt->execute();
        } 
        
         public function editarTarefa(){

           $query = "update
            tb_tarefas
            set
            tarefa = :tarefa_atualizada
            where
            id = :id";

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id', $this->tarefa->__get('id'));
            $stmt->bindValue(':tarefa_atualizada', $this->tarefa->__get('tarefa'));
            return $stmt->execute();

        } 

        public function concluirTarefa(){

            $query = "update
            tb_tarefas
            set
            id_status = 2
            where
            id = :id";

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id', $this->tarefa->__get('id'));
            return $stmt->execute();
        }

          public function listarTarefasP(){

            $query = " select * 
            from 
                 tb_tarefas 
            where 
                 id_usuario = :id and id_status = 1";
     
             $stmt = $this->conexao->prepare($query);
             $stmt->bindValue(':id', $this->usuario->__get('id'));

             $stmt->execute();


             return $stmt->fetchAll(PDO::FETCH_OBJ);  
        } 

         public function listarTarefas(){
            $query = " select * 
            from 
                 tb_tarefas 
            where 
                 id_usuario = :id";
     
             $stmt = $this->conexao->prepare($query);
             $stmt->bindValue(':id', $this->usuario->__get('id'));
             $stmt->execute();

             return $stmt->fetchAll(PDO::FETCH_OBJ);
            
        } 

        public function verificarEmail($email){

            $query = " select * from tb_usuarios where email = :email";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':email', $email);
            $stmt->execute();

            return $stmt->fetch();

        }

        public function criarConta(){
            
            $query = "insert into tb_usuarios ('nome', 'email', 'senha') values (:nome, :email, :senha)";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':email', $this->usuario->__get('email'));
            $stmt->bindValue(':senha', $this->usuario->__get('senha'));
            $stmt->bindValue(':nome', $this->usuario->__get('nome'));
            $stmt->execute();

            return $stmt->fetch();
        }
    }
    

?>