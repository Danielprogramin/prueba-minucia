<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  block: Object,
  projects: Array
})

const form = useForm({
  name: props.block?.name || '',
  project_id: props.block?.project_id || ''
})

const isEdit = !!props.block
const submit = () => {
  const route = isEdit ? `/blocks/${props.block.id}` : '/blocks'
  isEdit ? form.put(route) : form.post(route)
}
</script>

<template>
  <div class="max-w-md mx-auto p-4">
    <h2 class="text-lg font-bold mb-4">{{ isEdit ? 'Editar' : 'Nuevo' }} Bloque</h2>

    <form @submit.prevent="submit">
      <label class="block mb-1">Nombre</label>
      <input v-model="form.name" type="text" class="w-full border px-2 py-1 rounded mb-2" />

      <label class="block mb-1">Proyecto</label>
      <select v-model="form.project_id" class="w-full border px-2 py-1 rounded mb-4">
        <option value="">-- Selecciona un proyecto --</option>
        <option v-for="p in projects" :key="p.id" :value="p.id">{{ p.name }}</option>
      </select>

      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
        {{ isEdit ? 'Actualizar' : 'Guardar' }}
      </button>
    </form>
  </div>
</template>
