<template>
  <div>
    <v-row>
      <v-col cols="12">
        <v-card outlined>
          <v-card outlined color="blue-grey darken-2">
            <v-container fluid>
              <v-row>
                <v-col cols="3">
                  <v-card-title class="white--text my-0 py-0">
                    Importo artikujt
                  </v-card-title>
                </v-col>
                <v-spacer></v-spacer>
                <!-- <v-col cols="3" class="text-right">
                  <v-btn text dark>
                    Anulo
                    <v-icon right small>mdi-plus-circle-outline</v-icon>
                  </v-btn>
                </v-col> -->
              </v-row>
            </v-container>
          </v-card>
          <v-container fluid>
            <v-row>
              <v-col cols="4">
                <p class="font-weight-bold text-center mt-3">
                  Shablloni per imporimin e artikujve
                </p>
                <p class="text-body-2 mt-2">
                  1. Shkarko shabllonin per importimin e artikujve
                </p>
                <v-btn
                  small
                  color="red darken-2"
                  dark
                  class="align-self-center"
                  @click="export_template()"
                >
                  <v-icon dark left small>mdi-download</v-icon>
                  Shkarko</v-btn
                >
                <p class="text-body-2 mt-5">
                  2. Zgjidh furnitorin, brendin, kategorine, njesine matese dhe
                  kualitetin.
                </p>
                <p class="text-body-2 mt-5">
                  3. Ploteso shabllonin: Kolonat ne shabllon<b
                    class="red--text"
                  >
                    me "*..." duhet te plotesohen </b
                  >. Nuk duhet të ketë asnjë informatë më shumë ose më pak.
                  Informatat duhet të jenë saktë në kolonat me shkronja si ne
                  Shabllon. Ngarko shabllonin. Shtyp LEXO ARTIKUJT.
                </p>

                <p class="text-body-2 mt-5">
                  4. Shtyp shto artikujt, per ti regjistruar artikujt e rinje ne
                  program.
                </p>
              </v-col>
              <v-col cols="4">
                <v-autocomplete
                  v-model="form_data.supplier_id"
                  :items="suppliers"
                  item-text="name"
                  item-value="id"
                  label="Furnitori"
                  dense
                  outlined
                  clearable
                ></v-autocomplete>

                <v-autocomplete
                  v-model="form_data.brand_id"
                  :items="brands"
                  item-text="name"
                  item-value="id"
                  label="Brendi"
                  dense
                  outlined
                  clearable
                ></v-autocomplete>

                <v-autocomplete
                  v-model="form_data.category_id"
                  :items="categories"
                  item-text="name"
                  item-value="id"
                  label="Kategoria"
                  dense
                  outlined
                  clearable
                ></v-autocomplete>

                <v-autocomplete
                  v-model="form_data.measuring_unit_id"
                  :items="units"
                  item-text="name"
                  item-value="id"
                  label="Njesia matese"
                  dense
                  outlined
                  clearable
                ></v-autocomplete>

                <v-autocomplete
                  v-model="form_data.quality"
                  :items="quality"
                  item-text="value"
                  item-value="value"
                  label="Kualiteti"
                  dense
                  outlined
                  clearable
                ></v-autocomplete>
              </v-col>

              <v-col cols="4">
                <v-file-input
                  clearable
                  append-icon="mdi-file"
                  prepend-icon=""
                  show-size
                  label="Fajlli per importimin e artikujve te ri"
                  outlined
                  @click:clear="reset_file()"
                  dense
                  block
                  v-model="imported_file"
                ></v-file-input>

                <v-btn
                  outlined
                  block
                  @click="import_excel()"
                  color="green"
                  :disabled="
                    !all_fields_completed ||
                    import_loading ||
                    imported_rows_number != 0
                  "
                  :loading="import_loading"
                >
                  Lexo artikujt
                  <v-icon dark right>mdi-import</v-icon>
                </v-btn>
              </v-col>
            </v-row>
            <div v-if="imported_excel_data.length > 0 && imported_file">
              <v-divider></v-divider>
              <v-row class="px-1 pl-3">
                <v-col cols="auto">
                  <p class="text-info caption pb-0 mb-0">Reshta te lexuara:</p>
                  <p class="py-0 my-0">
                    {{ imported_excel_data.length }} rreshta
                  </p>
                </v-col>
                <v-divider vertical></v-divider>
                <v-col cols="auto">
                  <p class="text-info caption pb-0 mb-0">Te importuara:</p>
                  <p class="py-0 my-0">
                    {{ imported_rows_number }} nga
                    {{ imported_excel_data.length }} rreshta
                  </p>
                </v-col>
                <v-col cols="auto">
                  <p class="text-info caption pb-0 mb-0 green--text">
                    Artikuj te ruajtura:
                  </p>
                  <p class="py-0 my-0">{{ saved_products.length }} artikuj</p>
                </v-col>

                <v-col cols="auto">
                  <p class="text-info caption pb-0 mb-0 red--text">Gabime:</p>
                  <p class="py-0 my-0">
                    {{ imported_rows_number - saved_products.length }}
                    artikuj
                  </p>
                </v-col>
                <v-spacer></v-spacer>
                <v-col cols="auto">
                  <v-btn
                    outlined
                    small
                    block
                    @click="export_saved_data()"
                    :disabled="saved_products.length == 0 || import_loading"
                  >
                    Eksporto te ruajturat[{{ saved_products.length }}]
                    <v-icon dark right small>mdi-export</v-icon>
                  </v-btn>
                </v-col>
              </v-row>

              <v-row class="mt-5">
                <v-col cols="12">
                  <template>
                    <v-data-table
                      dense
                      :loading="import_loading"
                      :headers="imported_excel_data_headers"
                      :items="imported_excel_data"
                      item-key="index"
                      :items-per-page="imported_excel_data.length"
                      hide-default-footer
                    >
                      <template v-slot:item.actions="{ item }">
                        <div class="text-center">
                          <v-btn
                            v-if="item.errors.length != 0"
                            x-small
                            outlined
                            color="red"
                            @click="show_row_errors_dialog(item.errors)"
                            >Gabimet</v-btn
                          >
                          <div v-else>
                            <v-icon v-if="item.saved" color="green">
                              mdi-checkbox-marked-circle</v-icon
                            >

                            <v-icon v-else color="grey">
                              mdi-checkbox-marked-circle</v-icon
                            >
                          </div>
                        </div>
                      </template>

                      <!-- <template v-slot:item.errors="{ item }">
                        <v-btn
                          v-if="item.errors.length != 0"
                          x-small
                          outlined
                          color="red"
                          :disabled="item.errors.length == 0"
                          @click="show_row_errors_dialog(item.errors)"
                          >Gabimet</v-btn
                        >
                      </template> -->
                    </v-data-table>
                  </template>
                </v-col>
              </v-row>

              <v-divider></v-divider>
              <v-row>
                <v-col cols="9"> </v-col>
                <v-col cols="3">
                  <v-btn
                    :disabled="imported_rows_number != 0 || import_loading"
                    block
                    color="green"
                    :dark="imported_rows_number == 0"
                    @click="save_all_products()"
                    >Shto artikujt</v-btn
                  >
                </v-col>
              </v-row>
            </div>
          </v-container>
        </v-card>
      </v-col>
    </v-row>

    <v-dialog v-model="row_errors_dialog" width="500">
      <v-card>
        <v-card-title class="headline grey lighten-2"> Gabimet </v-card-title>

        <v-card-text class="mt-5">
          <pre>

          {{ row_errors }}
            </pre
          >
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" text @click="row_errors_dialog = false">
            Largohu
          </v-btn>
        </v-card-actions>
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
    categories: Array,
    brands: Array,
    suppliers: Array,
    units: Array,
    quality: Array,
  },

  data() {
    return {
      saved_products: [],
      import_loading: false,
      imported_rows_number: 0,
      imported_excel_data: [],
      imported_file: null,
      row_errors_dialog: false,
      row_errors: [],

      form_data: {
        supplier_id: null,
        brand_id: null,
        category_id: null,
        measuring_unit_id: null,
        quality: null,
      },
      imported_excel_data_headers: [
        {
          text: "*Numri i furnizuesit",
          value: "supplier_no",
          sortable: false,
        },
        {
          text: "*Numri origjinal",
          value: "original_no",
          sortable: false,
        },
        {
          text: "*Numri i prodhuesit",
          value: "producer_no",
          sortable: false,
        },
        {
          text: "Barkodi",
          value: "barcode",
          sortable: false,
        },

        {
          text: "*Pershkrimi i artikullit",
          value: "name",
          sortable: false,
        },

        {
          text: "Gjuha e dyte",
          value: "second_name",
          sortable: false,
        },

        {
          text: "Te dhena shtese",
          value: "info",
          sortable: false,
          align: "right",
        },

        {
          text: "Sasia ne set",
          value: "pieces_in_set",
          align: "right",
        },

        {
          text: "Stoku minimal",
          value: "minimal_stock",
          sortable: false,
          align: "right",
        },

        {
          text: "Stoku maksimal",
          value: "maximal_stock",
          sortable: false,
          align: "right",
        },

        {
          text: "*Cmimi i blerjes",
          value: "buying_price",
          sortable: false,
          align: "right",
        },
        {
          text: "*Kosto e furnizimi",
          value: "cost",
          sortable: false,
          align: "right",
        },
        {
          text: "*TVSH",
          value: "tax_rate",
          sortable: false,
          align: "right",
        },
        {
          text: "NUMRI I STOKUT",
          value: "stock_no",
          sortable: false,
          align: "right",
        },
        {
          text: "NUMRI UNIK",
          value: "id",
          sortable: false,
          align: "right",
        },
        // {
        //   text: "Gabimet",
        //   value: "errors",
        //   sortable: false,
        //   align: "center",
        // },
        {
          text: "Importuar",
          value: "actions",
          sortable: false,
          align: "center",
        },
      ],
    };
  },

  methods: {
    show_row_errors_dialog(errors) {
      this.row_errors = errors;
      this.row_errors_dialog = true;
    },
    export_template() {
      var formated_data = [];
      var tmp_product = {};

      tmp_product["*Numri i furnizuesit"] = "";
      tmp_product["*Numri origjinal"] = "";
      tmp_product["*Numri i prodhuesit"] = "";
      tmp_product["Barkodi"] = "";
      tmp_product["*Pershkrimi i artikullit"] = "";
      tmp_product["Gjuha e dyte"] = "";
      tmp_product["Te dhena shtese"] = "";
      tmp_product["Sasia ne set"] = "";
      tmp_product["Stoku minimal"] = "";
      tmp_product["Stoku maksimal"] = "";
      tmp_product["*Cmimi i blerjes"] = "";
      tmp_product["*Kosto e furnizimit"] = "";
      tmp_product["*TVSH"] = "";

      formated_data.push(tmp_product);

      var sheet = XLSX.utils.json_to_sheet(formated_data);

      /* add to workbook */
      var workbook = XLSX.utils.book_new();
      XLSX.utils.book_append_sheet(workbook, sheet, "Import");

      XLSX.writeFile(workbook, "shablloni_per_importimin_e_artikujve.xlsx");
    },

    reset_file() {
      this.saved_products = [];
      this.import_loading = false;
      this.imported_rows_number = 0;
      this.imported_excel_data = [];
      this.row_errors_dialog = false;
      this.row_errors = [];
    },
    import_excel() {
      if (!this.imported_file) {
        return;
      }

      this.reset_file();
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
          //   var product = this_obj.products.filter((arr_product) => {
          //     return excel_item.numri_unik == arr_product.id;
          //   })[0];

          //   if (product) {
          var tmp_prod = {};
          tmp_prod["index"] = index;
          tmp_prod["supplier_id"] = this_obj.form_data.supplier_id;
          tmp_prod["brand_id"] = this_obj.form_data.brand_id;
          tmp_prod["category_id"] = this_obj.form_data.category_id;
          tmp_prod["measuring_unit_id"] = this_obj.form_data.measuring_unit_id;
          tmp_prod["quality"] = this_obj.form_data.quality;

          tmp_prod["supplier_no"] = excel_item["*Numri i furnizuesit"];
          tmp_prod["original_no"] = excel_item["*Numri origjinal"];
          tmp_prod["producer_no"] = excel_item["*Numri i prodhuesit"];
          tmp_prod["barcode"] = excel_item["Barkodi"];
          tmp_prod["name"] = excel_item["*Pershkrimi i artikullit"];
          tmp_prod["second_name"] = excel_item["Gjuha e dyte"];
          tmp_prod["info"] = excel_item["Te dhena shtese"];
          tmp_prod["pieces_in_set"] = excel_item["Sasia ne set"];
          tmp_prod["minimal_stock"] = excel_item["Stoku minimal"];
          tmp_prod["maximal_stock"] = excel_item["Stoku maksimal"];
          tmp_prod["buying_price"] = excel_item["*Cmimi i blerjes"];
          tmp_prod["cost"] = excel_item["*Kosto e furnizimit"];
          tmp_prod["tax_rate"] = excel_item["*TVSH"];
          tmp_prod["stock_no"] =
            excel_item["*Numri i furnizuesit"] +
            "-" +
            this_obj.form_data.supplier_id;
          tmp_prod["errors"] = [];
          tmp_prod["saved"] = false;
          tmp_prod["id"] = "";

          found_products.push(tmp_prod);
          //   } else {
          //     var tmp_prod = {};
          //     tmp_prod["order_no"] = index + 1;
          //     tmp_prod["id"] = excel_item.numri_unik;
          //     tmp_prod["emri"] = excel_item.emri;
          //     tmp_prod["quantity"] = excel_item.sasia;
          //     tmp_prod["price"] = excel_item.cmimi;
          //     not_found_products.push(tmp_prod);
          //   }
          return;
        });

        this_obj.imported_excel_data = found_products;
        // this_obj.imported_excel_products_not_found = not_found_products;
      };

      reader.onerror = function (event) {
        console.error(
          "File could not be read! Code " + event.target.error.code
        );
      };

      reader.readAsBinaryString(selectedFile);
    },
    add_product(product) {
      var data = new FormData();

      Object.keys(product).forEach((key) => {
        data.append(key, product[key]);
      });

      axios
        .post("/api/product/store_api", data)
        .then((response) => {
          //   console.log(response.data.products);

          product.id = response.data.product_id;
          this.saved_products.push(product);
          product.errors = [];
          this.imported_rows_number = this.imported_rows_number + 1;
          if (this.imported_rows_number == this.imported_excel_data.length) {
            this.import_loading = false;
          }

          product.saved = true;
        })
        .catch((error) => {
          this.imported_rows_number = this.imported_rows_number + 1;
          if (this.imported_rows_number == this.imported_excel_data.length) {
            this.import_loading = false;
          }

          //   this.errors = error.response.data.errors;
          product.errors = error.response.data.errors;
        });
    },

    save_all_products() {
      this.import_loading = true;
      this.imported_rows_number = 0;

      this.imported_excel_data.forEach((product) => {
        if (!this.product_already_saved(product.id)) {
          this.add_product(product);
        }
      });
    },
    export_saved_data() {
      if (this.saved_products.length == 0) {
        alert("Nuk ka artikuj per te eksportuar");
        return;
      }
      var formated_data = [];
      this.saved_products.forEach((item) => {
        var tmp_prod = {};

        tmp_prod["Numri unik"] = item["id"];
        tmp_prod["*Numri i furnizuesit"] = item["supplier_no"];
        tmp_prod["*Numri origjinal"] = item["original_no"];
        tmp_prod["*Numri i prodhuesit"] = item["producer_no"];
        tmp_prod["*Numri i stokut"] = item["stock_no"];
        tmp_prod["Barkodi"] = item["barcode"];
        tmp_prod["*Pershkrimi i artikullit"] = item["name"];
        tmp_prod["Gjuha e dyte"] = item["second_name"];
        tmp_prod["Te dhena shtese"] = item["info"];
        tmp_prod["Sasia ne set"] = item["pieces_in_set"];
        tmp_prod["Stoku minimal"] = item["minimal_stock"];
        tmp_prod["Stoku maksimal"] = item["maximal_stock"];
        tmp_prod["*Cmimi i blerjes"] = item["buying_price"];
        tmp_prod["*Kosto e furnizimit"] = item["cost"];
        tmp_prod["*TVSH"] = item["tax_rate"];

        formated_data.push(tmp_prod);
      });

      var sheet = XLSX.utils.json_to_sheet(formated_data);

      /* add to workbook */
      var workbook = XLSX.utils.book_new();
      XLSX.utils.book_append_sheet(workbook, sheet, "Exported");

      /* generate an XLSX file */
      var now = this.moment().format("DD-MM-YY-HH-mm");
      XLSX.writeFile(workbook, "importimi_" + now + ".xlsx");
    },

    product_already_saved(item_id) {
      return this.saved_products.some((item) => item.id === item_id);
    },

    resart_import() {
      location.reload();
    },
  },
  computed: {
    all_fields_completed() {
      return (
        this.form_data.supplier_id &&
        this.form_data.brand_id &&
        this.form_data.category_id &&
        this.form_data.measuring_unit_id &&
        this.form_data.quality &&
        this.imported_file != null
      );
    },
    route() {
      return "http://" + window.location.host;
    },
  },
};
</script>
