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
                    placeholder="Kerko porosite"
                    autofocus
                    v-model="orders_search"
                  >
                  </v-text-field>
                </v-col>
                <v-spacer></v-spacer>
                <v-col cols="3" class="py-0 my-0">
                  <v-card-title class="white--text">
                    Lista e porosive ne pritje
                  </v-card-title>
                </v-col>
                <v-spacer></v-spacer>
                <v-col cols="3" class="text-right">
                  <inertia-link
                    :href="route + '/product/order/create'"
                    style="text-decoration: none"
                  >
                    <v-btn color="primary" dark depressed>
                      Shto porosi te ri
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
            :items="orders"
            :search="orders_search"
            item-key="product_order_no"
          >
            <template v-slot:item.actions="{ item }">
              <inertia-link
                :href="route + '/product/order/' + item.id"
                as="button"
                block
              >
                <v-btn small color="secondary" dark @click="() => {}">
                  Hape
                  <v-icon dark right small>mdi-page-next-outline</v-icon>
                </v-btn>
              </inertia-link>
            </template>
            <template v-slot:item.created_at="{ item }">
              <div>
                <span v-if="item.created_at === item.updated_at">
                  {{ moment(item.created_at).format("DD-MM-YY HH:mm") }}
                </span>
                <span v-else>
                  {{ moment(item.updated_at).format("DD-MM-YY HH:mm") }}[m]
                </span>
              </div>
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
    orders: Array,
  },

  data() {
    return {
      orders_search: null,

      headers: [
        {
          text: "# porosise",
          value: "id",
          width: "6%",
          sortable: false,
        },
        {
          text: "Emri i subjektit",
          value: "subject.name",
          width: "34%",
        },

        {
          text: "Personi kontaktues",
          value: "subject.contact_name",
          width: "10%",
        },

        {
          text: "Telefon",
          value: "subject.phone_1",
          width: "10%",
        },

        {
          text: "Numri artikujve",
          value: "products_count",
          width: "10%",
          align: "right",
        },

        {
          text: "Vlera e fatures",
          value: "profacture_sum",
          width: "10%",
          align: "right",
        },

        {
          text: "Krijuar me: ",
          value: "created_at",
          width: "10%",
          align: "right",
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
