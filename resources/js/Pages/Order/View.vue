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
                    label="Porosia"
                    single-line
                    hide-details
                    v-model="resource_id"
                    @keypress.enter="open_resource()"
                  ></v-text-field>
                </v-col>
                <v-spacer></v-spacer>
                <v-col cols="auto" class="text-right">
                  <v-btn
                    depressed
                    class="mr-3"
                    @click="import_excel_dialog = true"
                  >
                    Excel import
                    <v-icon right small>mdi-import</v-icon></v-btn
                  >

                  <v-btn depressed class="mr-3" @click="export_excel()">
                    Excel export
                    <v-icon right small>mdi-printer</v-icon></v-btn
                  >

                  <inertia-link
                    :href="route + '/document-type'"
                    style="text-decoration: none"
                  >
                    <v-btn depressed class="mr-1" color="green">
                      Perfundo porosine
                      <v-icon right small>mdi-file-send-outline</v-icon></v-btn
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
          <!-- {{ order }} -->
          <v-sheet tile color="grey lighten-4">
            <v-container fluid class="py-1">
              <v-row class="pr-2">
                <v-col cols="auto">
                  <p class="text-info caption pb-0 mb-0">Furnziuesi:</p>
                  <p class="py-0 my-0">
                    [
                    {{ order.subject.id }}
                    ] -
                    {{ order.subject.name }}
                  </p>
                </v-col>

                <v-col cols="auto">
                  <p class="text-info caption pb-0 mb-0">Qyteti/Adresa:</p>
                  <p class="py-0 my-0">
                    {{ order.subject.city }}
                  </p>
                </v-col>

                <v-col cols="auto">
                  <p class="text-info caption pb-0 mb-0">:</p>
                  <p class="py-0 my-0">
                    {{ order.subject.address }}
                  </p>
                </v-col>
                <v-col cols="auto">
                  <p class="text-info caption pb-0 mb-0">Personi kontaktues:</p>
                  <p class="py-0 my-0">
                    {{ order.subject.first_name }}
                    {{ order.subject.last_name }}
                  </p>
                </v-col>

                <v-col cols="auto">
                  <p class="text-info caption pb-0 mb-0">Telefon(1):</p>
                  <p class="py-0 my-0">
                    {{ order.subject.phone_1 }}
                  </p>
                </v-col>

                <v-col cols="auto">
                  <p class="text-info caption pb-0 mb-0">Email:</p>
                  <p class="py-0 my-0">
                    {{ order.subject.email }}
                  </p>
                </v-col>

                <v-spacer></v-spacer>

                <v-col cols="auto">
                  <p class="text-info caption pb-0 mb-0">Krijuar me:</p>
                  <p class="py-0 my-0">
                    {{ moment(order.created_at).format("DD-MM-YY HH:mm") }}
                  </p>
                </v-col>

                <v-col
                  cols="auto"
                  v-if="order.created_at !== order.modified_at"
                >
                  <p class="text-info caption pb-0 mb-0">Modifikuar me:</p>
                  <p class="py-0 my-0">
                    {{ moment(order.modified_at).format("DD-MM-YY HH:mm") }}
                  </p>
                </v-col>

                <v-col cols="auto">
                  <p class="text-info caption pb-0 mb-0">Nga useri:</p>
                  <p class="py-0 my-0">
                    {{ order.created_by }}
                  </p>
                </v-col>
              </v-row>
            </v-container>
            <v-divider class="mt-0"></v-divider>
          </v-sheet>

          <v-data-table
            dense
            :headers="headers"
            :items="order.products"
            item-key="id"
            :items-per-page="order.products.length"
            hide-default-footer
          >
            <template v-slot:item.actions="{ item }">
              <v-btn icon color="black" dark @click="remove_product(item)">
                <v-icon dark>mdi-delete-circle</v-icon>
              </v-btn>
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

            <template v-slot:item.sum="{ item }">
              <div>
                {{ Math.round(item.quantity * item.buying_price * 100) / 100 }}
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
                    <span class="font-weight-medium mr-3">Artikuj: </span>
                    <span class="font-weight-black">{{
                      order.products.length
                    }}</span>
                  </v-btn>
                  <v-btn tile depressed color="white" class="text-none">
                    <span class="font-weight-medium mr-3">Cope: </span>
                    <span class="font-weight-black">{{ order_quantity }}</span>
                  </v-btn>
                  <v-btn tile depressed color="white" class="text-none">
                    <span class="green-text">
                      <span class="font-weight-medium mr-3">Total: </span>
                      <span class="font-weight-black">{{ order_sum }} €</span>
                    </span>
                  </v-btn>
                </v-col>
              </v-row>
            </v-container>
          </v-sheet>
        </v-card>
      </v-col>
    </v-row>

    <v-dialog transition="dialog-top-transition" v-model="import_excel_dialog">
      <v-card class="pb-8">
        <v-toolbar dense color="primary" dark flat>
          <v-icon dark>mdi-import</v-icon>
          <span class="ml-3"> Importo artikujt nga excel </span>
          <v-spacer></v-spacer>

          <v-btn text @click="import_excel_dialog = false" small dark
            >Mbyll[esc]</v-btn
          >
        </v-toolbar>
        <v-container fluid>
          <v-row>
            <v-col cols="5">
              <v-file-input
                accept=".xls, .xlsx"
                outlined
                dense
                v-model="imported_file"
                show-size
                truncate-length="100"
                placeholder="Kliko per te shtuar fajllin"
                hide-details
                @change="import_excel()"
                @click:clear="clear_file_input()"
              ></v-file-input>
            </v-col>
            <v-spacer></v-spacer>
            <v-col cols="3">
              <v-btn
                @click="add_imported_products()"
                block
                outlined
                color="green"
                :disabled="
                  imported_excel_products_found.length == 0 ||
                  all_valid_rows_imported ||
                  import_loading
                "
              >
                Shto ne porosi
                <v-icon dark right>mdi-import</v-icon>
              </v-btn>
            </v-col>
          </v-row>

          <v-row class="mt-5" v-if="imported_file == null">
            <v-col cols="12">
              <p
                class="text-overline font-weight-bold grey--text text-center my-12"
              >
                <v-icon left>mdi-information-outline</v-icon>

                Shto excel-fajllin per te importuar artikujt
              </p>
            </v-col>
          </v-row>
        </v-container>
        <template v-if="imported_excel_products_found.length !== 0">
          <p class="text-overline font-weight-bold green--text text-center">
            Valide({{ imported_excel_products_found.length }} rreshta):
          </p>

          <v-data-table
            class="mt-5"
            dense
            :headers="imported_excel_products_found_table_headers"
            :items="imported_excel_products_found"
            :items-per-page="imported_excel_products_found.length"
            hide-default-footer
          >
            <template v-slot:item.actions="{ item }">
              <div class="text-center">
                <v-icon v-if="product_already_in_order(item.id)" color="green">
                  mdi-checkbox-marked-circle</v-icon
                >

                <v-icon v-else color="grey"> mdi-checkbox-marked-circle</v-icon>
              </div>
            </template>
          </v-data-table>
        </template>

        <template v-if="imported_excel_products_not_found.length !== 0">
          <p class="text-overline font-weight-bold red--text text-center mt-5">
            Jo valide({{ imported_excel_products_not_found.length }} rresht/a):
          </p>
          <v-data-table
            dense
            :headers="imported_excel_products_not_found_table_headers"
            :items="imported_excel_products_not_found"
            hide-default-footer
            :items-per-page="imported_excel_products_not_found.length"
          >
          </v-data-table>
        </template>
      </v-card>
    </v-dialog>

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
              <v-icon v-if="product_already_in_order(item.id)" color="green">
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
import XLSX from "xlsx";

export default {
  layout: AuthLayout,

  components: {},
  props: {
    order: Object,
    products: Array,
  },

  data() {
    return {
      resource_id: "",
      errors: null,
      add_product_dialog: false,
      product_search_dialog: "",

      import_excel_dialog: false,
      imported_file: null,
      imported_excel_products_found: [],
      imported_excel_products_not_found: [],
      import_loading: false,

      imported_excel_products_found_table_headers: [
        {
          text: "#",
          value: "order_no",
          width: "4%",
          sortable: false,
        },
        {
          text: "Nr. Unik",
          value: "id",
          width: "4%",
          sortable: false,
        },
        {
          text: "Artikulli",
          value: "name",
          width: "30%",
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
          text: "Brendi",
          value: "brand_name",
          width: "15%",
          sortable: false,
        },

        {
          text: "Sasia",
          value: "quantity",
          sortable: false,
          align: "right",
        },

        {
          text: "Cmimi i blerjes(pa TVSH)",
          value: "buying_price",
          sortable: false,
          align: "right",
        },
        {
          text: "Importuar",
          value: "actions",
          sortable: false,
          align: "center",
          width: "10%",
        },
      ],

      imported_excel_products_not_found_table_headers: [
        {
          text: "#",
          value: "order_no",
          width: "4%",
          sortable: false,
        },
        {
          text: "Nr. Unik",
          value: "id",
          width: "4%",
          sortable: false,
        },
        {
          text: "Artikulli",
          value: "name",
          width: "30%",
          sortable: false,
        },

        {
          text: "Sasia",
          value: "quantity",
          sortable: false,
          align: "right",
        },

        {
          text: "Cmimi i blerjes(pa TVSH)",
          value: "buying_price",
          sortable: false,
          align: "right",
        },
      ],
      add_product_table_headers: [
        {
          text: "Nr. Unik",
          value: "id",
          width: "4%",
          sortable: false,
        },
        {
          text: "Artikulli",
          value: "name",
          width: "30%",
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
          text: "Brendi",
          value: "brand.name",
          width: "15%",
          sortable: false,
        },

        {
          text: "Stoku minimal",
          value: "minimal_stock",
          sortable: false,
          align: "right",
        },
        {
          text: "Stoku maximal",
          value: "maximal_stock",
          sortable: false,
          align: "right",
        },
        {
          text: "Stoku momental",
          value: "stock",
          sortable: false,
          align: "right",
        },

        {
          text: "Cmimi i blerjes(pa TVSH)",
          value: "buying_price",
          sortable: false,
          align: "right",
        },
        {
          text: "Shto",
          value: "actions",
          sortable: false,
          align: "center",
          width: "10%",
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
          text: "Brendi",
          value: "brand_name",
          width: "20%",
          sortable: false,
        },
        {
          text: "Stoku minimal",
          value: "minimal_stock",
          width: "5%",
          sortable: false,
          align: "right",
        },
        {
          text: "Stoku minimal",
          value: "maximal_stock",
          width: "5%",
          sortable: false,
          align: "right",
        },
        {
          text: "Stoku momental",
          value: "stock",
          width: "5%",
          sortable: false,
          align: "right",
        },
        {
          text: "Sasia porosi",
          value: "quantity",
          width: "5%",
          sortable: false,
          align: "right",
        },
        {
          text: "Cmimi i blerjes(pa TVSH)",
          value: "buying_price",
          width: "7%",
          sortable: false,
          align: "right",
        },

        {
          text: "Vlera",
          value: "sum",
          width: "5%",
          sortable: false,
          align: "right",
        },
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
      this.$inertia.get("/order/" + this.resource_id);
    },
    remove_product(product) {
      if (confirm("Konfirmo fshirjen e artikullit!")) {
        var data = new FormData();
        data.append("profacture_id", this.order.id || "");
        data.append("product_id", product.id || "");

        axios
          .post("/api/order/remove_product", data)
          .then((response) => {
            //   console.log(response.data.products);
            this.order.products = this.order.products.filter((item) => {
              return item.id !== product.id;
            });
          })
          .catch((error) => {
            this.errors = error.response.data.errors;
          });
      }
    },
    add_product(product) {
      var data = new FormData();
      data.append("profacture_id", this.order.id || "");
      data.append("product_id", product.id || "");
      data.append("quantity", product.quantity || 1);

      axios
        .post("/api/order/add_product", data)
        .then((response) => {
          //   console.log(response.data.products);

          this.order.products.push(response.data.product);
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          this.import_loading = false;
        });
    },

    add_imported_products() {
      this.import_loading = true;

      this.imported_excel_products_found.forEach((product) => {
        if (!this.product_already_in_order(product.id)) {
          this.add_product(product);
        }
      });
    },

    update_order() {
      this.$inertia.put("/order/" + this.order.id, {});
    },
    product_already_in_order(item_id) {
      return this.order.products.some((item) => item.id === item_id);
    },

    import_excel() {
      if (!this.imported_file) {
        return;
      }
      var selectedFile = this.imported_file;
      var reader = new FileReader();
      var this_obj = this;
      reader.onload = function (event) {
        var data = event.target.result;
        var workbook = XLSX.read(data, {
          type: "binary",
        });

        var XL_row_object = XLSX.utils.sheet_to_row_object_array(
          workbook.Sheets[workbook.SheetNames[0]]
        );
        var json_object = JSON.parse(JSON.stringify(XL_row_object));

        var found_products = [];
        var not_found_products = [];
        json_object.forEach((excel_item, index) => {
          var product = this_obj.products.filter((arr_product) => {
            return excel_item.numri_unik == arr_product.id;
          })[0];

          if (product) {
            var tmp_prod = {};
            tmp_prod["order_no"] = index + 1;
            tmp_prod["id"] = excel_item.numri_unik;
            tmp_prod["name"] = product.name;
            tmp_prod["quantity"] = excel_item.sasia > 0 ? excel_item.sasia : 1;

            tmp_prod["buying_price"] = product.buying_price;
            tmp_prod["brand_name"] = product.brand.name;

            tmp_prod["supplier_no"] = product.supplier_no;
            tmp_prod["original_no"] = product.original_no;

            found_products.push(tmp_prod);
          } else {
            var tmp_prod = {};
            tmp_prod["order_no"] = index + 1;
            tmp_prod["id"] = excel_item.numri_unik;
            tmp_prod["emri"] = excel_item.emri;
            tmp_prod["quantity"] = excel_item.sasia;
            tmp_prod["price"] = excel_item.cmimi;
            not_found_products.push(tmp_prod);
          }
          return;
        });

        this_obj.imported_excel_products_found = found_products;
        this_obj.imported_excel_products_not_found = not_found_products;
      };

      reader.onerror = function (event) {
        console.error(
          "File could not be read! Code " + event.target.error.code
        );
      };

      reader.readAsBinaryString(selectedFile);
    },

    export_excel() {
      if (this.order.products.length == 0) {
        alert("Nuk ka artikuj per te eksportuar");
        return;
      }
      var formated_data = [];
      this.order.products.forEach((item) => {
        var tmp_product = {};

        tmp_product["Artikulli nr."] = item.product_order_no;
        tmp_product["Numri unik"] = item.id;
        tmp_product["Emertimi"] = item.custom_product_name;
        tmp_product["Numri i furnizuesit"] = item.supplier_no;
        tmp_product["Brendi"] = item.brand_name;
        tmp_product["Sasia porosi(cope)"] = item.quantity;
        tmp_product["Cmimi i blerjes(pa TVSH)"] = item.buying_price;

        formated_data.push(tmp_product);
      });

      var sheet = XLSX.utils.json_to_sheet(formated_data);

      /* add to workbook */
      var workbook = XLSX.utils.book_new();
      XLSX.utils.book_append_sheet(workbook, sheet, "Exported");

      /* generate an XLSX file */
      var now = this.moment().format("DD-MM-YY-HH-mm");
      XLSX.writeFile(
        workbook,
        "porosia_" + this.order.id + "_" + now + ".xlsx"
      );
    },

    clear_file_input() {
      this.imported_file = null;
      this.imported_excel_products_found = [];
      this.imported_excel_products_not_found = [];
      this.import_loading = false;
    },
  },

  computed: {
    all_valid_rows_imported() {
      var result = true;

      this.imported_excel_products_found.forEach((item) => {
        result = result && this.product_already_in_order(item.id);
      });

      return result;
    },
    order_quantity() {
      var total = 0;

      this.order.products.forEach((item) => {
        total = total + parseFloat(item.quantity);
      });
      return Math.round(total * 100) / 100;
    },

    order_sum() {
      var total = 0;

      this.order.products.forEach((item) => {
        total = total + item.quantity * item.buying_price;
      });
      return Math.round(total * 100) / 100;
    },

    route() {
      return "http://" + window.location.host;
    },
  },

  mounted() {
    this.resource_id = this.order.id;
  },
};
</script>
