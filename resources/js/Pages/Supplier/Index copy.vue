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
                    placeholder="Kerko brendet"
                    autofocus
                    v-model="brands_search"
                  >
                  </v-text-field>
                </v-col>
                <v-spacer></v-spacer>
                <v-col cols="3"   class="py-0 my-0">
                  <v-card-title class="white--text"> Lista e brendeve </v-card-title>
                </v-col>
                <v-spacer></v-spacer>
                <v-col cols="3" class="text-right">
                  <inertia-link
                    :href="route + '/brand/create'"
                    style="text-decoration: none"
                  >
                    <v-btn color="primary" dark depressed>
                      Shto brend te ri
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
            :items="brands"
            :search="brands_search"
            item-key="product_order_no"
          >
            <template v-slot:item.actions="{ item }">
              <inertia-link
                :href="route + '/brand/' + item.id"
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
    brands: Array,
  },

  data() {
    return {
      brands_search: null,

      headers: [
        {
          text: "# Unik",
          value: "id",
          width: "6%",
          sortable: false,
        },
        {
          text: "Brendi",
          value: "name",
          width: "35%",
        },
        {
          text: "Kompania prodhuese",
          value: "producing_company",
          width: "25%",
        },
        {
          text: "Vendi i origjines",
          value: "producing_country",
          width: "14%",
        },

        {
          text: "Numri artikujve",
          value: "products_count",
          width: "10%",
        },
             {
          text: "Nga N furnitor",
          value: "suppliers_count",
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
