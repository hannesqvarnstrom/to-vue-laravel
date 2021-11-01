<template>
<div>
    <h2 class="text-center underline">Todolists</h2>
    <create-todolist :url="url" @stored="onStored"></create-todolist>
    <ul :v-if="todos.length">
        <li class="card" v-for="todo in todos" :key="todo.id">
            {{todo.id + ', ' + todo.title}}
        </li>
    </ul>
    
</div>
</template>
<script>
export default{
    data(){
        return {
            todos: []
        }
    },
    computed: {},
    methods: {
        onStored(data){
            this.todos.push(data)
        }
    },
    created: function(){
        apiFetch(this.url).then(data => {
            this.todos = data;
            })
    },
    props: {
        url: String
    }
}
</script>
