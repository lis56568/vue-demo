<script setup>
import TextInput from "@/Components/Note/TextInput.vue";
import Table from "@/Components/Note/Table.vue";
import {onMounted, onUpdated, ref, watch} from "vue";
import { usePage } from '@inertiajs/vue3'

const { props } = usePage();
const notes = ref([...props.notes])
const addNote = (note) => {
    notes.value.push(note)
}
</script>

<template>
    <div class="container mx-auto">
        <TextInput @noteAdded="addNote"/>
        <Table :notes="notes"/>
    </div>
</template>

<style scoped>

</style>
