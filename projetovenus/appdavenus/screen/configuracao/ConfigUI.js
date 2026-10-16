import { Text as ScaledText } from '../../context/ScaledText';
import { useNavigation } from '@react-navigation/native';
import { Image, StyleSheet, Switch, Text, TouchableOpacity, View } from 'react-native';
import { Ionicons } from '@expo/vector-icons';
import { usePreferences } from '../../context/PreferencesContext';
import {
  useFonts,
  Nunito_400Regular,
  Nunito_500Medium,
  Nunito_600SemiBold,
  Nunito_700Bold,
  Nunito_800ExtraBold,
} from '@expo-google-fonts/nunito';

export const COLORS = {
  background: '#FFF5F1',
  wine: '#9E182B',
  ink: '#3A1620',
  muted: '#8A6670',
  border: '#F1D3DA',
  white: '#FFFFFF',
  iconBg: '#FCE3E8',
  selectedBg: '#FDE4EA',
  trackOff: '#E5CFD5',
};

export const FONT = {
  regular: 'Nunito_400Regular',
  medium: 'Nunito_500Medium',
  semibold: 'Nunito_600SemiBold',
  bold: 'Nunito_700Bold',
  extrabold: 'Nunito_800ExtraBold',
};

// carrega a Nunito; retorna true quando estiver pronta
export function useConfigFonts() {
  const [loaded] = useFonts({
    Nunito_400Regular,
    Nunito_500Medium,
    Nunito_600SemiBold,
    Nunito_700Bold,
    Nunito_800ExtraBold,
  });
  return loaded;
}

export function ScreenHeader({ title, onBack }) {
  const navigation = useNavigation();
  const { colors } = usePreferences();

  return (
    <View style={[styles.header, { borderBottomColor: colors.border, backgroundColor: colors.background }]}>
      <TouchableOpacity
        style={[styles.backButton, { backgroundColor: colors.card, borderColor: colors.border }]}
        activeOpacity={0.7}
        onPress={onBack || (() => navigation.goBack())}
        accessibilityRole="button"
        accessibilityLabel="Voltar"
      >
        <Ionicons name="chevron-back" size={20} color={colors.text} />
      </TouchableOpacity>
      <ScaledText style={[styles.headerTitle, { color: colors.text }]}>{title}</ScaledText>
    </View>
  );
}

export function Section({ title, children, style }) {
  const { colors } = usePreferences();
  return (
    <View style={[styles.section, style]}>
      <ScaledText style={[styles.sectionLabel, { color: colors.muted }]}>{title}</ScaledText>
      {children}
    </View>
  );
}

export function Card({ children, style }) {
  const { colors } = usePreferences();
  return <View style={[styles.card, { backgroundColor: colors.card, borderColor: colors.border }, style]}>{children}</View>;
}

export function Row({ icon, image, imageSize = [18, 18], label, subtitle, danger, onPress, isFirst }) {
  const { colors } = usePreferences();
  return (
    <TouchableOpacity
      style={[styles.row, { backgroundColor: colors.card, borderTopColor: colors.border }, !isFirst && styles.rowDivider]}
      activeOpacity={0.7}
      onPress={onPress}
      accessibilityRole="button"
      accessibilityLabel={label}
    >
      <View style={[styles.iconBox, { backgroundColor: colors.iconBg }]}>
        {image ? (
          <Image
            source={image}
            style={{ width: imageSize[0], height: imageSize[1] }}
            resizeMode="contain"
          />
        ) : (
          <Ionicons name={icon} size={18} color={colors.wine} />
        )}
      </View>

      <View style={styles.rowTexts}>
        <ScaledText style={[styles.rowLabel, { color: danger ? colors.wine : colors.text }]}>{label}</ScaledText>
        {subtitle ? <ScaledText style={[styles.rowSubtitle, { color: colors.muted }]}>{subtitle}</ScaledText> : null}
      </View>

      {!danger && <Ionicons name="chevron-forward" size={14} color={colors.wine} />}
    </TouchableOpacity>
  );
}

export function ToggleRow({ label, subtitle, value, onValueChange, isFirst }) {
  const { colors } = usePreferences();
  return (
    <View style={[styles.toggleRow, { backgroundColor: colors.card, borderTopColor: colors.border }, !isFirst && styles.rowDivider]}>
      <View style={styles.rowTexts}>
        <ScaledText style={[styles.toggleLabel, { color: colors.text }]}>{label}</ScaledText>
        {subtitle ? <ScaledText style={[styles.rowSubtitle, { color: colors.muted }]}>{subtitle}</ScaledText> : null}
      </View>
      <Switch
        value={value}
        onValueChange={onValueChange}
        trackColor={{ false: colors.border, true: colors.wine }}
        thumbColor={COLORS.white}
        activeThumbColor={COLORS.white}
        ios_backgroundColor={COLORS.trackOff}
      />
    </View>
  );
}

const styles = StyleSheet.create({
  /* Header */
  header: {
    flexDirection: 'row',
    alignItems: 'center',
    paddingHorizontal: 15,
    paddingTop: 44,
    paddingBottom: 14,
    borderBottomWidth: 1,
    borderBottomColor: COLORS.border,
  },
  backButton: {
    width: 30,
    height: 30,
    borderRadius: 15,
    borderWidth: 1,
    alignItems: 'center',
    justifyContent: 'center',
    marginRight: 15,
  },
  headerTitle: {
    fontSize: 22,
    fontFamily: FONT.extrabold,
    color: COLORS.ink,
  },

  /* Seções */
  section: {
    marginBottom: 20,
  },
  sectionLabel: {
    fontSize: 13,
    fontFamily: FONT.semibold,
    color: COLORS.muted,
    marginBottom: 8,
  },
  card: {
    backgroundColor: COLORS.white,
    borderRadius: 16,
    borderWidth: 1,
    borderColor: COLORS.border,
    overflow: 'hidden',
  },

  /* Linhas com seta */
  row: {
    flexDirection: 'row',
    alignItems: 'center',
    paddingVertical: 14,
    paddingHorizontal: 15,
    minHeight: 66,
  },
  rowDivider: {
    borderTopWidth: 1,
    borderTopColor: COLORS.border,
  },
  iconBox: {
    width: 36,
    height: 36,
    borderRadius: 10,
    backgroundColor: COLORS.iconBg,
    alignItems: 'center',
    justifyContent: 'center',
    marginRight: 13,
  },
  rowTexts: {
    flex: 1,
  },
  rowLabel: {
    fontSize: 14,
    fontFamily: FONT.semibold,
    color: COLORS.ink,
  },
  rowSubtitle: {
    fontFamily: FONT.regular,
    fontSize: 11,
    color: COLORS.muted,
    marginTop: 3,
  },

  /* Linhas com switch */
  toggleRow: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'space-between',
    paddingVertical: 12,
    paddingHorizontal: 15,
    minHeight: 58,
  },
  toggleLabel: {
    fontSize: 14,
    fontFamily: FONT.medium,
    color: COLORS.ink,
    paddingRight: 12,
  },
});
