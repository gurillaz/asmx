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
                    placeholder="Kerko furnitoret"
                    autofocus
                    v-model="suppliers_search"
                  >
                  </v-text-field>
                </v-col>
                <v-spacer></v-spacer>
                <v-col cols="3"   class="py-0 my-0">
                  <v-card-title class="white--text"> Lista e furnitoreve </v-card-title>
                </v-col>
                <v-spacer></v-spacer>
                <v-col cols="3" class="text-right">
                  <inertia-link
                    :href="route + '/supplier/create'"
                    style="text-decoration: none"
                  >
                    <v-btn color="primary" dark depressed>
                      Shto furnitor te ri
                      <v-icon right small
                        >mdi-plus-circle-outline</v-icon
                      ></v-btn
                    >
                  </inertia-link>
                </v-col>
              </v-row>
            </v-container>
          </v-card>
          <v-data-table
            :headers="headers"
            :items="suppliers"
            :search="suppliers_search"
            item-key="product_order_no"
          >
            <template v-slot:item.actions="{ item }">
              <inertia-link
                :href="route + '/supplier/' + item.id"
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
    suppliers: Array,
  },

  data() {
    return {
      suppliers_search: null,

      headers: [
        {
          text: "# Unik",
          value: "id",
          width: "6%",
          sortable: false,
        },
        {
          text: "Emri i subjektit",
          value: "name",
          width: "34%",
        },

                {
          text: "Qyteti",
          value: "city",
          width: "10%",
        },

                        {
          text: "Shteti",
          value: "country",
          width: "10%",
        },
        {
          text: "Personi kontaktues",
          value: "contact_name",
          width: "10%",
          align:'right'
        },
        {
          text: "Telefon(1)",
          value: "phone_1",
          width: "10%",
        },

        {
          text: "Numri artikujve",
          value: "products_count",
          width: "10%",
          align:'center'
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
