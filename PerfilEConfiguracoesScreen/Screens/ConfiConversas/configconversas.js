import { Image, ImageBackground, ScrollView, Text, TouchableOpacity, View } from 'react-native';
import { useRouter } from 'expo-router';

import iconExcluir from '@/assets/icons/excluir.png';
import fundoSuperiorTelas from '@/assets/icons/fundosuperiortelas.png';
import iconLimparConversas from '@/assets/icons/limparconversas.png';
import perfilTopo from '@/assets/icons/perfiltopo.png';
import { styles } from './style';

export default function ConfiConversas() {
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
        <Text style={styles.title}>Conversas</Text>
      </ImageBackground>

      <View style={styles.menuList}>
        <TouchableOpacity style={styles.menuItem}>
          <Image source={iconExcluir} style={styles.menuIcon} />
          <Text style={styles.menuTitle}>Apagar conversas</Text>
        </TouchableOpacity>

        <TouchableOpacity style={styles.menuItem}>
          <Image source={iconLimparConversas} style={styles.menuIcon} />
          <Text style={styles.menuTitle}>Limpar conversas</Text>
        </TouchableOpacity>
      </View>
    </ScrollView>
  );
}