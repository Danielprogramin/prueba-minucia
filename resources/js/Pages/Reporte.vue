<script setup>
import { ref } from 'vue'
import { Head } from '@inertiajs/vue3'
import { Bar } from 'vue-chartjs'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale
} from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

const props = defineProps({
  reportes: Array
})

const chartData = {
  labels: props.reportes.map(p => p.name),
  datasets: [
    {
      label: 'Pendientes',
      backgroundColor: '#facc15',
      data: props.reportes.map(p => p.pendientes)
    },
    {
      label: 'Fabricadas',
      backgroundColor: '#4ade80',
      data: props.reportes.map(p => p.fabricadas)
    }
  ]
}

const chartOptions = {
  responsive: true,
  plugins: {
    legend: { position: 'bottom' },
    title: {
      display: true,
      text: 'Estado de piezas por proyecto'
    }
  }
}
</script>

<template>
  <AuthenticatedLayout>
   
  <Head title="Reporte de Piezas" />
  <div class="max-w-5xl mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Reporte de Piezas por Proyecto</h2>

    <!-- Gráfico -->
    <div class="bg-white p-4 rounded shadow mb-6">
      <Bar :data="chartData" :options="chartOptions" />
    </div>

    <!-- Tabla -->
    <div v-for="p in reportes" :key="p.name" class="mb-6">
      <h3 class="text-lg font-semibold mb-2">{{ p.name }} ({{ p.pendientes }} pendientes)</h3>
      <ul class="bg-gray-50 border rounded p-2">
        <li v-for="pieza in p.piezas_pendientes" :key="pieza.id" class="border-b py-1">
          {{ pieza.name }} — Bloque: {{ pieza.block_id }}
        </li>
        <li v-if="p.pendientes === 0" class="italic text-gray-500">No hay piezas pendientes.</li>
      </ul>
    </div>
  </div>
  </AuthenticatedLayout>
</template>
