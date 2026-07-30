
import { StyleSheet, Dimensions } from 'react-native';

const { width } = Dimensions.get('window');

export const CORES = {
  fundo: '#FDF4F6',
  bordô: '#AA1B31',
  bordôEscuro: '#781422',
  rosa: '#F2AFBC',
  branco: '#FFFFFF',
};

export default StyleSheet.create({
 
  seguro: {
    flex: 1,
    backgroundColor: '#FDF4F6',
  },
  conteudoScroll: {
    paddingBottom: 0,
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

  // barra superior
  abas: {
    height: 53,
    marginHorizontal: 15,
    borderBottomWidth: 3,
    borderBottomColor: '#F2C4CD',
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
  },
  botaoAba: {
    width: '25%',
    height: '100%',
    alignItems: 'center',
    justifyContent: 'center',
  },
  abaInterna: {
    alignItems: 'center',
    justifyContent: 'center',
    height: '100%',
  },
  textoAba: {
    color: '#781422',
    fontSize: 15,
    fontFamily: 'Nunito_700Bold',
  },
  textoAbaAtivo: {
    color: '#AA1B31',
  },
  sublinhadoAba: {
    position: 'absolute',
    bottom: -2,
    height: 3,
    width: '150%',
    backgroundColor: '#AA1B31',
    borderRadius: 2,
  },
  conteudo: {
    paddingTop: 17,
  },

  // ciclo
  cardRastreador: {
    marginHorizontal: 15,
    borderWidth: 1,
    borderColor: CORES.rosa,
    borderRadius: 10,
    paddingHorizontal: 12,
    paddingTop: 12,
    paddingBottom: 16,
    backgroundColor: 'rgba(242,175,188,0.10)',
  },
  tituloRastreador: {
    color: CORES.bordô,
    fontSize: 13,
    fontFamily: 'Nunito_700Bold',
    textAlign: 'center',
    marginBottom: 10,
  },
  calendario: {
    width: '100%',
  },
  linhaCalendario: {
    flexDirection: 'row',
    width: '100%',
    marginBottom: 2,
  },
  celulaCalendario: {
    width: '14.2857%',
    height: 24,
    alignItems: 'center',
    justifyContent: 'center',
  },
  textoDiaSemana: {
    color: 'rgba(170,27,49,0.57)',
    fontSize: 10,
    fontFamily: 'Nunito_700Bold',
  },
  caixaDia: {
    width: '92%',
    height: 24,
    borderRadius: 4,
    alignItems: 'center',
    justifyContent: 'center',
  },
  textoDia: {
    color: '#000000',
    fontSize: 12,
    fontFamily: 'Nunito_700Bold',
  },
  diaMenstruacao: {
    backgroundColor: '#E8B8C1',
  },
  textoDiaMenstruacao: {
    color: '#AA1B31',
  },
  diaFertil: {
    backgroundColor: '#D4E2D7',
  },
  textoDiaFertil: {
    color: '#4BA45B',
  },
  diaDestaque: {
    backgroundColor: '#AA1B31',
  },
  textoDiaDestaque: {
    color: '#FFFFFF',
  },
  legenda: {
    flexDirection: 'row',
    justifyContent: 'center',
    alignItems: 'center',
    flexWrap: 'wrap',
    marginTop: 10,
    marginBottom: 13,
  },
  itemLegenda: {
    flexDirection: 'row',
    alignItems: 'center',
    marginHorizontal: 4,
    marginVertical: 2,
  },
  bolaLegenda: {
    width: 13,
    height: 13,
    borderRadius: 7,
    marginRight: 3,
  },
  textoLegenda: {
    fontSize: 10,
    fontFamily: 'Nunito_700Bold',
  },
  botaoPeriodo: {
    height: 41,
    borderRadius: 15,
    backgroundColor: CORES.bordô,
    justifyContent: 'center',
    alignItems: 'center',
  },
  textoBotaoPeriodo: {
    color: CORES.branco,
    fontSize: 11,
    fontFamily: 'Nunito_900Black',
  },
  caixaCiclo: {
    marginTop: 18,
    padding: 9,
    minHeight: 83,
    borderRadius: 10,
    backgroundColor: 'rgba(158,24,43,0.20)',
  },
  tituloCiclo: {
    color: CORES.bordôEscuro,
    fontSize: 10,
    fontFamily: 'Nunito_700Bold',
    marginBottom: 5,
  },
  textoCiclo: {
    color: CORES.bordôEscuro,
    fontSize: 10,
    lineHeight: 14,
    fontFamily: 'Nunito_400Regular',
  },
  negritoExtra: {
    fontFamily: 'Nunito_900Black',
  },

  cardSintomas: {
    marginHorizontal: 15,
    marginTop: 15,
    padding: 12,
    borderWidth: 1,
    borderColor: CORES.rosa,
    borderRadius: 10,
    backgroundColor: 'rgba(242,175,188,0.10)',
  },
  tituloCard: {
    color: '#000000',
    fontSize: 11,
    fontFamily: 'Nunito_700Bold',
    marginBottom: 10,
  },
  chips: {
    flexDirection: 'row',
    flexWrap: 'wrap',
    marginHorizontal: -3,
  },
  chip: {
    minHeight: 28,
    paddingHorizontal: 10,
    borderRadius: 15,
    borderWidth: 0.5,
    borderColor: CORES.rosa,
    backgroundColor: CORES.fundo,
    alignItems: 'center',
    justifyContent: 'center',
    margin: 3,
  },
  chipAtivo: {
    backgroundColor: CORES.bordô,
    borderColor: CORES.bordô,
  },
  textoChip: {
    color: CORES.bordôEscuro,
    fontSize: 11,
    fontFamily: 'Nunito_900Black',
  },
  textoChipAtivo: {
    color: CORES.fundo,
  },
  textoRegistrados: {
    color: CORES.bordô,
    fontSize: 10,
    fontFamily: 'Nunito_900Black',
    marginTop: 8,
  },

  cardPrevisoes: {
    marginHorizontal: 15,
    marginTop: 7,
    padding: 12,
    minHeight: 98,
    borderRadius: 10,
    borderWidth: 1,
    borderColor: '#D993A1',
    backgroundColor: 'rgba(158,24,43,0.20)',
  },
  tituloPrevisoes: {
    color: CORES.bordô,
    fontSize: 11,
    fontFamily: 'Nunito_900Black',
    marginBottom: 8,
  },
  textoPrevisao: {
    color: CORES.bordôEscuro,
    fontSize: 11,
    fontFamily: 'Nunito_600SemiBold',
    marginBottom: 2,
  },
  mediaCiclo: {
    color: '#A65A6B',
    fontSize: 10,
    fontFamily: 'Nunito_400Regular',
  },

  // humor
  containerHumor: {
    marginHorizontal: 15,
    minHeight: 685,
  },
  tituloHumor: {
    color: '#9E182B',
    fontSize: 15,
    fontFamily: 'Nunito_900Black',
    textAlign: 'center',
    marginBottom: 20,
  },
  linhaHumores: {
    flexDirection: 'row',
    justifyContent: 'space-around',
    alignItems: 'center',
    marginBottom: 20,
  },
  circuloHumor: {
    width: 50,
    height: 50,
    borderRadius: 25,
    backgroundColor: '#FDF4F6',
    borderWidth: 2,
    borderColor: '#EBC6CC',
    alignItems: 'center',
    justifyContent: 'center',
    overflow: 'hidden',
  },
  circuloHumorSelecionado: {
    backgroundColor: 'rgba(170,27,49,0.35)',
    borderColor: '#AA1B31',
  },
  imagemHumor: {
    width: 30,
    height: 30,
  },
  areaHumorRegistrado: {
    height: 20,
    justifyContent: 'center',
    alignItems: 'center',
    marginBottom: 15,
    flexDirection: 'row',
    flexWrap: 'wrap',
  },
  humorRegistradoLabel: {
    color: '#781222',
    fontSize: 12,
    fontFamily: 'Nunito_400Regular',
    textAlign: 'center',
  },
  humorRegistradoValor: {
    color: '#781222',
    fontSize: 12,
    fontFamily: 'Nunito_400Regular',
    textAlign: 'center',
    marginLeft: 4,
  },
  imagemHumorPequena: {
    width: 16,
    height: 16,
    marginLeft: 4,
  },
  cardHistorico: {
    borderWidth: 1,
    borderColor: CORES.rosa,
    borderRadius: 10,
    padding: 12,
    backgroundColor: '#FFFFFF',
  },
  tituloHistorico: {
    color: '#9E182B',
    fontSize: 10,
    fontFamily: 'Nunito_900Black',
    marginBottom: 8,
  },
  linhaHistorico: {
    flexDirection: 'row',
    justifyContent: 'space-around',
    alignItems: 'center',
  },
  diaHistorico: {
    alignItems: 'center',
  },
  rotuloDiaHistorico: {
    fontSize: 10,
    fontFamily: 'Nunito_900Black',
    color: '#000000',
    marginBottom: 4,
  },
  rotuloDiaHistoricoHoje: {
    color: '#AA1B31',
  },
  imagemHistorico: {
    width: 24,
    height: 24,
  },

  // saude
  containerSaude: {
    marginHorizontal: 15,
    marginTop: 5,
    minHeight: 685,
  },
  rowSaude: {
    flexDirection: 'row',
    justifyContent: 'space-between', 
    alignItems: 'stretch',
    marginBottom: 14,
  },
  halfCard: {
    width: '48%',
    
  },
  fullCard: {
    width: '100%',
    marginBottom: 14,
  },
  cardSaude: {
    backgroundColor: '#FFFFFF',
    borderWidth: 1,
    borderColor: 'rgba(170,27,49,0.2)',
    borderRadius: 10,
    padding: 14,
  },
  cardTitle: {
    fontSize: 12,
    fontWeight: '700',
    color: '#9E182B',
    marginBottom: 4,
    fontFamily: 'Nunito_700Bold',
  },
  cardSubtitle: {
    fontSize: 9,
    fontWeight: '200',
    color: '#AA1B31',
    marginBottom: 8,
    fontFamily: 'Nunito_400Regular',
    flexShrink: 1,
  },
  vaccineSubtitle: {
    fontSize: 9,
    fontWeight: '300',
    color: '#BA8130',
    fontFamily: 'Nunito_400Regular',
    flexShrink: 1,
  },
  pillButton: {
    backgroundColor: 'rgba(170,27,49,0.3)',
    borderRadius: 20,
    height: 26,
   
    alignItems: 'center',
    justifyContent: 'center',
    marginTop: 6,
    
  },
  pillButtonText: {
    fontSize: 10,
    fontWeight: '800',
    color: '#AA1B31',
    fontFamily: 'Nunito_900Black',
  },
  sectionTitle: {
    fontSize: 12,
    fontWeight: '800',
    color: '#9E182B',
    marginBottom: 14,
    fontFamily: 'Nunito_900Black',
  },
  sectionTitleBold: {
    fontSize: 15,
    fontWeight: '800',
    color: '#9E182B',
    marginBottom: 14,
    fontFamily: 'Nunito_900Black',
  },
  medRow: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'space-between',
    paddingVertical: 3,
  },
  medTextWrap: {
    flexShrink: 1,
  },
  medName: {
    fontSize: 15,
    fontWeight: '700',
    color: '#9E182B',
    fontFamily: 'Nunito_700Bold',
  },
  medTime: {
    fontSize: 10,
    fontWeight: '400',
    color: '#781422',
    marginTop: 4,
    fontFamily: 'Nunito_400Regular',
  },
  divider: {
    height: 1,
    backgroundColor: 'rgba(170,27,49,0.25)',
    marginVertical: 8,
  },
  smallPillButton: {
    backgroundColor: 'rgba(170,27,49,0.3)',
    borderRadius: 20,
    height: 20,
    width: 72,
    alignItems: 'center',
    justifyContent: 'center',
    marginTop: 8,
  },
  smallPillButtonText: {
    fontSize: 8,
    fontWeight: '800',
    color: '#AA1B31',
    fontFamily: 'Nunito_900Black',
  },
  historyItem: {
    fontSize: 12,
    fontWeight: '300',
    color: '#781422',
    paddingVertical: 8,
    fontFamily: 'Nunito_400Regular',
  },
  blocoInline: {
    marginTop: 6,
  },
  inputInline: {
    height: 34,
    borderRadius: 8,
    borderWidth: 1,
    borderColor: CORES.rosa,
    backgroundColor: CORES.fundo,
    paddingHorizontal: 10,
    fontSize: 11,
    color: CORES.bordôEscuro,
    fontFamily: 'Nunito_600SemiBold',
  },
  linhaBotoesInline: {
    flexDirection: 'row',
    marginTop: 8,
  },
  botaoConfirmar: {
    flex: 1,
    height: 28,
    borderRadius: 14,
    backgroundColor: CORES.bordô,
    alignItems: 'center',
    justifyContent: 'center',
    marginRight: 6,
  },
  textoBotaoConfirmar: {
    color: CORES.branco,
    fontSize: 10,
    fontFamily: 'Nunito_900Black',
  },
  botaoCancelar: {
    flex: 1,
    height: 28,
    borderRadius: 14,
    borderWidth: 1,
    borderColor: CORES.bordô,
    alignItems: 'center',
    justifyContent: 'center',
  },
  textoBotaoCancelar: {
    color: CORES.bordô,
    fontSize: 10,
    fontFamily: 'Nunito_900Black',
  },
  fundoModal: {
    flex: 1,
    backgroundColor: 'rgba(120,20,34,0.35)',
    justifyContent: 'center',
    alignItems: 'center',
    paddingHorizontal: 30,
  },
  caixaModal: {
    width: '100%',
    backgroundColor: '#FFFFFF',
    borderRadius: 14,
    padding: 18,
  },
  tituloModal: {
    fontSize: 14,
    color: '#9E182B',
    fontFamily: 'Nunito_900Black',
    marginBottom: 10,
  },
  textoModal: {
    fontSize: 11,
    color: '#781422',
    fontFamily: 'Nunito_400Regular',
    marginBottom: 4,
  },
  botaoRemoverModal: {
    flex: 1,
    height: 28,
    borderRadius: 14,
    backgroundColor: '#9E182B',
    alignItems: 'center',
    justifyContent: 'center',
    marginRight: 6,
  },
  toggleTrack: {
    width: 37,
    height: 20,
    borderRadius: 10,
    backgroundColor: 'rgba(170,27,49,0.3)',
    justifyContent: 'center',
    padding: 2,
  },
  toggleTrackActive: {
    backgroundColor: '#AA1B31',
  },
  toggleThumb: {
    width: 16,
    height: 16,
    borderRadius: 8,
    backgroundColor: '#FFFFFF',
    alignSelf: 'flex-start',
  },
  toggleThumbActive: {
    alignSelf: 'flex-end',
  },

  //notas
  containerNotas: {
    marginHorizontal: 15,
    marginTop: 5,
    minHeight: 685,
  },
  cardNotasSeguranca: {
    backgroundColor: 'rgba(170,27,49,0.2)',
    borderRadius: 18,
    paddingVertical: 14,
    paddingHorizontal: 20,
    marginBottom: 16,
  },
  textoSeguranca: {
    color: CORES.bordôEscuro,
    fontSize: 16,
    fontFamily: 'Nunito_600SemiBold',
    lineHeight: 22,
  },
  cardNotasTexto: {
    backgroundColor: CORES.fundo,
    borderWidth: 0.5,
    borderColor: 'rgba(170,27,49,0.7)',
    borderRadius: 18,
    paddingHorizontal: 12,
    paddingVertical: 8,
    height: 250,
    fontFamily: 'Nunito_200ExtraLight',
  },
  inputNota: {
    flex: 1,
    fontSize: 13,
    fontFamily: 'Nunito_400Regular',
    color: CORES.bordôEscuro,
    padding: 4,
    outlineWidth: 0,
    outlineStyle: 'none',
    outlineColor: 'transparent',
    borderWidth: 0,
    WebkitOutline: 'none',
    MozOutline: 'none',
  },
  linhaBotoesNotas: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginTop: 16,
    gap: 10,
  },
  botaoSalvarNota: {
    flex: 1,
    height: 47,
    borderRadius: 100,
    backgroundColor: CORES.bordô,
    alignItems: 'center',
    justifyContent: 'center',
    marginRight: 5,
  },
  textoBotaoSalvarNota: {
    color: '#FFFFFF',
    fontSize: 15,
    fontFamily: 'Nunito_900Black',
  },
  botaoLimparNota: {
    flex: 1,
    height: 47,
    borderRadius: 100,
    borderWidth: 0.5,
    borderColor: 'rgba(170,27,49,0.49)',
    backgroundColor: CORES.fundo,
    alignItems: 'center',
    justifyContent: 'center',
    marginLeft: 5,
  },
  textoBotaoLimparNota: {
    color: CORES.bordô,
    fontSize: 15,
    fontFamily: 'Nunito_900Black',
  },

  scrollView: {
  flex: 1,
},
scrollContent: {
  paddingBottom: 20,
},
});
