<template>
  <div>
    <v-row>
      <v-col cols="3">
        <v-card outlined color="" min-height="90vh">
          <p>Shortcuts</p>
        </v-card>
      </v-col>
      <v-col cols="6">
        <v-row>
          <v-col cols="12">
            <v-card outlined color="" min-height="40vh">
              <p>Ofertat e fundit</p>
            </v-card>
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="12">
            <v-card outlined color="" min-height="40vh">
              <p>Faturat e fundit</p>
            </v-card>
          </v-col>
        </v-row>
      </v-col>

      <v-col cols="3">
        <v-card outlined color="" min-height="90vh">
          <p>Empty Slot</p>
        </v-card>
      </v-col>
    </v-row>
  </div>
</template>

<script>
import AuthLayout from "@/Layouts/Authenticated";

export default {
  layout: AuthLayout,

  components: {},

  data() {
    return {};
  },

  methods: {},
};
</script>
