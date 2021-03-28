<template>
  <div>
    <v-row v-if="errors">
      <v-col cols="12">
        <v-expansion-panels flat>
          <v-expansion-panel>
            <v-expansion-panel-header color="red lighten-3">
              Gabim ne ndryshimin e te dhenave
            </v-expansion-panel-header>
            <v-expansion-panel-content color="red red lighten-4" class="pt-3">
              <span v-for="(filed, index) in errors" v-bind:key="index">
                <span v-for="(error, index) in filed" v-bind:key="index">
                  <p class="py-0 my-0">{{ error }}</p>
                </span>
              </span>
            </v-expansion-panel-content>
          </v-expansion-panel>
        </v-expansion-panels>
      </v-col>
    </v-row>
    <v-row>
      <code>

      </code>
      <v-col cols="12">
        <v-card outlined>
          <v-card outlined color="blue-grey darken-2">
            <v-container fluid>
              <v-row>
                <v-col cols="2" class="py-0 my-0">
                  <v-text-field
                    class="pt-3"
                    solo
                    flat
                    dense
                    label="Oferta"
                    single-line
                    hide-details
                    v-model="resource_id"
                    @keypress.enter="open_resource()"
                  ></v-text-field>
                </v-col>
                <v-spacer></v-spacer>
                <v-col cols="auto" class="text-right">
                  <inertia-link
                    :href="route + '/document-type'"
                    style="text-decoration: none"
                  >
                    <v-btn depressed class="mr-1">
                      Cakto mesazhet
                      <v-icon right small
                        >mdi-information-outline</v-icon
                      ></v-btn
                    >
                  </inertia-link>
                  <inertia-link
                    :href="route + '/document-type'"
                    style="text-decoration: none"
                  >
                    <v-btn depressed class="mr-1">
                      Ploteso Faturen
                      <v-icon right small>mdi-file-send-outline</v-icon></v-btn
                    >
                  </inertia-link>
                  <inertia-link
                    :href="route + '/offer/print/' + offer.id"
                    style="text-decoration: none"
                  >
                    <v-btn depressed class="mr-3">
                      Shtyp oferten
                      <v-icon right small>mdi-printer</v-icon></v-btn
                    >
                  </inertia-link>
                  <inertia-link
                    :href="route + '/document-type'"
                    style="text-decoration: none"
                  >
                    <v-btn depressed color="blue" dark>
                      veprimet
                      <v-icon right small
                        >mdi-format-list-bulleted</v-icon
                      ></v-btn
                    >
                  </inertia-link>
                </v-col>
              </v-row>
            </v-container>
          </v-card>
          <!-- {{ offer }} -->
          <v-sheet tile color="grey lighten-4">
            <v-container fluid class="py-1">
              <v-row class="pr-2">
                <v-col cols="auto">
                  <p class="text-info caption pb-0 mb-0">Klienti:</p>
                  <p class="py-0 my-0">
                    [
                    {{ offer.client.id }}
                    ] -
                    {{ offer.client.first_name }} {{ offer.client.last_name }}
                  </p>
                </v-col>

                <v-col cols="auto">
                  <p class="text-info caption pb-0 mb-0">Lloji i klientit:</p>
                  <p class="py-0 my-0">
                    {{ offer.client.client_type }}
                  </p>
                </v-col>
                <v-col cols="auto">
                  <p class="text-info caption pb-0 mb-0">Subjekti:</p>
                  <p class="py-0 my-0">
                    {{ offer.client.subject.name }}
                  </p>
                </v-col>

                <v-col cols="auto">
                  <p class="text-info caption pb-0 mb-0">Komuna/Qyteti:</p>
                  <p class="py-0 my-0">
                    {{ offer.client.subject.city }}
                  </p>
                </v-col>

                <v-col cols="auto">
                  <p class="text-info caption pb-0 mb-0">
                    Kategoria e klientit:
                  </p>
                  <p class="py-0 my-0">
                    {{ offer.client.price_level.name }}
                  </p>
                </v-col>

                <v-col cols="auto">
                  <p class="text-info caption pb-0 mb-0">Borxhi:</p>
                  <p class="py-0 my-0">
                    312 €
                    <!-- {{ offer.client.credit_limit }} -->
                  </p>
                </v-col>

                <v-col cols="auto">
                  <p class="text-info caption pb-0 mb-0">Kredit Limiti:</p>
                  <p class="py-0 my-0">{{ offer.client.credit_limit }} €</p>
                </v-col>
                <v-col cols="auto">
                  <p class="text-info caption pb-0 mb-0">
                    Afati i pageses per fature:
                  </p>
                  <p class="py-0 my-0">
                    {{ offer.client.payment_limit_days }} dite
                  </p>
                </v-col>

                <v-spacer></v-spacer>

                <v-col cols="auto">
                  <p class="text-info caption pb-0 mb-0">Krijuar me:</p>
                  <p class="py-0 my-0">
                    {{ moment(offer.created_at).format("DD-MM-YY HH:mm") }}
                  </p>
                </v-col>

                <v-col
                  cols="auto"
                  v-if="offer.created_at !== offer.modified_at"
                >
                  <p class="text-info caption pb-0 mb-0">Modifikuar me:</p>
                  <p class="py-0 my-0">
                    {{ moment(offer.modified_at).format("DD-MM-YY HH:mm") }}
                  </p>
                </v-col>

                <v-col cols="auto">
                  <p class="text-info caption pb-0 mb-0">Nga useri:</p>
                  <p class="py-0 my-0">
                    {{ offer.created_by }}
                  </p>
                </v-col>
              </v-row>
            </v-container>
            <v-divider class="mt-0"></v-divider>
          </v-sheet>
          <v-data-table
            dense
            :headers="headers"
            :items="offer.products"
            item-key="product_order_no"
            hide-default-footer
          >
            <template v-slot:item.actions="{ item }">
              <v-btn
                icon
                color="black"
                dark
                @click="remove_product(item)"
              >
                <v-icon dark>mdi-delete-circle</v-icon>
              </v-btn>
            </template>

            <!-- <template v-slot:item.custom_product_name="{ item }">
              <v-sheet
                block
                color="green lighten-3"
                rounded
                class="pl-2"
                @dblclick="edit_product_dialog = true"
              >
                {{ item.custom_product_name }}
              </v-sheet>
            </template> -->

            <template v-slot:item.custom_product_name="props">
              <v-edit-dialog
                :return-value.sync="props.item.custom_product_name"
              >
                <v-sheet block color="green lighten-3" rounded class="px-4">
                  {{ props.item.custom_product_name }}
                </v-sheet>

                <template v-slot:input>
                  <v-text-field
                    v-model="props.item.custom_product_name"
                    label="Artikulli"
                    single-line
                  ></v-text-field>
                </template>
              </v-edit-dialog>
            </template>

            <template v-slot:item.quantity="props">
              <v-edit-dialog :return-value.sync="props.item.quantity">
                <v-sheet block color="green lighten-3" rounded class="px-4">
                  {{ Math.round(props.item.quantity * 100) / 100 }}
                </v-sheet>

                <template v-slot:input>
                  <v-text-field
                    v-model="props.item.quantity"
                    label="Sasia"
                    single-line
                  ></v-text-field>
                </template>
              </v-edit-dialog>
            </template>
            <template v-slot:item.price="props">
              <v-edit-dialog :return-value.sync="props.item.price">
                <v-sheet block color="green lighten-3" rounded class="px-4">
                  {{ Math.round(props.item.price * 100) / 100 }}
                </v-sheet>

                <template v-slot:input>
                  <v-text-field
                    v-model="props.item.price"
                    label="Cmimi"
                    single-line
                  ></v-text-field>
                </template>
              </v-edit-dialog>
            </template>

            <template v-slot:item.discount="props">
              <v-edit-dialog :return-value.sync="props.item.discount">
                <v-sheet block color="green lighten-3" rounded class="px-4">
                  {{ Math.round(props.item.discount * 100) / 100 }}%
                </v-sheet>

                <template v-slot:input>
                  <v-text-field
                    v-model="props.item.discount"
                    label="Zbritja"
                    single-line
                  ></v-text-field>
                </template>
              </v-edit-dialog>
            </template>

            <template v-slot:item.sum="{ item }">
              <div>
                {{
                  Math.round(
                    (item.quantity * item.price -
                      (item.discount / 100) * (item.quantity * item.price)) *
                      100
                  ) / 100
                }}
              </div>
            </template>
            <template v-slot:no-data="{ item }">
              <div>
                <p>
                  Nuk ka artikuj. Kerkjo artikujt me poshte per ti shtuar ne
                  oferte/fature
                </p>
              </div>
            </template>
          </v-data-table>
          <v-sheet color="grey lighten-3" class="mt-5">
            <v-container fluid>
              <v-row>
                <v-col cols="2">
                  <v-text-field
                    block
                    :hover="false"
                    dense
                    hide-details
                    outlined
                    prepend-inner-icon="mdi-magnify"
                    background-color="white"
                    clearable
                    placeholder="Shto artikujt"
                    autofocus
                    v-model="product_search_dialog"
                    @keydown.enter="add_product_dialog = true"
                    @dblclick="add_product_dialog = true"
                  >
                  </v-text-field>
                </v-col>

                <v-spacer></v-spacer>
                <v-col cols="auto" class="d-flex align-items-center">
                  <v-btn tile depressed color="white" class="text-none">
                    <span class="font-weight-medium mr-3">Pa zbritje: </span>
                    <span class="font-weight-black"
                      >{{ total_without_discount }} €</span
                    >
                  </v-btn>
                  <v-btn tile depressed color="white" class="text-none">
                    <span
                      :class="calculated_discount !== 0 ? 'orange--text' : ''"
                    >
                      <span class="font-weight-medium mr-3">Zbritje: </span>
                      <span class="font-weight-black"
                        >{{ calculated_discount }} €</span
                      ></span
                    >
                  </v-btn>
                  <v-btn tile depressed color="white" class="text-none">
                    <span class="green-text">
                      <span class="font-weight-medium mr-3">Total: </span>
                      <span class="font-weight-black"
                        >{{ calculated_total }} €</span
                      >
                    </span>
                  </v-btn>
                </v-col>
              </v-row>
            </v-container>
          </v-sheet>
        </v-card>
      </v-col>
    </v-row>

    <v-dialog transition="dialog-top-transition" v-model="add_product_dialog">
      <v-card>
        <v-toolbar dense color="primary" dark flat>
          <v-icon dark>mdi-card-search</v-icon>
          <span class="ml-3"> Kerko artikullin </span>
          <v-spacer></v-spacer>
          <v-btn text @click="add_product_dialog = false" small dark
            >Mbyll[esc]</v-btn
          >
        </v-toolbar>
        <v-container fluid>
          <v-row>
            <v-col cols="3"> </v-col>

            <v-col cols="6">
              <v-text-field
                class="mt-9"
                outlined
                dense
                background-color="blue-grey lighten-5"
                autofocus
                clearable
                prepend-inner-icon="mdi-magnify"
                placeholder="Kerko sipas emrit, brendit, # unik/origjinal/furnitorit/prodhuesit, "
                v-model="product_search_dialog"
              >
              </v-text-field>
            </v-col>
            <v-col cols="3"> </v-col>
          </v-row>
        </v-container>
        <v-data-table
          dense
          :headers="add_product_table_headers"
          :items="products"
          :search="product_search_dialog"
          height="55vh"
        >
          <template v-slot:item.actions="{ item }">
            <div class="text-center">
              <v-icon v-if="product_already_in_offer(item.id)" color="green">
                mdi-checkbox-marked-circle</v-icon
              >

              <v-btn
                v-else
                color="primary"
                class="my-1"
                small
                outlined
                dark
                @click="add_product(item)"
              >
                Shto
                <v-icon small right>mdi-plus-circle</v-icon>
              </v-btn>
            </div>
          </template>
        </v-data-table>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import AuthLayout from "@/Layouts/Authenticated";

export default {
  layout: AuthLayout,

  components: {},
  props: {
    offer: Object,
    products: Array,
  },

  data() {
    return {
      resource_id: "",
      errors: null,
      add_product_dialog: false,
      edit_product_dialog: false,
      product_search_dialog: null,
      add_product_table_headers: [
        {
          text: "Nr. Unik",
          value: "id",
          width: "5%",
          sortable: false,
        },
        {
          text: "Artikulli",
          value: "name",
          width: "25%",
          sortable: false,
        },

        {
          text: "# origjinal",
          value: "original_no",
          width: "7%",
          sortable: false,
        },

        {
          text: "# i furnizuesi",
          value: "supplier_no",
          width: "7%",
          sortable: false,
        },
        {
          text: "# furnizuesit",
          value: "producer_no",
          width: "7%",
          sortable: false,
        },
        {
          text: "Brendi",
          value: "brand.name",
          width: "15%",
          sortable: false,
        },

        {
          text: "Stoku",
          value: "stock",
          width: "5%",
          sortable: false,
        },
        {
          text: "Cmimi",
          value: "buying_price",
          width: "10%",
          sortable: false,
        },
        {
          text: "Shto",
          value: "actions",
          sortable: false,
          width: "5%",
          align: "left",
        },
      ],
      headers: [
        {
          text: "#",
          align: "start",
          sortable: false,
          value: "product_order_no",
          width: "1%",
        },
        {
          text: "Nr. Unik",
          value: "id",
          width: "4%",
          sortable: false,
        },
        {
          text: "Artikulli",
          value: "custom_product_name",
          width: "30%",
          sortable: false,
        },
        {
          text: "# furnizuesit",
          value: "supplier_no",
          width: "10%",
          sortable: false,
        },
        {
          text: "# origjinal",
          value: "original_no",
          width: "10%",
          sortable: false,
        },
        {
          text: "Sasia",
          value: "quantity",
          width: "5%",
          sortable: false,
        },
        { text: "Cmimi", value: "price", width: "5%", sortable: false },
        {
          text: "Zbritje",
          value: "discount",
          width: "5%",
          sortable: false,
        },
        { text: "Vlera", value: "sum", width: "5%", sortable: false },
        {
          text: "Fshij",
          value: "actions",
          sortable: false,
          width: "5%",
        },
      ],
    };
  },

  methods: {
    open_resource() {
      this.$inertia.get("/offer/" + this.resource_id);
    },
    remove_product(product) {
      if (confirm("Konfirmo fshirjen e artikullit!")) {
        var data = new FormData();
        data.append("offer_id", this.offer.id || "");
        data.append("product_id", product.id || "");

        axios
          .post("/api/offer/remove_product", data)
          .then((response) => {
            //   console.log(response.data.products);

            this.offer.products = response.data.products;
          })
          .catch((error) => {
            this.errors = error.response.data.errors;
          });
      }
    },
    add_product(product) {
      var data = new FormData();
      data.append("offer_id", this.offer.id || "");
      data.append("product_id", product.id || "");

      axios
        .post("/api/offer/add_product", data)
        .then((response) => {
          //   console.log(response.data.products);

          this.offer.products = response.data.products;
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },

    update_offer() {
      this.$inertia.put("/offer/" + this.offer.id, {});
    },
    product_already_in_offer(item_id) {
      return this.offer.products.some((item) => item.id === item_id);
    },
  },

  computed: {
    calculated_total() {
      var total = 0;

      this.offer.products.forEach((item) => {
        total =
          total +
          item.quantity * item.price -
          (item.quantity * item.price * item.discount) / 100;
      });
      return Math.round(total * 100) / 100;
    },

    total_without_discount() {
      var total = 0;

      this.offer.products.forEach((item) => {
        total = total + item.quantity * item.price;
      });
      return Math.round(total * 100) / 100;
    },

    calculated_discount() {
      var discount_sum = this.calculated_total - this.total_without_discount;
      return Math.round(discount_sum * 100) / 100;
    },
    route() {
      return "http://" + window.location.host;
    },
  },

  mounted() {
    this.resource_id = this.offer.id;
  },
};
</script>
