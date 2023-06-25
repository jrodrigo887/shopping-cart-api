<script lang="ts" setup>
import ButtonComponent from './ButtonComponent.vue';

</script>
<template>
    <div class="bg-slate-100">
        <p>Resumo da compra</p>
        <div>
            <div class="flex space-x-3 bg-white shadow-lg rounded-sm px-2 p-2">
                <p>1X</p>
                <p>Produto 1</p>
                <button class="p-2  transition-colors duration-150 bg-red-500 hover:bg-red-400 w-7 h-7 rounded-sm">
                    <img src="../../assets/delete_white_24dp.svg" alt="adicionar produto" />
                </button>
            </div>
        </div>
        <ButtonComponent :disabled="false">
            <span>Fechar Pedido</span>
        </ButtonComponent>
    </div>
</template>
