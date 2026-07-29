import { StyleSheet } from 'react-native';

const PINK = '#D81B60';
const PINK_DARK = '#AD1457';
const PINK_LIGHT = '#F8BBD0';
const BG = '#FFF3F7';
 
export default StyleSheet.create({
  safe: {
    flex: 1,
    backgroundColor: '#BFDF4F6',
  },
  scrollContent: {
    paddingBottom: 90,
  },
 
  header: {
    backgroundColor: '#ff87af',
    paddingHorizontal: 20,
    paddingTop: 18,
    paddingBottom: 28,
    borderBottomLeftRadius: 20,
    borderBottomRightRadius: 20,
  },
  headerTopRow: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    marginBottom: 16,
  },
  headerTitle: {
    color: '#FFFFFF',
    fontSize: 22,
    fontWeight: '800',
    letterSpacing: 0.5,
  },
  headerBadge: {
    backgroundColor: 'rgba(255,255,255,0.25)',
    paddingHorizontal: 12,
    paddingVertical: 6,
    borderWidth: 1,
    borderColor: '#ffffff',
    borderRadius: 16,
  },
  headerBadgeText: {
    color: '#FFFFFF',
    fontSize: 12,
    fontWeight: '600',
  },
  searchBar: {
    flexDirection: 'row',
    alignItems: 'center',
    backgroundColor: '#FFFFFF',
    borderRadius: 18,
    paddingHorizontal: 16,
    paddingVertical: 12,
    gap: 8,
  },
  searchInput: {
    flex: 1,
    fontSize: 14,
    color: '#333',
  },
 
  progressCard: {
    flexDirection: 'row',
    alignItems: 'center',
    height: 100,
    backgroundColor: '#FFFFFF',
    marginHorizontal: 16,
    marginTop: 18,
    padding: 16,
    borderWidth: 1,
    borderColor: '#F2AFBC',
    borderRadius: 20,
    shadowColor: '#000',
    shadowOpacity: 0.06,
    shadowRadius: 8,
    shadowOffset: { width: 0, height: 4 },
    elevation: 3,
  },
  progressPercent: {
    fontSize: 26,
    fontWeight: '800',
    color: PINK,
  },
  progressTitle: {
    fontSize: 14,
    fontWeight: '700',
    color: '#222',
  },
  progressSubtitle: {
    fontSize: 12,
    color: '#888',
    marginTop: 2,
    right: 3
  },
 
  tabsRow: {
    flexDirection: 'row',
    gap: 10,
    paddingHorizontal: 16,
    marginTop: 18,
  },
  tabButton: {
    paddingHorizontal: 18,
    paddingVertical: 9,
    borderRadius: 20,
    backgroundColor: '#FFFFFF',
    borderWidth: 1,
    borderColor: '#F3C6D6',
  },
  tabButtonActive: {
    backgroundColor: PINK,
    borderColor: PINK,
  },
  tabButtonText: {
    fontSize: 13,
    fontWeight: '600',
    color: PINK_DARK,
  },
  tabButtonTextActive: {
    color: '#FFFFFF',
  },
 
  sectionHeaderRow: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    paddingHorizontal: 16,
    marginTop: 20,
    marginBottom: 10,
  },
  sectionHeaderTitle: {
    fontSize: 15,
    fontWeight: '700',
    color: PINK,
  },
  sectionHeaderLink: {
    fontSize: 13,
    color: '#999',
  },
 
  card: {
    flexDirection: 'row',
    width: '90%',
    height: 160,
    backgroundColor: '#FFFFFF',
    marginHorizontal: 16,
    marginBottom: 14,
    borderRadius: 18,
    borderWidth: 1,
    borderColor: '#F2AFBC',
    padding: 12,
    shadowColor: '#000',
    shadowOpacity: 0.04,
    shadowRadius: 6,
    shadowOffset: { width: 0, height: 2 },
    elevation: 1,
  },

  cardThumb: {
    width: 44,
    height: 44,
    marginTop: 20,
    marginLeft : 2,
    marginRight: 10,
    borderRadius: 14,
    overflow: 'hidden', 
  },

  cardBody: {
    flex: 1,
  },

  tagPill: {
    alignSelf: 'flex-start',
    backgroundColor: '#FCE4EC',
    paddingHorizontal: 8,
    paddingVertical: 2,
    borderRadius: 8,
    marginBottom: 4,
  },

  tagPillText: {
    fontSize: 10,
    fontWeight: '700',
    color: PINK,
  },

  cardTitle: {
    fontSize: 13,
    fontWeight: '700',
    color: '#222',
    marginBottom: 2,
  },

  cardReadTime: {
    fontSize: 11,
    color: PINK,
    fontWeight: '600',
    marginBottom: 8,
  },

  cardProgressRow: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginBottom: 40,
  },

  cardViewed: {
    fontSize: 11,
    color: '#777',
  },

  cardPercent: {
    fontSize: 11,
    color: '#777',
  },

  progressTrack: {
    height: 4,
    borderRadius: 2,
    backgroundColor: '#F5D6E2',
    overflow: 'hidden',
  },

  progressFill: {
    height: 4,
    backgroundColor: PINK,
    borderRadius: 2,
  },
 
  bottomNav: {
    position: 'absolute',
    bottom: 0,
    left: 0,
    right: 0,
    backgroundColor: '#FFFFFF',
    paddingVertical: 10,
    borderTopLeftRadius: 20,
    borderTopRightRadius: 20,
    borderWidth: 1,
    borderColor: '#F2AFBC',
    shadowColor: '#000',
    shadowOpacity: 0.06,
    shadowRadius: 8,
    shadowOffset: { width: 0, height: -2 },
    elevation: 6,
  },

  bottomNavContent: {
    flexGrow: 1,
    flexDirection: 'row',
    justifyContent: 'space-around',
  },

  navItem: {
    alignItems: 'center',
    gap: 2,
  },

  navLabel: {
    fontSize: 9,
    color: '#F06292',
    fontWeight: '600',
  },
});
