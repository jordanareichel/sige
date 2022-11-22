<?php

class Main extends Controller
{

    function logout()
    {
        session_destroy();
        $this->redirect('/');
    }

    function index()
    {

        if ($this->session('id')) {
            $this->redirect('/main/stream');
        }
        $this->render("Main/index");
    }

    function stream()
    {

        return $this->redirect('/dashboard');

        $primeiroAcesso = ($this->session('cadastroOk')) ? true : false;
        $this->setSession('cadastroOk', false);


        $this->render("Main/stream", [
            'primeiroAcesso' => $primeiroAcesso
        ]);
    }

    function cadastro()
    {

        if ($this->isPost() === true) {
            $validaUsuario = $this->mysql()->row("SELECT * FROM usuarios WHERE email = '{$this->post("email")}'");
            if ($validaUsuario) {
                echo json_encode(['success' => false, 'message' => 'Usuário já cadastrado.']);
                exit;
            } else {
                if ($this->post("nome") && $this->post("telefone") && $this->post("senha")) {
                    $novoUsuario = $this->mysql()->insert("usuarios", [
                        "nome" => $this->post("nome"),
                        "telefone" => $this->post("telefone"),
                        "senha" => sha1($this->post("senha")),
                        "regra" => 1,
                        "status" => 1,
                    ]);

                    $this->setSession("usuarioId", $novoUsuario);
                    $this->setSession("usuarioId", $novoUsuario);
                    $this->setSession("usuarioTelefone", $this->post("telefone"));
                    $this->setSession("usuarioRegra", 1);
                    $this->setSession("cadastroOk", true);

                    $msg = "Olá {$this->post("nome")}, seu cadastro foi criado com sucesso na SIGE!";
                    echo json_encode(['success' => true, 'message' => 'Usuário cadastrado com sucesso.']);
                    exit;
                }
            }

            echo json_encode(['success' => false, 'message' => 'Erro ao criar o cadastro.']);
            exit;
        }

        $this->render("Main/cadastro", []);
    }

    function login()
    {

        if ($this->isPost() === true) {
            $validaUsuario = $this->mysql()->row("SELECT * FROM usuarios WHERE email = '{$this->post("email")}'");
            if (!$validaUsuario) {
                echo json_encode(['success' => false, 'message' => 'Usuário ou senha inválidos.']);
                exit;
            } else {
                if($validaUsuario->status === 2) {
                    echo json_encode(['success' => false, 'message' => 'Usuário bloqueado.']);
                    exit;
                } else {
                    if ($validaUsuario->senha === sha1($this->post("senha"))) {
                        $this->setSession("id", $validaUsuario->id);
                        $this->setSession("nome", $validaUsuario->nome);
                        $this->setSession("telefone", $validaUsuario->telefone);
                        $this->setSession("regra", $validaUsuario->regra);
                        $this->setSession("email", $validaUsuario->email);
                        echo json_encode(['success' => true, 'message' => 'Usuário logado com sucesso.']);
                        exit;
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Usuário ou senha inválidos.']);
                        exit;
                    }
                }
            }

            echo json_encode(['success' => false, 'message' => 'Erro ao logar usuário.']);
            exit;
        }

        $this->render("Main/login");
    }
    
}