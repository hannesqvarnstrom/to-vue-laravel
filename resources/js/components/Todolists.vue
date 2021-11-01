<template>
<div>
    <h2 class="text-center" @click="showTodos = !showTodos">Todolists <i v-bind:class="['fas', showTodos ? 'fa-arrow-up' : 'fa-arrow-down']" ></i></h2>
    <create-todolist :url="url"  @toggleLoading="onToggleLoading" @stored="onStored"></create-todolist>
    <ul v-if="(todos.length && showTodos)">
        <li class="card" v-for="todo in todos" :key="todo.id">
            {{todo.id + ', ' + todo.title}}
        </li>
    </ul>
    <div v-if="loading">LOADING
        <i class="fas fa-spinner fa-spin"></i>
    </div>
</div>
</template>
<script>
export default{
    data(){
        return {
            todos: [],
            loading: false,
            showTodos: false
        }
    },
    computed: {},
    methods: {
        onToggleLoading(bool){
            this.loading = bool;
        },
        onStored(data){
            this.todos.push(data)
        }
    },
    created: function(){
        this.loading = true;
        apiFetch(this.url).then(data => {
            this.todos = data;
            this.loading = false;
            })
    },
    props: {
        url: String
    }
}
</script>
