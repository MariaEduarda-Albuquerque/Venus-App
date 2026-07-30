import { StyleSheet } from 'react-native';

const VERMELHO = '#AA1B31';
const ROSA = '#F2AFBC';
const TEXTO = '#333333';
const FRACO = 'rgba(170, 27, 49, 0.45)';
const FUNDO = '#FDF2F5';

export default StyleSheet.create({
  safe: {
    flex: 1,
    backgroundColor: FUNDO,
  },

  header: {
    width: '100%',
    height: 90,
    flexDirection: 'row',
    alignItems: 'center',
    paddingHorizontal: 16,
  },
  botaoVoltar: {
    backgroundColor: '#FBE7EC',
    borderRadius: 16,
    paddingHorizontal: 18,
    paddingVertical: 6,
  },
  textoVoltar: {
    fontSize: 13,
    color: ROSA,
  },
  logo: {
    marginLeft: 'auto',
    width: 54,
    height: 54,
    resizeMode: 'contain',
  },

  scrollContent: {
    paddingBottom: 10,
  },
  principal: {
    paddingHorizontal: 14,
    paddingTop: 12,
    paddingBottom: 10,
  },
  resposta: {
    paddingHorizontal: 14,
    paddingVertical: 12,
    borderTopWidth: 1,
    borderTopColor: '#F5E1E7',
  },
  cardTopo: {
    flexDirection: 'row',
    alignItems: 'center',
    gap: 8,
  },
  avatar: {
    width: 26,
    height: 26,
    borderRadius: 13,
    backgroundColor: '#FBE7EC',
    alignItems: 'center',
    justifyContent: 'center',
  },
  autor: {
    flex: 1,
    fontSize: 15,
    fontWeight: '700',
    color: VERMELHO,
  },
  autorResposta: {
    flex: 1,
    fontSize: 13,
    fontWeight: '700',
    color: VERMELHO,
  },
  tempo: {
    fontSize: 11,
    color: FRACO,
  },
  texto: {
    marginTop: 8,
    fontSize: 11,
    color: VERMELHO,
  },
  areaImagem: {
    height: 200,
  },

  rodape: {
    flexDirection: 'row',
    alignItems: 'center',
    gap: 16,
    marginTop: 12,
  },
  contador: {
    flexDirection: 'row',
    alignItems: 'center',
    gap: 4,
  },
  numero: {
    fontSize: 11,
    color: FRACO,
  },
  espaco: {
    flex: 1,
  },

  responderLinha: {
    paddingHorizontal: 14,
    paddingVertical: 10,
  },
  responderBox: {
    flexDirection: 'row',
    alignItems: 'center',
    gap: 10,
    backgroundColor: '#FBE7EC',
    borderRadius: 18,
    paddingHorizontal: 16,
    paddingVertical: 8,
  },
  responderInput: {
    flex: 1,
    fontSize: 12,
    color: TEXTO,
  },

  bottomNav: {
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
  navLabel: {
    fontSize: 8,
    color: ROSA,
    fontWeight: '600',
  },
});
