<template>
  <div>
    <h5>{{ title }}</h5>
    <small>{{ description }}</small>
    <button @click="complete">{{ done ? "Done" : "Not done" }}</button>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
  computed: {},
  methods: {
    complete() {
        console.log('hello')
      axios.get("http://localhost/api/test").then((data) => {
        console.log(data);
      });
    },
  },
  props: {
    title: String,
    description: String,
    done: Boolean,
  },
};
</script>
