import { StyleSheet } from 'react-native';

export const Colors = {
  primary: '#F2AFBC',
  primaryDark: '#9E182B',
  primaryLight: '#F8AFC8',
  background: '#FFF4F6',
  card: '#FFFFFF',
  textDark: '#3A1420',
  textMuted: '#3A1420',
  placeholder: '#C9A9B2',
  inputIcon: '#E0356B',
  border: '#F7D3DF',
  white: '#FFFFFF',
};

export const Spacing = {
  xs: 4,
  sm: 8,
  md: 16,
  lg: 24,
  xl: 32,
};

export const commonStyles = StyleSheet.create({
  screen: {
    flex: 1,
    backgroundColor: Colors.background,
  },
  scrollContent: {
    flexGrow: 1,
    padding: Spacing.lg,
    justifyContent: 'center',
  },
  card: {
    backgroundColor: Colors.card,
    borderRadius: 20,
    padding: Spacing.lg,
    shadowColor: '#000',
    shadowOffset: { width: 0, height: 4 },
    shadowOpacity: 0.06,
    shadowRadius: 12,
    elevation: 2,
  },
  title: {
    fontSize: 22,
    fontWeight: '700',
    color: Colors.textDark,
    marginBottom: 4,
  },
  subtitle: {
    fontSize: 14,
    color: Colors.textMuted,
    marginBottom: Spacing.lg,
  },
  label: {
    fontSize: 13,
    fontWeight: '600',
    color: Colors.textDark,
    marginBottom: 6,
    marginTop: Spacing.sm,
  },
  inputWrapper: {
    flexDirection: 'row',
    alignItems: 'center',
    borderWidth: 1,
    borderColor: Colors.border,
    borderRadius: 10,
    paddingHorizontal: 12,
    backgroundColor: Colors.white,
  },
  inputIconStyle: {
    marginRight: 8,
  },
  input: {
    flex: 1,
    paddingVertical: 12,
    fontSize: 14,
    color: Colors.textDark,
  },
  button: {
    backgroundColor: Colors.primaryDark,
    borderRadius: 10,
    paddingVertical: 14,
    alignItems: 'center',
    marginTop: Spacing.lg,
  },
  buttonSecondary: {
    backgroundColor: Colors.white,
    borderColor: Colors.primaryDark,
    borderWidth: 1,
    borderRadius: 10,
    paddingVertical: 14,
    alignItems: 'center',
    marginTop: Spacing.md,
  },
  buttonSecondaryText: {
    color: Colors.primaryDark,
    fontWeight: '700',
    fontSize: 15,
  },
  buttonDanger: {
    backgroundColor: '#7A1022',
    borderRadius: 10,
    paddingVertical: 14,
    alignItems: 'center',
    marginTop: Spacing.md,
  },
  buttonDisabled: {
    opacity: 0.6,
  },
  buttonText: {
    color: Colors.white,
    fontWeight: '700',
    fontSize: 15,
  },
  footerText: {
    textAlign: 'center',
    marginTop: Spacing.md,
    fontSize: 13,
    color: Colors.textMuted,
  },
  link: {
    color: Colors.primaryDark,
    fontWeight: '700',
  },
});
