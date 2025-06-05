<script setup>
defineProps({ projects: Array })
</script>

<template>
  <div class="p-4 max-w-2xl mx-auto">
    <h2 class="text-xl font-bold mb-4">Lista de Proyectos</h2>

    <a href="/projects/create" class="text-blue-600">+ Nuevo Proyecto</a>

    <ul class="mt-4">
      <li v-for="project in projects" :key="project.id" class="border-b py-2">
        {{ project.name }}
        <a :href="`/projects/${project.id}/edit`" class="ml-4 text-sm text-blue-500">Editar</a>
        <form :action="`/projects/${project.id}`" method="POST" class="inline ml-2">
          <input type="hidden" name="_method" value="DELETE" />
          <input type="hidden" name="_token" :value="$page.props.csrf_token" />
          <button class="text-sm text-red-500" type="submit">Eliminar</button>
        </form>
      </li>
    </ul>
  </div>
</template>
