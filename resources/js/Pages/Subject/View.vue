<template>
  <div>
    <v-row>
      <v-col cols="6">
        <v-card outlined min-height="10vh"> </v-card>
      </v-col>
      <v-col cols="6">
        <v-card outlined min-height="10vh">
          <v-simple-table dense>
            <thead>
              <tr>
                <th class="text-center" colspan="2">Te dhenat per klientin</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-info">Numri i subjektit / Subjekti:</td>
                <td class="font-weight-medium text-right">
                  123 / Auto servis asdasd
                </td>
              </tr>
              <tr>
                <td class="text-info">Vendi / Adresa:</td>
                <td class="font-weight-medium text-right">
                  Suhareke / Te rrethi
                </td>
              </tr>
              <tr>
                <td class="text-info">Personi kontaktues / Telefon:</td>
                <td class="font-weight-medium text-right">
                  {{ offer.client.first_name }} {{ offer.client.last_name }} /
                  {{ offer.client.phone_1 }}
                </td>
              </tr>

              <tr>
                <td class="font-wight-bolder text-info">
                  Borgji / Kredit Limiti:
                </td>
                <td class="font-weight-bold text-right">
                  123 € / {{ offer.client.credit_limit }} €
                </td>
              </tr>
            </tbody>
          </v-simple-table>
        </v-card>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12">
        <v-card outlined>
          <v-card outlined color="blue-grey darken-2">
            <v-container fluid>
              <v-row>
                <v-col cols="auto" class="d-flex d-col align-items-center">
                  <span>Oferta:</span>
                </v-col>
                <v-col cols="2">
                  <v-text-field
                    background-color="white"
                    dense
                    hide-details
                    :value="offer.id"
                    outlined
                  ></v-text-field>
                </v-col>
                <v-col cols="2">
                  <v-text-field
                    background-color="white"
                    dense
                    hide-details
                    :value="offer.updated_at"
                    outlined
                  ></v-text-field>
                </v-col>
                <v-spacer />
                <v-col cols="auto">
                  <v-btn block color="primary" dark>
                    Veprimet
                    <v-icon right>mdi-menu-down</v-icon></v-btn
                  >
                </v-col>
              </v-row>
            </v-container>
          </v-card>
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
                @click="remove_product(item.product_order_no)"
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
                <v-sheet block color="green lighten-3" rounded class="px-2">
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
                <v-sheet block color="green lighten-3" rounded class="px-2">
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
                <v-sheet block color="green lighten-3" rounded class="px-2">
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
                <v-sheet block color="green lighten-3" rounded class="px-2">
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
          <v-sheet color="blue-grey darken-2">
            <v-container fluid>
              <v-row>
                <v-col cols="2" class="py-0">
                  <v-text-field
                    class="mt-9"
                    outlined
                    dense
                    hide-details
                    placeholder="Shto artikujt"
                    background-color="blue-grey lighten-5"
                    autofocus
                    v-model="product_search_dialog"
                    @keydown.enter="add_product_dialog = true"
                  >
                  </v-text-field>
                </v-col>
                <v-col cols="12"></v-col>
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
                append-icon="mdi-magnify"
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
      add_product_dialog: true,
      edit_product_dialog: false,
      product_search_dialog: null,
      add_product_table_headers: [
        { text: "Nr. Unik", value: "id", width: "5%", sortable: false },
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
        { text: "Nr. Unik", value: "id", width: "4%", sortable: false },
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
        { text: "Sasia", value: "quantity", width: "5%", sortable: false },
        { text: "Cmimi", value: "price", width: "5%", sortable: false },
        { text: "Zbritje", value: "discount", width: "5%", sortable: false },
        { text: "Vlera", value: "sum", width: "5%", sortable: false },
        { text: "Fshij", value: "actions", sortable: false, width: "5%" },
      ],
    };
  },

  methods: {
    remove_product(product_order_no) {
      if (confirm("Konfirmo fshirjen e artikullit!")) {
        this.offer.products = this.offer.products.filter((item) => {
          return product_order_no !== item.product_order_no;
        });

        this.offer.products.forEach((item, index) => {
          item.product_order_no = index + 1;
          return;
        });
      }
    },
    add_product(product) {
      var product_obj_copy = JSON.parse(JSON.stringify(product));
      product_obj_copy["quantity"] = 1;
      product_obj_copy["custom_product_name"] = product.name;
      product_obj_copy["price"] =
        product_obj_copy.cost *
        this.offer.client.price_level.quota *
        this.offer.client.price_increase_quota;
      product_obj_copy["discount"] = 0.0;
      product_obj_copy["product_order_no"] = this.offer.products.length + 1;

      this.offer.products.push(product_obj_copy);
    },

    update_offer() {
      this.$inertia.put("/offer/" + this.offer.id, {});
    },
    product_already_in_offer(item_id) {
      return this.offer.products.some((item) => item.id === item_id);
    },
  },

  computed: {
    route() {
      return "http://" + window.location.host;
    },
  },
};
</script>

