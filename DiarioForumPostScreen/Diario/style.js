import { StyleSheet } from 'react-native';

const VERMELHO = '#AA1B31';
const ROSA = '#F2AFBC';
const ROSA_CLARO = '#F9CBD6';
const TEXTO = '#333333';
const FRACO = 'rgba(170, 27, 49, 0.45)';
const FUNDO = '#FDF2F5';

export default StyleSheet.create({
  safe: {
    flex: 1,
    backgroundColor: FUNDO,
  },
  scrollContent: {
    paddingTop: 14,
    paddingBottom: 100,
  },

  semana: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    paddingHorizontal: 20,
  },
  dia: {
    alignItems: 'center',
  },
  diaLabel: {
    fontSize: 12,
    fontWeight: '700',
    color: TEXTO,
    marginBottom: 6,
  },
  diaCirculo: {
    width: 28,
    height: 28,
    borderRadius: 14,
    alignItems: 'center',
    justifyContent: 'center',
  },
  diaCheio: {
    backgroundColor: ROSA_CLARO,
  },
  diaTracejado: {
    borderWidth: 1,
    borderColor: VERMELHO,
    borderStyle: 'dashed',
  },
  diaNumero: {
    fontSize: 12,
    color: VERMELHO,
  },
  diaNumeroCheio: {
    color: TEXTO,
    fontWeight: '700',
  },

  cardMenstruacao: {
    height: 175,
    alignItems: 'center',
    justifyContent: 'center',
    marginTop: 10,
  },
  brilho: {
    position: 'absolute',
    width: '100%',
    height: 175,
    resizeMode: 'cover',
  },
  menstruacaoTexto: {
    fontSize: 17,
    color: TEXTO,
  },
  menstruacaoDias: {
    fontSize: 30,
    fontWeight: '800',
    color: TEXTO,
    marginTop: 2,
  },
  botaoInicio: {
    marginTop: 14,
    backgroundColor: VERMELHO,
    paddingHorizontal: 18,
    paddingVertical: 7,
    borderRadius: 16,
  },
  botaoInicioTexto: {
    color: '#FFFFFF',
    fontSize: 11,
    fontWeight: '700',
  },

  secaoTitulo: {
    fontSize: 17,
    fontWeight: '700',
    color: TEXTO,
    paddingHorizontal: 20,
    marginBottom: 10,
  },
  dicasRow: {
    flexDirection: 'row',
    paddingHorizontal: 20,
    gap: 8,
  },
  dicaCard: {
    flex: 1,
    height: 105,
    backgroundColor: '#FFFFFF',
    borderRadius: 12,
    borderWidth: 1,
    borderColor: '#F8DDE4',
    overflow: 'hidden',
  },
  dicaConteudo: {
    flex: 1,
    paddingHorizontal: 6,
    paddingTop: 8,
    paddingBottom: 4,
    alignItems: 'center',
    justifyContent: 'space-around',
  },
  dicaTitulo: {
    fontSize: 10,
    fontWeight: '600',
    color: TEXTO,
    textAlign: 'center',
  },
  dicaImg: {
    width: 46,
    height: 26,
    resizeMode: 'contain',
  },
  dicaBotao: {
    backgroundColor: VERMELHO,
    paddingVertical: 5,
  },
  dicaBotaoTexto: {
    color: '#FFFFFF',
    fontSize: 9,
    fontWeight: '700',
    textAlign: 'center',
  },
  dicaMais: {
    width: 30,
    height: 30,
    borderRadius: 15,
    backgroundColor: VERMELHO,
    alignItems: 'center',
    justifyContent: 'center',
  },

  cardBranco: {
    backgroundColor: '#FFFFFF',
    borderRadius: 16,
    borderWidth: 1,
    borderColor: '#F8DDE4',
    marginHorizontal: 16,
    marginTop: 16,
    paddingVertical: 16,
    paddingHorizontal: 14,
  },
  cardTitulo: {
    fontSize: 15,
    fontWeight: '700',
    color: TEXTO,
    textAlign: 'center',
  },
  cardTituloRosa: {
    color: VERMELHO,
  },

  itensRow: {
    flexDirection: 'row',
    justifyContent: 'space-around',
    marginTop: 14,
  },
  item: {
    width: 92,
    alignItems: 'center',
  },
  itemCirculo: {
    width: 58,
    height: 58,
    borderRadius: 29,
    borderWidth: 2,
    borderColor: VERMELHO,
    backgroundColor: FUNDO,
    alignItems: 'center',
    justifyContent: 'center',
  },
  itemImg: {
    width: 40,
    height: 34,
    resizeMode: 'contain',
  },
  itemImgSolta: {
    width: 48,
    height: 44,
    resizeMode: 'contain',
  },
  itemCheck: {
    position: 'absolute',
    bottom: -2,
    right: -2,
    width: 19,
    height: 19,
    borderRadius: 10,
    backgroundColor: VERMELHO,
    alignItems: 'center',
    justifyContent: 'center',
    borderWidth: 2,
    borderColor: '#FFFFFF',
  },
  itemNome: {
    marginTop: 5,
    fontSize: 10,
    color: TEXTO,
    textAlign: 'center',
  },
  divisoria: {
    height: 1,
    backgroundColor: '#F5E1E7',
    marginTop: 14,
  },

  conhecaCiclo: {
    marginTop: 18,
    fontSize: 12,
    fontWeight: '700',
    color: VERMELHO,
    textAlign: 'center',
  },
  periodo: {
    marginTop: 12,
  },
  periodoTexto: {
    fontSize: 10,
    color: TEXTO,
    marginBottom: 5,
  },
  bolinhasRow: {
    flexDirection: 'row',
    justifyContent: 'space-between',
  },
  bolinha: {
    width: 6,
    height: 6,
    borderRadius: 3,
  },

  saudeTopo: {
    flexDirection: 'row',
    alignItems: 'center',
    gap: 6,
    marginBottom: 4,
  },
  saudeTitulo: {
    fontSize: 16,
    fontWeight: '700',
    color: TEXTO,
  },
  saudeLinha: {
    flexDirection: 'row',
    alignItems: 'center',
    borderTopWidth: 1,
    borderTopColor: '#F5E1E7',
    paddingVertical: 11,
    gap: 10,
  },
  saudeIconeBox: {
    width: 30,
    height: 30,
    borderRadius: 15,
    backgroundColor: FUNDO,
    alignItems: 'center',
    justifyContent: 'center',
  },
  saudeTextos: {
    flex: 1,
  },
  saudeNome: {
    fontSize: 13,
    fontWeight: '700',
    color: VERMELHO,
    marginBottom: 2,
  },
  saudeDetalhe: {
    fontSize: 9,
    color: FRACO,
  },

  bottomNav: {
    position: 'absolute',
    bottom: 0,
    left: 0,
    right: 0,
    flexDirection: 'row',
    justifyContent: 'space-around',
    backgroundColor: '#FFFFFF',
    paddingTop: 8,
    paddingBottom: 12,
    borderTopWidth: 1,
    borderTopColor: '#F8DDE4',
  },
  navItem: {
    alignItems: 'center',
    gap: 2,
  },
  navIcone: {
    width: 24,
    height: 24,
    resizeMode: 'contain',
  },
  navLabel: {
    fontSize: 8,
    color: ROSA,
    fontWeight: '600',
  },
});
