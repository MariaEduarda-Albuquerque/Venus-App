import { Image, ImageBackground, ScrollView, Text, TouchableOpacity, View } from 'react-native';
import { useRouter } from 'expo-router';

import fundoSuperiorTelas from '@/assets/icons/fundosuperiortelas.png';
import iconNotificacoes from '@/assets/icons/notificacoes.png';
import perfilTopo from '@/assets/icons/perfiltopo.png';
import iconVibracao from '@/assets/icons/vibracao.png';
import { styles } from './style';

export default function ConfiNotificacao() {
  const router = useRouter();

  return (
    <ScrollView style={styles.container}>
      <ImageBackground source={fundoSuperiorTelas} style={styles.header} resizeMode="cover">
        <View style={styles.topRow}>
          <TouchableOpacity style={styles.backButton} onPress={() => router.back()}>
            <Text style={styles.backArrow}>←</Text>
          </TouchableOpacity>
          <Image source={perfilTopo} style={styles.topImage} />
        </View>
        <Text style={styles.title}>Notificações</Text>
      </ImageBackground>

      <View style={styles.menuList}>
        <TouchableOpacity style={styles.menuItem}>
          <Image source={iconNotificacoes} style={styles.menuIcon} />
          <View style={styles.menuTextContainer}>
            <Text style={styles.menuTitle}>Notificações</Text>
            <Text style={styles.menuSubtitle}>Ativado</Text>
          </View>
        </TouchableOpacity>

        <TouchableOpacity style={styles.menuItem}>
          <Image source={iconVibracao} style={styles.menuIcon} />
          <View style={styles.menuTextContainer}>
            <Text style={styles.menuTitle}>Vibração</Text>
            <Text style={styles.menuSubtitle}>Ativado</Text>
          </View>
        </TouchableOpacity>
      </View>
    </ScrollView>
  );
}