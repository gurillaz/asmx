<template>
  <div>
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
                    placeholder="Kerko ofertat"
                    autofocus
                    v-model="offers_search"
                  >
                  </v-text-field>
                </v-col>
                <v-spacer></v-spacer>
                <v-col cols="auto" class="py-0 my-0">
                  <v-card-title class="white--text">
                    Liste e ofertave
                  </v-card-title>
                </v-col>
                <v-spacer></v-spacer>
                <v-col cols="3" class="text-right">
                  <inertia-link
                    :href="route + '/offer/create'"
                    style="text-decoration: none"
                  >
                    <v-btn color="primary" dark depressed>
                      Oferte e re
                      <v-icon right small
                        >mdi-plus-circle-outline</v-icon
                      ></v-btn
                    >
                  </inertia-link>
                </v-col>
              </v-row>
            </v-container>
          </v-card>
   <v-sheet tile color="grey lighten-4">
            <v-container fluid class="py-1">
              <v-row >
                <v-col cols="auto">
                  <p class="text-info caption pb-0 mb-0">Nga data:</p>
                  <p class="py-0 my-0">
                      {{moment().format("DD-MM-YYYY HH:mm")}}
                  </p>
                </v-col>

                <v-col cols="auto">
                  <p class="text-info caption pb-0 mb-0">Deri me date:</p>
                  <p class="py-0 my-0">
                      {{moment().format("DD-MM-YYYY HH:mm")}}

                  </p>
                </v-col>

                <v-spacer></v-spacer>
                <v-col cols="auto">
                        <v-btn small outlined class="mt-2" >Filtro
                             <v-icon right small>mdi-filter</v-icon>

                        </v-btn>

                </v-col>

              </v-row>
            </v-container>
            <v-divider class="mt-0"></v-divider>
          </v-sheet>
          <v-data-table
            :headers="headers"
            :items="offers"
            :search="offers_search"
            item-key="id"
          >
            <template v-slot:item.actions="{ item }">
              <inertia-link
                :href="route + '/offer/' + item.id"
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
                      {{moment(item.created_at).format("DD-MM-YY HH:mm")}}
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
    offers: Array,
  },

  data() {
    return {
      offers_search: null,

      headers: [
        {
          text: "# unik",
          value: "id",
          width: "6%",
          sortable: false,
        },
          {
          text: "Krijuar me",
          value: "created_at",
          width: "10%",
        },
           {
          text: "Subjekti",
          value: "client.subject_name",
          width: "20%",
          align:"center"
        },
        {
          text: "Klienti emri",
          value: "client.first_name",
          width: "10%",
          align:"right"

        },
          {
              text:"Klienti mbiemri",
          value: "client.last_name",
          width: "10%",
          align:'left'
        },

        {
          text: "Nr. i artikujve",
          value: "products_count",
          width: "10%",
        },
        {
          text: "Vlera",
          value: "profacture_sum",
          width: "10%",
        },

        {
          text: "Hape",
          value: "actions",
          sortable: false,
          width: "10%",
          align: "center",
        },
      ],
    };
  },

  methods: {},
  computed: {
    route() {
      return "http://" + window.location.host;
    },
  },
};
</script>
