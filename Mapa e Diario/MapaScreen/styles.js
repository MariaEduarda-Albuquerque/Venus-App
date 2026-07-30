// MapaScreen/styles.js
import { StyleSheet } from 'react-native';

export const CORES = {
  fundo: '#FDF4F6',
  bordô: '#AA1B31',
  bordôEscuro: '#781422',
  rosa: '#F2AFBC',
  branco: '#FFFFFF',
  verde: '#52A44B',
  amarelo: '#FAAC3F',
};

export default StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: CORES.fundo,
  },
  scrollContent: {
    paddingBottom: 20,
  },

  // header
  cabecalho: {
    height: 120,
    borderBottomLeftRadius: 20,
    borderBottomRightRadius: 20,
    justifyContent: 'center',
    paddingLeft: 20,
    overflow: 'hidden',
    position: 'relative',
  },
  imagemOndas: {
    position: 'absolute',
    left: 0,
    right: 0,
    bottom: -2,
    width: '100%',
    height: '50%',
    resizeMode: 'cover',
  },
  imagemElipse: {
    position: 'absolute',
    top: -30,
    right: 0,
    width: 110,
    height: 110,
    resizeMode: 'contain',
    zIndex: 0,
  },
  tituloCabecalho: {
    color: '#FFFFFF',
    fontSize: 31,
    fontFamily: 'Nunito_700Bold',
    textAlign: 'left',
    zIndex: 2,
  },


  // ===== BUSCA =====
  buscaContainer: {
    marginHorizontal: 16,
    marginTop: 16,
    flexDirection: 'row',
    alignItems: 'center',
    backgroundColor: 'rgba(248,114,140,0.08)',
    borderWidth: 1,
    borderColor: 'rgba(158,24,43,0.22)',
    borderRadius: 7,
    paddingHorizontal: 12,
    height: 45,
  },
  iconeBusca: {
    width: 20,
    height: 20,
    marginRight: 8,
  },
  inputBusca: {
    flex: 1,
    height: '100%',
    fontSize: 14,
    fontFamily: 'Nunito_700Bold',
    color: CORES.bordôEscuro,
    padding: 4,
    outlineWidth: 0,
    outlineStyle: 'none',
    outlineColor: 'transparent',
    borderWidth: 0,
    WebkitOutline: 'none',
    MozOutline: 'none',
  },

  // ===== FILTROS =====
  filtrosContainer: {
    flexDirection: 'row',
    marginHorizontal: 16,
    marginTop: 12,
    justifyContent: 'space-between',
  },
  botaoFiltro: {
    height: 44,
    flex: 1,
    marginHorizontal: 4,
    borderRadius: 7,
    alignItems: 'center',
    justifyContent: 'center',
    backgroundColor: 'rgba(249,203,214,0)',
    borderWidth: 1,
    borderColor: 'rgba(170,27,49,0.21)',
  },
  botaoFiltroAtivo: {
    backgroundColor: '#AA1B31',
    borderColor: '#AA1B31',
  },
  textoFiltro: {
    fontSize: 13,
    fontFamily: 'Nunito_700Bold',
    color: '#9E182B',
    textAlign: 'center', // os filtros ficam centralizados dentro do botão
  },
  textoFiltroAtivo: {
    color: '#FFFFFF',
  },

  // ===== MAPA =====
  mapaContainer: {
   
    marginTop: 16,
    height: 388,
    backgroundColor: '#C4C4C4',
    borderWidth: 1,
    borderColor: '#000000',
  
    position: 'relative',
    overflow: 'hidden',
  },
  marcador: {
    position: 'absolute',
    width: 30,
    height: 30,
    borderRadius: 15,
    borderWidth: 2,
    borderColor: '#FFFFFF',
    justifyContent: 'center',
    alignItems: 'center',
    shadowColor: '#000',
    shadowOffset: { width: 0, height: 4 },
    shadowOpacity: 0.25,
    shadowRadius: 2,
    elevation: 4,
  },
  marcadorVerde: {
    backgroundColor: '#52A44B',
  },
  marcadorVermelho: {
    backgroundColor: '#AA1B31',
  },
  marcadorAmarelo: {
    backgroundColor: '#FAAC3F',
  },
  marcadorBordo: {
    backgroundColor: '#9E182B',
  },

  // ===== LEGENDA =====
  legendaContainer: {
    flexDirection: 'row',
    justifyContent: 'flex-start', // alinhado à esquerda
    marginHorizontal: 16,
    marginTop: 12,
    gap: 16,
  },
  itemLegenda: {
    flexDirection: 'row',
    alignItems: 'center',
    marginRight: 16,
  },
  bolinhaLegenda: {
    width: 20,
    height: 20,
    borderRadius: 15,
    borderWidth: 2,
    borderColor: '#FFFFFF',
    justifyContent: 'center',
    alignItems: 'center',
    shadowColor: '#000',
    shadowOffset: { width: 0, height: 4 },
    shadowOpacity: 0.25,
    shadowRadius: 2,
    marginRight: 6,
  },
  textoLegendaMapa: {
    fontSize: 13,
    fontFamily: 'Nunito_700Bold',
  },

  // ===== CARD DA UNIDADE =====
  cardUnidade: {
    marginHorizontal: 16,
    marginTop: 16,
    borderWidth: 1,
    borderColor: 'rgba(158,24,43,0.24)',
    borderRadius: 15,
    backgroundColor: 'rgba(255,255,255,0.08)',
    overflow: 'hidden',
  },
  cardHeader: {
    backgroundColor: '#AA1B31',
    paddingVertical: 12,
    paddingHorizontal: 16,
  },
  nomeUnidade: {
    fontSize: 16,
    fontFamily: 'Nunito_700Bold',
    color: '#FFFFFF',
    textAlign: 'left', // alinhado à esquerda
  },
  distanciaUnidade: {
    fontSize: 12,
    fontFamily: 'Nunito_700Bold',
    color: 'rgba(255,255,255,0.68)',
    textAlign: 'left',
    marginTop: 2,
  },
  cardBody: {
    paddingHorizontal: 16,
    paddingVertical: 12,
  },
  horarioUnidade: {
    fontSize: 12,
    fontFamily: 'Nunito_700Bold',
    color: '#781222',
    textAlign: 'left',
  },
  telefoneUnidade: {
    fontSize: 12,
    fontFamily: 'Nunito_700Bold',
    color: '#781222',
    textAlign: 'left',
    marginTop: 2,
  },

  // Lotação
  lotacaoContainer: {
    marginTop: 8,
    alignItems: 'flex-start', // alinhado à esquerda
  },
  lotacaoTitulo: {
    fontSize: 10,
    fontFamily: 'Nunito_700Bold',
    color: '#781222',
    textAlign: 'left',
  },
  barraLotacao: {
    flexDirection: 'row',
    marginTop: 4,
    height: 7,
  },
  barraSegmento: {
    width: 44,
    height: 7,
    borderRadius: 33,
    marginHorizontal: 2,
  },
  barraCheia: {
    backgroundColor: '#4BA45B',
  },
  barraVazia: {
    backgroundColor: 'rgba(249,203,214,0.6)',
  },
  statusLotacao: {
    fontSize: 10,
    fontFamily: 'Nunito_700Bold',
    color: '#4BA45B',
    marginTop: 4,
    textAlign: 'left',
  },

  // Serviços (chips) – alinhados à esquerda
  servicosContainer: {
    flexDirection: 'row',
    flexWrap: 'wrap',
    justifyContent: 'flex-start', // alinhado à esquerda
    marginTop: 8,
  },
  chipServico: {
    backgroundColor: 'rgba(248,114,140,0.35)',
    borderRadius: 15,
    paddingHorizontal: 10,
    paddingVertical: 4,
    margin: 4,
  },
  textoChipServico: {
    fontSize: 10,
    fontFamily: 'Nunito_700Bold',
    color: '#AA1B31',
    textAlign: 'left',
  },

  // Botões ação – centralizados apenas os textos dentro dos botões
  botoesContainer: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    paddingHorizontal: 16,
    paddingVertical: 16,
    marginBottom: 8,
  },
  botaoRota: {
    backgroundColor: '#AA1B31',
    borderRadius: 15,
    height: 39,
    width: '48%',
    alignItems: 'center',
    justifyContent: 'center',
    borderWidth: 1,
    borderColor: 'rgba(158,24,43,0.24)',
  },
  botaoLigar: {
    backgroundColor: '#FFFFFF',
    borderRadius: 15,
    height: 39,
    width: '48%',
    alignItems: 'center',
    justifyContent: 'center',
    borderWidth: 1,
    borderColor: 'rgba(170,27,49,0.39)',
  },
  textoBotaoRota: {
    fontSize: 13,
    fontFamily: 'Nunito_700Bold',
    color: '#FFFFFF',
    textAlign: 'center',
  },
  textoBotaoLigar: {
    fontSize: 13,
    fontFamily: 'Nunito_700Bold',
    color: '#AA1B31',
    textAlign: 'center',
  },

  // ===== FOOTER =====
  footer: {
    marginTop: 20,
    borderTopLeftRadius: 16,
    borderTopRightRadius: 16,
    backgroundColor: 'rgba(255,255,255,0.5)',
    height: 78,
    flexDirection: 'row',
    justifyContent: 'space-around',
    alignItems: 'center',
    paddingHorizontal: 16,
  },
  itemNav: {
    alignItems: 'center',
    justifyContent: 'center',
  },
  iconeNav: {
    width: 48,
    height: 48,
  },
  textoNav: {
    fontFamily: 'Nunito_700Bold',
    fontSize: 12,
    color: '#BBBBBB',
    marginTop: 2,
    textAlign: 'center',
  },
});