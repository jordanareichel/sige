<?php
require_once 'vendor/autoload.php';


class Pdf extends Controller
{

  function estoquePdf() 
  {

    $estoque = $this->mysql()->table("SELECT * FROM estoque WHERE id > 0 AND deletado is Null AND quantidade > 0 ORDER BY status ASC, produto ASC");
    $idUsuario = $this->session('id');
    $usuario = $this->mysql()->row("SELECT * FROM usuarios WHERE id = $idUsuario");

    $mpdfConfig = array(
      'mode' => 'utf-8',
      'format' => 'A4',
      'margin_bottom' => 22,
      'margin_top' => 24,
      'margin-left' => 15,
      'margin-right' => 15,
      'margin_header' => 7,     // 30mm not pixel
      'margin_footer' => 10,     // 10mm
      'orientation' => 'P'
    );

    $mpdf = new \Mpdf\Mpdf($mpdfConfig);
    $mpdf->allow_charset_conversion = true;
    $mpdf->curlAllowUnsafeSslRequests = true;
    $mpdf->showImageErrors = true;
    $mpdf->use_kwt = true;    // Default: false
    $mpdf->charset_in = 'utf-8';

    $stylesheet = '<style>
            @page {
                margin: 2cm;
            }
        
            body {
                margin: 0px 0px 0px 0px;
            }

            .table-bordered {
                width: 100%;
                display: table-row-group;
                page-break-inside: avoid;
                border-collapse: collapse;
                border: 1px solid #dddddd;
            }
            td,
            th {
                text-align: left;
                padding: 8px;
            }
            .table-bordered-one, td {
                border: 1px solid #dddddd;
                font-size: 12px;
            }
        </style>';


    $html .='<div>';
    $html .= '<div class="header"><h2>Relatório de Estoque</h2></div>';
    $html .='
      <div class="info">
        <div class="text-left">
          <div>
              <span style="font-family: Arial,Helvetica,sans-serif; font-size: 12px;">
                Data do relatório: '.  date("d-m-y H:i:s") .'
              </span>
              <br>
              <span style="font-family: Arial,Helvetica,sans-serif; font-size: 12px;">
                Usuário: '. $usuario->nome .'
              </span>
              <br>
              <span style="font-family: Arial,Helvetica,sans-serif; font-size: 12px;">
               Código do Usuário: '. $usuario->id .'
              </span>
          </div>
        </div>
      </div>
    ';       
    $html .='<br>';
    $html .= '<table autosize="1" class="table table-striped" style=" border-collapse: collapse; width: 100%; margin-bottom: 20px;">
      <tbody>
        <tr>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Código</td>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Produto</td>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Quantidade</td>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Data de Entrada</td>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Data Atualização</td>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Localização</td>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Status</td>
        </tr>
    ';
    foreach($estoque as $e) {
    $nomeProduto = $this->mysql()->row("SELECT * FROM produtos WHERE id = $e->produto");
    $status = $e->status == 2 ? 'BLOQUEADO' : 'ATIVO';
    $statusColor = $e->status == 2 ? 'red' : 'green';
    $html .= '
        <tr>
          <td style="text-align: left; height: 34px;">'.$e->codigo.'</td>
          <td style="text-align: left; height: 34px;">'.$nomeProduto->nome.'</td>
          <td style="text-align: left; height: 34px;">'.$e->quantidade.'</td>
          <td style="text-align: left; height: 34px;">'.date("d-m-Y H:i:s", strtotime($e->data_entrada)).'</td>
          <td style="text-align: left; height: 34px;">'.date("d-m-Y H:i:s", strtotime($e->data_atualizacao)).'</td>
          <td style="text-align: left; height: 34px;">'.$e->localizacao.'</td>
          <td style="text-align: left; height: 34px; color: '.$statusColor.'">'.$status.'</td>
        </tr>
      </tbody>
    ';
    }
    $html .= '</table>';
  
    $mpdf->WriteHTML($stylesheet);
    $mpdf->WriteHTML($html);
    $mpdf->Output();

  }

  function produtosPdf() 
  {
    $produtos = $this->mysql()->table("SELECT * FROM produtos WHERE id > 0 AND deletado is Null  ORDER BY nome ASC, nome ASC");
    $idUsuario = $this->session('id');
    $usuario = $this->mysql()->row("SELECT * FROM usuarios WHERE id = $idUsuario");

    $mpdfConfig = array(
      'mode' => 'utf-8',
      'format' => 'A4',
      'margin_bottom' => 22,
      'margin_top' => 24,
      'margin-left' => 15,
      'margin-right' => 15,
      'margin_header' => 7,     // 30mm not pixel
      'margin_footer' => 10,     // 10mm
      'orientation' => 'P'
    );

    $mpdf = new \Mpdf\Mpdf($mpdfConfig);
    $mpdf->allow_charset_conversion = true;
    $mpdf->curlAllowUnsafeSslRequests = true;
    $mpdf->showImageErrors = true;
    $mpdf->use_kwt = true;    // Default: false
    $mpdf->charset_in = 'utf-8';

    $stylesheet = '<style>
            @page {
                margin: 2cm;
            }
        
            body {
                margin: 0px 0px 0px 0px;
            }

            .table-bordered {
                width: 100%;
                display: table-row-group;
                page-break-inside: avoid;
                border-collapse: collapse;
                border: 1px solid #dddddd;
            }
            td,
            th {
                text-align: left;
                padding: 8px;
            }
            .table-bordered-one, td {
                border: 1px solid #dddddd;
                font-size: 12px;
            }
        </style>';


    $html .='<div>';
    $html .= '<div class="header"><h2>Relatório de Produtos</h2></div>';
    $html .='
      <div class="info">
        <div class="text-left">
          <div>
              <span style="font-family: Arial,Helvetica,sans-serif; font-size: 12px;">
                Data do relatório: '.  date("d-m-y H:i:s") .'
              </span>
              <br>
              <span style="font-family: Arial,Helvetica,sans-serif; font-size: 12px;">
                Usuário: '. $usuario->nome .'
              </span>
              <br>
              <span style="font-family: Arial,Helvetica,sans-serif; font-size: 12px;">
               Código do Usuário: '. $usuario->id .'
              </span>
          </div>
        </div>
      </div>
    ';       
    $html .='<br>';
    $html .= '<table autosize="1" class="table table-striped" style=" border-collapse: collapse; width: 100%; margin-bottom: 20px;">
      <tbody>
        <tr>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Código</td>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Produto</td>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Status</td>
        </tr>
    ';

    foreach($produtos as $p) {
    $status = $p->status == 2 ? 'BLOQUEADO' : 'ATIVO';
    $statusColor = $p->status == 2 ? 'red' : 'green';
    $html .= '
        <tr>
          <td style="text-align: left; height: 34px;">'.$p->codigo.'</td>
          <td style="text-align: left; height: 34px;">'.$p->nome.'</td>
          <td style="text-align: left; height: 34px; color: '.$statusColor.'">'.$status.'</td>
        </tr>
      </tbody>
    ';
    }
    $html .= '</table>';

    $mpdf->WriteHTML($stylesheet);
    $mpdf->WriteHTML($html);
    $mpdf->Output();

  }

  public function usuariosPdf() 
  {
    $usuarios = $this->mysql()->table("SELECT * FROM usuarios WHERE id > 0 AND deletado is Null  ORDER BY nome ASC, nome ASC");
    $idUsuario = $this->session('id');
    $usuarioNome = $this->mysql()->row("SELECT * FROM usuarios WHERE id = $idUsuario");

    $mpdfConfig = array(
      'mode' => 'utf-8',
      'format' => 'A4',
      'margin_bottom' => 22,
      'margin_top' => 24,
      'margin-left' => 15,
      'margin-right' => 15,
      'margin_header' => 7,     // 30mm not pixel
      'margin_footer' => 10,     // 10mm
      'orientation' => 'P'
    );

    $mpdf = new \Mpdf\Mpdf($mpdfConfig);
    $mpdf->allow_charset_conversion = true;
    $mpdf->curlAllowUnsafeSslRequests = true;
    $mpdf->showImageErrors = true;
    $mpdf->use_kwt = true;    // Default: false
    $mpdf->charset_in = 'utf-8';

    $stylesheet = '<style>
            @page {
                margin: 2cm;
            }
        
            body {
                margin: 0px 0px 0px 0px;
            }

            .table-bordered {
                width: 100%;
                display: table-row-group;
                page-break-inside: avoid;
                border-collapse: collapse;
                border: 1px solid #dddddd;
            }
            td,
            th {
                text-align: left;
                padding: 8px;
            }
            .table-bordered-one, td {
                border: 1px solid #dddddd;
                font-size: 12px;
            }
        </style>';


    $html .='<div>';
    $html .= '<div class="header"><h2>Relatório de Usuários</h2></div>';
    $html .='
      <div class="info">
        <div class="text-left">
          <div>
              <span style="font-family: Arial,Helvetica,sans-serif; font-size: 12px;">
                Data do relatório: '.  date("d-m-y H:i:s") .'
              </span>
              <br>
              <span style="font-family: Arial,Helvetica,sans-serif; font-size: 12px;">
                Usuário: '. $usuarioNome->nome .'
              </span>
              <br>
              <span style="font-family: Arial,Helvetica,sans-serif; font-size: 12px;">
               Código do Usuário: '. $usuarioNome->id .'
              </span>
          </div>
        </div>
      </div>
    ';       
    $html .='<br>';
    $html .= '<table autosize="1" class="table table-striped" style=" border-collapse: collapse; width: 100%; margin-bottom: 20px;">
      <tbody>
        <tr>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Código</td>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Nome</td>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Telefone</td>
          <td style="text-align: left; background-color: #efefef; height: 34px;">E-mail</td>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Sexo</td>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Status</td>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Regra</td>
        </tr>
    ';

    foreach($usuarios as $u) {
    $status = $u->status == 2 ? 'BLOQUEADO' : 'ATIVO';
    $sexo = $u->status == 2 ? 'FEMININO' : 'MASCULINO';
    $regra = $u->regra == 2 ? 'ADMIN' : 'SUPER-ADMIN';
    $statusColor = $u->status == 2 ? 'red' : 'green';
    $html .= '
        <tr>
          <td style="text-align: left; height: 34px;">'.$u->id.'</td>
          <td style="text-align: left; height: 34px;">'.$u->nome.'</td>
          <td style="text-align: left; height: 34px;">'.$u->telefone.'</td>
          <td style="text-align: left; height: 34px;">'.$u->email.'</td>
          <td style="text-align: left; height: 34px;">'.$sexo.'</td>
          <td style="text-align: left; height: 34px; color: '.$statusColor.'">'.$status.'</td>
          <td style="text-align: left; height: 34px;">'.$regra.'</td>
        </tr>
      </tbody>
    ';
    }
    $html .= '</table>';

    $mpdf->WriteHTML($stylesheet);
    $mpdf->WriteHTML($html);
    $mpdf->Output();

  }
  
  public function usuariosDeletadosPdf() 
  {
    $usuarios = $this->mysql()->table("SELECT * FROM usuarios WHERE id > 0 AND deletado > 0 ORDER BY nome ASC, nome ASC");
    $idUsuario = $this->session('id');
    $usuarioNome = $this->mysql()->row("SELECT * FROM usuarios WHERE id = $idUsuario");

    $mpdfConfig = array(
      'mode' => 'utf-8',
      'format' => 'A4',
      'margin_bottom' => 22,
      'margin_top' => 24,
      'margin-left' => 15,
      'margin-right' => 15,
      'margin_header' => 7,     // 30mm not pixel
      'margin_footer' => 10,     // 10mm
      'orientation' => 'P'
    );

    $mpdf = new \Mpdf\Mpdf($mpdfConfig);
    $mpdf->allow_charset_conversion = true;
    $mpdf->curlAllowUnsafeSslRequests = true;
    $mpdf->showImageErrors = true;
    $mpdf->use_kwt = true;    // Default: false
    $mpdf->charset_in = 'utf-8';

    $stylesheet = '<style>
            @page {
                margin: 2cm;
            }
        
            body {
                margin: 0px 0px 0px 0px;
            }

            .table-bordered {
                width: 100%;
                display: table-row-group;
                page-break-inside: avoid;
                border-collapse: collapse;
                border: 1px solid #dddddd;
            }
            td,
            th {
                text-align: left;
                padding: 8px;
            }
            .table-bordered-one, td {
                border: 1px solid #dddddd;
                font-size: 12px;
            }
        </style>';


    $html .='<div>';
    $html .= '<div class="header">
    <h2>Relatório de Usuários</h2>
     <span>Relatório relacionado aos itens excluídos do sistema     
    </div>';
    $html .='
      <div class="info">
        <div class="text-left">
          <div>
              <span style="font-family: Arial,Helvetica,sans-serif; font-size: 12px;">
                Data do relatório: '.  date("d-m-y H:i:s") .'
              </span>
              <br>
              <span style="font-family: Arial,Helvetica,sans-serif; font-size: 12px;">
                Usuário: '. $usuarioNome->nome .'
              </span>
              <br>
              <span style="font-family: Arial,Helvetica,sans-serif; font-size: 12px;">
               Código do Usuário: '. $usuarioNome->id .'
              </span>
          </div>
        </div>
      </div>
    ';       
    $html .='<br>';
    $html .= '<table autosize="1" class="table table-striped" style=" border-collapse: collapse; width: 100%; margin-bottom: 20px;">
      <tbody>
        <tr>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Código</td>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Nome</td>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Telefone</td>
          <td style="text-align: left; background-color: #efefef; height: 34px;">E-mail</td>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Sexo</td>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Status</td>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Regra</td>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Data da exclusão</td>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Usuário responsável</td>

        </tr>
    ';

    foreach($usuarios as $u) {
    $status = $u->status == 2 ? 'BLOQUEADO' : 'ATIVO';
    $sexo = $u->status == 2 ? 'FEMININO' : 'MASCULINO';
    $regra = $u->regra == 2 ? 'ADMIN' : 'SUPER-ADMIN';
    $statusColor = $u->status == 2 ? 'red' : 'green';
    $usuarioResponsavel = $this->mysql()->row("SELECT * FROM usuarios WHERE id = $u->usuario_responsavel");

    $html .= '
        <tr>
          <td style="text-align: left; height: 34px;">'.$u->id.'</td>
          <td style="text-align: left; height: 34px;">'.$u->nome.'</td>
          <td style="text-align: left; height: 34px;">'.$u->telefone.'</td>
          <td style="text-align: left; height: 34px;">'.$u->email.'</td>
          <td style="text-align: left; height: 34px;">'.$sexo.'</td>
          <td style="text-align: left; height: 34px; color: '.$statusColor.'">'.$status.'</td>
          <td style="text-align: left; height: 34px;">'.$regra.'</td>
          <td style="text-align: left; height: 34px;">'.date("d-m-Y H:i:s", strtotime($u->data_delete)).'</td>
          <td style="text-align: left; height: 34px;">'.$usuarioResponsavel->nome.'</td>
        </tr>
      </tbody>
    ';
    }
    $html .= '</table>';

    $mpdf->WriteHTML($stylesheet);
    $mpdf->WriteHTML($html);
    $mpdf->Output();
  }

  public function produtosDeletadosPdf()
  {
    $produtos = $this->mysql()->table("SELECT * FROM produtos WHERE id > 0 AND deletado > 0 ORDER BY nome ASC, nome ASC");
    $idUsuario = $this->session('id');
    $usuarioNome = $this->mysql()->row("SELECT * FROM usuarios WHERE id = $idUsuario");

    $mpdfConfig = array(
      'mode' => 'utf-8',
      'format' => 'A4',
      'margin_bottom' => 22,
      'margin_top' => 24,
      'margin-left' => 15,
      'margin-right' => 15,
      'margin_header' => 7,     // 30mm not pixel
      'margin_footer' => 10,     // 10mm
      'orientation' => 'P'
    );

    $mpdf = new \Mpdf\Mpdf($mpdfConfig);
    $mpdf->allow_charset_conversion = true;
    $mpdf->curlAllowUnsafeSslRequests = true;
    $mpdf->showImageErrors = true;
    $mpdf->use_kwt = true;    // Default: false
    $mpdf->charset_in = 'utf-8';

    $stylesheet = '<style>
            @page {
                margin: 2cm;
            }
        
            body {
                margin: 0px 0px 0px 0px;
            }

            .table-bordered {
                width: 100%;
                display: table-row-group;
                page-break-inside: avoid;
                border-collapse: collapse;
                border: 1px solid #dddddd;
            }
            td,
            th {
                text-align: left;
                padding: 8px;
            }
            .table-bordered-one, td {
                border: 1px solid #dddddd;
                font-size: 12px;
            }
        </style>';


    $html .='<div>';
    $html .= '<div class="header">
    <h2>Relatório de Produtos</h2>
     <span>Relatório relacionado aos itens excluídos do sistema     
  </div>';
    $html .='
      <div class="info">
        <div class="text-left">
          <div>
              <span style="font-family: Arial,Helvetica,sans-serif; font-size: 12px;">
                Data do relatório: '.  date("d-m-y H:i:s") .'
              </span>
              <br>
              <span style="font-family: Arial,Helvetica,sans-serif; font-size: 12px;">
                Usuário: '. $usuarioNome->nome .'
              </span>
              <br>
              <span style="font-family: Arial,Helvetica,sans-serif; font-size: 12px;">
               Código do Usuário: '. $usuarioNome->id .'
              </span>
          </div>
        </div>
      </div>
    ';       
    $html .='<br>';
    $html .= '<table autosize="1" class="table table-striped" style=" border-collapse: collapse; width: 100%; margin-bottom: 20px;">
      <tbody>
        <tr>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Código</td>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Produto</td>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Status</td>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Data da exclusão</td>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Usuário responsável</td>
        </tr>
    ';

    foreach($produtos as $p) {
    $status = $p->status == 2 ? 'BLOQUEADO' : 'ATIVO';
    $statusColor = $p->status == 2 ? 'red' : 'green';
    $usuarioResponsavel = $this->mysql()->row("SELECT * FROM usuarios WHERE id = $p->usuario_responsavel");

    $html .= '
        <tr>
          <td style="text-align: left; height: 34px;">'.$p->id.'</td>
          <td style="text-align: left; height: 34px;">'.$p->nome.'</td>
          <td style="text-align: left; height: 34px; color: '.$statusColor.'">'.$status.'</td>
          <td style="text-align: left; height: 34px;">'.date("d-m-Y H:i:s", strtotime($p->data_exclusao)).'</td>
          <td style="text-align: left; height: 34px;">'.$usuarioResponsavel->nome.'</td>
        </tr>
      </tbody>
    ';
    }
    $html .= '</table>';

    $mpdf->WriteHTML($stylesheet);
    $mpdf->WriteHTML($html);
    $mpdf->Output();
  
  }

  public function estoqueDeletadosPdf() 
  {
    $estoque = $this->mysql()->table("SELECT * FROM estoque WHERE id > 0 AND deletado > 0 ORDER BY status ASC, produto ASC");
    $idUsuario = $this->session('id');
    $usuario = $this->mysql()->row("SELECT * FROM usuarios WHERE id = $idUsuario");

    $mpdfConfig = array(
      'mode' => 'utf-8',
      'format' => 'A4',
      'margin_bottom' => 22,
      'margin_top' => 24,
      'margin-left' => 15,
      'margin-right' => 15,
      'margin_header' => 7,     // 30mm not pixel
      'margin_footer' => 10,     // 10mm
      'orientation' => 'P'
    );

    $mpdf = new \Mpdf\Mpdf($mpdfConfig);
    $mpdf->allow_charset_conversion = true;
    $mpdf->curlAllowUnsafeSslRequests = true;
    $mpdf->showImageErrors = true;
    $mpdf->use_kwt = true;    // Default: false
    $mpdf->charset_in = 'utf-8';

    $stylesheet = '<style>
            @page {
                margin: 2cm;
            }
        
            body {
                margin: 0px 0px 0px 0px;
            }

            .table-bordered {
                width: 100%;
                display: table-row-group;
                page-break-inside: avoid;
                border-collapse: collapse;
                border: 1px solid #dddddd;
            }
            td,
            th {
                text-align: left;
                padding: 8px;
            }
            .table-bordered-one, td {
                border: 1px solid #dddddd;
                font-size: 12px;
            }
        </style>';


    $html .='<div>';
    $html .= '<div class="header">
      <h2>Relatório de Estoque</h2>
       <span>Relatório relacionado aos itens excluídos do sistema     
    </div>';
    $html .='<br>';
    $html .='
      <div class="info">
        <div class="text-left">
          <div>
              <span style="font-family: Arial,Helvetica,sans-serif; font-size: 12px;">
                Data do relatório: '.  date("d-m-y H:i:s") .'
              </span>
              <br>
              <span style="font-family: Arial,Helvetica,sans-serif; font-size: 12px;">
                Usuário: '. $usuario->nome .'
              </span>
              <br>
              <span style="font-family: Arial,Helvetica,sans-serif; font-size: 12px;">
               Código do Usuário: '. $usuario->id .'
              </span>
          </div>
        </div>
      </div>
    ';       
    $html .='<br>';
    $html .= '<table autosize="1" class="table table-striped" style=" border-collapse: collapse; width: 100%; margin-bottom: 20px;">
      <tbody>
        <tr>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Código</td>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Produto</td>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Quantidade</td>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Data de Entrada</td>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Data Atualização</td>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Localização</td>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Status</td>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Data exclusão</td>
          <td style="text-align: left; background-color: #efefef; height: 34px;">Usuário responsável</td>
        </tr>
    ';
    foreach($estoque as $e) {
    $nomeProduto = $this->mysql()->row("SELECT * FROM produtos WHERE id = $e->produto");
    $status = $e->status == 2 ? 'BLOQUEADO' : 'ATIVO';
    $statusColor = $e->status == 2 ? 'red' : 'green';
    $responsavel = $this->mysql()->row("SELECT * FROM usuarios WHERE id = $e->usuario_responsavel");

    $html .= '
        <tr>
          <td style="text-align: left; height: 34px;">'.$e->codigo.'</td>
          <td style="text-align: left; height: 34px;">'.$nomeProduto->nome.'</td>
          <td style="text-align: left; height: 34px;">'.$e->quantidade.'</td>
          <td style="text-align: left; height: 34px;">'.date("d-m-Y H:i:s", strtotime($e->data_entrada)).'</td>
          <td style="text-align: left; height: 34px;">'.date("d-m-Y H:i:s", strtotime($e->data_atualizacao)).'</td>
          <td style="text-align: left; height: 34px;">'.$e->localizacao.'</td>
          <td style="text-align: left; height: 34px; color: '.$statusColor.'">'.$status.'</td>
          <td style="text-align: left; height: 34px;">'.date("d-m-Y H:i:s", strtotime($e->data_exclusao)).'</td>
          <td style="text-align: left; height: 34px;">'.$responsavel->nome.'</td>
        </tr>
      </tbody>
    ';
    }
    $html .= '</table>';
  
    $mpdf->WriteHTML($stylesheet);
    $mpdf->WriteHTML($html);
    $mpdf->Output();
  }

}

?>