<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({ project: Object })

const form = useForm({
  name: props.project?.name || ''
})

const isEdit = !!props.project
const submit = () => {
  if (isEdit) {
    form.put(`/projects/${props.project.id}`)
  } else {
    form.post('/projects')
  }
}
</script>

<template>
  <div class="p-4 max-w-md mx-auto">
    <h2 class="text-lg font-bold mb-4">{{ isEdit ? 'Editar' : 'Nuevo' }} Proyecto</h2>

    <form @submit.prevent="submit">
      <label class="block mb-1">Nombre del proyecto</label>
      <input v-model="form.name" type="text" class="w-full border px-2 py-1 rounded" />
      <div class="text-red-500 text-sm" v-if="form.errors.name">{{ form.errors.name }}</div>

      <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">
        {{ isEdit ? 'Actualizar' : 'Guardar' }}
      </button>
    </form>
  </div>
</template>
