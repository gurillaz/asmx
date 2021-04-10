<template>
  <div>
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
                    prefix="Furnitori:"
                    single-line
                    hide-details
                    v-model="resource_id"
                    @keypress.enter="open_resource()"
                  >
                  </v-text-field>
                </v-col>
                <v-spacer></v-spacer>
                <v-col cols="auto" class="text-right">
                  <v-btn
                    depressed
                    dark
                    class="mr-1"
                    color="green"
                    @click="export_products()"
                  >
                    Eksporto artikujt XLSX
                    <v-icon right small>mdi-export</v-icon></v-btn
                  >

                  <v-btn depressed color="blue" dark>
                    veprimet
                    <v-icon right small>mdi-format-list-bulleted</v-icon></v-btn
                  >
                </v-col>
              </v-row>
            </v-container>
          </v-card>

          <v-sheet tile color="grey lighten-4">
            <v-container fluid class="py-1">
              <v-row class="pr-2">
                <v-col cols="auto">
                  <p class="text-info caption pb-0 mb-0">Numri i artikujve:</p>
                  <p class="py-0 my-0">
                    {{ supplier.products_count }}
                  </p>
                </v-col>

                <v-spacer></v-spacer>

                <v-col cols="auto">
                  <p class="text-info caption pb-0 mb-0">Krijuar me:</p>
                  <p class="py-0 my-0">
                    {{ moment(supplier.created_at).format("DD-MM-YY HH:mm") }}
                  </p>
                </v-col>

                <v-col
                  cols="auto"
                  v-if="supplier.created_at !== supplier.updated_at"
                >
                  <p class="text-info caption pb-0 mb-0">Modifikuar me:</p>
                  <p class="py-0 my-0">
                    {{ moment(supplier.updated_at).format("DD-MM-YY HH:mm") }}
                  </p>
                </v-col>

                <v-col cols="auto">
                  <p class="text-info caption pb-0 mb-0">Nga useri:</p>
                  <p class="py-0 my-0">
                    {{ supplier.created_by }}
                  </p>
                </v-col>
              </v-row>
            </v-container>
          </v-sheet>

          <v-container fluid>
            <v-row>
              <v-col cols="3">
                <p class="text-subtitle-1 font-weight-bold pb-1 mb-1">
                  Te dhenat per subjektin
                </p>
                <p class="text-body-2 font-weight-bold ml-3 pb-0 mb-0">
                  - Zgjidh llojin e subjektit Klient ose Furnitor
                </p>
                <p class="text-body-2 gray--text ml-3 pb-0 mb-0">
                  - Me '*' duhet te plotesohen
                </p>
                <p class="text-body-2 gray--text ml-3 pb-0 mb-0">
                  - Nr. unik caktohet automatikisht
                </p>
              </v-col>
              <v-col cols="9">
                <v-row>
                  <v-col cols="4">
                    <v-text-field
                      block
                      outlined
                      dense
                      readonly
                      v-model="supplier_obj_copy.id"
                      background-color="yellow lighten-5"
                      label="Numri unik"
                    >
                    </v-text-field>

                    <v-autocomplete
                      :items="subject_types"
                      item-text="text"
                      item-value="value"
                      outlined
                      background-color="grey lighten-5"
                      flat
                      autofocus
                      dense
                      label="* Lloji i subjektit"
                      v-model="supplier_obj_copy.subject_type"
                      :error-messages="$page.props.errors.subject_type"
                    ></v-autocomplete>
                  </v-col>
                  <v-col cols="8">
                    <v-text-field
                      :disabled="!supplier_obj_copy.subject_type"
                      block
                      outlined
                      dense
                      clearable
                      label="* Emri i subjektit"
                      v-model="supplier_obj_copy.name"
                      :error-messages="$page.props.errors.name"
                    >
                    </v-text-field>

                    <v-row>
                      <v-col cols="6">
                        <v-text-field
                          :disabled="!supplier_obj_copy.subject_type"
                          block
                          outlined
                          dense
                          clearable
                          label="Adresa"
                          hint="Rruga ose fshati"
                          v-model="supplier_obj_copy.address"
                          :error-messages="$page.props.errors.address"
                        >
                        </v-text-field>
                        <v-text-field
                          :disabled="!supplier_obj_copy.subject_type"
                          block
                          outlined
                          dense
                          clearable
                          label="* Qyteti"
                          hint="Komuna"
                          v-model="supplier_obj_copy.city"
                          :error-messages="$page.props.errors.city"
                        >
                        </v-text-field>
                        <v-text-field
                          :disabled="!supplier_obj_copy.subject_type"
                          block
                          outlined
                          dense
                          clearable
                          label="Numri postal"
                          v-model="supplier_obj_copy.postal_code"
                          :error-messages="$page.props.errors.postal_code"
                        >
                        </v-text-field>
                      </v-col>
                      <v-col cols="6">
                        <v-text-field
                          :disabled="!supplier_obj_copy.subject_type"
                          block
                          outlined
                          dense
                          clearable
                          label="* Shteti"
                          v-model="supplier_obj_copy.country"
                          :error-messages="$page.props.errors.country"
                        >
                        </v-text-field>

                        <v-textarea
                          :disabled="!supplier_obj_copy.subject_type"
                          outlined
                          dense
                          height="6.6rem"
                          label="Te dhena shtese"
                          v-model="supplier_obj_copy.info"
                          :error-messages="$page.props.errors.info"
                        >
                        </v-textarea>
                      </v-col>
                    </v-row>
                  </v-col>
                </v-row>
              </v-col>
            </v-row>
            <v-divider></v-divider>

            <v-row>
              <v-col cols="3">
                <p class="text-subtitle-1 font-weight-bold pb-1 mb-1">
                  Kontakt dhe tjera
                </p>

                <p class="text-body-2 gray--text ml-3 pb-0 mb-0">
                  - Me '*' duhet te plotesohen
                </p>
              </v-col>
              <v-col cols="9">
                <v-row>
                  <v-col cols="4">
                    <v-text-field
                      :disabled="!supplier_obj_copy.subject_type"
                      block
                      outlined
                      dense
                      clearable
                      label="Personi kontaktues"
                      v-model="supplier_obj_copy.contact_name"
                      :error-messages="$page.props.errors.contact_name"
                    >
                    </v-text-field>
                  </v-col>

                  <v-col cols="4">
                    <v-text-field
                      :disabled="!supplier_obj_copy.subject_type"
                      block
                      outlined
                      dense
                      clearable
                      label="* Telefon 1"
                      v-model="supplier_obj_copy.phone_1"
                      :error-messages="$page.props.errors.phone_1"
                    >
                    </v-text-field>
                    <v-text-field
                      :disabled="!supplier_obj_copy.subject_type"
                      block
                      outlined
                      dense
                      clearable
                      label="Telefon 2"
                      v-model="supplier_obj_copy.phone_2"
                      :error-messages="$page.props.errors.phone_2"
                    >
                    </v-text-field>
                  </v-col>
                  <v-col cols="4">
                    <v-text-field
                      :disabled="!supplier_obj_copy.subject_type"
                      block
                      outlined
                      dense
                      clearable
                      label="Email"
                      type="email"
                      v-model="supplier_obj_copy.email"
                      :error-messages="$page.props.errors.email"
                    >
                    </v-text-field>
                    <v-text-field
                      :disabled="!supplier_obj_copy.subject_type"
                      block
                      outlined
                      dense
                      clearable
                      label="Website"
                      v-model="supplier_obj_copy.website"
                      :error-messages="$page.props.errors.website"
                    >
                    </v-text-field>
                  </v-col>
                </v-row>
              </v-col>
            </v-row>
            <v-divider></v-divider>

            <v-row>
              <v-col cols="3">
                <p class="text-subtitle-1 font-weight-bold pb-1 mb-1">
                  Te dhena financiare
                </p>

                <p class="text-body-2 gray--text ml-3 pb-0 mb-0">
                  - Me '*' duhet te plotesohen
                </p>

                <p class="text-body-2 gray--text ml-3 pb-0 mb-0">
                  - Me '**' duhet te plotesohen kur lloji i subjektit eshte
                  klient
                </p>
              </v-col>
              <v-col cols="9">
                <v-row>
                  <v-col cols="4">
                    <v-autocomplete
                      :disabled="!supplier_obj_copy.subject_type"
                      :items="price_levels"
                      item-text="name"
                      item-value="id"
                      outlined
                      background-color="grey lighten-5"
                      flat
                      dense
                      label="** Kategoria e cmimeve"
                      v-model="supplier_obj_copy.price_level_id"
                      :error-messages="$page.props.errors.price_level_id"
                    ></v-autocomplete>

                    <v-text-field
                      :disabled="!supplier_obj_copy.subject_type"
                      block
                      outlined
                      dense
                      clearable
                      label="** Kuote e ngritjes se cmimeve"
                      hint="P.sh: 1.01, 1.3 etj"
                      v-model="supplier_obj_copy.price_increase_quota"
                      :error-messages="$page.props.errors.price_increase_quota"
                    >
                    </v-text-field>
                  </v-col>

                  <v-col cols="4">
                    <v-text-field
                      :disabled="!supplier_obj_copy.subject_type"
                      block
                      outlined
                      dense
                      clearable
                      label="** Kredit limiti"
                      v-model="supplier_obj_copy.credit_limit"
                      :error-messages="$page.props.errors.credit_limit"
                    >
                    </v-text-field>
                    <v-text-field
                      :disabled="!supplier_obj_copy.subject_type"
                      block
                      outlined
                      dense
                      clearable
                      label="** Afati i pageses(dite)"
                      v-model="supplier_obj_copy.payment_limit_days"
                      :error-messages="$page.props.errors.payment_limit_days"
                    >
                    </v-text-field>
                  </v-col>
                  <v-col cols="4">
                    <v-text-field
                      :disabled="!supplier_obj_copy.subject_type"
                      block
                      outlined
                      dense
                      clearable
                      label="Numri fiskal"
                      v-model="supplier_obj_copy.fiscal_no"
                      :error-messages="$page.props.errors.fiscal_no"
                    >
                    </v-text-field>
                    <v-text-field
                      :disabled="!supplier_obj_copy.subject_type"
                      block
                      outlined
                      dense
                      clearable
                      label="Emri i bankes"
                      v-model="supplier_obj_copy.bank_name"
                      :error-messages="$page.props.errors.bank_name"
                    >
                    </v-text-field>
                    <v-text-field
                      :disabled="!supplier_obj_copy.subject_type"
                      block
                      outlined
                      dense
                      clearable
                      label="Llogaria bankare"
                      v-model="supplier_obj_copy.bank_account_no"
                      :error-messages="$page.props.errors.bank_account_no"
                    >
                    </v-text-field>
                  </v-col>
                </v-row>
              </v-col>
            </v-row>
            <v-divider></v-divider>

            <v-row>
              <v-col cols="9"> </v-col>
              <v-col cols="3">
                <v-btn
                  block
                  color="green"
                  dark
                  :disabled="!supplier_obj_copy.subject_type"
                  @click="submit()"
                  >Ruaj</v-btn
                >
              </v-col>
            </v-row>
          </v-container>
        </v-card>
      </v-col>
    </v-row>

    <v-row class="mt-5">
      <v-col cols="6">
        <v-card outlined>
          <v-card outlined color="blue-grey darken-2">
            <v-container>
              <v-row>
                <v-col cols="auto" class="d-flex d-column align-center">
                  <h5 class="white--text my-0 py-0">Porosite e fundit</h5>
                </v-col>
                <v-spacer></v-spacer>
                <v-col cols="auto">
                  <inertia-link
                    :href="route + '/supplier/create'"
                    style="text-decoration: none"
                  >
                    <v-btn color="primary" dark depressed small>
                      Te gjitha faturat
                      <v-icon right small
                        >mdi-plus-circle-outline</v-icon
                      ></v-btn
                    >
                  </inertia-link>
                </v-col>
              </v-row>
            </v-container>
          </v-card>
          Faturat e furnitorit
          <!-- <v-data-table
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
          </v-data-table> -->
        </v-card>
      </v-col>
      <v-col cols="6">
        <v-card outlined>
          <v-card outlined color="blue-grey darken-2">
            <v-container>
              <v-row>
                <v-col cols="auto" class="d-flex d-column align-center">
                  <h5 class="white--text my-0 py-0">Fakturat e fundit</h5>
                </v-col>
                <v-spacer></v-spacer>
                <v-col cols="auto">
                  <inertia-link
                    :href="route + '/supplier/create'"
                    style="text-decoration: none"
                  >
                    <v-btn color="primary" dark depressed small>
                      Te gjitha fakturat
                      <v-icon right small
                        >mdi-plus-circle-outline</v-icon
                      ></v-btn
                    >
                  </inertia-link>
                </v-col>
              </v-row>
            </v-container>
          </v-card>
          Faturat e furnitorit
          <!-- <v-data-table
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
          </v-data-table> -->
        </v-card>
      </v-col>
    </v-row>
  </div>
</template>

<script>
import AuthLayout from "@/Layouts/Authenticated";
import XLSX from "xlsx";

export default {
  layout: AuthLayout,

  components: {},
  props: {
    supplier: Object,
    price_levels: Array,
    subject_types: Array,
  },

  data() {
    return {
      resource_id: "",
      supplier_obj_copy: {},
    };
  },

  methods: {
    submit() {
      if (!confirm("Ruaj ndryshimet?")) {
        return;
      }
      this.$page.props.errors = {};
      var data = new FormData();
      data.append("_method", "PUT");

      Object.keys(this.supplier_obj_copy).forEach((key) => {
        data.append(key, this.supplier_obj_copy[key]);
      });

      this.$inertia.post(this.route + "/subject/" + this.supplier.id, data);
    },

    open_resource() {
      this.$inertia.get("/supplier/" + this.resource_id);
    },

    export_products() {
      if (this.supplier.products.length == 0) {
        alert("Nuk ka artikuj per te eksportuar");
        return;
      }
      var formated_data = [];
      this.supplier.products.forEach((item) => {
        var tmp_product = {};

        tmp_product["Numri unik"] = item.id;
        tmp_product["Emertimi"] = item.name;
        tmp_product["Numri i stokut"] = item.stock_no;
        tmp_product["Numri origjinal"] = item.original_no;
        tmp_product["Numri i furnizuesit"] = item.supplier_no;
        tmp_product["Numri i prodhuesit"] = item.producer_no;
        tmp_product["Brand"] = item.brand_name;
        tmp_product["Copa ne set"] = item.pieces_in_set;
        tmp_product["Cmimi i blerjes(Pa TVSH)"] = item.buying_price;
        tmp_product["TVSH"] = item.tax_rate;
        tmp_product["Stoku minimal"] = item.minimal_stock;
        tmp_product["Stoku maximal"] = item.maximal_stock;
        tmp_product["Stoku momental"] = item.stock;
        tmp_product["Kategoria"] = item.category_name;

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
        "Artikujt_" + this.supplier.id + "_" + now + ".xlsx"
      );
    },
  },
  mounted() {
    this.resource_id = this.supplier.id;

    this.supplier_obj_copy = JSON.parse(JSON.stringify(this.supplier));
  },
  computed: {
    route() {
      return "http://" + window.location.host;
    },
  },
};
</script>
