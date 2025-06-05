<script setup>
defineProps({ pieces: Array })
</script>

<template>
  <div class="max-w-4xl mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Lista de Piezas</h2>

    <a href="/pieces/create" class="text-blue-600 mb-4 inline-block">+ Nueva Pieza</a>

    <ul>
      <li v-for="piece in pieces" :key="piece.id" class="border-b py-2">
        <div class="flex justify-between">
          <div>
            <strong>{{ piece.name }}</strong> —
            Bloque: {{ piece.block.name }} |
            Peso Teórico: {{ piece.peso_teorico }} |
            Estado: <span :class="piece.estado === 'Pendiente' ? 'text-yellow-600' : 'text-green-600'">
              {{ piece.estado }}
            </span>
          </div>
          <div>
            <a :href="`/pieces/${piece.id}/edit`" class="text-sm text-blue-500 mr-2">Editar</a>
            <form :action="`/pieces/${piece.id}`" method="POST" class="inline">
              <input type="hidden" name="_method" value="DELETE" />
              <input type="hidden" name="_token" :value="$page.props.csrf_token" />
              <button class="text-sm text-red-500" type="submit">Eliminar</button>
            </form>
          </div>
        </div>
      </li>
    </ul>
  </div>
</template>
