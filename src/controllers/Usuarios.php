<?php


class Usuarios extends Controller
{

  public function index()
  {
      $this->requireAdmin();
      $query = "";
      $search = null;

      if ($this->get('nome')) {
          $nome = $this->get("nome");
          $query .= " AND (nome like '%$nome%' OR email like '%$nome%')";
          $search = $nome;
      }

      $usuarios = $this->mysql()->table("SELECT * FROM usuarios WHERE id > 0 AND deletado is Null $query ORDER BY status ASC, nome ASC");

      $this->render('Usuarios/index', [
          'usuarios' => $usuarios,
          'search' => $search
      ]);
  }
  

  public function cadastro()
  {
      $this->requireAdmin();

      if ($this->isPost()) {
          if (!$this->post('email')) {
              echo json_encode(['error' => true, 'msg' => 'E-mail é obrigatório!']);
              die();
          }

          $novoUsuario = [
              "nome" => $this->post("nome"),
              "email" => $this->post('email'),
              "telefone" => $this->post("telefone"),
              "senha" => sha1($this->post("senha")),
              "status" => $this->post("status"),
              "regra" => $this->post("regra"),
              "sexo" => $this->post("sexo"),
          ];

          $email = $this->post('email');


          $validaUsuario = $this->mysql()->row("SELECT * FROM usuarios WHERE email = '$email'");
          if ($validaUsuario) {
              echo json_encode(['error' => true, 'msg' => 'E-mail já cadastrado!']);
              die();
          }

          $this->mysql()->insert("usuarios", $novoUsuario);
          echo json_encode(['error' => false, 'msg' => 'Usuário atualizado com sucesso']);
          die();
      }

      $this->render('Usuarios/cadastro', []);
  }

  public function editar()
  {
      $this->requireAdmin();

      $this->requireLogin();

      $id = $this->get('id');

      $usuario = $this->mysql()->row("SELECT * FROM usuarios WHERE id = $id");

 
      if ($this->isPost()) {
          $dadosUsuario = $this->copyFromPost();
          unset($dadosUsuario['senha']);

          if($this->post('senha') && $this->post('senha') != "") {
              if($this->post("senha") !== $usuario->senha) {
                  $dadosUsuario['senha'] = sha1($this->post('senha'));
              }
          }
          $this->mysql()->update("usuarios", $dadosUsuario, ['id' => $id]);
          echo json_encode(['user' => $usuario]);
          die();
      }


      $this->render('Usuarios/editar', [
          'usuario' => $usuario,
      ]);
  }

  public function status()
  {
      $this->requireAdmin();

      $this->requireLogin();

      $id = $this->get('id');
      $status = $this->get('status');

      $usuario = $this->mysql()->row("SELECT * FROM usuarios WHERE id = $id");


      if($usuario && $status == 1) {
        $this->mysql()->update("usuarios",  ['status' => 2], ['id' => $id]);
      } else {
        $this->mysql()->update("usuarios",  ['status' => 1], ['id' => $id]);
      }
   
    
    return $this->redirect('/usuarios');
  }

  public function delete()
  {
      $this->requireAdmin();

      $this->requireLogin();

      $id = $this->get('id');

      $usuario = $this->mysql()->row("SELECT * FROM usuarios WHERE id = $id");
      $usuarioLogado = $this->session('id');

      if($usuario) {
        $this->mysql()->update('usuarios',[
            'deletado' => 1,
            'status' => 2,
            'data_delete' => date("Y-m-d H:i:s"),
            'usuario_responsavel' => $usuarioLogado,
        ], ['id' => $id]);
      } 

    return $this->redirect('/usuarios');
  }

  public function deletados() {
    $this->requireAdmin();

    $usuarios = $this->mysql()->table("SELECT * FROM usuarios WHERE id > 0 AND deletado > 0 $query ORDER BY status ASC, nome ASC");

    $this->render('Usuarios/deletados', [
        'usuarios' => $usuarios,
    ]);
  }

  public function voltarUsuario()
  {
    $this->requireLogin();

    $id = $this->get('id');

    $usuario = $this->mysql()->row("SELECT * FROM usuarios WHERE id = $id");
    $usuarioLogado = $this->session('id');


    if($usuario) {
      $this->mysql()->update('usuarios',[
          'deletado' => 0,
          'status' => 1,
          'data_atualizacao' => date("Y-m-d H:i:s"),
          'usuario_responsavel' => $usuarioLogado,
      ], ['id' => $id]);
    } 

    return $this->redirect('/usuarios/deletados');
  }
}
?>