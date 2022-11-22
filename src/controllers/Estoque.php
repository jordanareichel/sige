<?php

class Estoque extends Controller
{

  public function index()
  {

      $query = "";
      $search = null;

      if ($this->get('nome')) {
          $nome = $this->get("nome");
          $query .= " AND (codigo like '%$nome%')";
          $search = $nome;
      }
      

      $estoque = $this->mysql()->table("SELECT * FROM estoque WHERE id > 0 AND deletado is Null AND quantidade > 0 $query ORDER BY status ASC, produto ASC");

      $this->render('Estoque/index', [
          'estoque' => $estoque,
          'search' => $search
      ]);
  }

  public function cadastro()
  {

      if ($this->isPost()) {
          if (!$this->post('codigo')) {
              echo json_encode(['error' => true, 'msg' => 'Código é obrigatório!']);
              die();
          }

          $novoEstoque = [
              "produto" => $this->post("produto"),
              "quantidade" => $this->post("quantidade"),
              "localizacao"  => $this->post("localizacao"),
              "data_entrada" => date("Y-m-d H:i:s"),
              "codigo" => $this->post('codigo'),
              "status" => $this->post("status"),
          ];

          $codigo = $this->post('codigo');


          $validaEstoque = $this->mysql()->row("SELECT * FROM produtos WHERE codigo = '$codigo'");
          if ($validaEstoque) {
              echo json_encode(['error' => true, 'msg' => 'Produto já cadastrado no estoque!']);
              die();
          }

          $this->mysql()->insert("estoque", $novoEstoque);
          echo json_encode(['error' => false, 'msg' => 'Produto atualizado com sucesso no estoque']);
          die();
      }

      $this->render('Estoque/cadastro', []);
  }

  public function editar()
  {

      $this->requireLogin();

      $id = $this->get('id');

      $estoque = $this->mysql()->row("SELECT * FROM estoque WHERE id = $id");

 
      if ($this->isPost()) {
          $dadosEstoque = $this->copyFromPost();

          $this->mysql()->update("estoque", $dadosEstoque, ['id' => $id]);
          echo json_encode(['estoque' => $estoque]);
          die();
      }


      $this->render('Estoque/editar', [
          'estoque' => $estoque,
      ]);
  }

  public function status()  
  {
      $this->requireAdmin();

      $this->requireLogin();

      $id = $this->get('id');
      $status = $this->get('status');

      $estoque = $this->mysql()->row("SELECT * FROM estoque WHERE id = $id");


      if($estoque && $status == 1) {
        $this->mysql()->update("estoque",  ['status' => 2], ['id' => $id]);
      } else {
        $this->mysql()->update("estoque",  ['status' => 1], ['id' => $id]);
      }
   
    
    return $this->redirect('/estoque');
  }

  public function delete()
  {

      $this->requireLogin();

      $id = $this->get('id');

      $estoque = $this->mysql()->row("SELECT * FROM estoque WHERE id = $id");
      $usuarioLogado = $this->session('id');

      if($estoque) {
        $this->mysql()->update('estoque',[
            'deletado' => 1,
            'status' => 2,
            'data_exclusao' => date("Y-m-d H:i:s"),
            'data_atualizacao' => date("Y-m-d H:i:s"),
            'usuario_responsavel' => $usuarioLogado,
        ], ['id' => $id]);
      } 

    return $this->redirect('/estoque');
  }

  public function deletados() 
  {

    $estoque = $this->mysql()->table("SELECT * FROM estoque WHERE id > 0 AND deletado > 0 $query ORDER BY status ASC, produto ASC");

    $this->render('Estoque/deletados', [
        'estoque' => $estoque,
    ]);
  }

  public function voltarEstoque()
  {
    $this->requireLogin();

    $id = $this->get('id');

    $usuario = $this->mysql()->row("SELECT * FROM estoque WHERE id = $id");
    $usuarioLogado = $this->session('id');


    if($usuario) {
      $this->mysql()->update('estoque',[
          'deletado' => 0,
          'status' => 1,
          'data_atualizacao' => date("Y-m-d H:i:s"),
          'usuario_responsavel' => $usuarioLogado,
      ], ['id' => $id]);
    } 

    return $this->redirect('/estoque/deletados');
  }

}


?>