<script setup>
import {onMounted, reactive,} from "vue";
import axios from "axios";

const emit = defineEmits([
    'noteAdded'
])
const formData = reactive({
    text: ''
})
const save = async () => {
    axios.post('/note', formData)
        .then( async response =>{
            const result = await response.data
            console.log(`Save Data!`)
            console.log(result.note)
            emit('noteAdded', result.note)
        })
        .catch(error => {
            console.log(formData.text)
            console.log(`Error Message: ${error}`)
        })
}
</script>

<template>
    <div class="flex justify-center mt-4 gap-2">
        <input type="text" placeholder="今天要做什麼？" class="input input-bordered input-md w-full max-w-xs" v-model="formData.text">
        <button @click="save" class="btn btn-primary">儲存</button>
    </div>
</template>
