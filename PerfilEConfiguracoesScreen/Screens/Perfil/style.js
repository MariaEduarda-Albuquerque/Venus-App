import { StyleSheet } from 'react-native';

export const styles = StyleSheet.create({
  mainContainer: { flex: 1, backgroundColor: '#FFF8F8' },
  container: { flex: 1 },

  // Proporção real da imagem: 325x316
  header: {
    width: '100%',
    aspectRatio: 325 / 316,
    position: 'relative',
  },

  configButton: {
    position: 'absolute',
    top: '4%',
    right: '4%',
    zIndex: 3,
    borderRadius: 10,
    padding: 6,
  },
  configIcon: { width: 30, height: 30, resizeMode: 'contain' },

  // Avatar: medido na imagem (círculo à esquerda)
  avatarWrapper: {
    position: 'absolute',
    top: '19%',
    left: '6.5%',
    width: '48.5%',
    aspectRatio: 1,
    zIndex: 2,
  },
  editBadge: {
    position: 'absolute',
    top: '77%',
    left: '61%',
    width: '12%',
    aspectRatio: 92 / 77,
    zIndex: 3,
  },

  // Textos ficam ao lado do avatar (não mais embaixo)
  textsBlock: {
    position: 'absolute',
    top: '22%',
    left: '50%',
    width: '38%',
    height: '50%',
    justifyContent: 'center',
    zIndex: 2,
  },
  userName: { fontSize: 16, fontWeight: 'bold', color: '#8A1C28' },
  userHandle: { fontSize: 11, color: '#7A5A5A', marginTop: 1 },
  userBio: {
    fontSize: 10.5,
    color: '#8A1C28',
    marginTop: 4,
    fontStyle: 'italic',
  },

  // Faixa de estatísticas (medida: top 72%, left 4%, width 93%, height 23%)
  statsRow: {
    position: 'absolute',
    top: '72%',
    left: '4%',
    width: '93%',
    height: '23%',
    flexDirection: 'row',
    alignItems: 'center',
  },
  statItem: { flexDirection: 'row', alignItems: 'baseline', justifyContent: 'center' },
  statNumber: { fontSize: 13, fontWeight: 'bold', color: '#8A1C28' },
  statLabel: { fontSize: 11, color: '#8A1C28' },

  // Linhas divisórias na posição exata medida na imagem (23.2% e 63.6% da faixa)
  dividerOne: {
    position: 'absolute',
    left: '23.2%',
    top: '20%',
    width: 1,
    height: '60%',
    backgroundColor: 'rgba(138,28,40,0.35)',
  },
  dividerTwo: {
    position: 'absolute',
    left: '63.6%',
    top: '20%',
    width: 1,
    height: '60%',
    backgroundColor: 'rgba(138,28,40,0.35)',
  },

  feedTabs: {
    flexDirection: 'row',
    justifyContent: 'space-around',
    alignItems: 'center',
    paddingVertical: 12,
    borderBottomWidth: 1,
    borderBottomColor: '#F0D0D0',
  },
  tabItemActive: {
    borderBottomWidth: 2,
    borderBottomColor: '#8A1C28',
    paddingBottom: 8,
  },
  tabIcon: { width: 22, height: 22, resizeMode: 'contain' },

  postsGrid: {
    flexDirection: 'row',
    flexWrap: 'wrap',
    gap: 10,
    padding: 15,
  },
  postThumb: { width: 100, height: 100, borderRadius: 10 },

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