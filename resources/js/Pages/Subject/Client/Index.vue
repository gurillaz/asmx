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
                    placeholder="Kerko klientet"
                    autofocus
                    v-model="clients_search"
                  >
                  </v-text-field>
                </v-col>
                    <v-spacer></v-spacer>
                <v-cols cols="3">
                    <v-card-title  class="white--text">
                        Lista e klienteve
                    </v-card-title>
                </v-cols>
                <v-spacer></v-spacer>
                <v-col cols="3" class="text-right">
                  <v-btn color="primary" dark depressed>
                    Shto klient te ri
                    <v-icon right small>mdi-plus-circle-outline</v-icon></v-btn
                  >
                </v-col>
              </v-row>
            </v-container>
          </v-card>
          <v-data-table
            :headers="headers"
            :items="clients"
            :search="clients_search"
            item-key="product_order_no"
          >
            <template v-slot:item.actions="{ item }">
              <inertia-link
                :href="route + '/client/' + item.id"
                as="button"
                block
              >
                <v-btn small color="secondary" dark @click="() => {}">
                  Shiko
                  <v-icon dark right small>mdi-page-next-outline</v-icon>
                </v-btn>
              </inertia-link>
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
    clients: Array,
  },

  data() {
    return {
      clients_search: null,

      headers: [
        {
          text: "# Unik",
          value: "subject.id",
          width: "6%",
          sortable: false,
        },
        {
          text: "Subjekti",
          value: "subject.name",
          width: "20%",
        },
        {
          text: "Vendi/Qyteti",
          value: "subject.city",
          width: "19%",
          align: "center",
        },
        {
          text: "Emri",
          value: "first_name",
          width: "10%",
          align: "right",
        },

        {
          text: "Mbiemri",
          value: "last_name",
          width: "10%",
        },
        {
          text: "Nr. fiskal",
          value: "subject.fiscal_no",
          width: "8%",
        },
        {
          text: "Telefon(1)",
          value: "phone_1",
          width: "10%",
        },
        {
          text: "Kategorizimi",
          value: "price_level.name",
          width: "7%",
          sortable: false,
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
