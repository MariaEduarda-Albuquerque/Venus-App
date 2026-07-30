import { StyleSheet } from 'react-native';

export const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: '#ffffff' },
  header: {
    width: '100%',
    aspectRatio: 362 / 211,
    paddingTop: 45,
    paddingHorizontal: 20,
  },
  topRow: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'space-between',
  },
  backButton: { padding: 5, zIndex: 2 },
  backArrow: { fontSize: 24, fontWeight: 'bold', color: '#000000' },
  topImage: { width: 41, height: 55, resizeMode: 'contain' },
  title: {
    fontSize: 35,
    fontWeight: 'bold',
    color: '#8A1C28',
    marginTop: 14,
    textAlign: 'center', // ADICIONE essa linha pra centralizar o texto
    width: '100%',       // ADICIONE essa linha também — sem ela o textAlign não funciona direito
    zIndex: 2,
  },
  menuList: { paddingHorizontal: 25, paddingTop: 20 },
  menuItem: { flexDirection: 'row', alignItems: 'center', marginBottom: 25 },
  menuIcon: { width: 32, height: 32, resizeMode: 'contain' },
  menuTextContainer: { marginLeft: 15 },
  menuTitle: { fontSize: 18, fontWeight: '500', color: '#8A1C28' },
  menuSubtitle: { fontSize: 11, color: '#888888', marginTop: 2 },
  footer: { marginTop: 40, alignItems: 'center', paddingBottom: 30 },
  footerText: { fontSize: 11, color: '#AA8888', textAlign: 'center' },
});