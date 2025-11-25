<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class UsuariosController
{

    public function index(){

    // Paginação 
        $page=1;

        if(isset($_GET['paginacaoNumero']) && !empty($_GET['paginacaoNumero'])){
            $page = intval($_GET['paginacaoNumero']);

            if($page<=0){
                return redirect('admin/listaUsuarios');
            }
        }
        $itensPage = 5;
        $inicio = $itensPage * $page - $itensPage;
        $rows_count = App::get('database')->countAll('usuarios');
        
        if($inicio>$rows_count){
            return redirect('admin/listaUsuarios');
        }
        $total_pages= ceil($rows_count/$itensPage);

        // user
        $users = App::get('database')->selectAll('usuarios');
        return view('admin/listaUsuarios', compact('users'));
    }

    public function criar()
    {
        $imagemTemporaria= $_FILES['imagemUsuario']['tmp_name'];
        $nomeImagem= sha1(uniqid($_FILES['imagemUsuario']['name'], true)) . "." . pathinfo($_FILES['imagemUsuario']['name'],PATHINFO_EXTENSION) ;

        $caminhoImagem= "public/assets/imagensUsuarios/" . $nomeImagem; 
        move_uploaded_file($imagemTemporaria, $caminhoImagem);

        $parameters = [
            'nome' => $_POST['nome'],
            'email' => $_POST['email'],
            'senha' => $_POST['senha'],
            'imagem' => $caminhoImagem
        ];   

        App::get('database')->insert('usuarios', $parameters);

        header('Location: /usuarios');
    }

    public function editar()
    {
        if(isset($_FILES['imagemUsuarioEdit'])&& (isset($_FILES['imagemUsuarioEdit']['error']))&& $_FILES['imagemUsuarioEdit']['error'] === 0){
            $imagemTemporaria= $_FILES['imagemUsuarioEdit']['tmp_name'];
            $nomeImagem= sha1(uniqid($_FILES['imagemUsuarioEdit']['name'], true)) . "." . pathinfo($_FILES['imagemUsuarioEdit']['name'],PATHINFO_EXTENSION) ;

            $caminhoImagem= "public/assets/imagensUsuarios/" . $nomeImagem; 
            move_uploaded_file($imagemTemporaria, $caminhoImagem);
        }
        else{
            $caminhoImagem= $_POST['imgAtual'];
        }
        $id = $_POST['id'];

        $parameters = [
            'nome' => $_POST['nome'],
            'email' => $_POST['email'],
            'senha' => $_POST['senha'],
            'imagem' => $caminhoImagem        
        ];

        App::get('database')->update('usuarios', $id, $parameters);

        header ('Location: /usuarios');

    }

    public function deletar()
    {
        $id = $_POST['id'];

        App::get('database')->delete('usuarios', $id);

        header ('Location: /usuarios');
    }
    public function paginacao()
    {
        $page=1;

        if(isset($_GET['paginacaoNumero']) && !empty($_GET['paginacaoNumero'])){
            $page = intval($_GET['paginacaoNumero']);

            if($page<=0){
                return redirect('admin/listaUsuarios');
            }
        }
        $itensPage = 5;
        $inicio = $itensPage * $page - $itensPage;
        $rows_count = App::get('database')->countAll('usuarios');
        
        if($inicio>$rows_count){
            return redirect('admin/listaUsuarios');
        }

    }
}