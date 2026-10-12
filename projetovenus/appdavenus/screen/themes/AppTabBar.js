import React from 'react';
import { Image, StyleSheet, TouchableOpacity, View } from 'react-native';
import { Ionicons } from '@expo/vector-icons';
import { Text } from '../../context/ScaledText';
import { usePreferences } from '../../context/PreferencesContext';

export default function AppTabBar({ image, tabs, activeKey, onTabPress }) {
  const { colors, dark } = usePreferences();

  return (
    <View
      style={[
        styles.container,
        { backgroundColor: colors.card, borderTopColor: colors.border },
        dark && styles.darkContainer,
      ]}
    >
      {dark ? (
        <View style={styles.tabs}>
          {tabs.map((tab) => {
            const active = tab.key === activeKey;
            const color = active ? colors.wine : colors.muted;

            return (
              <TouchableOpacity
                key={tab.key}
                style={[styles.tab, { flex: tab.flex }]}
                activeOpacity={0.7}
                accessibilityRole="button"
                accessibilityLabel={tab.label}
                onPress={() => onTabPress(tab)}
              >
                <Ionicons name={tab.icon} size={18} color={color} />
                <Text style={[styles.label, { color }]}>{tab.label}</Text>
              </TouchableOpacity>
            );
          })}
        </View>
      ) : (
        <>
          <Image source={image} style={styles.image} resizeMode="stretch" />
          <View style={styles.touchArea}>
            {tabs.map((tab) => (
              <TouchableOpacity
                key={tab.key}
                style={[styles.tab, { flex: tab.flex }]}
                activeOpacity={0.7}
                accessibilityRole="button"
                accessibilityLabel={tab.label}
                onPress={() => onTabPress(tab)}
              />
            ))}
          </View>
        </>
      )}
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    width: '100%',
    aspectRatio: 412 / 76,
  },
  darkContainer: {
    borderTopWidth: StyleSheet.hairlineWidth,
    paddingHorizontal: 4,
    paddingTop: 7,
  },
  image: {
    width: '100%',
    height: '100%',
  },
  touchArea: {
    ...StyleSheet.absoluteFillObject,
    flexDirection: 'row',
  },
  tabs: {
    flex: 1,
    flexDirection: 'row',
    alignItems: 'center',
  },
  tab: {
    alignItems: 'center',
    justifyContent: 'center',
  },
  label: {
    fontSize: 9,
    lineHeight: 12,
    textAlign: 'center',
    marginTop: 2,
  },
});
