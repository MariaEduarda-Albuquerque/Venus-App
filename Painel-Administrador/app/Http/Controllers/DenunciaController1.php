<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class denunciaController extends Controller
{
   public function index()
    {
        // Simulação dos dados vindos do banco de dados (Variáveis)
        $tickets = [
            [
                'id' => 346520,
                'subject' => 'A barra lateral não responde em dispositivos móveis.',
                'date' => 'Segunda-feira, 15h20 (há 2 dias)',
                'user' => [
                    'name' => 'João Ninguém',
                    'email' => 'jhondelin@gmail.com',
                ],
                'description' => "Olá, suporte do MaliWoman\n\nGostaria de informar que foi identificado um problema na barra lateral do sistema. Em dispositivos móveis, a barra lateral não está respondendo corretamente às interações do usuário, impedindo que as opções sejam acessadas normalmente.\n\nSolicito, por gentileza, que o problema seja verificado e corrigido para garantir o funcionamento adequado da barra lateral também em dispositivos móveis.\nAtenciosamente,\n\nJoão",
                'support_team' => 'Suporte MaliWoman',
                'response' => null, // Resposta ainda não enviada
            ],
            [
                'id' => 346521,
                'subject' => 'Erro 500 ao tentar salvar perfil.',
                'date' => 'Terça-feira, 09h15 (há 1 dia)',
                'user' => [
                    'name' => 'Maria Silva',
                    'email' => 'maria.silva@email.com',
                ],
                'description' => "Olá, equipe de suporte.\n\nSempre que tento atualizar minha foto de perfil ou alterar o nome de usuário, a página carrega por alguns segundos e exibe uma tela de Erro Interno (Erro 500).\n\nPoderiam verificar o que está ocorrendo com a minha conta?\nObrigada,\n\nMaria",
                'support_team' => 'Suporte MaliWoman',
                'response' => 'Olá Maria! Identificamos uma instabilidade temporária em nosso servidor de arquivos. O problema já foi corrigido pela nossa equipe técnica. Por favor, tente atualizar seu perfil novamente.',
            ],
            [
                'id' => 346522,
                'subject' => 'Linguagem inadequada em comentário público.',
                'date' => 'Hoje, 10h40',
                'user' => [
                    'name' => 'Carlos Eduardo',
                    'email' => 'carlos.edu@gmail.com',
                ],
                'description' => "Prezados,\n\nGostaria de denunciar um comentário ofensivo realizado na publicação #8894. O usuário utilizou termos desrespeitosos que violam os termos de uso da plataforma.\n\nPeço a remoção do comentário e análise da conta do infrator.\nAtenciosamente,\n\nCarlos",
                'support_team' => 'Suporte MaliWoman',
                'response' => null,
            ],
        ];

        return view('admin.denuncias', compact('tickets'));
    }
}

