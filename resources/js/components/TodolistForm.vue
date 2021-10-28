<template>
  <form method="post">
      <input name="title" v-model="title" placeholder="Title"/>
      <button type="submit" @click="submit">Submit</button>
  </form>
</template>

<script>
export default {
    data() {
        return {
            title: '',
        };
    },

    computed: {},
    methods: {
        onFetchData(data){
            this.$emit('stored', data)
        },
        submit(e) {
            e.preventDefault()
            const title = this.title;
            apiFetch(this.url, {title}, 'POST').then(data => data.json()).then(data =>
                onDataFetch(data)
            )
        }
    },
    props: {
        url: String
    },
};
</script>
