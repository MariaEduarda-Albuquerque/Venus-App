import React from 'react';
import { StyleSheet, Text as NativeText, TextInput as NativeTextInput } from 'react-native';
import { usePreferences } from './PreferencesContext';

function scaledStyle(style, fontScale) {
  const flattenedStyle = StyleSheet.flatten(style);
  const overrides = {};

  if (typeof flattenedStyle?.fontSize === 'number') {
    overrides.fontSize = flattenedStyle.fontSize * fontScale;
  }
  if (typeof flattenedStyle?.lineHeight === 'number') {
    overrides.lineHeight = flattenedStyle.lineHeight * fontScale;
  }

  return Object.keys(overrides).length ? [style, overrides] : style;
}

export const Text = React.forwardRef(function ScaledText({ style, ...props }, ref) {
  const { fontScale } = usePreferences();
  return <NativeText ref={ref} {...props} style={scaledStyle(style, fontScale)} />;
});

export const TextInput = React.forwardRef(function ScaledTextInput({ style, ...props }, ref) {
  const { fontScale } = usePreferences();
  return <NativeTextInput ref={ref} {...props} style={scaledStyle(style, fontScale)} />;
});
