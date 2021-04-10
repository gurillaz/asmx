<template>
  <div>
    <v-row>
      <v-col cols="12">
        <v-card outlined>
          <v-card outlined tile  color="blue-grey darken-2">
            <v-container fluid>
              <v-row>
                <v-col cols="auto" class="py-0 my-0">
                  <v-card-title class="pl-0 white--text">
                    Mesazhi:
                    {{ message.name }}
                  </v-card-title>
                </v-col>
                <v-spacer></v-spacer>
                <v-col cols="3" class="text-right">
                  <inertia-link
                    :href="route + '/invoice/message'"
                    style="text-decoration: none"
                  >
                    <v-btn color="primary" dark depressed>
                      Te gjitha mesazhet
                      <v-icon right small
                        >mdi-format-list-bulleted</v-icon
                      ></v-btn
                    >
                  </inertia-link>
                </v-col>
              </v-row>
            </v-container>
          </v-card>
          <v-sheet tile>
            <v-container fluid class="py-1">
              <v-row class="pr-2">
 
                <v-spacer></v-spacer>

                <v-col cols="auto">
                  <p class="text-info caption pb-0 mb-0">Krijuar me:</p>
                  <p class="py-0 my-0">
                    {{
                      moment(message_copy.created_at).format(
                        "DD-MM-YY HH:mm"
                      )
                    }}
                  </p>
                </v-col>

                <v-col
                  cols="auto"
                  v-if="
                    message_copy.created_at !==
                    message_copy.updated_at
                  "
                >
                  <p class="text-info caption pb-0 mb-0">Modifikuar me:</p>
                  <p class="py-0 my-0">
                    {{
                      moment(message_copy.updated_at).format(
                        "DD-MM-YY HH:mm"
                      )
                    }}
                  </p>
                </v-col>

                <v-col cols="auto">
                  <p class="text-info caption pb-0 mb-0">Nga useri:</p>
                  <p class="py-0 my-0">
                    {{ message_copy.created_by }}
                  </p>
                </v-col>
              </v-row>
            </v-container>
            <v-divider class="mt-0"></v-divider>
          </v-sheet>
          <v-container fluid>
            <v-row>
              <v-col cols="3">
                <p class="text-subtitle-1 font-weight-bold pb-1 mb-1">
                  Te dhenat per mesazhin
                </p>
                <p class="text-body-2 gray--text ml-3 pb-0 mb-0">
                  - Me '*' duhet te plotesohen
                </p>
                <p class="text-body-2 gray--text ml-3 pb-0 mb-0">
                  - Nr. unik caktohet automatikisht
                </p>

              </v-col>
              <v-col cols="9">
                <v-row>
                  <v-col cols="4">
                    <v-text-field
                      :value="message.id"
                      block
                      outlined
                      dense
                      background-color="yellow lighten-5"
                      label="Numri unik"
                      disabled
                    >
                    </v-text-field>

                  </v-col>
                   <v-col cols="8">
                    <v-textarea
                      block
                      outlined
                      rows="3"
                      label="* Teksti i mesazhit"
                      autofocus
                      name="name"
                      v-model="message_copy.text"
                      :error-messages="$page.props.errors.text"
                    >
                    </v-textarea>
                  </v-col>

                </v-row>
              </v-col>
            </v-row>
            <v-divider></v-divider>
            <v-row>
              <v-col cols="9"> </v-col>
              <v-col cols="3">
                <v-btn block color="green" dark @click="submit()">Ruaj</v-btn>
              </v-col>
            </v-row>
          </v-container>
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
  props: {
    message: Object,
  },

  data() {
    return {
      message_copy: {
        text: "",

      },
    };
  },

  methods: {
    submit() {
        this.$page.props.errors = {};
      if (!confirm("Ruaj ndryshimet?")) {
        return;
      }
      var data = new FormData();
      data.append("_method", "PUT");
      data.append("text", this.message_copy.text || "");


      this.$inertia.post(
        this.route + "/invoice/message/" + this.message.id,
        data
      );
    },
  },
  mounted() {
    this.message_copy = JSON.parse(JSON.stringify(this.message));
  },

  computed: {
    route() {
      return "http://" + window.location.host;
    },
  },
};
</script>
