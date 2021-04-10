<template>
  <v-row no-gutters class="d-flex d-column justify-center align-center">
    <v-col cols="12" sm="6" md="4" lg="4" xl="3"
      ><v-card
        color="white"
        class="pa-3"
        elevation="24"
      >
        <v-container fluid>
          <form @submit.prevent="submit">
            <v-row no-gutters>
              <v-col cols="12">
                <h3>Kyqu</h3>
                <v-spacer></v-spacer>
                <h6>ASMX</h6>
              </v-col>
            </v-row>
            <v-row no-gutters class="pa-0 ma-0 mx-n7">
                    <v-divider class="my-0 py-0"></v-divider>
                        </v-row>
            <v-row no-gutters>
              <v-col cols="12">
                <ul class="caption red--text">
                  <li v-for="(error, key) in errors" :key="key">
                    {{ error }}
                  </li>
                </ul>
              </v-col>

              <v-col cols="12">
                <v-text-field
                  label="Perdoruesi"
                  name="username"
                  id="username"
                  background-color="white"
                  v-model="form.username"
                  required
                  outlined
                  dense
                  autofocus
                ></v-text-field>
              </v-col>
              <v-col cols="12" class="mt-0 my-0">
                <v-text-field
                  label="Fjalkalimi"
                  name="password"
                  id="password"
                  background-color="white"
                  type="password"
                  v-model="form.password"
                  required
                  outlined
                  dense
                ></v-text-field>
              </v-col>

              <v-col cols="12" class="">
                <v-switch
                  dense
                  inset
                  class="mt-n2 mb-3"
                  hide-details
                  label="Me mbaj mend"
                  v-model="form.remember"
                  :true-value="true"
                >
                </v-switch>
              </v-col>

              <v-col cols="12">
                <v-btn
                class="mt-5"
                  block
                  :disabled="form.processing"
                  color="primary"
                  type="submit"
                  >Kyqu</v-btn
                >
              </v-col>
              <!-- <inertia-link
                                v-if="canResetPassword"
                                href="#"
                                class="caption mt-1"
                            >
                                Kam harruar fjalkalimin
                            </inertia-link> -->
            </v-row>
          </form>
        </v-container>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
import GuestLayout from "@/Layouts/Guest";

export default {
  layout: GuestLayout,

  components: {},

  props: {
    canResetPassword: Boolean,
    status: String,
  },

  data() {
    return {
      remember: false,
      form: this.$inertia.form({
        username: "",
        password: "",
        remember: false,
      }),
    };
  },

  computed: {
    errors() {
      return this.$page.props.errors;
    },

    hasErrors() {
      return Object.keys(this.errors).length > 0;
    },
  },

  methods: {
    submit() {
      this.form
        .transform((data) => ({
          ...data,
          remember: this.form.remember ? "on" : "",
        }))
        .post("/login", {
          onFinish: () => this.form.reset("password"),
        });
    },
  },
};
</script>
