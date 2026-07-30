import { StyleSheet } from 'react-native';

const ROSA = '#F2AFBC';
const TEXTO = '#333333';
const FRACO = 'rgba(170, 27, 49, 0.45)';
const FUNDO = '#FDF2F5';

export default StyleSheet.create({
  safe: {
    flex: 1,
    backgroundColor: FUNDO,
  },

  topo: {
    flexDirection: 'row',
    alignItems: 'center',
    backgroundColor: '#F8DDE4',
    paddingHorizontal: 16,
    paddingTop: 12,
    paddingBottom: 14,
  },
  botaoCancelar: {
    backgroundColor: '#FBE7EC',
    borderRadius: 16,
    paddingHorizontal: 16,
    paddingVertical: 6,
  },
  textoCancelar: {
    fontSize: 13,
    color: ROSA,
  },
  botaoPostar: {
    marginLeft: 'auto',
    backgroundColor: ROSA,
    borderRadius: 16,
    paddingHorizontal: 20,
    paddingVertical: 6,
  },
  textoPostar: {
    fontSize: 13,
    fontWeight: '700',
    color: '#FFFFFF',
  },

  card: {
    height: 250,
    backgroundColor: '#FFFFFF',
    borderRadius: 14,
    borderWidth: 1,
    borderColor: '#F8DDE4',
    marginHorizontal: 16,
    marginTop: 14,
    padding: 12,
  },
  linhaEscrita: {
    flex: 1,
    flexDirection: 'row',
    gap: 10,
  },
  avatar: {
    width: 26,
    height: 26,
    borderRadius: 13,
    backgroundColor: ROSA,
    alignItems: 'center',
    justifyContent: 'center',
  },
  input: {
    flex: 1,
    fontSize: 12,
    color: TEXTO,
    textAlignVertical: 'top',
  },
  rodape: {
    flexDirection: 'row',
    alignItems: 'center',
    gap: 12,
  },
  espaco: {
    flex: 1,
  },
});
