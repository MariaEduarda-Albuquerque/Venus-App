import { StyleSheet } from 'react-native';

export const styles = StyleSheet.create({
  mainContainer: { flex: 1, backgroundColor: '#FFF8F8' },
  container: { flex: 1 },

  headerImage: {
    width: '100%',
    aspectRatio: 207 / 145,
    position: 'relative',
  },

  backButton: { position: 'absolute', left: 20, top: 45, zIndex: 3 },
  backArrow: { fontSize: 24, fontWeight: 'bold', color: '#000' },

  configButton: {
    position: 'absolute',
    right: 35,   // AJUSTE: aumente esse número pra mover mais pra esquerda (era 20)
    top: 45,
    zIndex: 3,
  },
configIcon: { width: 30, height: 30, resizeMode: 'contain' },

  // Agora posicionado em % do header, mirando o círculo do avatar
  cameraBadge: {
    position: 'absolute',
    top: '50.3%',   // AJUSTE: desce/sobe a câmera até acertar a altura do círculo
    left: '57.6%',  // AJUSTE: move a câmera pra direita/esquerda até acertar a borda do círculo
    width: 34,
    height: 34,
    borderRadius: 16,
    backgroundColor: '#8A1C28',
    alignItems: 'center',
    justifyContent: 'center',
    borderWidth: 2,
    borderColor: '#FFF8F8',
  },

  textsContainer: {
    alignItems: 'center',
    marginTop: -70, // AJUSTE: puxa "Marina Silva" pra cima, sobre o espaço vazio do header
  },
  userName: { fontSize: 20, fontWeight: 'bold', color: '#8A1C28' },
  userHandle: { fontSize: 12, color: '#7A5A5A', marginTop: 2 },

  formPanel: {
    marginTop: 10, // AJUSTE: espaço entre os textos e a caixinha de botões
    marginHorizontal: 24,
    backgroundColor: '#FBE4E8',
    borderRadius: 24,
    paddingVertical: 8,
    paddingHorizontal: 16,
  },
  inputCard: {
    backgroundColor: '#FFF3F5',
    borderRadius: 16,
    paddingVertical: 14,
    alignItems: 'center',
    marginVertical: 6,
  },
  inputText: { fontSize: 15, fontWeight: 'bold', color: '#8A1C28' },

  bottomNav: {
    flexDirection: 'row',
    justifyContent: 'space-around',
    alignItems: 'center',
    backgroundColor: '#FFF8F8',
    paddingVertical: 8,
    borderTopWidth: 1,
    borderTopColor: '#FAD8DE',
  },
  navItem: { alignItems: 'center' },
  navIcon: { width: 24, height: 24, resizeMode: 'contain' },
  navLabel: { fontSize: 10, color: '#B08080', marginTop: 2 },
  navLabelActive: { fontSize: 10, color: '#8A1C28', fontWeight: 'bold', marginTop: 2 },
});