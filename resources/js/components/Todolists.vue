<template>
<div>
    <p>Todolists</p>
    <ul :v-if="todos.length">
        <li v-for="todo in todos" :key="todo.id">
            {{todo.id + ', ' + todo.title}}
        </li>
    </ul>
    <create-todolist :url="url"></create-todolist>
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
    methods: {},
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
