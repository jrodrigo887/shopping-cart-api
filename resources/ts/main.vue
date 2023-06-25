<script setup lang="ts">
import { ref } from 'vue';

const name = ref('Rodrigo');


</script>
<template>
    <div>
        <h1 class="text-3xl font-bold underline bg-slate-500">
    Olá {{ name }}
  </h1>
    </div>
</template>
