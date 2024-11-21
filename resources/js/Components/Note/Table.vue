<script setup>
import axios from "axios";
import { ref } from "vue";

const props = defineProps({
    notes: Array
})
const items = ref(props.notes);

const changeMode = (index) => {
    const item = items.value[index]
    item.isEdit = !item.isEdit
}

const update = (index) => {
    const item = items.value[index];
    axios.patch(`/edit/${item.id}`, {
        text: item.text,
        isEdit: false,
    })
        .then(response => {
            const result = response.data;
            console.log(result.note);
            items.value[index].isEdit = false;
        })
        .catch(error => {
            console.log(error);
        });
};

const remove = (index) => {
    const item = items.value[index]
    axios.delete(`/remove/${item.id}`)
    .then(response=>{
        console.log(`Deleted item with ID ${item.id}`);
        items.value.splice(index, 1);
    })
    .catch(error=>{
        console.log(error)
    })
}
</script>

<template>
    <div class="overflow-x-auto">
        <table class="table table-zebra">
            <thead>
                <th>編號</th>
                <th>內容</th>
                <th>#</th>
            </thead>
            <tbody>
                <tr v-for="(item, index) in items" :key="item">
                    <th>{{ item.id }}</th>
                    <td>
                        <p v-if="!item.isEdit">
                            {{ item.text }}
                        </p>
                        <input v-else type="text" class="input input-bordered input-md w-full max-w-xs" placeholder="今天要做什麼？" v-model="item.text">
                    </td>
                    <td>
                        <button class="btn btn-xs" v-if="!item.isEdit" @click="changeMode(index)">編輯</button>
                        <div v-if="item.isEdit">
                            <button class="btn btn-success btn-outline btn-xs mr-2" @click="update(index)">更新</button>
                            <button class="btn btn-error btn-outline btn-xs" @click="remove(index)">刪除</button>
                        </div>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</template>
