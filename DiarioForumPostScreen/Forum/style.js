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
    backgroundColor: '#F8DDE4',
    paddingHorizontal: 14,
    paddingTop: 10,
    paddingBottom: 14,
  },
  logo: {
    textAlign: 'center',
    fontSize: 15,
    fontWeight: '700',
    color: VERMELHO,
    marginBottom: 10,
  },
  headerLinha: {
    flexDirection: 'row',
    alignItems: 'center',
    gap: 10,
  },
  buscaBox: {
    flex: 1,
    flexDirection: 'row',
    alignItems: 'center',
    gap: 8,
    backgroundColor: '#FBE7EC',
    borderRadius: 20,
    paddingHorizontal: 14,
    paddingVertical: 10,
  },
  buscaInput: {
    flex: 1,
    fontSize: 14,
    color: TEXTO,
  },
  avatarTopo: {
    width: 34,
    height: 34,
    borderRadius: 17,
    backgroundColor: ROSA,
    alignItems: 'center',
    justifyContent: 'center',
  },

  lista: {
    padding: 14,
    paddingBottom: 100,
  },
  card: {
    backgroundColor: '#FFFFFF',
    borderRadius: 16,
    padding: 12,
    marginBottom: 14,
  },
  cardAlto: {
    height: 270,
  },
  cardTopo: {
    flexDirection: 'row',
    alignItems: 'center',
    gap: 8,
  },
  avatar: {
    width: 28,
    height: 28,
    borderRadius: 14,
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
  tempo: {
    fontSize: 11,
    color: FRACO,
  },
  texto: {
    marginTop: 8,
    fontSize: 11,
    color: VERMELHO,
    lineHeight: 16,
  },
  rodape: {
    flexDirection: 'row',
    alignItems: 'center',
    gap: 16,
    marginTop: 'auto',
    paddingTop: 12,
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

  botaoMais: {
    position: 'absolute',
    right: 18,
    bottom: 90,
    width: 50,
    height: 50,
    borderRadius: 25,
    backgroundColor: ROSA,
    alignItems: 'center',
    justifyContent: 'center',
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
  navLabel: {
    fontSize: 8,
    color: ROSA,
    fontWeight: '600',
  },
});
