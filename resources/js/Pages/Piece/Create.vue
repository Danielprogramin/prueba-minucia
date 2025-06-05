<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({ blocks: Array })

const form = useForm({
  name: '',
  block_id: '',
  peso_teorico: '',
  estado: 'Pendiente'
})

const submit = () => {
  form.post('/pieces')
}
</script>

<template>
  <div class="max-w-md mx-auto p-4">
    <h2 class="text-lg font-bold mb-4">Nueva Pieza</h2>

    <form @submit.prevent="submit">
      <label class="block mb-1">Nombre</label>
      <input v-model="form.name" class="w-full border px-2 py-1 rounded mb-2" />

      <label class="block mb-1">Bloque</label>
      <select v-model="form.block_id" class="w-full border px-2 py-1 rounded mb-2">
        <option value="">Selecciona un bloque</option>
        <option v-for="block in blocks" :key="block.id" :value="block.id">
          {{ block.name }}
        </option>
      </select>

      <label class="block mb-1">Peso Teórico</label>
      <input type="number" v-model="form.peso_teorico" class="w-full border px-2 py-1 rounded mb-2" />

      <label class="block mb-1">Estado</label>
      <select v-model="form.estado" class="w-full border px-2 py-1 rounded mb-4">
        <option value="Pendiente">Pendiente</option>
        <option value="Fabricada">Fabricada</option>
      </select>

      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
        Guardar
      </button>
    </form>
  </div>
</template>
