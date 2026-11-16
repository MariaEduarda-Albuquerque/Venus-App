/* ==========================================================
   VÊNUS — Preferências do usuário (tema e idioma)
   Arquivo: public/js/preferencias.js
   ========================================================== */

(function () {
    'use strict';

    var CHAVE_TEMA = 'venus_tema';
    var CHAVE_IDIOMA = 'venus_idioma';
    var IDIOMAS = ['pt-BR', 'en', 'es'];
    var TEMAS = ['claro', 'escuro'];
    var raiz = document.documentElement;

    function ler(chave, padrao) {
        try { return localStorage.getItem(chave) || padrao; } catch (e) { return padrao; }
    }
    function gravar(chave, valor) {
        try { localStorage.setItem(chave, valor); } catch (e) { }
    }

    var tema = ler(CHAVE_TEMA, 'claro');
    var idioma = ler(CHAVE_IDIOMA, 'pt-BR');
    if (TEMAS.indexOf(tema) === -1) tema = 'claro';
    if (IDIOMAS.indexOf(idioma) === -1) idioma = 'pt-BR';

    /* ==========================================================
       DICIONÁRIO  PT -> EN / ES  (COMPLETO E FINAL)
       ========================================================== */
    var DICIONARIO = {

        /* ---------- Menu lateral / Comuns ---------- */
        'Principal': { en: 'Main', es: 'Principal' },
        'Gestão': { en: 'Management', es: 'Gestión' },
        'Conta': { en: 'Account', es: 'Cuenta' },
        'Painel': { en: 'Dashboard', es: 'Panel' },
        'Caixa de Entrada': { en: 'Inbox', es: 'Bandeja de entrada' },
        'Agenda': { en: 'Schedule', es: 'Agenda' },
        'Pacientes': { en: 'Patients', es: 'Pacientes' },
        'Conteúdos': { en: 'Content', es: 'Contenidos' },
        'Relatórios': { en: 'Reports', es: 'Informes' },
        'Fórum': { en: 'Forum', es: 'Foro' },
        'Aprender': { en: 'Learn', es: 'Aprender' },
        'Meu Perfil': { en: 'My Profile', es: 'Mi perfil' },
        'Configurações': { en: 'Settings', es: 'Configuración' },
        'Suporte': { en: 'Support', es: 'Soporte' },
        'Sair': { en: 'Log out', es: 'Salir' },

        /* ---------- Topo / Busca ---------- */
        'Buscar atendimentos, pacientes...': { en: 'Search appointments, patients...', es: 'Buscar atenciones, pacientes...' },
        'Foto do profissional': { en: 'Professional photo', es: 'Foto del profesional' },

        /* ---------- Botões / Ações comuns ---------- */
        'Fechar': { en: 'Close', es: 'Cerrar' },
        'Cancelar': { en: 'Cancel', es: 'Cancelar' },
        'Continuar': { en: 'Continue', es: 'Continuar' },
        'Voltar': { en: 'Back', es: 'Volver' },
        'Verificado': { en: 'Verified', es: 'Verificada' },
        'Dúvida rápida': { en: 'Quick question', es: 'Duda rápida' },
        'Presencial': { en: 'In person', es: 'Presencial' },
        'Chat': { en: 'Chat', es: 'Chat' },
        'Outro': { en: 'Other', es: 'Otro' },
        'Selecione': { en: 'Select', es: 'Selecciona' },
        'Salvar': { en: 'Save', es: 'Guardar' },
        'Editar': { en: 'Edit', es: 'Editar' },
        'Excluir': { en: 'Delete', es: 'Eliminar' },
        'Visualizar': { en: 'View', es: 'Ver' },
        'Aplicar': { en: 'Apply', es: 'Aplicar' },
        'Limpar': { en: 'Clear', es: 'Limpiar' },
        'Limpar Filtros': { en: 'Clear filters', es: 'Limpiar filtros' },
        'Buscar': { en: 'Search', es: 'Buscar' },

        /* ---------- Configurações ---------- */
        'Preferências da conta, segurança e aparência.': {
            en: 'Account, security and appearance preferences.',
            es: 'Preferencias de cuenta, seguridad y apariencia.'
        },
        'E-mail de login': { en: 'Login email', es: 'Correo de inicio de sesión' },
        'Alterar senha': { en: 'Change password', es: 'Cambiar contraseña' },
        'Sessões ativas': { en: 'Active sessions', es: 'Sesiones activas' },
        'Este dispositivo': { en: 'This device', es: 'Este dispositivo' },
        'São Paulo, SP · Ativo agora': { en: 'São Paulo, SP · Active now', es: 'São Paulo, SP · Activo ahora' },
        'São Paulo, SP · Há 2 horas': { en: 'São Paulo, SP · 2 hours ago', es: 'São Paulo, SP · Hace 2 horas' },
        'Encerrar sessão': { en: 'End session', es: 'Cerrar sesión' },
        'dispositivo': { en: 'device', es: 'dispositivo' },
        'dispositivos': { en: 'devices', es: 'dispositivos' },
        'Segurança': { en: 'Security', es: 'Seguridad' },
        'Verificação de duas etapas': { en: 'Two-step verification', es: 'Verificación en dos pasos' },
        'Proteja sua conta com uma camada extra': {
            en: 'Protect your account with an extra layer',
            es: 'Protege tu cuenta con una capa adicional'
        },
        'Alertas de acesso': { en: 'Access alerts', es: 'Alertas de acceso' },
        'Receber avisos em novos dispositivos': {
            en: 'Get notified about new devices',
            es: 'Recibir avisos en nuevos dispositivos'
        },
        'Aparência': { en: 'Appearance', es: 'Apariencia' },
        'Claro': { en: 'Light', es: 'Claro' },
        'Escuro': { en: 'Dark', es: 'Oscuro' },
        'Idioma': { en: 'Language', es: 'Idioma' },
        'Zona de Risco': { en: 'Danger Zone', es: 'Zona de riesgo' },
        'A exclusão da conta é permanente e exige confirmação de duas etapas.': {
            en: 'Deleting your account is permanent and requires two-step confirmation.',
            es: 'La eliminación de la cuenta es permanente y requiere confirmación en dos pasos.'
        },
        'Excluir conta': { en: 'Delete account', es: 'Eliminar cuenta' },
        'Excluir conta?': { en: 'Delete account?', es: '¿Eliminar cuenta?' },
        'Essa ação é permanente. Todos os dados associados à sua conta serão processados conforme a política de privacidade.': {
            en: 'This action is permanent. All data associated with your account will be handled according to the privacy policy.',
            es: 'Esta acción es permanente. Todos los datos asociados a tu cuenta se tratarán conforme a la política de privacidad.'
        },

        /* ---------- Painel (Dashboard) ---------- */
        'Visão geral das suas atividades hoje.': { en: 'Overview of your activity today.', es: 'Resumen de tu actividad de hoy.' },
        '+ Definir disponibilidade': { en: '+ Set availability', es: '+ Definir disponibilidad' },
        'Consultas hoje': { en: 'Appointments today', es: 'Consultas hoy' },
        '+2 em relação a ontem': { en: '+2 compared to yesterday', es: '+2 respecto a ayer' },
        'Mensagens pendentes': { en: 'Pending messages', es: 'Mensajes pendientes' },
        '2 aguardando há +2h': { en: '2 waiting for over 2h', es: '2 esperando hace más de 2 h' },
        'Avaliação média': { en: 'Average rating', es: 'Valoración media' },
        'Usuárias atendidas': { en: 'Users served', es: 'Usuarias atendidas' },
        '+18 esta semana': { en: '+18 this week', es: '+18 esta semana' },
        'Atendimentos da semana': { en: 'Appointments this week', es: 'Atenciones de la semana' },
        'Esta semana comparada à semana passada': { en: 'This week compared to last week', es: 'Esta semana comparada con la semana pasada' },
        'Assuntos mais procurados': { en: 'Most searched topics', es: 'Temas más buscados' },
        'Temas das dúvidas das usuárias': { en: 'Topics of users\' questions', es: 'Temas de las dudas de las usuarias' },
        'Próximos atendimentos': { en: 'Upcoming appointments', es: 'Próximas atenciones' },
        'Ver agenda': { en: 'View schedule', es: 'Ver agenda' },
        'Ver todas': { en: 'View all', es: 'Ver todas' },
        'Consulta de rotina': { en: 'Routine checkup', es: 'Consulta de rutina' },
        'Primeira consulta': { en: 'First appointment', es: 'Primera consulta' },
        'Retorno': { en: 'Follow-up', es: 'Seguimiento' },
        'Consulta por chat': { en: 'Chat consultation', es: 'Consulta por chat' },
        'Agendada': { en: 'Scheduled', es: 'Agendada' },
        'Entrar': { en: 'Join', es: 'Entrar' },
        'Fila de dúvidas rápidas': { en: 'Quick question queue', es: 'Cola de dudas rápidas' },
        'Aguardando resposta': { en: 'Awaiting reply', es: 'Esperando respuesta' },
        'Atendimentos por dia': { en: 'Appointments per day', es: 'Atenciones por día' },
        'Últimos 20 dias': { en: 'Last 20 days', es: 'Últimos 20 días' },
        'Clique em uma barra para ampliar · duplo clique para voltar.': { en: 'Click a bar to zoom in · double-click to go back.', es: 'Haz clic en una barra para ampliar · doble clic para volver.' },
        'Evolução na semana': { en: 'Weekly trend', es: 'Evolución en la semana' },
        'Avaliações recentes': { en: 'Recent reviews', es: 'Valoraciones recientes' },
        '"Me senti acolhida e consegui entender minhas opções sem julgamento."': { en: '"I felt welcomed and was able to understand my options without judgment."', es: '"Me sentí acogida y pude entender mis opciones sin juicios."' },
        '"Resposta clara e rápida. Muito obrigada."': { en: '"Clear and quick answer. Thank you so much."', es: '"Respuesta clara y rápida. Muchas gracias."' },

        /* Gráficos / Dias da semana */
        'Semana passada': { en: 'Last week', es: 'Semana pasada' },
        'Esta semana': { en: 'This week', es: 'Esta semana' },
        'Assuntos': { en: 'Topics', es: 'Temas' },
        'Saúde sexual': { en: 'Sexual health', es: 'Salud sexual' },
        'Exames': { en: 'Tests', es: 'Exámenes' },
        'Ciclo menstrual': { en: 'Menstrual cycle', es: 'Ciclo menstrual' },
        'Pré-natal': { en: 'Prenatal', es: 'Prenatal' },
        'Anticoncepção': { en: 'Contraception', es: 'Anticoncepción' },
        'Dia': { en: 'Day', es: 'Día' },
        'atendimentos': { en: 'appointments', es: 'atenciones' },
        'Seg': { en: 'Mon', es: 'Lun' },
        'Ter': { en: 'Tue', es: 'Mar' },
        'Qua': { en: 'Wed', es: 'Mié' },
        'Qui': { en: 'Thu', es: 'Jue' },
        'Sex': { en: 'Fri', es: 'Vie' },
        'Sáb': { en: 'Sat', es: 'Sáb' },
        'Dom': { en: 'Sun', es: 'Dom' },

        /* ---------- Meu Perfil ---------- */
        'Dados públicos exibidos para as usuárias.': { en: 'Public information shown to users.', es: 'Datos públicos que se muestran a las usuarias.' },
        'Trocar foto': { en: 'Change photo', es: 'Cambiar foto' },
        'JPG ou PNG, até 5MB': { en: 'JPG or PNG, up to 5MB', es: 'JPG o PNG, hasta 5 MB' },
        'Trocar senha': { en: 'Change password', es: 'Cambiar contraseña' },
        'Editar perfil': { en: 'Edit profile', es: 'Editar perfil' },
        'Estas informações aparecem no seu perfil público.': { en: 'This information appears on your public profile.', es: 'Esta información aparece en tu perfil público.' },
        'Contato e documento': { en: 'Contact and ID', es: 'Contacto y documento' },
        'Email': { en: 'Email', es: 'Correo electrónico' },
        'Telefone': { en: 'Phone', es: 'Teléfono' },
        'CPF ou CNPJ': { en: 'CPF or CNPJ', es: 'CPF o CNPJ' },
        'Localização': { en: 'Location', es: 'Ubicación' },
        'CEP': { en: 'ZIP code', es: 'Código postal (CEP)' },
        'UF': { en: 'State', es: 'Estado (UF)' },
        'País': { en: 'Country', es: 'País' },
        'Cidade': { en: 'City', es: 'Ciudad' },
        'Atuação profissional': { en: 'Professional practice', es: 'Actuación profesional' },
        'Categoria profissional': { en: 'Professional category', es: 'Categoría profesional' },
        'Especialidade': { en: 'Specialty', es: 'Especialidad' },
        'Apresentação profissional': { en: 'Professional introduction', es: 'Presentación profesional' },
        'Ao desativar, seu perfil deixa de aparecer para as usuárias.': { en: 'If you deactivate, your profile stops appearing to users.', es: 'Al desactivar, tu perfil deja de mostrarse a las usuarias.' },
        'Desativar conta': { en: 'Deactivate account', es: 'Desactivar cuenta' },
        'Prévia do perfil': { en: 'Profile preview', es: 'Vista previa del perfil' },
        'Como a usuária verá você': { en: 'How users will see you', es: 'Cómo te verá la usuaria' },
        'Tem certeza que deseja desativar sua conta?': { en: 'Are you sure you want to deactivate your account?', es: '¿Seguro que quieres desactivar tu cuenta?' },
        'Sim, desativar': { en: 'Yes, deactivate', es: 'Sí, desactivar' },

        /* Categorias profissionais */
        'Médico': { en: 'Physician', es: 'Médico' },
        'Enfermeiro': { en: 'Nurse', es: 'Enfermero' },
        'Psicologo': { en: 'Psychologist', es: 'Psicólogo' },
        'Assistente Social': { en: 'Social worker', es: 'Trabajador social' },

        /* ---------- Editar Perfil ---------- */
        'Editar Perfil': { en: 'Edit Profile', es: 'Editar perfil' },
        'Atualize seus dados públicos e profissionais.': { en: 'Update your public and professional details.', es: 'Actualiza tus datos públicos y profesionales.' },
        'Salvar alterações': { en: 'Save changes', es: 'Guardar cambios' },
        'Dados pessoais e profissionais': { en: 'Personal and professional details', es: 'Datos personales y profesionales' },
        'Essas informações aparecem no seu perfil público.': { en: 'This information appears on your public profile.', es: 'Esta información aparece en tu perfil público.' },
        'Foto de perfil': { en: 'Profile photo', es: 'Foto de perfil' },
        'JPG ou PNG': { en: 'JPG or PNG', es: 'JPG o PNG' },
        'Nenhum arquivo selecionado': { en: 'No file selected', es: 'Ningún archivo seleccionado' },
        'Prévia da foto': { en: 'Photo preview', es: 'Vista previa de la foto' },
        'Nome': { en: 'Name', es: 'Nombre' },
        'E-mail': { en: 'Email', es: 'Correo electrónico' },
        'Categoria': { en: 'Category', es: 'Categoría' },
        'Apresentação': { en: 'Introduction', es: 'Presentación' },
        'Selecione a UF': { en: 'Select state', es: 'Selecciona el estado' },
        'Médica': { en: 'Physician', es: 'Médica' },
        'Enfermeira': { en: 'Nurse', es: 'Enfermera' },
        'Psicóloga': { en: 'Psychologist', es: 'Psicóloga' },
        'Assistente Social': { en: 'Social worker', es: 'Trabajadora social' },
        'CEP não encontrado.': { en: 'ZIP code not found.', es: 'Código postal no encontrado.' },

        /* ---------- Suporte ---------- */
        'Encontre respostas ou fale com a equipe gestora.': { en: 'Find answers or contact the management team.', es: 'Encuentra respuestas o contacta al equipo de gestión.' },
        'Como podemos ajudar?': { en: 'How can we help?', es: '¿Cómo podemos ayudar?' },
        'Buscar na central de ajuda...': { en: 'Search help center...', es: 'Buscar en el centro de ayuda...' },
        'Conta e verificação': { en: 'Account and verification', es: 'Cuenta y verificación' },
        'Publicação de conteúdo': { en: 'Content publishing', es: 'Publicación de contenido' },
        'Fale com a equipe': { en: 'Contact the team', es: 'Habla con el equipo' },
        'Tem alguma dúvida ou situação que não conseguiu resolver? Nossa equipe está pronta para te ajudar.': { en: 'Have any questions or issues you couldn\'t resolve? Our team is ready to help.', es: '¿Tienes alguna duda o situación que no pudiste resolver? Nuestro equipo está listo para ayudarte.' },
        'Iniciar atendimento': { en: 'Start chat', es: 'Iniciar atención' },
        'Atendimento online': { en: 'Online support', es: 'Atención en línea' },
        'Seg a Sex · 8h às 18h': { en: 'Mon to Fri · 8am to 6pm', es: 'Lun a Vie · 8h a 18h' },
        'Perguntas frequentes': { en: 'Frequently asked questions', es: 'Preguntas frecuentes' },
        'Ver todas': { en: 'View all', es: 'Ver todas' },
        'Como redefinir minha senha?': { en: 'How to reset my password?', es: '¿Cómo restablecer mi contraseña?' },
        'Em Meu Perfil, clique em "Trocar senha" e siga as instruções. Se esqueceu a senha, use "Esqueci minha senha" na tela de login.': { en: 'In My Profile, click "Change password" and follow the instructions. If you forgot your password, use "Forgot password" on the login screen.', es: 'En Mi Perfil, haz clic en "Cambiar contraseña" y sigue las instrucciones. Si olvidaste tu contraseña, usa "Olvidé mi contraseña" en la pantalla de inicio.' },
        'Como alterar meus dados?': { en: 'How to change my data?', es: '¿Cómo cambiar mis datos?' },
        'Acesse Meu Perfil e clique em "Editar perfil". Depois de ajustar as informações, é só salvar as alterações.': { en: 'Access My Profile and click "Edit profile". After adjusting the information, just save the changes.', es: 'Accede a Mi Perfil y haz clic en "Editar perfil". Después de ajustar la información, solo guarda los cambios.' },
        'Como funciona a agenda?': { en: 'How does the schedule work?', es: '¿Cómo funciona la agenda?' },
        'Na Agenda você define sua disponibilidade e acompanha os atendimentos marcados pelas usuárias.': { en: 'In the Schedule you set your availability and track appointments booked by users.', es: 'En la Agenda defines tu disponibilidad y sigues las atenciones agendadas por las usuarias.' },
        'Como publicar conteúdos na plataforma?': { en: 'How to publish content on the platform?', es: '¿Cómo publicar contenido en la plataforma?' },
        'Em Conteúdos, crie uma nova publicação e envie para análise. Após a aprovação da equipe, ela fica disponível.': { en: 'In Content, create a new publication and send it for review. After team approval, it becomes available.', es: 'En Contenidos, crea una nueva publicación y envíala para revisión. Tras la aprobación del equipo, queda disponible.' },
        'Como acessar meus laudos e relatórios?': { en: 'How to access my reports?', es: '¿Cómo acceder a mis informes?' },
        'Os relatórios ficam disponíveis no menu Relatórios, organizados por período de atendimento.': { en: 'Reports are available in the Reports menu, organized by appointment period.', es: 'Los informes están disponibles en el menú Informes, organizados por período de atención.' },
        'Status dos serviços': { en: 'Service status', es: 'Estado de los servicios' },
        'Plataforma Vênus': { en: 'Vênus Platform', es: 'Plataforma Vênus' },
        'Operacional': { en: 'Operational', es: 'Operativo' },
        'Publicações': { en: 'Publications', es: 'Publicaciones' },
        'Notificações': { en: 'Notifications', es: 'Notificaciones' },
        'Última atualização': { en: 'Last updated', es: 'Última actualización' },
        'Canais de atendimento': { en: 'Support channels', es: 'Canales de atención' },
        'Chat online': { en: 'Online chat', es: 'Chat en línea' },
        'Atendimento em tempo real': { en: 'Real-time support', es: 'Atención en tiempo real' },
        'E-mail': { en: 'Email', es: 'Correo electrónico' },
        'Telefone': { en: 'Phone', es: 'Teléfono' },
        'Vênus • A Saúde da Mulher': { en: 'Vênus • Women\'s Health', es: 'Vênus • Salud de la Mujer' },

        /* ---------- Relatórios ---------- */
        'Relatório de Impacto': { en: 'Impact Report', es: 'Informe de Impacto' },
        'Acompanhe o seu desempenho e o impacto do seu atendimento na plataforma.': { en: 'Track your performance and the impact of your care on the platform.', es: 'Sigue tu desempeño y el impacto de tu atención en la plataforma.' },
        'Exportar PDF': { en: 'Export PDF', es: 'Exportar PDF' },
        '7 dias': { en: '7 days', es: '7 días' },
        '30 dias': { en: '30 days', es: '30 días' },
        '90 dias': { en: '90 days', es: '90 días' },
        'Personalizado': { en: 'Custom', es: 'Personalizado' },
        'De': { en: 'From', es: 'Desde' },
        'Até': { en: 'To', es: 'Hasta' },
        'Usuárias atendidas': { en: 'Users served', es: 'Usuarias atendidas' },
        'atendimentos no período': { en: 'appointments in the period', es: 'atenciones en el período' },
        'Tempo médio de resposta': { en: 'Average response time', es: 'Tiempo medio de respuesta' },
        'Entre a mensagem da usuária e a sua resposta': { en: 'Between the user\'s message and your reply', es: 'Entre el mensaje de la usuaria y tu respuesta' },
        'Nota média': { en: 'Average rating', es: 'Valoración media' },
        'Nenhuma avaliação no período': { en: 'No ratings in the period', es: 'Ninguna valoración en el período' },
        'Últimos 30 dias': { en: 'Last 30 days', es: 'Últimos 30 días' },
        'Evolução mensal dos atendimentos': { en: 'Monthly evolution of appointments', es: 'Evolución mensual de las atenciones' },
        'Atendimentos realizados por mês': { en: 'Appointments per month', es: 'Atenciones realizadas por mes' },
        'Resumo dos atendimentos': { en: 'Appointments summary', es: 'Resumen de atenciones' },
        'atendimentos no período selecionado': { en: 'appointments in the selected period', es: 'atenciones en el período seleccionado' },
        'Nenhum atendimento no período': { en: 'No appointments in the period', es: 'Ninguna atención en el período' },
        'Escolha outro período para ver os atendimentos realizados.': { en: 'Choose another period to see the appointments.', es: 'Elige otro período para ver las atenciones realizadas.' },
        'Vênus • A Saúde da Mulher': { en: 'Vênus • Women\'s Health', es: 'Vênus • Salud de la Mujer' },
        'Relatório de Impacto': { en: 'Impact Report', es: 'Informe de Impacto' },
        'Acompanhe o seu desempenho e o impacto do seu atendimento na plataforma.': { en: 'Track your performance and the impact of your care on the platform.', es: 'Sigue tu desempeño y el impacto de tu atención en la plataforma.' },
        'Exportar PDF': { en: 'Export PDF', es: 'Exportar PDF' },
        '7 dias': { en: '7 days', es: '7 días' },
        '30 dias': { en: '30 days', es: '30 días' },
        '90 dias': { en: '90 days', es: '90 días' },
        'Personalizado': { en: 'Custom', es: 'Personalizado' },
        'De': { en: 'From', es: 'Desde' },
        'Até': { en: 'To', es: 'Hasta' },

        /* ---------- Conteúdos ---------- */
        'Publicação de conteúdo': { en: 'Content publishing', es: 'Publicación de contenido' },
        'Crie artigos, vídeos e infográficos para a revisão editorial.': { en: 'Create articles, videos and infographics for editorial review.', es: 'Crea artículos, videos e infografías para revisión editorial.' },
        '+ Criar novo conteúdo': { en: '+ Create new content', es: '+ Crear nuevo contenido' },
        'Todos': { en: 'All', es: 'Todos' },
        'Rascunhos': { en: 'Drafts', es: 'Borradores' },
        'Em Revisão': { en: 'Under review', es: 'En revisión' },
        'Publicados': { en: 'Published', es: 'Publicados' },
        'Recusados': { en: 'Rejected', es: 'Rechazados' },
        'Nenhum conteúdo por aqui ainda': { en: 'No content here yet', es: 'Ningún contenido por aquí aún' },
        'Clique em "Criar novo conteúdo" para escrever seu primeiro material.': { en: 'Click "Create new content" to write your first piece.', es: 'Haz clic en "Crear nuevo contenido" para escribir tu primer material.' },
        'Título': { en: 'Title', es: 'Título' },
        'Ex: Como cuidar da saúde menstrual...': { en: 'Ex: How to care for menstrual health...', es: 'Ej: Cómo cuidar la salud menstrual...' },
        'Categoria': { en: 'Category', es: 'Categoría' },
        'Formato': { en: 'Format', es: 'Formato' },
        'Conteúdo': { en: 'Content', es: 'Contenido' },
        'Escreva um conteúdo educativo...': { en: 'Write educational content...', es: 'Escribe contenido educativo...' },
        'Salvar rascunho': { en: 'Save draft', es: 'Guardar borrador' },
        'Enviar para revisão': { en: 'Submit for review', es: 'Enviar para revisión' },
        'Novo conteúdo': { en: 'New content', es: 'Nuevo contenido' },
        'O conteúdo será enviado para a revisão editorial antes de ser publicado.': { en: 'The content will be sent for editorial review before being published.', es: 'El contenido se enviará para revisión editorial antes de publicarse.' },
        'Editar conteúdo': { en: 'Edit content', es: 'Editar contenido' },
        'Rascunho: continue editando ou envie para a revisão editorial.': { en: 'Draft: keep editing or submit for editorial review.', es: 'Borrador: sigue editando o envía para revisión editorial.' },
        'Publicado: ao privar, o conteúdo deixa de ser público e volta a ser rascunho.': { en: 'Published: when made private, the content stops being public and returns to draft.', es: 'Publicado: al privar, el contenido deja de ser público y vuelve a borrador.' },
        'Recusado: ajuste o conteúdo e envie novamente para a revisão.': { en: 'Rejected: adjust the content and submit again for review.', es: 'Rechazado: ajusta el contenido y envíalo de nuevo para revisión.' },
        'Em revisão: a equipe editorial está analisando, por isso a edição está bloqueada.': { en: 'Under review: the editorial team is analyzing, so editing is blocked.', es: 'En revisión: el equipo editorial está analizando, por eso la edición está bloqueada.' },
        'Privar conteúdo': { en: 'Make private', es: 'Hacer privado' },
        'Manter como rascunho': { en: 'Keep as draft', es: 'Mantener como borrador' },
        'Salvar como rascunho': { en: 'Save as draft', es: 'Guardar como borrador' },
        'Fechar': { en: 'Close', es: 'Cerrar' },

        /* ---------- Pacientes ---------- */
        'Pacientes': { en: 'Patients', es: 'Pacientes' },
        'Histórico de usuárias atendidas por você.': { en: 'History of users served by you.', es: 'Historial de usuarias atendidas por ti.' },
        'Buscar pacientes...': { en: 'Search patients...', es: 'Buscar pacientes...' },
        'Últimos 7 dias': { en: 'Last 7 days', es: 'Últimos 7 días' },
        'Últimos 30 dias': { en: 'Last 30 days', es: 'Últimos 30 días' },
        'Últimos 90 dias': { en: 'Last 90 days', es: 'Últimos 90 días' },
        'Nenhuma paciente encontrada': { en: 'No patients found', es: 'Ninguna paciente encontrada' },
        'Quando você concluir atendimentos, as usuárias atendidas aparecerão aqui.': { en: 'When you complete appointments, the served users will appear here.', es: 'Cuando completes atenciones, las usuarias atendidas aparecerán aquí.' },
        'Nenhum atendimento nesse período. Tente outro filtro.': { en: 'No appointments in this period. Try another filter.', es: 'Ninguna atención en este período. Prueba otro filtro.' },
        'Nome / Apelido': { en: 'Name / Nickname', es: 'Nombre / Apodo' },
        'Último atendimento': { en: 'Last appointment', es: 'Última atención' },
        'Consultas': { en: 'Appointments', es: 'Consultas' },
        'Status': { en: 'Status', es: 'Estado' },
        'Ver histórico': { en: 'View history', es: 'Ver historial' },
        'Nenhuma paciente encontrada com esse nome.': { en: 'No patient found with that name.', es: 'Ninguna paciente encontrada con ese nombre.' },
        'Paciente': { en: 'Patient', es: 'Paciente' },
        'Tipo': { en: 'Type', es: 'Tipo' },
        'Data': { en: 'Date', es: 'Fecha' },
        'Descrição': { en: 'Description', es: 'Descripción' },
        'Fechar histórico': { en: 'Close history', es: 'Cerrar historial' },
        'Sem avaliação': { en: 'No rating', es: 'Sin valoración' },

        /* ---------- Agenda ---------- */
        'Agenda e disponibilidade': { en: 'Schedule and availability', es: 'Agenda y disponibilidad' },
        'Gestão dos horários em que o profissional está disponível para atendimento.': { en: 'Management of hours when the professional is available for appointments.', es: 'Gestión de horarios en que el profesional está disponible para atenciones.' },
        '+ Bloquear horário': { en: '+ Block time slot', es: '+ Bloquear horario' },
        'Semana anterior': { en: 'Previous week', es: 'Semana anterior' },
        'Próxima semana': { en: 'Next week', es: 'Próxima semana' },
        'Hoje': { en: 'Today', es: 'Hoy' },
        'Disponível': { en: 'Available', es: 'Disponible' },
        'Ocupado': { en: 'Busy', es: 'Ocupado' },
        'Bloqueado': { en: 'Blocked', es: 'Bloqueado' },
        'Horário': { en: 'Time', es: 'Hora' },
        'Nenhum horário de atendimento configurado': { en: 'No appointment hours configured', es: 'Ningún horario de atención configurado' },
        'Quando seus dias e horários de atendimento forem cadastrados, eles aparecerão aqui.': { en: 'When your appointment days and hours are registered, they will appear here.', es: 'Cuando se registren tus días y horarios de atención, aparecerán aquí.' },
        'Bloquear horário': { en: 'Block time slot', es: 'Bloquear horario' },
        'Escolha o período que ficará indisponível para novos atendimentos.': { en: 'Choose the period that will be unavailable for new appointments.', es: 'Elige el período que estará no disponible para nuevas atenciones.' },
        'Data': { en: 'Date', es: 'Fecha' },
        'Motivo': { en: 'Reason', es: 'Motivo' },
        'Início': { en: 'Start', es: 'Inicio' },
        'Fim': { en: 'End', es: 'Fin' },
        'Cancelar': { en: 'Cancel', es: 'Cancelar' },
        'Bloquear horário': { en: 'Block time slot', es: 'Bloquear horario' },
        'Horário bloqueado': { en: 'Blocked time slot', es: 'Horario bloqueado' },
        'Este período está indisponível para novos atendimentos.': { en: 'This period is unavailable for new appointments.', es: 'Este período no está disponible para nuevas atenciones.' },
        'Período': { en: 'Period', es: 'Período' },
        'Fechar': { en: 'Close', es: 'Cerrar' },
        'Remover bloqueio': { en: 'Remove block', es: 'Eliminar bloqueo' },
        'Atendimento': { en: 'Appointment', es: 'Atención' },
        'Detalhes do atendimento marcado neste horário.': { en: 'Details of the appointment scheduled at this time.', es: 'Detalles de la atención agendada en este horario.' },
        'Paciente': { en: 'Patient', es: 'Paciente' },
        'Horário': { en: 'Time', es: 'Hora' },
        'Editar consulta': { en: 'Edit appointment', es: 'Editar cita' },

        /* ---------- Caixa de Entrada ---------- */
        'Caixa de Entrada': { en: 'Inbox', es: 'Bandeja de entrada' },
        'Responda às usuárias que entraram em contato com você, em um único lugar.': { en: 'Reply to users who contacted you, all in one place.', es: 'Responde a las usuarias que te contactaron, todo en un solo lugar.' },
        'Limpar Filtros': { en: 'Clear filters', es: 'Limpiar filtros' },
        'Todas': { en: 'All', es: 'Todas' },
        'Não lidas': { en: 'Unread', es: 'No leídas' },
        'Buscar pelo nome da usuária...': { en: 'Search by user name...', es: 'Buscar por nombre de la usuaria...' },
        'Selecione uma conversa': { en: 'Select a conversation', es: 'Selecciona una conversación' },
        'Escolha uma conversa na lista, ou pesquise pelo nome da usuária, para ver as mensagens.': { en: 'Choose a conversation from the list, or search by user name to see messages.', es: 'Elige una conversación de la lista, o busca por nombre de la usuaria para ver los mensajes.' },
        'Sigilo médico: esta conversa é confidencial e deve ser utilizada exclusivamente para o atendimento.': { en: 'Medical confidentiality: this conversation is confidential and must be used exclusively for the appointment.', es: 'Confidencialidad médica: esta conversación es confidencial y debe usarse exclusivamente para la atención.' },
        'Digite sua mensagem…': { en: 'Type your message…', es: 'Escribe tu mensaje…' },
        'Você:': { en: 'You:', es: 'Tú:' },
        'Nenhuma conversa ainda. Quando uma usuária enviar uma mensagem, ela aparecerá aqui.': { en: 'No conversations yet. When a user sends a message, it will appear here.', es: 'Ninguna conversación aún. Cuando una usuaria envíe un mensaje, aparecerá aquí.' },
        'Nenhuma conversa encontrada com esse nome.': { en: 'No conversation found with that name.', es: 'Ninguna conversación encontrada con ese nombre.' },
        'Nenhuma mensagem não lida.': { en: 'No unread messages.', es: 'Ningún mensaje no leído.' },

        /* ---------- Perfil / Editar Perfil (extras) ---------- */
        'Meu Perfil': { en: 'My Profile', es: 'Mi perfil' },
        'Dados públicos exibidos para as usuárias.': { en: 'Public data shown to users.', es: 'Datos públicos que se muestran a las usuarias.' },
        'Trocar foto': { en: 'Change photo', es: 'Cambiar foto' },
        'JPG ou PNG, até 5MB': { en: 'JPG or PNG, up to 5MB', es: 'JPG o PNG, hasta 5 MB' },
        'Trocar senha': { en: 'Change password', es: 'Cambiar contraseña' },
        'Editar perfil': { en: 'Edit profile', es: 'Editar perfil' },
        'Estas informações aparecem no seu perfil público.': { en: 'This information appears on your public profile.', es: 'Esta información aparece en tu perfil público.' },
        'Contato e documento': { en: 'Contact and document', es: 'Contacto y documento' },
        'CPF ou CNPJ': { en: 'CPF or CNPJ', es: 'CPF o CNPJ' },
        'Localização': { en: 'Location', es: 'Ubicación' },
        'Atuação profissional': { en: 'Professional practice', es: 'Actuación profesional' },
        'Apresentação profissional': { en: 'Professional introduction', es: 'Presentación profesional' },
        'Ao desativar, seu perfil deixa de aparecer para as usuárias.': { en: 'If you deactivate, your profile stops appearing to users.', es: 'Al desactivar, tu perfil deja de mostrarse a las usuarias.' },
        'Desativar conta': { en: 'Deactivate account', es: 'Desactivar cuenta' },
        'Prévia do perfil': { en: 'Profile preview', es: 'Vista previa del perfil' },
        'Como a usuária verá você': { en: 'How the user will see you', es: 'Cómo te verá la usuaria' },
        'Verificado': { en: 'Verified', es: 'Verificada' },
        'Tem certeza que deseja desativar sua conta?': { en: 'Are you sure you want to deactivate your account?', es: '¿Seguro que quieres desactivar tu cuenta?' },
        'Sim, desativar': { en: 'Yes, deactivate', es: 'Sí, desactivar' },

        /* ---------- Textos comuns / UI ---------- */
        'Fechar': { en: 'Close', es: 'Cerrar' },
        'Cancelar': { en: 'Cancel', es: 'Cancelar' },
        'Continuar': { en: 'Continue', es: 'Continuar' },
        'Voltar': { en: 'Back', es: 'Volver' },
        'Verificado': { en: 'Verified', es: 'Verificada' },
        'Dúvida rápida': { en: 'Quick question', es: 'Duda rápida' },
        'Presencial': { en: 'In person', es: 'Presencial' },
        'Chat': { en: 'Chat', es: 'Chat' },
        'Outro': { en: 'Other', es: 'Otro' },
        'Selecione': { en: 'Select', es: 'Selecciona' },
        'Salvar': { en: 'Save', es: 'Guardar' },
        'Editar': { en: 'Edit', es: 'Editar' },
        'Excluir': { en: 'Delete', es: 'Eliminar' },
        'Visualizar': { en: 'View', es: 'Visualizar' },
        'Aplicar': { en: 'Apply', es: 'Aplicar' },
        'Limpar': { en: 'Clear', es: 'Limpiar' },
        'Buscar': { en: 'Search', es: 'Buscar' },
        'Novo': { en: 'New', es: 'Nuevo' },
        'Criar': { en: 'Create', es: 'Crear' },
        'Enviar': { en: 'Send', es: 'Enviar' },
        'Próximo': { en: 'Next', es: 'Siguiente' },
        'Anterior': { en: 'Previous', es: 'Anterior' },
        'Concluir': { en: 'Finish', es: 'Finalizar' },
        'Confirmar': { en: 'Confirm', es: 'Confirmar' },
        'Remover': { en: 'Remove', es: 'Eliminar' },
        'Bloquear': { en: 'Block', es: 'Bloquear' },
        'Desbloquear': { en: 'Unblock', es: 'Desbloquear' },
        'Privar': { en: 'Make private', es: 'Hacer privado' },
        'Publicar': { en: 'Publish', es: 'Publicar' },
        'Recusar': { en: 'Reject', es: 'Rechazar' },
        'Aprovar': { en: 'Approve', es: 'Aprobar' },
        'Rascunho': { en: 'Draft', es: 'Borrador' },
        'Publicado': { en: 'Published', es: 'Publicado' },
        'Recusado': { en: 'Rejected', es: 'Rechazado' },
        'Em revisão': { en: 'Under review', es: 'En revisión' },
        'Sem avaliação': { en: 'No rating', es: 'Sin valoración' },
        'JPG ou PNG, até 5MB': { en: 'JPG or PNG, up to 5MB', es: 'JPG o PNG, hasta 5 MB' },
        'JPG ou PNG': { en: 'JPG or PNG', es: 'JPG o PNG' },
        'Nenhum arquivo selecionado': { en: 'No file selected', es: 'Ningún archivo seleccionado' },
        'Prévia da foto': { en: 'Photo preview', es: 'Vista previa de la foto' },
        'Selecione a UF': { en: 'Select state', es: 'Selecciona el estado' },
        'Médica': { en: 'Physician', es: 'Médica' },
        'Enfermeira': { en: 'Nurse', es: 'Enfermera' },
        'Psicóloga': { en: 'Psychologist', es: 'Psicóloga' },
        'Assistente Social': { en: 'Social worker', es: 'Trabajadora social' },
        'CEP não encontrado.': { en: 'ZIP code not found.', es: 'Código postal no encontrado.' },
        'Médico': { en: 'Physician', es: 'Médico' },
        'Enfermeiro': { en: 'Nurse', es: 'Enfermero' },
        'Psicologo': { en: 'Psychologist', es: 'Psicólogo' },

        /* Textos já existentes (mantidos) */
        'Principal': { en: 'Main', es: 'Principal' },
        'Gestão': { en: 'Management', es: 'Gestión' },
        'Conta': { en: 'Account', es: 'Cuenta' },
        'Painel': { en: 'Dashboard', es: 'Panel' },
        'Caixa de Entrada': { en: 'Inbox', es: 'Bandeja de entrada' },
        'Agenda': { en: 'Schedule', es: 'Agenda' },
        'Pacientes': { en: 'Patients', es: 'Pacientes' },
        'Conteúdos': { en: 'Content', es: 'Contenidos' },
        'Relatórios': { en: 'Reports', es: 'Informes' },
        'Fórum': { en: 'Forum', es: 'Foro' },
        'Aprender': { en: 'Learn', es: 'Aprender' },
        'Meu Perfil': { en: 'My Profile', es: 'Mi perfil' },
        'Configurações': { en: 'Settings', es: 'Configuración' },
        'Suporte': { en: 'Support', es: 'Soporte' },
        'Sair': { en: 'Log out', es: 'Salir' },
        'Buscar atendimentos, pacientes...': { en: 'Search appointments, patients...', es: 'Buscar atenciones, pacientes...' },
        'Foto do profissional': { en: 'Professional photo', es: 'Foto del profesional' },
        'Bem vinda(o),': { en: 'Welcome,', es: 'Bienvenida(o),' },
        'Portal do<br>Profissional': { en: 'Professional<br>Portal', es: 'Portal del<br>Profesional' },
        'Preferências da conta, segurança e aparência.': { en: 'Account, security and appearance preferences.', es: 'Preferencias de cuenta, seguridad y apariencia.' },
        'E-mail de login': { en: 'Login email', es: 'Correo de inicio de sesión' },
        'Alterar senha': { en: 'Change password', es: 'Cambiar contraseña' },
        'Sessões ativas': { en: 'Active sessions', es: 'Sesiones activas' },
        'Este dispositivo': { en: 'This device', es: 'Este dispositivo' },
        'São Paulo, SP · Ativo agora': { en: 'São Paulo, SP · Active now', es: 'São Paulo, SP · Activo ahora' },
        'São Paulo, SP · Há 2 horas': { en: 'São Paulo, SP · 2 hours ago', es: 'São Paulo, SP · Hace 2 horas' },
        'Encerrar sessão': { en: 'End session', es: 'Cerrar sesión' },
        'dispositivo': { en: 'device', es: 'dispositivo' },
        'dispositivos': { en: 'devices', es: 'dispositivos' },
        'Verificação de duas etapas': { en: 'Two-step verification', es: 'Verificación en dos pasos' },
        'Proteja sua conta com uma camada extra': { en: 'Protect your account with an extra layer', es: 'Protege tu cuenta con una capa adicional' },
        'Alertas de acesso': { en: 'Access alerts', es: 'Alertas de acceso' },
        'Receber avisos em novos dispositivos': { en: 'Get notified about new devices', es: 'Recibir avisos en nuevos dispositivos' },
        'Aparência': { en: 'Appearance', es: 'Apariencia' },
        'Claro': { en: 'Light', es: 'Claro' },
        'Escuro': { en: 'Dark', es: 'Oscuro' },
        'Idioma': { en: 'Language', es: 'Idioma' },
        'Zona de Risco': { en: 'Danger Zone', es: 'Zona de riesgo' },
        'A exclusão da conta é permanente e exige confirmação de duas etapas.': { en: 'Deleting your account is permanent and requires two-step confirmation.', es: 'La eliminación de la cuenta es permanente y requiere confirmación en dos pasos.' },
        'Excluir conta': { en: 'Delete account', es: 'Eliminar cuenta' },
        'Excluir conta?': { en: 'Delete account?', es: '¿Eliminar cuenta?' },
        'Essa ação é permanente. Todos os dados associados à sua conta serão processados conforme a política de privacidade.': { en: 'This action is permanent. All data associated with your account will be handled according to the privacy policy.', es: 'Esta acción es permanente. Todos los datos asociados a tu cuenta se tratarán conforme a la política de privacidad.' },
        'Visão geral das suas atividades hoje.': { en: 'Overview of your activity today.', es: 'Resumen de tu actividad de hoy.' },
        '+ Definir disponibilidade': { en: '+ Set availability', es: '+ Definir disponibilidad' },
        'Consultas hoje': { en: 'Appointments today', es: 'Consultas hoy' },
        '+2 em relação a ontem': { en: '+2 compared to yesterday', es: '+2 respecto a ayer' },
        'Mensagens pendentes': { en: 'Pending messages', es: 'Mensajes pendientes' },
        '2 aguardando há +2h': { en: '2 waiting for over 2h', es: '2 esperando hace más de 2 h' },
        'Avaliação média': { en: 'Average rating', es: 'Valoración media' },
        'Usuárias atendidas': { en: 'Users served', es: 'Usuarias atendidas' },
        '+18 esta semana': { en: '+18 this week', es: '+18 esta semana' },
        'Atendimentos da semana': { en: 'Appointments this week', es: 'Atenciones de la semana' },
        'Esta semana comparada à semana passada': { en: 'This week compared to last week', es: 'Esta semana comparada con la semana pasada' },
        'Assuntos mais procurados': { en: 'Most searched topics', es: 'Temas más buscados' },
        'Temas das dúvidas das usuárias': { en: 'Topics of users\' questions', es: 'Temas de las dudas de las usuarias' },
        'Próximos atendimentos': { en: 'Upcoming appointments', es: 'Próximas atenciones' },
        'Ver agenda': { en: 'View schedule', es: 'Ver agenda' },
        'Ver todas': { en: 'View all', es: 'Ver todas' },
        'Consulta de rotina': { en: 'Routine checkup', es: 'Consulta de rutina' },
        'Primeira consulta': { en: 'First appointment', es: 'Primera consulta' },
        'Retorno': { en: 'Follow-up', es: 'Seguimiento' },
        'Consulta por chat': { en: 'Chat consultation', es: 'Consulta por chat' },
        'Agendada': { en: 'Scheduled', es: 'Agendada' },
        'Entrar': { en: 'Join', es: 'Entrar' },
        'Fila de dúvidas rápidas': { en: 'Quick question queue', es: 'Cola de dudas rápidas' },
        'Aguardando resposta': { en: 'Awaiting reply', es: 'Esperando respuesta' },
        'Atendimentos por dia': { en: 'Appointments per day', es: 'Atenciones por día' },
        'Últimos 20 dias': { en: 'Last 20 days', es: 'Últimos 20 días' },
        'Clique em uma barra para ampliar · duplo clique para voltar.': { en: 'Click a bar to zoom in · double-click to go back.', es: 'Haz clic en una barra para ampliar · doble clic para volver.' },
        'Evolução na semana': { en: 'Weekly trend', es: 'Evolución en la semana' },
        'Avaliações recentes': { en: 'Recent reviews', es: 'Valoraciones recientes' },
        '"Me senti acolhida e consegui entender minhas opções sem julgamento."': { en: '"I felt welcomed and was able to understand my options without judgment."', es: '"Me sentí acogida y pude entender mis opciones sin juicios."' },
        '"Resposta clara e rápida. Muito obrigada."': { en: '"Clear and quick answer. Thank you so much."', es: '"Respuesta clara y rápida. Muchas gracias."' },
        'Semana passada': { en: 'Last week', es: 'Semana pasada' },
        'Esta semana': { en: 'This week', es: 'Esta semana' },
        'Assuntos': { en: 'Topics', es: 'Temas' },
        'Saúde sexual': { en: 'Sexual health', es: 'Salud sexual' },
        'Exames': { en: 'Tests', es: 'Exámenes' },
        'Ciclo menstrual': { en: 'Menstrual cycle', es: 'Ciclo menstrual' },
        'Pré-natal': { en: 'Prenatal', es: 'Prenatal' },
        'Anticoncepção': { en: 'Contraception', es: 'Anticoncepción' },
        'Dia': { en: 'Day', es: 'Día' },
        'atendimentos': { en: 'appointments', es: 'atenciones' },
        'Seg': { en: 'Mon', es: 'Lun' },
        'Ter': { en: 'Tue', es: 'Mar' },
        'Qua': { en: 'Wed', es: 'Mié' },
        'Qui': { en: 'Thu', es: 'Jue' },
        'Sex': { en: 'Fri', es: 'Vie' },
        'Sáb': { en: 'Sat', es: 'Sáb' },
        'Dom': { en: 'Sun', es: 'Dom' },
        'Dados públicos exibidos para as usuárias.': { en: 'Public information shown to users.', es: 'Datos públicos que se muestran a las usuarias.' },
        'Trocar foto': { en: 'Change photo', es: 'Cambiar foto' },
        'JPG ou PNG, até 5MB': { en: 'JPG or PNG, up to 5MB', es: 'JPG o PNG, hasta 5 MB' },
        'Trocar senha': { en: 'Change password', es: 'Cambiar contraseña' },
        'Editar perfil': { en: 'Edit profile', es: 'Editar perfil' },
        'Estas informações aparecem no seu perfil público.': { en: 'This information appears on your public profile.', es: 'Esta información aparece en tu perfil público.' },
        'Contato e documento': { en: 'Contact and ID', es: 'Contacto y documento' },
        'Email': { en: 'Email', es: 'Correo electrónico' },
        'Telefone': { en: 'Phone', es: 'Teléfono' },
        'CPF ou CNPJ': { en: 'CPF or CNPJ', es: 'CPF o CNPJ' },
        'Localização': { en: 'Location', es: 'Ubicación' },
        'CEP': { en: 'ZIP code', es: 'Código postal (CEP)' },
        'UF': { en: 'State', es: 'Estado (UF)' },
        'País': { en: 'Country', es: 'País' },
        'Cidade': { en: 'City', es: 'Ciudad' },
        'Atuação profissional': { en: 'Professional practice', es: 'Actuación profesional' },
        'Categoria profissional': { en: 'Professional category', es: 'Categoría profesional' },
        'Especialidade': { en: 'Specialty', es: 'Especialidad' },
        'Apresentação profissional': { en: 'Professional introduction', es: 'Presentación profesional' },
        'Ao desativar, seu perfil deixa de aparecer para as usuárias.': { en: 'If you deactivate, your profile stops appearing to users.', es: 'Al desactivar, tu perfil deja de mostrarse a las usuarias.' },
        'Desativar conta': { en: 'Deactivate account', es: 'Desactivar cuenta' },
        'Prévia do perfil': { en: 'Profile preview', es: 'Vista previa del perfil' },
        'Como a usuária verá você': { en: 'How users will see you', es: 'Cómo te verá la usuaria' },
        'Tem certeza que deseja desativar sua conta?': { en: 'Are you sure you want to deactivate your account?', es: '¿Seguro que quieres desactivar tu cuenta?' },
        'Sim, desativar': { en: 'Yes, deactivate', es: 'Sí, desactivar' },
        'Médico': { en: 'Physician', es: 'Médico' },
        'Enfermeiro': { en: 'Nurse', es: 'Enfermero' },
        'Psicologo': { en: 'Psychologist', es: 'Psicólogo' },
        'Assistente Social': { en: 'Social worker', es: 'Trabajador social' },
        'Editar Perfil': { en: 'Edit Profile', es: 'Editar perfil' },
        'Atualize seus dados públicos e profissionais.': { en: 'Update your public and professional details.', es: 'Actualiza tus datos públicos y profesionales.' },
        'Salvar alterações': { en: 'Save changes', es: 'Guardar cambios' },
        'Dados pessoais e profissionais': { en: 'Personal and professional details', es: 'Datos personales y profesionales' },
        'Essas informações aparecem no seu perfil público.': { en: 'This information appears on your public profile.', es: 'Esta información aparece en tu perfil público.' },
        'Foto de perfil': { en: 'Profile photo', es: 'Foto de perfil' },
        'JPG ou PNG': { en: 'JPG or PNG', es: 'JPG o PNG' },
        'Nenhum arquivo selecionado': { en: 'No file selected', es: 'Ningún archivo seleccionado' },
        'Prévia da foto': { en: 'Photo preview', es: 'Vista previa de la foto' },
        'Nome': { en: 'Name', es: 'Nombre' },
        'E-mail': { en: 'Email', es: 'Correo electrónico' },
        'Categoria': { en: 'Category', es: 'Categoría' },
        'Apresentação': { en: 'Introduction', es: 'Presentación' },
        'Selecione a UF': { en: 'Select state', es: 'Selecciona el estado' },
        'Médica': { en: 'Physician', es: 'Médica' },
        'Enfermeira': { en: 'Nurse', es: 'Enfermera' },
        'Psicóloga': { en: 'Psychologist', es: 'Psicóloga' },
        'CEP não encontrado.': { en: 'ZIP code not found.', es: 'Código postal no encontrado.' },
        'Encontre respostas ou fale com a equipe gestora.': { en: 'Find answers or contact the management team.', es: 'Encuentra respuestas o contacta al equipo de gestión.' },
        'Como podemos ajudar?': { en: 'How can we help?', es: '¿Cómo podemos ayudar?' },
        'Buscar na central de ajuda...': { en: 'Search help center...', es: 'Buscar en el centro de ayuda...' },
        'Conta e verificação': { en: 'Account and verification', es: 'Cuenta y verificación' },
        'Publicação de conteúdo': { en: 'Content publishing', es: 'Publicación de contenido' },
        'Fale com a equipe': { en: 'Contact the team', es: 'Habla con el equipo' },
        'Tem alguma dúvida ou situação que não conseguiu resolver? Nossa equipe está pronta para te ajudar.': { en: 'Have any questions or issues you couldn\'t resolve? Our team is ready to help.', es: '¿Tienes alguna duda o situación que no pudiste resolver? Nuestro equipo está listo para ayudarte.' },
        'Iniciar atendimento': { en: 'Start chat', es: 'Iniciar atención' },
        'Atendimento online': { en: 'Online support', es: 'Atención en línea' },
        'Seg a Sex · 8h às 18h': { en: 'Mon to Fri · 8am to 6pm', es: 'Lun a Vie · 8h a 18h' },
        'Perguntas frequentes': { en: 'Frequently asked questions', es: 'Preguntas frecuentes' },
        'Ver todas': { en: 'View all', es: 'Ver todas' },
        'Como redefinir minha senha?': { en: 'How to reset my password?', es: '¿Cómo restablecer mi contraseña?' },
        'Em Meu Perfil, clique em "Trocar senha" e siga as instruções. Se esqueceu a senha, use "Esqueci minha senha" na tela de login.': { en: 'In My Profile, click "Change password" and follow the instructions. If you forgot your password, use "Forgot password" on the login screen.', es: 'En Mi Perfil, haz clic en "Cambiar contraseña" y sigue las instrucciones. Si olvidaste tu contraseña, usa "Olvidé mi contraseña" en la pantalla de inicio.' },
        'Como alterar meus dados?': { en: 'How to change my data?', es: '¿Cómo cambiar mis datos?' },
        'Acesse Meu Perfil e clique em "Editar perfil". Depois de ajustar as informações, é só salvar as alterações.': { en: 'Access My Profile and click "Edit profile". After adjusting the information, just save the changes.', es: 'Accede a Mi Perfil y haz clic en "Editar perfil". Después de ajustar la información, solo guarda los cambios.' },
        'Como funciona a agenda?': { en: 'How does the schedule work?', es: '¿Cómo funciona la agenda?' },
        'Na Agenda você define sua disponibilidade e acompanha os atendimentos marcados pelas usuárias.': { en: 'In the Schedule you set your availability and track appointments booked by users.', es: 'En la Agenda defines tu disponibilidad y sigues las atenciones agendadas por las usuarias.' },
        'Como publicar conteúdos na plataforma?': { en: 'How to publish content on the platform?', es: '¿Cómo publicar contenido en la plataforma?' },
        'Em Conteúdos, crie uma nova publicação e envie para análise. Após a aprovação da equipe, ela fica disponível.': { en: 'In Content, create a new publication and send it for review. After team approval, it becomes available.', es: 'En Contenidos, crea una nueva publicación y envíala para revisión. Tras la aprobación del equipo, queda disponible.' },
        'Como acessar meus laudos e relatórios?': { en: 'How to access my reports?', es: '¿Cómo acceder a mis informes?' },
        'Os relatórios ficam disponíveis no menu Relatórios, organizados por período de atendimento.': { en: 'Reports are available in the Reports menu, organized by appointment period.', es: 'Los informes están disponibles en el menú Informes, organizados por período de atención.' },
        'Status dos serviços': { en: 'Service status', es: 'Estado de los servicios' },
        'Plataforma Vênus': { en: 'Vênus Platform', es: 'Plataforma Vênus' },
        'Operacional': { en: 'Operational', es: 'Operativo' },
        'Publicações': { en: 'Publications', es: 'Publicaciones' },
        'Notificações': { en: 'Notifications', es: 'Notificaciones' },
        'Última atualização': { en: 'Last updated', es: 'Última actualización' },
        'Canais de atendimento': { en: 'Support channels', es: 'Canales de atención' },
        'Chat online': { en: 'Online chat', es: 'Chat en línea' },
        'Atendimento em tempo real': { en: 'Real-time support', es: 'Atención en tiempo real' },
        'E-mail': { en: 'Email', es: 'Correo electrónico' },
        'Telefone': { en: 'Phone', es: 'Teléfono' },
        'Vênus • A Saúde da Mulher': { en: 'Vênus • Women\'s Health', es: 'Vênus • Salud de la Mujer' },
        'Relatório de Impacto': { en: 'Impact Report', es: 'Informe de Impacto' },
        'Acompanhe o seu desempenho e o impacto do seu atendimento na plataforma.': { en: 'Track your performance and the impact of your care on the platform.', es: 'Sigue tu desempeño y el impacto de tu atención en la plataforma.' },
        'Exportar PDF': { en: 'Export PDF', es: 'Exportar PDF' },
        '7 dias': { en: '7 days', es: '7 días' },
        '30 dias': { en: '30 days', es: '30 días' },
        '90 dias': { en: '90 days', es: '90 días' },
        'Personalizado': { en: 'Custom', es: 'Personalizado' },
        'De': { en: 'From', es: 'Desde' },
        'Até': { en: 'To', es: 'Hasta' },
        'Publicação de conteúdo': { en: 'Content publishing', es: 'Publicación de contenido' },
        'Crie artigos, vídeos e infográficos para a revisão editorial.': { en: 'Create articles, videos and infographics for editorial review.', es: 'Crea artículos, videos e infografías para revisión editorial.' },
        '+ Criar novo conteúdo': { en: '+ Create new content', es: '+ Crear nuevo contenido' },
        'Todos': { en: 'All', es: 'Todos' },
        'Rascunhos': { en: 'Drafts', es: 'Borradores' },
        'Em Revisão': { en: 'Under review', es: 'En revisión' },
        'Publicados': { en: 'Published', es: 'Publicados' },
        'Recusados': { en: 'Rejected', es: 'Rechazados' },
        'Nenhum conteúdo por aqui ainda': { en: 'No content here yet', es: 'Ningún contenido por aquí aún' },
        'Clique em "Criar novo conteúdo" para escrever seu primeiro material.': { en: 'Click "Create new content" to write your first piece.', es: 'Haz clic en "Crear nuevo contenido" para escribir tu primer material.' },
        'Título': { en: 'Title', es: 'Título' },
        'Ex: Como cuidar da saúde menstrual...': { en: 'Ex: How to care for menstrual health...', es: 'Ej: Cómo cuidar la salud menstrual...' },
        'Categoria': { en: 'Category', es: 'Categoría' },
        'Formato': { en: 'Format', es: 'Formato' },
        'Conteúdo': { en: 'Content', es: 'Contenido' },
        'Escreva um conteúdo educativo...': { en: 'Write educational content...', es: 'Escribe contenido educativo...' },
        'Salvar rascunho': { en: 'Save draft', es: 'Guardar borrador' },
        'Enviar para revisão': { en: 'Submit for review', es: 'Enviar para revisión' },
        'Novo conteúdo': { en: 'New content', es: 'Nuevo contenido' },
        'O conteúdo será enviado para a revisão editorial antes de ser publicado.': { en: 'The content will be sent for editorial review before being published.', es: 'El contenido se enviará para revisión editorial antes de publicarse.' },
        'Editar conteúdo': { en: 'Edit content', es: 'Editar contenido' },
        'Rascunho: continue editando ou envie para a revisão editorial.': { en: 'Draft: keep editing or submit for editorial review.', es: 'Borrador: sigue editando o envía para revisión editorial.' },
        'Publicado: ao privar, o conteúdo deixa de ser público e volta a ser rascunho.': { en: 'Published: when made private, the content stops being public and returns to draft.', es: 'Publicado: al privar, el contenido deja de ser público y vuelve a borrador.' },
        'Recusado: ajuste o conteúdo e envie novamente para a revisão.': { en: 'Rejected: adjust the content and submit again for review.', es: 'Rechazado: ajusta el contenido y envíalo de nuevo para revisión.' },
        'Em revisão: a equipe editorial está analisando, por isso a edição está bloqueada.': { en: 'Under review: the editorial team is analyzing, so editing is blocked.', es: 'En revisión: el equipo editorial está analizando, por eso la edición está bloqueada.' },
        'Privar conteúdo': { en: 'Make private', es: 'Hacer privado' },
        'Manter como rascunho': { en: 'Keep as draft', es: 'Mantener como borrador' },
        'Salvar como rascunho': { en: 'Save as draft', es: 'Guardar como borrador' },
        'Fechar': { en: 'Close', es: 'Cerrar' },
        'Pacientes': { en: 'Patients', es: 'Pacientes' },
        'Histórico de usuárias atendidas por você.': { en: 'History of users served by you.', es: 'Historial de usuarias atendidas por ti.' },
        'Buscar pacientes...': { en: 'Search patients...', es: 'Buscar pacientes...' },
        'Últimos 7 dias': { en: 'Last 7 days', es: 'Últimos 7 días' },
        'Últimos 30 dias': { en: 'Last 30 days', es: 'Últimos 30 días' },
        'Últimos 90 dias': { en: 'Last 90 days', es: 'Últimos 90 días' },
        'Nenhuma paciente encontrada': { en: 'No patients found', es: 'Ninguna paciente encontrada' },
        'Quando você concluir atendimentos, as usuárias atendidas aparecerão aqui.': { en: 'When you complete appointments, the served users will appear here.', es: 'Cuando completes atenciones, las usuarias atendidas aparecerán aquí.' },
        'Nenhum atendimento nesse período. Tente outro filtro.': { en: 'No appointments in this period. Try another filter.', es: 'Ninguna atención en este período. Prueba otro filtro.' },
        'Nome / Apelido': { en: 'Name / Nickname', es: 'Nombre / Apodo' },
        'Último atendimento': { en: 'Last appointment', es: 'Última atención' },
        'Consultas': { en: 'Appointments', es: 'Consultas' },
        'Status': { en: 'Status', es: 'Estado' },
        'Ver histórico': { en: 'View history', es: 'Ver historial' },
        'Nenhuma paciente encontrada com esse nome.': { en: 'No patient found with that name.', es: 'Ninguna paciente encontrada con ese nombre.' },
        'Paciente': { en: 'Patient', es: 'Paciente' },
        'Tipo': { en: 'Type', es: 'Tipo' },
        'Data': { en: 'Date', es: 'Fecha' },
        'Descrição': { en: 'Description', es: 'Descripción' },
        'Fechar histórico': { en: 'Close history', es: 'Cerrar historial' },
        'Sem avaliação': { en: 'No rating', es: 'Sin valoración' },
        'Agenda e disponibilidade': { en: 'Schedule and availability', es: 'Agenda y disponibilidad' },
        'Gestão dos horários em que o profissional está disponível para atendimento.': { en: 'Management of hours when the professional is available for appointments.', es: 'Gestión de horarios en que el profesional está disponible para atenciones.' },
        '+ Bloquear horário': { en: '+ Block time slot', es: '+ Bloquear horario' },
        'Semana anterior': { en: 'Previous week', es: 'Semana anterior' },
        'Próxima semana': { en: 'Next week', es: 'Próxima semana' },
        'Hoje': { en: 'Today', es: 'Hoy' },
        'Disponível': { en: 'Available', es: 'Disponible' },
        'Ocupado': { en: 'Busy', es: 'Ocupado' },
        'Bloqueado': { en: 'Blocked', es: 'Bloqueado' },
        'Horário': { en: 'Time', es: 'Hora' },
        'Nenhum horário de atendimento configurado': { en: 'No appointment hours configured', es: 'Ningún horario de atención configurado' },
        'Quando seus dias e horários de atendimento forem cadastrados, eles aparecerão aqui.': { en: 'When your appointment days and hours are registered, they will appear here.', es: 'Cuando se registren tus días y horarios de atención, aparecerán aquí.' },
        'Bloquear horário': { en: 'Block time slot', es: 'Bloquear horario' },
        'Escolha o período que ficará indisponível para novos atendimentos.': { en: 'Choose the period that will be unavailable for new appointments.', es: 'Elige el período que estará no disponible para nuevas atenciones.' },
        'Data': { en: 'Date', es: 'Fecha' },
        'Motivo': { en: 'Reason', es: 'Motivo' },
        'Início': { en: 'Start', es: 'Inicio' },
        'Fim': { en: 'End', es: 'Fin' },
        'Cancelar': { en: 'Cancel', es: 'Cancelar' },
        'Bloquear horário': { en: 'Block time slot', es: 'Bloquear horario' },
        'Horário bloqueado': { en: 'Blocked time slot', es: 'Horario bloqueado' },
        'Este período está indisponível para novos atendimentos.': { en: 'This period is unavailable for new appointments.', es: 'Este período no está disponible para nuevas atenciones.' },
        'Período': { en: 'Period', es: 'Período' },
        'Fechar': { en: 'Close', es: 'Cerrar' },
        'Remover bloqueio': { en: 'Remove block', es: 'Eliminar bloqueo' },
        'Atendimento': { en: 'Appointment', es: 'Atención' },
        'Detalhes do atendimento marcado neste horário.': { en: 'Details of the appointment scheduled at this time.', es: 'Detalles de la atención agendada en este horario.' },
        'Paciente': { en: 'Patient', es: 'Paciente' },
        'Horário': { en: 'Time', es: 'Hora' },
        'Editar consulta': { en: 'Edit appointment', es: 'Editar cita' },
        'Caixa de Entrada': { en: 'Inbox', es: 'Bandeja de entrada' },
        'Responda às usuárias que entraram em contato com você, em um único lugar.': { en: 'Reply to users who contacted you, all in one place.', es: 'Responde a las usuarias que te contactaron, todo en un solo lugar.' },
        'Limpar Filtros': { en: 'Clear filters', es: 'Limpiar filtros' },
        'Todas': { en: 'All', es: 'Todas' },
        'Não lidas': { en: 'Unread', es: 'No leídas' },
        'Buscar pelo nome da usuária...': { en: 'Search by user name...', es: 'Buscar por nombre de la usuaria...' },
        'Selecione uma conversa': { en: 'Select a conversation', es: 'Selecciona una conversación' },
        'Escolha uma conversa na lista, ou pesquise pelo nome da usuária, para ver as mensagens.': { en: 'Choose a conversation from the list, or search by user name to see messages.', es: 'Elige una conversación de la lista, o busca por nombre de la usuaria para ver los mensajes.' },
        'Sigilo médico: esta conversa é confidencial e deve ser utilizada exclusivamente para o atendimento.': { en: 'Medical confidentiality: this conversation is confidential and must be used exclusively for the appointment.', es: 'Confidencialidad médica: esta conversación es confidencial y debe usarse exclusivamente para la atención.' },
        'Digite sua mensagem…': { en: 'Type your message…', es: 'Escribe tu mensaje…' },
        'Você:': { en: 'You:', es: 'Tú:' },
        'Meu Perfil': { en: 'My Profile', es: 'Mi perfil' },
        'Dados públicos exibidos para as usuárias.': { en: 'Public data shown to users.', es: 'Datos públicos que se muestran a las usuarias.' },
        'Trocar foto': { en: 'Change photo', es: 'Cambiar foto' },
        'JPG ou PNG, até 5MB': { en: 'JPG or PNG, up to 5MB', es: 'JPG o PNG, hasta 5 MB' },
        'Trocar senha': { en: 'Change password', es: 'Cambiar contraseña' },
        'Editar perfil': { en: 'Edit profile', es: 'Editar perfil' },
        'Estas informações aparecem no seu perfil público.': { en: 'This information appears on your public profile.', es: 'Esta información aparece en tu perfil público.' },
        'Contato e documento': { en: 'Contact and document', es: 'Contacto y documento' },
        'CPF ou CNPJ': { en: 'CPF or CNPJ', es: 'CPF o CNPJ' },
        'Localização': { en: 'Location', es: 'Ubicación' },
        'Atuação profissional': { en: 'Professional practice', es: 'Actuación profesional' },
        'Apresentação profissional': { en: 'Professional introduction', es: 'Presentación profesional' },
        'Ao desativar, seu perfil deixa de aparecer para as usuárias.': { en: 'If you deactivate, your profile stops appearing to users.', es: 'Al desactivar, tu perfil deja de mostrarse a las usuarias.' },
        'Desativar conta': { en: 'Deactivate account', es: 'Desactivar cuenta' },
        'Prévia do perfil': { en: 'Profile preview', es: 'Vista previa del perfil' },
        'Como a usuária verá você': { en: 'How the user will see you', es: 'Cómo te verá la usuaria' },
        'Verificado': { en: 'Verified', es: 'Verificada' },
        'Tem certeza que deseja desativar sua conta?': { en: 'Are you sure you want to deactivate your account?', es: '¿Seguro que quieres desactivar tu cuenta?' },
        'Sim, desativar': { en: 'Yes, deactivate', es: 'Sí, desactivar' },
        'Fechar': { en: 'Close', es: 'Cerrar' },
        'Cancelar': { en: 'Cancel', es: 'Cancelar' },
        'Continuar': { en: 'Continue', es: 'Continuar' },
        'Voltar': { en: 'Back', es: 'Volver' },
        'Verificado': { en: 'Verified', es: 'Verificada' },
        'Dúvida rápida': { en: 'Quick question', es: 'Duda rápida' },
        'Presencial': { en: 'In person', es: 'Presencial' },
        'Chat': { en: 'Chat', es: 'Chat' },
        'Outro': { en: 'Other', es: 'Otro' },
        'Selecione': { en: 'Select', es: 'Selecciona' },
        'Salvar': { en: 'Save', es: 'Guardar' },
        'Editar': { en: 'Edit', es: 'Editar' },
        'Excluir': { en: 'Delete', es: 'Eliminar' },
        'Visualizar': { en: 'View', es: 'Visualizar' },
        'Aplicar': { en: 'Apply', es: 'Aplicar' },
        'Limpar': { en: 'Clear', es: 'Limpiar' },
        'Buscar': { en: 'Search', es: 'Buscar' },
        'Novo': { en: 'New', es: 'Nuevo' },
        'Criar': { en: 'Create', es: 'Crear' },
        'Enviar': { en: 'Send', es: 'Enviar' },
        'Próximo': { en: 'Next', es: 'Siguiente' },
        'Anterior': { en: 'Previous', es: 'Anterior' },
        'Concluir': { en: 'Finish', es: 'Finalizar' },
        'Confirmar': { en: 'Confirm', es: 'Confirmar' },
        'Remover': { en: 'Remove', es: 'Eliminar' },
        'Bloquear': { en: 'Block', es: 'Bloquear' },
        'Desbloquear': { en: 'Unblock', es: 'Desbloquear' },
        'Privar': { en: 'Make private', es: 'Hacer privado' },
        'Publicar': { en: 'Publish', es: 'Publicar' },
        'Recusar': { en: 'Reject', es: 'Rechazar' },
        'Aprovar': { en: 'Approve', es: 'Aprobar' },
        'Rascunho': { en: 'Draft', es: 'Borrador' },
        'Publicado': { en: 'Published', es: 'Publicado' },
        'Recusado': { en: 'Rejected', es: 'Rechazado' },
        'Em revisão': { en: 'Under review', es: 'En revisión' },
        'Sem avaliação': { en: 'No rating', es: 'Sin valoración' },
        'JPG ou PNG, até 5MB': { en: 'JPG or PNG, up to 5MB', es: 'JPG o PNG, hasta 5 MB' },
        'JPG ou PNG': { en: 'JPG or PNG', es: 'JPG o PNG' },
        'Nenhum arquivo selecionado': { en: 'No file selected', es: 'Ningún archivo seleccionado' },
        'Prévia da foto': { en: 'Photo preview', es: 'Vista previa de la foto' },
        'Selecione a UF': { en: 'Select state', es: 'Selecciona el estado' },
        'Médica': { en: 'Physician', es: 'Médica' },
        'Enfermeira': { en: 'Nurse', es: 'Enfermera' },
        'Psicóloga': { en: 'Psychologist', es: 'Psicóloga' },
        'Assistente Social': { en: 'Social worker', es: 'Trabajadora social' },
        'CEP não encontrado.': { en: 'ZIP code not found.', es: 'Código postal no encontrado.' },
        'Médico': { en: 'Physician', es: 'Médico' },
        'Enfermeiro': { en: 'Nurse', es: 'Enfermero' },
        'Psicologo': { en: 'Psychologist', es: 'Psicólogo' },
    };

    /* ==========================================================
       PADRÕES — frases com parte variável
       ========================================================== */
    var PADROES = [
        { re: /^Bem vinda\(o\), (.+)$/, en: 'Welcome, $1', es: 'Bienvenida(o), $1' },
        { re: /^(.+) dispositivos?$/, en: '$1 device(s)', es: '$1 dispositivo(s)' },
        { re: /^Última atualização: (.+)$/, en: 'Last updated: $1', es: 'Última actualización: $1' },
        { re: /^Vênus • A Saúde da Mulher$/, en: 'Vênus • Women\'s Health', es: 'Vênus • Salud de la Mujer' }
    ];

    var BLOCOS = [
        { seletor: '.brand-text', en: 'Professional<br>Portal', es: 'Portal del<br>Profesional' }
    ];

    var ATRIBUTOS = ['placeholder', 'title', 'aria-label', 'alt'];
    var originais = (typeof WeakMap !== 'undefined') ? new WeakMap() : null;
    var tituloOriginal = null;

    function buscar(chave, lang) {
        var entrada = DICIONARIO[chave];
        if (entrada) return entrada[lang] || chave;
        for (var i = 0; i < PADROES.length; i++) {
            var p = PADROES[i];
            if (p.re.test(chave)) return chave.replace(p.re, p[lang] || '$&');
        }
        return null;
    }

    function traduzirTexto(no, lang) {
        var tinha = !!(originais && originais.has(no));
        if (lang === 'pt-BR' && !tinha) return;
        var original = tinha ? originais.get(no) : no.nodeValue;
        var chave = original.trim();
        if (!chave) return;
        var destino = (lang === 'pt-BR') ? chave : buscar(chave, lang);
        if (destino === null) return;
        if (originais && !tinha) originais.set(no, original);
        no.nodeValue = original.replace(chave, function () { return destino; });
    }

    function traduzirAtributos(el, lang) {
        el.__i18n = el.__i18n || {};
        ATRIBUTOS.forEach(function (attr) {
            if (!el.hasAttribute(attr)) return;
            if (!(attr in el.__i18n)) el.__i18n[attr] = el.getAttribute(attr);
            var original = el.__i18n[attr];
            var destino = (lang === 'pt-BR') ? original : buscar(original.trim(), lang);
            el.setAttribute(attr, destino === null ? original : destino);
        });
    }

    function traduzirBlocos(lang) {
        BLOCOS.forEach(function (bloco) {
            document.querySelectorAll(bloco.seletor).forEach(function (el) {
                if (!el.hasAttribute('data-i18n-html')) el.setAttribute('data-i18n-html', el.innerHTML);
                el.innerHTML = (lang === 'pt-BR') ? el.getAttribute('data-i18n-html') : (bloco[lang] || el.getAttribute('data-i18n-html'));
            });
        });
    }

    function traduzirTitulo(lang) {
        if (tituloOriginal === null) tituloOriginal = document.title;
        var partes = tituloOriginal.split(' | ');
        if (lang !== 'pt-BR') {
            var destino = buscar(partes[0].trim(), lang);
            if (destino !== null) partes[0] = destino;
        }
        document.title = partes.join(' | ');
    }

    function nosDeTexto() {
        var passeio = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT, {
            acceptNode: function (no) {
                var pai = no.parentNode && no.parentNode.nodeName;
                if (pai === 'SCRIPT' || pai === 'STYLE' || pai === 'TEXTAREA') return NodeFilter.FILTER_REJECT;
                return NodeFilter.FILTER_ACCEPT;
            }
        });
        var nos = [];
        while (passeio.nextNode()) nos.push(passeio.currentNode);
        return nos;
    }

    function aplicarIdioma() {
        raiz.lang = idioma;
        traduzirTitulo(idioma);
        traduzirBlocos(idioma);
        nosDeTexto().forEach(function (no) { traduzirTexto(no, idioma); });
        document.querySelectorAll('[placeholder],[title],[aria-label],[alt]').forEach(function (el) {
            traduzirAtributos(el, idioma);
        });
    }

    function aplicarTema() {
        raiz.classList.toggle('tema-escuro', tema === 'escuro');
    }

    function avisar(nome, detalhe) {
        document.dispatchEvent(new CustomEvent(nome, { detail: detalhe }));
    }

    aplicarTema();
    raiz.lang = idioma;

    window.Venus = {
        getTema: function () { return tema; },
        getIdioma: function () { return idioma; },
        setTema: function (novo) {
            if (TEMAS.indexOf(novo) === -1) return;
            tema = novo; gravar(CHAVE_TEMA, tema); aplicarTema(); avisar('venus:tema', { tema: tema });
        },
        setIdioma: function (novo) {
            if (IDIOMAS.indexOf(novo) === -1) return;
            idioma = novo; gravar(CHAVE_IDIOMA, idioma); aplicarIdioma(); avisar('venus:idioma', { idioma: idioma });
        },
        t: function (chavePt) {
            if (idioma === 'pt-BR') return chavePt;
            var destino = buscar(String(chavePt).trim(), idioma);
            return destino === null ? chavePt : destino;
        },
        aplicarIdioma: aplicarIdioma,
        semTraducao: function () {
            var faltando = [];
            nosDeTexto().forEach(function (no) {
                var original = (originais && originais.has(no)) ? originais.get(no) : no.nodeValue;
                var chave = original.trim();
                if (!chave || !/[A-Za-zÀ-ÿ]/.test(chave)) return;
                if (buscar(chave, 'en') === null && faltando.indexOf(chave) === -1) faltando.push(chave);
            });
            console.log('Textos sem tradução (' + faltando.length + '):\n- ' + faltando.join('\n- '));
            return faltando;
        }
    };

    document.addEventListener('DOMContentLoaded', function () {
        if (idioma !== 'pt-BR') aplicarIdioma();
    });

    window.addEventListener('storage', function (e) {
        if (e.key === CHAVE_TEMA && TEMAS.indexOf(e.newValue) !== -1) { tema = e.newValue; aplicarTema(); avisar('venus:tema', { tema: tema }); }
        if (e.key === CHAVE_IDIOMA && IDIOMAS.indexOf(e.newValue) !== -1) { idioma = e.newValue; aplicarIdioma(); avisar('venus:idioma', { idioma: idioma }); }
    });
})();