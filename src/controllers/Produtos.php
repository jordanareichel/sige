<?php


class Produtos extends Controller
{

  public function index()
  {

      $query = "";
      $search = null;

      if ($this->get('nome')) {
          $nome = $this->get("nome");
          $query .= " AND (nome like '%$nome%' OR codigo like '%$nome%')";
          $search = $nome;
      }

      $produtos = $this->mysql()->table("SELECT * FROM produtos WHERE id > 0 AND deletado is Null $query ORDER BY status ASC, nome ASC");

      $this->render('Produtos/index', [
          'produtos' => $produtos,
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

          $novoProduto = [
              "nome" => $this->post("nome"),
              "codigo" => $this->post('codigo'),
              "status" => $this->post("status"),
          ];

          $codigo = $this->post('codigo');


          $validaProduto = $this->mysql()->row("SELECT * FROM produtos WHERE codigo = '$codigo'");
          if ($validaProduto) {
              echo json_encode(['error' => true, 'msg' => 'Produto já cadastrado!']);
              die();
          }

          $this->mysql()->insert("produtos", $novoProduto);
          echo json_encode(['error' => false, 'msg' => 'Produto atualizado com sucesso']);
          die();
      }

      $this->render('Produtos/cadastro', []);
  }

  public function editar()
  {

      $this->requireLogin();

      $id = $this->get('id');

      $produto = $this->mysql()->row("SELECT * FROM produtos WHERE id = $id");

 
      if ($this->isPost()) {
          $dadosProduto = $this->copyFromPost();

          $this->mysql()->update("produtos", $dadosProduto, ['id' => $id]);
          echo json_encode(['produto' => $produto]);
          die();
      }


      $this->render('Produtos/editar', [
          'produto' => $produto,
      ]);
  }

  public function status()  
  {
      $this->requireAdmin();

      $this->requireLogin();

      $id = $this->get('id');
      $status = $this->get('status');

      $produto = $this->mysql()->row("SELECT * FROM produtos WHERE id = $id");


      if($produto && $status == 1) {
        $this->mysql()->update("produtos",  ['status' => 2], ['id' => $id]);
      } else {
        $this->mysql()->update("produtos",  ['status' => 1], ['id' => $id]);
      }
   
    
    return $this->redirect('/produtos');
  }

  public function delete()
  {
      $this->requireLogin();

      $id = $this->get('id');

      $produto = $this->mysql()->row("SELECT * FROM produtos WHERE id = $id");
      $usuarioLogado = $this->session('id');

      if($produto) {
        $this->mysql()->update('produtos',[
            'deletado' => 1,
            'status' => 2,
            'data_exclusao' => date("Y-m-d H:i:s"),
            'usuario_responsavel' => $usuarioLogado,
        ], ['id' => $id]);
      } 

    return $this->redirect('/produtos');
  }

  public function deletados() 
  {

    $produtos = $this->mysql()->table("SELECT * FROM produtos WHERE id > 0 AND deletado > 0 $query ORDER BY status ASC, nome ASC");

    $this->render('Produtos/deletados', [
        'produtos' => $produtos,
    ]);
  }
  
  public function voltarProduto()
  {
    $this->requireLogin();

    $id = $this->get('id');

    $produto = $this->mysql()->row("SELECT * FROM produtos WHERE id = $id");
    $usuarioLogado = $this->session('id');


    if($produto) {
      $this->mysql()->update('produtos',[
          'deletado' => 0,
          'status' => 1,
          'data_atualizacao' => date("Y-m-d H:i:s"),
          'usuario_responsavel' => $usuarioLogado,
      ], ['id' => $id]);
    } 

    return $this->redirect('/produtos/deletados');
  }
}


?>