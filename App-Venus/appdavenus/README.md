# App Vênus - pastas reorganizadas

## Estrutura

```
├── App.js
├── index.js
├── app.json / babel.config.js / package.json
├── assets/
├── context/
│   └── AuthContext.js
├── hooks/
│   └── useOnboarding.js
├── navigation/
│   ├── routes.js
│   └── RootNavigator.js
└── screen/
    ├── themes/
    │   ├── theme.js
    │   └── FundoOndas.js
    ├── senhas/
    │   ├── EsqueciSenha.js
    │   └── CriarNovaSenha.js
    ├── perfil/
    │   ├── Perfil.js
    │   └── EditarPerfil.js
    ├── CadastroeLogin/
    │   ├── Login.js
    │   └── Cadastro.js
    ├── Inicio/
    │   ├── Slide1.js
    │   ├── Slide2.js
    │   ├── Slide3.js
    │   └── Inicio.js
    └── home/
        └── Home.js
```

## O que mudou

Só os caminhos de import (`import ... from "..."`), pra bater com as
pastas novas, e o registro dessas telas no `navigation/RootNavigator.js`
(`Login`, `Cadastro`, `EsqueciSenha`, `CriarNovaSenha`, `Perfil`,
`EditarPerfil`, além das que já existiam). Nenhuma lógica, validação ou
chamada de API foi alterada em nenhuma tela.

`theme.js` e `FundoOndas.js` (que são só estilo compartilhado, não lógica)
foram ajustados pra bater com o padrão da imagem que você mandou: fundo
rosa com onda, inputs preenchidos em formato pill (sem borda), botão bem
arredondado. Também completei ali alguns estilos que `Perfil.js`,
`EditarPerfil.js` e `CriarNovaSenha.js` já esperavam mas não existiam no
`theme.js` que veio antes (`commonStyles.centered`, `.logoCircle`,
`.buttonSecondary`, `.buttonSecondaryText`, `.buttonDanger`,
`Colors.danger`, `Colors.success`, `Colors.input`) - sem isso, essas telas
renderizavam sem quebrar, mas com pedaços sem cor/estilo nenhum.

## Testado

`npm install`, `npx expo export --platform web`, e simulação de cliques
reais no bundle final:
`Slide1 → Pular → Inicio → Entrar/Registrar → Login → Esqueceu a senha? →
EsqueciSenha → Voltar para o login → Registre-se aqui. → Cadastro` -
tudo sem erro.

`Perfil.js` e `EditarPerfil.js` ficaram registrados no navigator mas
nenhuma tela ainda navega pra elas (nem Login, nem Cadastro, nem Home) -
isso não fazia parte do que você pediu dessa vez, então não inventei um
link pra elas. Se quiser, me diga de onde a usuária deveria chegar no
Perfil (ex: aba "Perfil" da tab bar da Home) que eu ligo.

## Instalação

```bash
npm install
npx expo start
```
