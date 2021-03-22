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
                    placeholder="Kerko tipet e dok"
                    autofocus
                    v-model="document_types_search"
                  >
                  </v-text-field>
                </v-col>
                <v-spacer></v-spacer>
                <v-col cols="auto" class="py-0 my-0">
                  <v-card-title class="white--text">
                    Tipet e dokumenteve materale
                  </v-card-title>
                </v-col>
                <v-spacer></v-spacer>
                <v-col cols="3" class="text-right">
                  <inertia-link
                    :href="route + '/document-type/create'"
                    style="text-decoration: none"
                  >
                    <v-btn color="primary" dark depressed>
                      Tip i ri i dokumenteve
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
            :items="document_types"
            :search="document_types_search"
            item-key="product_order_no"
          >
            <template v-slot:item.actions="{ item }">
              <inertia-link
                :href="route + '/document-type/' + item.id"
                as="button"
                block
              >
                <v-btn small color="secondary" dark @click="() => {}">
                  Shiko
                  <v-icon dark right small>mdi-page-next-outline</v-icon>
                </v-btn>
              </inertia-link>
            </template>

            <template v-slot:item.stock_type="{ item }">
              <v-chip v-if="item.stock_type === 'IN'" small dark class="font-weight-bold" color="green accent-4"> Hyrje </v-chip>
              <v-chip v-else dark small class="font-weight-bold" color="orange accent-4"> Dalje </v-chip>
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
    document_types: Array,
  },

  data() {
    return {
      document_types_search: null,

      headers: [
        {
          text: "# unik",
          value: "id",
          width: "6%",
          sortable: false,
        },
        {
          text: "Emri",
          value: "name",
          width: "20%",
        },
                {
          text: "Pershrkimi",
          value: "info",
          width: "39%",
        },
        {
          text: "Veprimi stok",
          value: "stock_type",
          width: "10%",
        },
        {
          text: "Numri i dokumenteve",
          value: "document_count",
          width: "15%",
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
