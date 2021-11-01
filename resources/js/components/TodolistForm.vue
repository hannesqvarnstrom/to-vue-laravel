<template>
<div class="form-container">
<i v-bind:class="[ 'fas', 'icon-button', show ? 'fa-times' : 'fa-plus']" v-on:click="toggleShow"></i>
<form method="post" v-bind:class="{ hidden: !show, shown: show }" class="form card hideable from-left margin-0">
      <input name="title" v-model="title" placeholder="Title"/>
      <button  class="submit button " type="submit" @click="submit">Submit</button>
</form>
</div>
</template>

<script>
export default {
    data() {
        return {
            title: '',
            show: false
        };
    },

    computed: {},
    methods: {
        onFetchData(data){
            this.$emit('stored', data)
        },
        toggleShow(e) {
            this.show = !this.show;
        },
        submit(e) {
            e.preventDefault()
            const title = this.title;
            apiFetch(this.url, {title}, 'POST').then(data =>
            {
                this.onFetchData(data)
            }
                
            )
        }
    },
    props: {
        url: String
    },
};
</script>
