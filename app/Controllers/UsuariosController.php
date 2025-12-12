<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class UsuariosController
{

    public function index()
    {
        // Paginação
        $page = isset($_GET['page']) && $_GET['page'] > 0 ? intval($_GET['page']) : 1;
        $itensPage = 5;
        $inicio = ($page - 1) * $itensPage;

        // Busca
        $nome = isset($_GET['pesquisarUsuarios']) ? trim($_GET['pesquisarUsuarios']) : '';

        if (!empty($nome)) {
            // Com busca
            $todosUsuarios = App::get('database')->buscaUsuarios($nome);
            $rows_count = count($todosUsuarios);
            $users = array_slice($todosUsuarios, $inicio, $itensPage);
        } else {
            // Sem busca
            $rows_count = App::get('database')->countAll('usuarios');
            $users = App::get('database')->selectAll('usuarios', $inicio, $itensPage);
        }

        $totalPages = max(1, ceil($rows_count / $itensPage));

        // Garante que a página não seja maior que o total
        if ($page > $totalPages) {
            header("Location: /usuarios?page=" . $totalPages);
            exit;
        }

        return view('admin/listaUsuarios', compact('users', 'page', 'totalPages'));
    }

    public function criar()
    {

        if ($_FILES['imagemUsuario']['name'] == NULL) {
            $caminhoImagem = 'public/assets/foto perfil.png';
        } else {
            $imagemTemporaria = $_FILES['imagemUsuario']['tmp_name'];
            $nomeImagem = sha1(uniqid($_FILES['imagemUsuario']['name'], true)) . "." . pathinfo($_FILES['imagemUsuario']['name'], PATHINFO_EXTENSION);

            $caminhoImagem = "public/assets/imagensUsuarios/" . $nomeImagem;
            move_uploaded_file($imagemTemporaria, $caminhoImagem);
        };

        $parameters = [
            'nome' => $_POST['nome'],
            'email' => $_POST['email'],
            'senha' => $_POST['senha'],
            'imagem' => $caminhoImagem,
            'tipo_usuario' => 0
        ];

        App::get('database')->insert('usuarios', $parameters);

        header('Location: /usuarios');
    }

    public function editar()
    {
        session_start();
        
        if (isset($_FILES['imagemUsuarioEdit']) && (isset($_FILES['imagemUsuarioEdit']['error'])) && $_FILES['imagemUsuarioEdit']['error'] === 0) {
            $imagemTemporaria = $_FILES['imagemUsuarioEdit']['tmp_name'];
            $nomeImagem = sha1(uniqid($_FILES['imagemUsuarioEdit']['name'], true)) . "." . pathinfo($_FILES['imagemUsuarioEdit']['name'], PATHINFO_EXTENSION);

            $caminhoImagem = "public/assets/imagensUsuarios/" . $nomeImagem;
            move_uploaded_file($imagemTemporaria, $caminhoImagem);
        } else {
            $caminhoImagem = $_POST['imgAtual'];
        }
        $id = $_POST['id'];

        $parameters = [
            'nome' => $_POST['nome'],
            'email' => $_POST['email'],
            'senha' => $_POST['senha'],
            'imagem' => $caminhoImagem
        ];

        App::get('database')->update('usuarios', $id, $parameters);

        // Atualiza a variável de foto_perfil da sessão para que a imagem do usuário mude dinamicamente caso ele edite sua foto de perfil
        if ($_SESSION['id'] == $id) {
            $_SESSION['foto_perfil'] = $caminhoImagem;
            $_SESSION['nome'] = $_POST['nome'];
            $_SESSION['email'] = $_POST['email'];
        }

        header('Location: /usuarios');
    }

    public function deletar()
    {
        session_start();

        $id = $_POST['id'];

        App::get('database')->delete('usuarios', $id);

        if ($_SESSION['id'] == $id) {
            session_unset();
            session_destroy();
            header("Location: /login");
            exit;
        }

        header('Location: /usuarios');
    }

    public function paginacao()
    {
        $page = 1;

        if (isset($_GET['paginacaoNumero']) && !empty($_GET['paginacaoNumero'])) {
            $page = intval($_GET['paginacaoNumero']);

            if ($page <= 0) {
                return redirect('admin/listaUsuarios');
            }
        }
        $itensPage = 5;
        $inicio = $itensPage * $page - $itensPage;
        $rows_count = App::get('database')->countAll('usuarios');

        if ($inicio > $rows_count) {
            return redirect('admin/listaUsuarios');
        }
    }
}
