
import api from "../../api/api";
import { Platform } from "react-native";

const BASE_URL = (api.defaults.baseURL || "").replace(/\/api\/?$/, "");

export function urlFoto(caminho) {
  if (!caminho) return null;

  if (caminho.startsWith("http://") ||
      caminho.startsWith("https://")) {
    return caminho;
  }

  const caminhoLimpo = caminho.replace(/^\/+/, "");
  if (caminhoLimpo.startsWith("storage/")) return `${BASE_URL}/${caminhoLimpo}`;
  return `${BASE_URL}/storage/${caminhoLimpo}`;
}

export async function enviarFotoPerfil(id, uri) {
  const mimeData = /^data:(image\/(?:jpeg|png|webp));base64,/i.exec(uri)?.[1]?.toLowerCase();
  const extensaoArquivo = /\.(jpe?g|png|webp)$/i.exec(uri.split(/[?#]/)[0])?.[1]?.toLowerCase();
  const mimeExtensao = mimeData?.split("/")[1];
  const extensao = mimeExtensao === "jpeg"
    ? "jpg"
    : mimeExtensao || extensaoArquivo || "jpg";
  const tipo = mimeData || (
    extensao === "png" ? "image/png" :
      extensao === "webp" ? "image/webp" : "image/jpeg"
  );

  const formData = new FormData();
  const nomeArquivo = `perfil-${Date.now()}.${extensao}`;

  if (Platform.OS === "web") {
    const imageResponse = await fetch(uri);
    if (!imageResponse.ok) {
      throw new Error("Não foi possível ler a imagem selecionada.");
    }
    formData.append("foto", await imageResponse.blob(), nomeArquivo);
  } else {
    formData.append("foto", {
      uri,
      name: nomeArquivo,
      type: tipo,
    });
  }

  const response = await api.post(
    `/usuario/${id}/foto`,
    formData,
    {
      headers: {
        Accept: "application/json",
        "Content-Type": "multipart/form-data",
      },
    }
  );

  return (
    response.data.fotoPerfilUsuario ||
    response.data.usuario?.fotoPerfilUsuario
  );
}
