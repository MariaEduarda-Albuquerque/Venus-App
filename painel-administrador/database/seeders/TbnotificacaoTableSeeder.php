<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbnotificacaoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbnotificacao')->delete();
        
        \DB::table('tbnotificacao')->insert(array (
            0 => 
            array (
                'codNotificacao' => 1,
                'destinatarioTipo' => 'usuaria',
                'codDestinatario' => 1,
                'tipoNotificacao' => 'consulta_confirmada',
                'tituloNotificacao' => 'Sua consulta foi confirmada',
                'corpoNotificacao' => 'A consulta com a Dra. Helena Costa esta confirmada para 10/09/2026 as 14h.',
                'lida' => 0,
                'dataEnvio' => '2026-09-05 11:21:00',
            ),
            1 => 
            array (
                'codNotificacao' => 2,
                'destinatarioTipo' => 'usuaria',
                'codDestinatario' => 3,
                'tipoNotificacao' => 'consulta_confirmada',
                'tituloNotificacao' => 'Sua consulta foi confirmada',
                'corpoNotificacao' => 'A consulta com a Dra. Helena Costa esta confirmada para 24/09/2026 as 14h30.',
                'lida' => 1,
                'dataEnvio' => '2026-09-20 09:16:00',
            ),
            2 => 
            array (
                'codNotificacao' => 3,
                'destinatarioTipo' => 'usuaria',
                'codDestinatario' => 5,
                'tipoNotificacao' => 'consulta_confirmada',
                'tituloNotificacao' => 'Sua consulta foi confirmada',
                'corpoNotificacao' => 'A consulta com Priscila Andrade esta confirmada para 22/09/2026 as 18h.',
                'lida' => 1,
                'dataEnvio' => '2026-09-18 20:01:00',
            ),
            3 => 
            array (
                'codNotificacao' => 4,
                'destinatarioTipo' => 'usuaria',
                'codDestinatario' => 9,
                'tipoNotificacao' => 'consulta_confirmada',
                'tituloNotificacao' => 'Sua consulta foi confirmada',
                'corpoNotificacao' => 'A consulta com Carolina Mendes esta confirmada para 01/10/2026 as 10h.',
                'lida' => 1,
                'dataEnvio' => '2026-09-25 08:31:00',
            ),
            4 => 
            array (
                'codNotificacao' => 5,
                'destinatarioTipo' => 'usuaria',
                'codDestinatario' => 10,
                'tipoNotificacao' => 'consulta_lembrete',
                'tituloNotificacao' => 'Sua consulta e hoje',
                'corpoNotificacao' => 'Voce tem consulta com Rogerio Alves hoje as 19h.',
                'lida' => 1,
                'dataEnvio' => '2026-10-08 17:00:00',
            ),
            5 => 
            array (
                'codNotificacao' => 6,
                'destinatarioTipo' => 'usuaria',
                'codDestinatario' => 13,
                'tipoNotificacao' => 'consulta_confirmada',
                'tituloNotificacao' => 'Sua consulta foi confirmada',
                'corpoNotificacao' => 'A consulta com Simone Batista esta confirmada para 20/10/2026 as 15h.',
                'lida' => 0,
                'dataEnvio' => '2026-10-14 19:31:00',
            ),
            6 => 
            array (
                'codNotificacao' => 7,
                'destinatarioTipo' => 'usuaria',
                'codDestinatario' => 2,
                'tipoNotificacao' => 'consulta_confirmada',
                'tituloNotificacao' => 'Sua consulta foi confirmada',
                'corpoNotificacao' => 'A consulta com a Dra. Helena Costa esta confirmada para 22/10/2026 as 15h.',
                'lida' => 0,
                'dataEnvio' => '2026-10-15 20:51:00',
            ),
            7 => 
            array (
                'codNotificacao' => 8,
                'destinatarioTipo' => 'usuaria',
                'codDestinatario' => 4,
                'tipoNotificacao' => 'consulta_cancelada',
                'tituloNotificacao' => 'Consulta cancelada',
                'corpoNotificacao' => 'Sua consulta de 12/10/2026 as 18h30 foi cancelada. Voce pode remarcar quando quiser.',
                'lida' => 1,
                'dataEnvio' => '2026-10-11 19:31:00',
            ),
            8 => 
            array (
                'codNotificacao' => 9,
                'destinatarioTipo' => 'usuaria',
                'codDestinatario' => 16,
                'tipoNotificacao' => 'duvida_enviada',
                'tituloNotificacao' => 'Sua duvida foi enviada',
                'corpoNotificacao' => 'Sua duvida rapida foi enviada para a Dra. Fernanda Albuquerque. Voce recebera a resposta por aqui.',
                'lida' => 0,
                'dataEnvio' => '2026-10-16 09:41:00',
            ),
            9 => 
            array (
                'codNotificacao' => 10,
                'destinatarioTipo' => 'usuaria',
                'codDestinatario' => 1,
                'tipoNotificacao' => 'evento_inscricao',
                'tituloNotificacao' => 'Inscricao confirmada',
                'corpoNotificacao' => 'Voce esta inscrita em: Roda de conversa: saude menstrual (05/10/2026 as 19h).',
                'lida' => 1,
                'dataEnvio' => '2026-09-17 18:19:08',
            ),
            10 => 
            array (
                'codNotificacao' => 11,
                'destinatarioTipo' => 'usuaria',
                'codDestinatario' => 17,
                'tipoNotificacao' => 'aviso_moderacao',
                'tituloNotificacao' => 'Aviso da moderacao',
                'corpoNotificacao' => 'Sua publicacao foi analisada e voce recebeu uma advertencia por divulgar orientacao de saude sem respaldo.',
                'lida' => 1,
                'dataEnvio' => '2026-09-17 18:20:00',
            ),
            11 => 
            array (
                'codNotificacao' => 12,
                'destinatarioTipo' => 'usuaria',
                'codDestinatario' => 17,
                'tipoNotificacao' => 'conta_suspensa',
                'tituloNotificacao' => 'Conta suspensa',
                'corpoNotificacao' => 'Sua conta foi suspensa por violar as regras da comunidade. Em caso de duvidas, fale com o suporte.',
                'lida' => 1,
                'dataEnvio' => '2026-09-29 10:01:00',
            ),
            12 => 
            array (
                'codNotificacao' => 13,
                'destinatarioTipo' => 'usuaria',
                'codDestinatario' => 3,
                'tipoNotificacao' => 'nova_resposta_forum',
                'tituloNotificacao' => 'Nova resposta na sua publicacao',
                'corpoNotificacao' => 'A Dra. Helena Costa respondeu sua publicacao "DIU ou pilula: qual voces escolheram?".',
                'lida' => 1,
                'dataEnvio' => '2026-09-19 11:31:00',
            ),
            13 => 
            array (
                'codNotificacao' => 14,
                'destinatarioTipo' => 'usuaria',
                'codDestinatario' => 12,
                'tipoNotificacao' => 'nova_resposta_forum',
                'tituloNotificacao' => 'Nova resposta na sua publicacao',
                'corpoNotificacao' => 'A Dra. Fernanda Albuquerque respondeu sua publicacao "Menstruacao atrasada ha 10 dias, o que fazer?".',
                'lida' => 1,
                'dataEnvio' => '2026-09-22 21:01:00',
            ),
            14 => 
            array (
                'codNotificacao' => 15,
                'destinatarioTipo' => 'usuaria',
                'codDestinatario' => 20,
                'tipoNotificacao' => 'evento_inscricao',
                'tituloNotificacao' => 'Inscricao confirmada',
                'corpoNotificacao' => 'Voce esta inscrita em: Oficina de autocuidado e saude mental (22/10/2026 as 19h30).',
                'lida' => 1,
                'dataEnvio' => '2026-10-02 09:00:00',
            ),
            15 => 
            array (
                'codNotificacao' => 16,
                'destinatarioTipo' => 'usuaria',
                'codDestinatario' => 9,
                'tipoNotificacao' => 'evento_inscricao',
                'tituloNotificacao' => 'Inscricao confirmada',
                'corpoNotificacao' => 'Voce esta inscrita em: Pre-natal sem medo: tire suas duvidas (29/10/2026 as 19h).',
                'lida' => 0,
                'dataEnvio' => '2026-10-10 20:00:00',
            ),
            16 => 
            array (
                'codNotificacao' => 17,
                'destinatarioTipo' => 'usuaria',
                'codDestinatario' => 5,
                'tipoNotificacao' => 'lembrete_diario',
                'tituloNotificacao' => 'Como voce esta hoje?',
                'corpoNotificacao' => 'Registre seu humor e uma anotacao no diario para acompanhar seu bem-estar.',
                'lida' => 0,
                'dataEnvio' => '2026-10-16 08:00:00',
            ),
            17 => 
            array (
                'codNotificacao' => 18,
                'destinatarioTipo' => 'profissional',
                'codDestinatario' => 1,
                'tipoNotificacao' => 'consulta_agendada',
                'tituloNotificacao' => 'Nova consulta agendada',
                'corpoNotificacao' => 'Camila Oliveira Santos agendou consulta para 22/10/2026 as 15h.',
                'lida' => 0,
                'dataEnvio' => '2026-10-15 20:51:00',
            ),
            18 => 
            array (
                'codNotificacao' => 19,
                'destinatarioTipo' => 'profissional',
                'codDestinatario' => 7,
                'tipoNotificacao' => 'consulta_agendada',
                'tituloNotificacao' => 'Nova consulta agendada',
                'corpoNotificacao' => 'Gabriela Teixeira agendou consulta para 20/10/2026 as 15h.',
                'lida' => 0,
                'dataEnvio' => '2026-10-14 19:31:00',
            ),
            19 => 
            array (
                'codNotificacao' => 20,
                'destinatarioTipo' => 'profissional',
                'codDestinatario' => 5,
                'tipoNotificacao' => 'nova_duvida_rapida',
                'tituloNotificacao' => 'Nova duvida rapida',
                'corpoNotificacao' => 'Uma usuaria enviou uma duvida rapida e aguarda resposta.',
                'lida' => 0,
                'dataEnvio' => '2026-10-16 09:41:00',
            ),
            20 => 
            array (
                'codNotificacao' => 21,
                'destinatarioTipo' => 'profissional',
                'codDestinatario' => 4,
                'tipoNotificacao' => 'conteudo_aprovado',
                'tituloNotificacao' => 'Conteudo aprovado',
                'corpoNotificacao' => 'Seu conteudo "Seus direitos no pre-natal e no parto" foi aprovado e publicado.',
                'lida' => 1,
                'dataEnvio' => '2026-09-09 09:01:00',
            ),
            21 => 
            array (
                'codNotificacao' => 22,
                'destinatarioTipo' => 'profissional',
                'codDestinatario' => 4,
                'tipoNotificacao' => 'ajuste_solicitado',
                'tituloNotificacao' => 'Ajuste solicitado no conteudo',
                'corpoNotificacao' => 'A moderacao solicitou ajustes em "Violencia obstetrica: reconhecer e denunciar".',
                'lida' => 0,
                'dataEnvio' => '2026-10-13 10:31:00',
            ),
            22 => 
            array (
                'codNotificacao' => 23,
                'destinatarioTipo' => 'profissional',
                'codDestinatario' => 10,
                'tipoNotificacao' => 'conteudo_recusado',
                'tituloNotificacao' => 'Conteudo nao aprovado',
                'corpoNotificacao' => 'Seu conteudo "Chas e simpatias contra gravidez" nao foi aprovado. Veja o motivo no painel.',
                'lida' => 0,
                'dataEnvio' => '2026-10-11 09:16:00',
            ),
            23 => 
            array (
                'codNotificacao' => 24,
                'destinatarioTipo' => 'profissional',
                'codDestinatario' => 10,
                'tipoNotificacao' => 'cadastro_em_analise',
                'tituloNotificacao' => 'Cadastro em analise',
                'corpoNotificacao' => 'Recebemos seus documentos e seu cadastro esta em analise.',
                'lida' => 1,
                'dataEnvio' => '2026-10-09 17:21:00',
            ),
            24 => 
            array (
                'codNotificacao' => 25,
                'destinatarioTipo' => 'profissional',
                'codDestinatario' => 11,
                'tipoNotificacao' => 'cadastro_pendencia',
                'tituloNotificacao' => 'Pendencia no cadastro',
                'corpoNotificacao' => 'Envie o documento complementar do conselho para concluir a verificacao.',
                'lida' => 0,
                'dataEnvio' => '2026-10-06 10:00:00',
            ),
            25 => 
            array (
                'codNotificacao' => 26,
                'destinatarioTipo' => 'profissional',
                'codDestinatario' => 8,
                'tipoNotificacao' => 'cadastro_aprovado',
                'tituloNotificacao' => 'Cadastro aprovado',
                'corpoNotificacao' => 'Seu cadastro foi aprovado. Bem-vinda ao Venus!',
                'lida' => 1,
                'dataEnvio' => '2026-08-19 10:00:00',
            ),
            26 => 
            array (
                'codNotificacao' => 27,
                'destinatarioTipo' => 'admin',
                'codDestinatario' => 3,
                'tipoNotificacao' => 'denuncia_nova',
                'tituloNotificacao' => 'Nova denuncia de gravidade alta',
                'corpoNotificacao' => 'Uma resposta do forum foi denunciada por recomendacao de planta potencialmente perigosa.',
                'lida' => 0,
                'dataEnvio' => '2026-10-14 18:11:00',
            ),
            27 => 
            array (
                'codNotificacao' => 28,
                'destinatarioTipo' => 'admin',
                'codDestinatario' => 4,
                'tipoNotificacao' => 'denuncia_nova',
                'tituloNotificacao' => 'Nova denuncia de perfil',
                'corpoNotificacao' => 'O perfil de um profissional foi denunciado por divulgacao de produtos.',
                'lida' => 1,
                'dataEnvio' => '2026-10-12 15:21:00',
            ),
            28 => 
            array (
                'codNotificacao' => 29,
                'destinatarioTipo' => 'admin',
                'codDestinatario' => 1,
                'tipoNotificacao' => 'conteudo_para_revisao',
                'tituloNotificacao' => 'Conteudo aguardando revisao',
                'corpoNotificacao' => 'Novo conteudo para revisar: "Higiene intima sem mitos".',
                'lida' => 0,
                'dataEnvio' => '2026-10-08 10:21:00',
            ),
            29 => 
            array (
                'codNotificacao' => 30,
                'destinatarioTipo' => 'admin',
                'codDestinatario' => 3,
                'tipoNotificacao' => 'conteudo_para_revisao',
                'tituloNotificacao' => 'Conteudo aguardando revisao',
                'corpoNotificacao' => 'Novo conteudo para revisar: "Violencia obstetrica: reconhecer e denunciar".',
                'lida' => 1,
                'dataEnvio' => '2026-10-11 14:01:00',
            ),
            30 => 
            array (
                'codNotificacao' => 31,
                'destinatarioTipo' => 'admin',
                'codDestinatario' => 1,
                'tipoNotificacao' => 'cadastro_profissional_pendente',
                'tituloNotificacao' => 'Verificacao de profissional',
                'corpoNotificacao' => 'A profissional Dra. Lucia Helena Prado aguarda verificacao de cadastro.',
                'lida' => 0,
                'dataEnvio' => '2026-10-09 17:21:00',
            ),
        ));
        
        
    }
}