<script setup>
import { ref, computed, watch } from 'vue'
import { useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
  projects: Array,
})

const selectedProject = ref(null)
const selectedBlock = ref(null)
const selectedPiece = ref(null)

const blocks = computed(() => selectedProject.value?.blocks ?? [])
const pieces = computed(() => selectedBlock.value?.pieces.filter(p => p.estado === 'Pendiente') ?? [])
const pesoTeorico = computed(() => selectedPiece.value?.peso_teorico ?? '')

const form = useForm({
  project_id: '',
  block_id: '',
  piece_id: '',
  peso_real: '',
})

// Validación local
const localErrors = ref({})

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

const validateBeforeSubmit = () => {
  localErrors.value = {}

  if (!form.project_id) localErrors.value.project_id = 'Debes seleccionar un proyecto'
  if (!form.block_id) localErrors.value.block_id = 'Debes seleccionar un bloque'
  if (!form.piece_id) localErrors.value.piece_id = 'Debes seleccionar una pieza'
  if (!form.peso_real || isNaN(form.peso_real)) localErrors.value.peso_real = 'El peso real debe ser un número válido'

  if (Object.keys(localErrors.value).length === 0) {
    form.post('/formulario')
  }
}
</script>

<template>
<AuthenticatedLayout>
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
      <div v-if="localErrors.project_id" class="text-sm text-red-500 mt-1">{{ localErrors.project_id }}</div>
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
      <div v-if="localErrors.block_id" class="text-sm text-red-500 mt-1">{{ localErrors.block_id }}</div>
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
      <div v-if="localErrors.piece_id" class="text-sm text-red-500 mt-1">{{ localErrors.piece_id }}</div>
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
      <div v-if="localErrors.peso_real" class="text-sm text-red-500 mt-1">{{ localErrors.peso_real }}</div>
    </div>

    <!-- Botón -->
    <button @click.prevent="validateBeforeSubmit" class="px-4 py-2 bg-blue-600 text-white rounded">
      Registrar
    </button>
  </div>

  <!-- Errores del servidor -->
  <div v-if="$page.props.errors" class="mb-4 mt-4 text-red-600">
    <ul>
      <li v-for="(msg, field) in $page.props.errors" :key="field">
        {{ msg }}
      </li>
    </ul>
  </div>
</AuthenticatedLayout>
</template>
