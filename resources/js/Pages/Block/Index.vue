<template>
    <div class="max-w-2xl mx-auto p-4">
      <h2 class="text-xl font-bold mb-4">Bloques</h2>
      <a href="/blocks/create" class="text-blue-600">+ Nuevo Bloque</a>
      <ul class="mt-4">
        <li v-for="block in blocks" :key="block.id" class="border-b py-2">
          {{ block.name }} — Proyecto: {{ block.project.name }}
          <a :href="`/blocks/${block.id}/edit`" class="ml-4 text-blue-500 text-sm">Editar</a>
          <form :action="`/blocks/${block.id}`" method="POST" class="inline ml-2">
            <input type="hidden" name="_method" value="DELETE" />
            <input type="hidden" name="_token" :value="$page.props.csrf_token" />
            <button class="text-sm text-red-500" type="submit">Eliminar</button>
          </form>
        </li>
      </ul>
    </div>
  </template>
  
  <script setup>
  defineProps({ blocks: Array })
  </script>
  