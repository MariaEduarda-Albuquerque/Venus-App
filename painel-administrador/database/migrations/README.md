# Migrations do banco dbvenus

Este pacote contém **60 migrations**, uma para cada tabela do dump enviado, exceto `migrations`.

## Conteúdo

- Cria as tabelas e colunas do schema do dump.
- Preserva tipos, tamanhos, campos `ENUM`, valores padrão, `NULL`, `AUTO_INCREMENT`, chaves primárias, índices, índices únicos e chaves estrangeiras identificadas no SQL.
- Não importa os `INSERT`s do dump: as tabelas serão criadas vazias.
- Não cria a tabela `migrations`, pois o próprio Laravel gerencia essa tabela ao executar `php artisan migrate`.
- A ordem dos arquivos foi organizada para criar primeiro as tabelas referenciadas pelas chaves estrangeiras.

## Como instalar

1. Faça backup do banco e da pasta `database/migrations` do projeto.
2. Copie os arquivos PHP desta pasta para `database/migrations` do Laravel.
3. Confira o `.env` para apontar para o banco correto (`DB_CONNECTION=mysql`, `DB_DATABASE=dbvenus`, usuário e senha correspondentes).
4. Para criar o schema do zero, use um banco vazio e execute:

   ```bash
   php artisan migrate
   ```

**Atenção:** não execute estas migrations sobre um banco que já tenha essas tabelas. Se o projeto já possui migrations antigas que criam as mesmas tabelas, revise/substitua as antigas antes de rodar, para evitar erros de tabela duplicada. Este pacote foi gerado para reconstruir a estrutura, não para atualizar um banco já preenchido.

## Inventário

- Tabelas no dump: 61
- Migrations geradas: 60
- Tabela omitida por ser interna do Laravel: `migrations`

## Ordem de criação

- `cache`
- `cache_locks`
- `categorias`
- `codtipocategoria`
- `failed_jobs`
- `job_batches`
- `jobs`
- `notifications`
- `password_reset_tokens`
- `sessions`
- `tbdatasaude`
- `tbdestaque`
- `tbnotaclinica`
- `tbnotificacao`
- `tbpapel`
- `tbprofissionalsaude`
- `tbservicounidade`
- `tbtipoatendimento`
- `tbtipoconteudo`
- `tbtipodiario`
- `tbunidadesaude`
- `tbusuario`
- `tbverificacaoprofissional`
- `users`
- `tbtrilhaaprendizado`
- `tbadmin`
- `tbatendimento`
- `tbbloqueioagenda`
- `tbchamadosuporte`
- `tbconselho`
- `tbevento`
- `tbdisponibilidadeprofissional`
- `tbunidadeservico`
- `tbavaliacaounidade`
- `tbciclomenstrual`
- `tbconsulta`
- `tbdenuncia`
- `tbdiario`
- `tbexame`
- `tbfeedback`
- `tbforumpublicacao`
- `tbhumordiario`
- `tbinteresseusuario`
- `tblembreteremedio`
- `tbvacina`
- `tbconteudo`
- `tbconteudolog`
- `tbchamadomensagem`
- `tbinscricaoevento`
- `tbsintomaciclo`
- `tbavaliacaoconsulta`
- `tbmensagem`
- `tbdenunciaacao`
- `tbforumreacao`
- `tbforumresposta`
- `tbconteudoadmin`
- `tbconteudosalvo`
- `tbprogressotrilha`
- `tbpublicacao`
- `tbtrilhaconteudo`
