<script setup>
import { ref, computed, watch } from 'vue'
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  projects: Array,
})

const selectedProject = ref(null)
const selectedBlock = ref(null)
const selectedPiece = ref(null)

const blocks = computed(() => {
  return selectedProject.value?.blocks ?? []
})

const pieces = computed(() => {
  return selectedBlock.value
    ? selectedBlock.value.pieces.filter(p => p.estado === 'Pendiente')
    : []
})

const pesoTeorico = computed(() => {
  return selectedPiece.value?.peso_teorico ?? ''
})

const form = useForm({
  project_id: '',
  block_id: '',
  piece_id: '',
  peso_real: '',
})

watch(selectedProject, project => {
  selectedBlock.value = null
  selectedPiece.value = null
  form.project_id = project?.id ?? ''
})

watch(selectedBlock, block => {
  selectedPiece.value = null
  form.block_id = block?.id ?? ''
})

watch(selectedPiece, piece => {
  form.piece_id = piece?.id ?? ''
})
</script>

<template>
  <div class="max-w-xl mx-auto p-4 bg-white shadow rounded-xl">
    <h2 class="text-xl font-bold mb-4">Registro de pieza</h2>

    <!-- Proyecto -->
    <div class="mb-4">
      <label class="block mb-1 font-medium">Proyecto</label>
      <select v-model="selectedProject" class="w-full border rounded px-2 py-1">
        <option :value="null">Selecciona un proyecto</option>
        <option v-for="project in projects" :key="project.id" :value="project">
          {{ project.name }}
        </option>
      </select>
    </div>

    <!-- Bloque -->
    <div class="mb-4" v-if="blocks.length">
      <label class="block mb-1 font-medium">Bloque</label>
      <select v-model="selectedBlock" class="w-full border rounded px-2 py-1">
        <option :value="null">Selecciona un bloque</option>
        <option v-for="block in blocks" :key="block.id" :value="block">
          {{ block.name }}
        </option>
      </select>
    </div>

    <!-- Pieza -->
    <div class="mb-4" v-if="pieces.length">
      <label class="block mb-1 font-medium">Pieza</label>
      <select v-model="selectedPiece" class="w-full border rounded px-2 py-1">
        <option :value="null">Selecciona una pieza</option>
        <option v-for="piece in pieces" :key="piece.id" :value="piece">
          {{ piece.name }}
        </option>
      </select>
    </div>

    <!-- Peso Teórico -->
    <div class="mb-4">
      <label class="block mb-1 font-medium">Peso Teórico</label>
      <input type="text" class="w-full border rounded px-2 py-1 bg-gray-100" :value="pesoTeorico" readonly>
    </div>

    <!-- Peso Real -->
    <div class="mb-4">
      <label class="block mb-1 font-medium">Peso Real</label>
      <input type="number" step="0.01" v-model="form.peso_real" class="w-full border rounded px-2 py-1">
    </div>

    <!-- Botón -->
    <button @click="form.post('/formulario')" class="px-4 py-2 bg-blue-600 text-white rounded">
      Registrar
    </button>
  </div>
</template>
