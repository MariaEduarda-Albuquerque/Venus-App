
import React from 'react';
import {
  View,
  Text,
  TouchableOpacity,
} from 'react-native';
import estilos from '../styles';


const diasSemana = ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'];
const calendario = [
  ['1', '2', '3', '4', '5', '6', '7'],
  ['8', '9', '10', '11', '12', '13', '14'],
  ['15', '16', '17', '18', '19', '20', '21'],
  ['22', '23', '24', '25', '26', '27', '28'],
  ['29', '30', '31', '', '', '', ''],
];
const diasMenstruacao = ['1', '2', '3', '4', '5'];
const diasFertil = ['11', '12', '13', '15', '16', '17'];
const DIA_DESTAQUE = new Date().getDate().toString();

const sintomas = [
  'Cólica',
  'Fluxo intenso',
  'Fluxo leve',
  'Dor de cabeça',
  'Inchaço',
  'Irritabilidade',
  'Cansaço',
  'Náusea',
];

export default function CicloScreen({ onMarcarInicio, sintomasSelecionados, alternarSintoma }) {
  return (
    <>
      <RastreadorMenstrual onMarcarInicio={onMarcarInicio} />
      <View style={estilos.cardSintomas}>
        <Text style={estilos.tituloCard}>Registrar sintomas de hoje</Text>
        <View style={estilos.chips}>
          {sintomas.map((sintoma) => {
            const ativo = sintomasSelecionados.includes(sintoma);
            return (
              <TouchableOpacity
                key={sintoma}
                onPress={() => alternarSintoma(sintoma)}
                style={[estilos.chip, ativo && estilos.chipAtivo]}
              >
                <Text style={[estilos.textoChip, ativo && estilos.textoChipAtivo]}>
                  {sintoma}
                </Text>
              </TouchableOpacity>
            );
          })}
        </View>
        <Text style={estilos.textoRegistrados}>
          {sintomasSelecionados.length} sintoma(s) registrado(s) para hoje
        </Text>
      </View>
      <Previsoes />
    </>
  );
}


function RastreadorMenstrual({ onMarcarInicio }) {
  return (
    <View style={estilos.cardRastreador}>
      <Text style={estilos.tituloRastreador}>RASTREADOR MENSTRUAL</Text>
      <View style={estilos.calendario}>
        <View style={estilos.linhaCalendario}>
          {diasSemana.map((dia, index) => (
            <View style={estilos.celulaCalendario} key={`${dia}-${index}`}>
              <Text style={estilos.textoDiaSemana}>{dia}</Text>
            </View>
          ))}
        </View>
        {calendario.map((semana, linhaIndex) => (
          <View style={estilos.linhaCalendario} key={linhaIndex}>
            {semana.map((dia, colIndex) => {
              const isMenstruacao = diasMenstruacao.includes(dia);
              const isFertil = diasFertil.includes(dia);
              const isDestaque = dia === DIA_DESTAQUE && dia !== '';
              return (
                <View style={estilos.celulaCalendario} key={`${dia}-${colIndex}`}>
                  <View
                    style={[
                      estilos.caixaDia,
                      isMenstruacao && estilos.diaMenstruacao,
                      isFertil && estilos.diaFertil,
                      isDestaque && estilos.diaDestaque,
                    ]}
                  >
                    <Text
                      style={[
                        estilos.textoDia,
                        isMenstruacao && estilos.textoDiaMenstruacao,
                        isFertil && estilos.textoDiaFertil,
                        isDestaque && estilos.textoDiaDestaque,
                      ]}
                    >
                      {dia}
                    </Text>
                  </View>
                </View>
              );
            })}
          </View>
        ))}
      </View>

      <View style={estilos.legenda}>
        <ItemLegenda cor="#ECC3CB" texto="Menstruação" corTexto="#AA1B31" />
        <ItemLegenda cor="#D9DFD3" texto="Fértil" corTexto="#667E6A" />
        <ItemLegenda cor="#FAAC3F" texto="Ovulação" corTexto="#FAAC3F" opacidade={0.2} />
        <ItemLegenda cor="#9E182B" texto="Hoje" corTexto="#9E182B" />
      </View>

      <TouchableOpacity style={estilos.botaoPeriodo} onPress={onMarcarInicio}>
        <Text style={estilos.textoBotaoPeriodo}>Marcar início da menstruação</Text>
      </TouchableOpacity>

      <View style={estilos.caixaCiclo}>
        <Text style={estilos.tituloCiclo}>Fase do seu ciclo</Text>
        <Text style={estilos.textoCiclo}>
          Você está na <Text style={estilos.negritoExtra}>fase fértil</Text> (dia 14). É comum
          sentir mais energia e disposição. Use camisinha se não quiser engravidar!
        </Text>
      </View>
    </View>
  );
}

function ItemLegenda({ cor, texto, corTexto, opacidade = 1 }) {
  return (
    <View style={estilos.itemLegenda}>
      <View style={[estilos.bolaLegenda, { backgroundColor: cor, opacity: opacidade }]} />
      <Text style={[estilos.textoLegenda, { color: corTexto }]}>{texto}</Text>
    </View>
  );
}

function Previsoes() {
  return (
    <View style={estilos.cardPrevisoes}>
      <Text style={estilos.tituloPrevisoes}>Previsões</Text>
      <Text style={estilos.textoPrevisao}>
        Próxima menstruação: <Text style={estilos.negritoExtra}>15 de agosto</Text>
      </Text>
      <Text style={estilos.textoPrevisao}>
        Próxima ovulação: <Text style={estilos.negritoExtra}>20 de agosto</Text>
      </Text>
      <Text style={estilos.mediaCiclo}>Ciclo médio: 28 dias · Regular</Text>
    </View>
  );
}