<template>
  <div>
    <v-row>
      <v-col cols="12">
        <v-card outlined>
          <v-card outlined color="blue-grey darken-2">
            <v-container fluid>
              <v-row>
                <v-col cols="3" class="py-0 my-0">
                  <v-card-title class="white--text"
                    >Shto mesazh te ri
                  </v-card-title>
                </v-col>
                <v-spacer></v-spacer>
                <v-col cols="3" class="text-right"> </v-col>
              </v-row>
            </v-container>
          </v-card>
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
                      block
                      outlined
                      dense
                      clearable
                      background-color="yellow lighten-5"
                      label="Numri unik"
                      autofocus
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
                      v-model="new_message.text"
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
                <v-btn block color="green" dark @click="submit_new()"
                  >Ruaj</v-btn
                >
              </v-col>
            </v-row>
          </v-container>
        </v-card>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12">
        <v-card outlined>
          <v-card outlined color="blue-grey darken-2">
            <v-container fluid>
              <v-row>
                <v-col cols="3">
                  <v-text-field
                    block
                    :hover="false"
                    dense
                    hide-details
                    solo
                    flat
                    prepend-inner-icon="mdi-magnify"
                    background-color="gray lighten-4"
                    clearable
                    placeholder="Kerko mesazhet"
                    autofocus
                    v-model="messages_search"
                  >
                  </v-text-field>
                </v-col>
                <v-spacer></v-spacer>
                <v-col cols="auto" class="py-0 my-0 text-center">
                  <v-card-title class="white--text">
                    Lista e mesazheve
                  </v-card-title>
                </v-col>
                <v-spacer></v-spacer>
                <v-col cols="3" class="text-right">
                  <!-- <v-btn
                    color="primary"
                    dark
                    depressed
                    @click="new_message = true"
                  >
                    Shto kategori te re
                    <v-icon right small>mdi-plus-circle-outline</v-icon></v-btn
                  > -->
                </v-col>
              </v-row>
            </v-container>
          </v-card>
          <v-data-table
            :headers="headers"
            :items="messages"
            :search="messages_search"
            :items-per-page="8"
          >
            <template v-slot:item.actions="{ item }">
               <inertia-link
                :href="route + '/invoice/message/' + item.id"
                as="button"
                block
              >
                <v-btn small color="secondary" dark @click="() => {}">
                  Shiko
                  <v-icon dark right small>mdi-page-next-outline</v-icon>
                </v-btn>
              </inertia-link>
            </template>

            <template v-slot:item.created_at="{ item }">
              <span>
                {{ moment(item.created_at).format("DD-MM-YYYY HH:mm") }}
              </span>
            </template>
          </v-data-table>
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
    messages: Array,
  },

  data() {
    return {
      new_message: {
        text: "",
      },

      messages_search: "",
      headers: [

        {
          text: "Teksti",
          value: "text",
          width: "66%",
        },

        {
          text: "Shtuar nga",
          value: "created_by",
          width: "14%",
          align: "right",
        },
        {
          text: "Shtuar date",
          value: "created_at",
          width: "10%",
        },
        {
          text: "Veprimet",
          value: "actions",
          sortable: false,
          width: "10%",
          align:'right',
        },
      ],
    };
  },

  methods: {
    submit_new() {
      if (!confirm("Konfirmo?")) {
        return;
      }
      var data = new FormData();
      data.append("text", this.new_message.text || "");

      this.$inertia.post(this.route + "/invoice/message", data);
    },
  },

  computed: {
    route() {
      return "http://" + window.location.host;
    },
  },
};
</script>
