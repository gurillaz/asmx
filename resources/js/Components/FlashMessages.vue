<template>
  <div >
    <v-snackbar
      :value="$page.props.flash.success != null && show"
      :timeout="3000"
       style="positon:absolute!important;"

      bottom
      right
      color="green accent-4"
      elevation="24"
    >
      {{ $page.props.flash.success }}

      <template v-slot:action="{ attrs }">
        <v-btn text fab x-small @click="show = false">
          <v-icon small>mdi-close</v-icon>
        </v-btn>
      </template>
    </v-snackbar>

    <v-snackbar
      :value="
        (Object.keys($page.props.errors).length > 0 || $page.props.error) &&
        show
      "
      :timeout="3000"
       style="positon:absolute!important;"

      bottom
      right
      color="orange accent-4"
      elevation="24"
    >
      <span v-if="$page.props.errors.not_found"> {{$page.props.errors.not_found}} </span>
      <span v-else>

      <span v-if="Object.keys($page.props.errors).length === 1 "
        >Nje nga te dhenat e derguara eshte gabim.
      </span>
      <span v-else>
        Jane {{ Object.keys($page.props.errors).length }} gabime ne te dhenat e
        derguara.</span
      >
      </span>

      <template v-slot:action="{ attrs }">
        <v-btn text fab x-small @click="show = false">
          <v-icon small>mdi-close</v-icon>
        </v-btn>
      </template>
    </v-snackbar>
  </div>
</template>

<script>
export default {
  data() {
    return {
      show: true,
    };
  },
  watch: {
    "$page.props.flash": {
      handler() {
        this.show = true;
      },
      deep: true,
    },
  },
};
</script>
