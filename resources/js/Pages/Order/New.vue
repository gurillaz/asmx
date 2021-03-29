<template>
  <div>
    <v-row>
      <v-col cols="12">
        <v-card outlined>
          <v-card outlined color="blue-grey darken-2">
            <v-container fluid>
              <v-row>
                <v-col cols="3" class="py-0 my-0">
                  <v-card-title class="white--text"> Porosi e re </v-card-title>
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
                  Furnitori
                </p>
                <p class="text-body-2 gray--text ml-3 pb-0 mb-0">
                  - Me '*' duhet te plotesohen
                </p>
                <p class="text-body-2 gray--text ml-3 pb-0 mb-0">
                  - Zgjjidh furnitorin
                </p>
                <p class="text-body-2 gray--text ml-3 pb-0 mb-0">
                  - Sipas stokut minimal ose maksimal
                </p>
              </v-col>
              <v-col cols="9">
                <v-row>
                  <v-col cols="6">
                    <v-autocomplete
                      class="mt-3"
                      :items="suppliers"
                      item-text="name"
                      item-value="id"
                      outlined
                      background-color="grey lighten-5"
                      flat
                      clearable
                      label="* Furnitori"
                      v-model="new_order.supplier_id"
                      :error-messages="$page.props.errors.supplier_id"
                    ></v-autocomplete>
                  </v-col>
                  <v-col cols="6"></v-col>

                  <v-col cols="6">
                    <v-autocomplete
                      class="mt-3"
                      :items="stock_type"
                      item-text="text"
                      item-value="value"
                      outlined
                      clearable

                      background-color="grey lighten-5"
                      flat
                      label="* Sipas stokut"
                      v-model="new_order.stock_type"
                      :error-messages="$page.props.errors.stock_type"
                    ></v-autocomplete>
                  </v-col>
                  <v-col cols="6"></v-col>
                </v-row>
              </v-col>
            </v-row>
            <v-divider></v-divider>
            <v-row>
              <v-col cols="9"> </v-col>
              <v-col cols="3">
                <v-btn block color="green" dark @click="submit()">Vazhdo</v-btn>
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
    suppliers: Array,
  },

  data() {
    return {
      client_search: "",

      stock_type: [
        {
          text: "Stokut minimal",
          value: "minimal_stock",
        },
        {
          text: "Stokut maximal",
          value: "maximal_stock",
        },

        {
          text: "Porosi e zbrazet",
          value: "none",
        },
      ],
      new_order: {
        supplier_id: "",
        stock_type: null,
      },
    };
  },

  methods: {
    submit(id) {
      var data = new FormData();
      data.append("supplier_id", this.new_order.supplier_id || "");
      data.append("stock_type", this.new_order.stock_type || "");

      this.$inertia.post(this.route + "/product/order", data);
    },
  },

  computed: {
    route() {
      return "http://" + window.location.host;
    },
  },
};
</script>

