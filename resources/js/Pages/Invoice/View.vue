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
                    label="Produkti:"
                    single-line
                    hide-details
                    prefix="Artikulli:"

                    v-model="open_resource_id"
                    @keypress.enter="open_resource()"
                  ></v-text-field>
                </v-col>
                <v-spacer></v-spacer>
                <v-col cols="auto" class="text-right">

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
                <v-sheet tile color="grey lighten-4">
            <v-container fluid class="py-1">
              <v-row class="pr-2">

                <v-spacer></v-spacer>

                <v-col cols="auto">
                  <p class="text-info caption pb-0 mb-0">Krijuar me:</p>
                  <p class="py-0 my-0">
                    {{ moment(product_obj_copy.created_at).format("DD-MM-YY HH:mm") }}
                  </p>
                </v-col>

                <v-col
                  cols="auto"
                  v-if="product_obj_copy.created_at !== product_obj_copy.updated_at"
                >
                  <p class="text-info caption pb-0 mb-0">Modifikuar me:</p>
                  <p class="py-0 my-0">
                    {{ moment(product_obj_copy.updated_at).format("DD-MM-YY HH:mm") }}
                  </p>
                </v-col>

                <v-col cols="auto">
                  <p class="text-info caption pb-0 mb-0">Nga useri:</p>
                  <p class="py-0 my-0">
                    {{ product_obj_copy.created_by }}
                  </p>
                </v-col>
              </v-row>
            </v-container>
            <v-divider class="mt-0"></v-divider>
          </v-sheet>
          <v-container fluid>
            <v-row>
              <v-col cols="3">
                <p class="text-subtitle-1 font-weight-bold pb-1 mb-1">
                  Te dhenat per artikullin
                </p>
                <p class="text-body-2 gray--text ml-3 pb-0 mb-0">
                  - Me '*' duhet te plotesohen
                </p>
                <p class="text-body-2 gray--text ml-3 pb-0 mb-0">
                  - Nr. unik caktohet automatikisht
                </p>

                         <p class="text-body-2 gray--text ml-3 pb-0 mb-0">
                  - Nr. i stokut caktohet automatikisht sipas numrit te furnizuesit dhe furnitorit
                </p>
              </v-col>
              <v-col cols="9">
                <v-row>
                  <v-col cols="4">
                    <v-autocomplete
                      :items="suppliers"
                      item-text="name"
                      item-value="id"
                      outlined
                      background-color="grey lighten-5"
                      flat
                      dense

                      label="* Furnitori"
                      v-model="product_obj_copy.supplier_id"
                      @change="set_stock_no()"
                      :error-messages="$page.props.errors.supplier_id"
                    ></v-autocomplete>
                    <v-autocomplete
                      :items="brands"
                      item-text="name"
                      item-value="id"
                      outlined
                      background-color="grey lighten-5"
                      flat
                      dense

                      label="* Brendi"
                      v-model="product_obj_copy.brand_id"
                      :error-messages="$page.props.errors.brand_id"
                    ></v-autocomplete>
                                                      <v-autocomplete
                      :items="categories"
                      item-text="name"
                      item-value="id"
                      outlined
                      background-color="grey lighten-5"
                      flat
                      dense
                      label="* Kategoria"
                      v-model="product_obj_copy.category_id"
                      :error-messages="$page.props.errors.category_id"
                      ></v-autocomplete>
                    <v-text-field
                      block
                      outlined
                      dense
                      background-color="yellow lighten-5"
                      label="Numri unik"
                      readonly
                      v-model="product_obj_copy.id"
                      :error-messages="$page.props.errors.id"
                    >
                    </v-text-field>
                    <v-text-field
                      block
                      outlined
                      dense
                      background-color="yellow lighten-5"
                      label="* Numri i stokut"
                      name="stock_no"
                      readonly

                      v-model="product_obj_copy.stock_no"
                      :error-messages="$page.props.errors.stock_no"
                    >
                    </v-text-field>
                    <v-switch
                      v-if="$page.props.public == false"
                      true-value="TRUE"
                      false-value="FALSE"
                      inset
                      dense
                      label="P"
                                v-model="product_obj_copy.public"
                      :error-messages="$page.props.errors.public"
                    ></v-switch>
                  </v-col>
                  <v-col cols="4">
                    <v-text-field
                      block
                      outlined
                      dense

                      label="* Pershkrimi i artikullit"

                      name="name"
                      v-model="product_obj_copy.name"
                      :error-messages="$page.props.errors.name"
                    >
                    </v-text-field>
                    <v-text-field
                      block
                      outlined
                      dense

                      label="Gjuha e dyte"

                      name="second_name"
                      v-model="product_obj_copy.second_name"
                      :error-messages="$page.props.errors.second_name"
                    >
                    </v-text-field>

                    <v-text-field
                      block
                      outlined
                      dense

                      label="* Numri i furnizuesit"
                      name="supplier_no"
                      @input="set_stock_no()"
                      v-model="product_obj_copy.supplier_no"
                      :error-messages="$page.props.errors.supplier_no"
                    >
                    </v-text-field>
                    <v-text-field
                      block
                      outlined
                      dense

                      label="* Numri i prodhuesit"
                      name="producer_no"
                      v-model="product_obj_copy.producer_no"
                      :error-messages="$page.props.errors.producer_no"
                    >
                    </v-text-field>

                    <v-text-field
                      block
                      outlined
                      dense

                      label="* Numri orgjinal"
                      name="original_no"
                      v-model="product_obj_copy.original_no"
                      :error-messages="$page.props.errors.original_no"
                    >
                    </v-text-field>
                    <v-text-field
                      block
                      outlined
                      dense

                      label="Barkodi"
                      name="barcode"
                      v-model="product_obj_copy.barcode"
                      :error-messages="$page.props.errors.barcode"
                    >
                    </v-text-field>
                  </v-col>
                  <v-col cols="4">
                    <v-autocomplete
                      :items="quality"
                      item-text="value"
                      outlined
                      background-color="grey lighten-5"
                      flat
                      dense

                      label="Kualiteti"
                      v-model="product_obj_copy.quality"
                      :error-messages="$page.props.errors.quality"
                    ></v-autocomplete>
                    <v-autocomplete
                      :items="units"
                      item-text="name"
                      item-value="id"
                      outlined
                      background-color="grey lighten-5"
                      flat
                      dense

                      label="* Njesia matese"
                      v-model="product_obj_copy.measuring_unit_id"
                      :error-messages="$page.props.errors.measuring_unit_id"
                    ></v-autocomplete>
                    <v-text-field
                      block
                      outlined
                      dense
                    hint="KG Kilogram"
                      label="Pesha"
                      name="weight"
                      v-model="product_obj_copy.weight"
                      :error-messages="$page.props.errors.weight"
                    >
                    </v-text-field>
                    <v-text-field
                      block
                      outlined
                      dense

                      label="Sasia ne set"
                      name="pieces_in_set"
                      v-model="product_obj_copy.pieces_in_set"
                      :error-messages="$page.props.errors.pieces_in_set"
                    >
                    </v-text-field>
                    <v-textarea
                      outlined
                      dense
                      height="6.6rem"
                      label="Te dhena shtese"
                      name="info"
                      v-model="product_obj_copy.info"
                      :error-messages="$page.props.errors.info"
                    >
                    </v-textarea>
                  </v-col>
                </v-row>
              </v-col>
            </v-row>

            <v-divider></v-divider>

            <v-row>
              <v-col cols="3">
                <p class="text-subtitle-1 font-weight-bold pb-1 mb-1">
                  Gjendja aktuale
                </p>
                <p class="text-body-2 gray--text ml-3 pb-0 mb-0">
                  - Stoku minimal dhe maximal per porosi automatike
                </p>

                 <p class="text-body-2 gray--text ml-3 pb-0 mb-0">
                  - Cmimi i blerjes => Cmimi baze nga furnitori <b>(pa TVSH)</b>
                </p>

                         <p class="text-body-2 gray--text ml-3 pb-0 mb-0">
                  - Kosto e furnizimit => Cmimi i blerjes + Trasport + Tatime <b>(pa TVSH)</b>
                </p>
              </v-col>
              <v-col cols="9">
                <v-row>
                  <v-col cols="4">
                    <!-- <v-text-field
                      block
                      solo-inverted
                      dense
                      color="red"
                      background-color="grey darken-5"
                      label="Gjendja Aktuale"
                      hint="Gjendja aktuale"
                      persistent-hint
                      name="producing_company"
                      :error-messages="$page.props.errors.producing_company"
                    ></v-text-field> -->

                    <v-text-field
                      block
                      outlined
                      dense

                      label="Stoku momental"
                      hint="Gjendja aktuale"
                      persistent-hint

                    name="stock"
                      :value="product_obj_copy.stock"
                      readonly
                      :error-messages="$page.props.errors.stock"
                    >
                    </v-text-field>
                    <v-text-field
                      block
                      outlined
                      dense

                      label="Stoku minimal"
                      v-model="product_obj_copy.minimal_stock"
                      :error-messages="$page.props.errors.minimal_stock"
                    >
                    </v-text-field>

                    <v-text-field
                      block
                      outlined
                      dense

                      label="Stoku maksimal"
                      v-model="product_obj_copy.maximal_stock"
                      :error-messages="$page.props.errors.maximal_stock"
                    >
                    </v-text-field>
                  </v-col>

                  <v-col cols="4">
                    <v-text-field
                      block
                      outlined
                      dense

                      label="* Cmimi i blerjes"
                      v-model="product_obj_copy.buying_price"
                      :error-messages="$page.props.errors.buying_price"
                    >
                    </v-text-field>

                    <v-text-field
                      block
                      outlined
                      dense

                      label="* Kosto e furnizimit"
                      v-model="product_obj_copy.cost"
                      :error-messages="$page.props.errors.cost"
                    >
                    </v-text-field>

                    <v-text-field
                      block
                      outlined
                      dense

                      label="* TVSH"
                      append-icon="mdi-percent-outline"
                      v-model="product_obj_copy.tax_rate"
                      :error-messages="$page.props.errors.tax_rate"
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
                <v-btn block color="green" dark @click="submit()">Ruaj</v-btn>
              </v-col>
            </v-row>
          </v-container>
        </v-card>
      </v-col>
    </v-row>

        <v-row class="mt-5" >
      <v-col cols="6">
        <v-card outlined min-height="25vh" >
          <v-card outlined color="blue-grey darken-2">
            <v-container>
              <v-row>
                <v-col cols="auto" class="d-flex d-column align-center">
                  <h5 class="white--text my-0 py-0">Vendet</h5>
                </v-col>
                <v-spacer></v-spacer>
                <v-col cols="auto">

                    <v-btn color="primary" dark depressed small @click="show_add_place_form=!show_add_place_form">
                      Shto vend te ri
                      <v-icon right small
                        >mdi-plus-circle-outline</v-icon
                      ></v-btn
                    >
                </v-col>
              </v-row>
            </v-container>
          </v-card>
         <v-expand-transition>
          <div v-if="show_add_place_form" >

          <v-container fluid >

          <v-row class="mt-1">
              <v-col cols="4"><v-text-field placeholder="* Vendi" dense :hide-details="!new_place_errors.place_no" v-model="new_place.place_no" @keypress.enter="add_place()" :error-messages="new_place_errors.place_no"></v-text-field></v-col>
              <v-col cols="6"><v-text-field placeholder="Koment"  dense hide-details v-model="new_place.comment" @keypress.enter="add_place()" :error-messages="new_place_errors.comment"></v-text-field></v-col>
              <v-col cols="2"><v-btn small block outlined color="green" @click="add_place()">Ruaj</v-btn>
              </v-col>
          </v-row>
          </v-container>
          <v-divider></v-divider>
          </div>
         </v-expand-transition>
          <v-data-table
            :headers="places_table_headers"
            :items="product.places"
            item-key="id"
            hide-default-footer
            no-data-text="Artikulli nuk ka vende te caktuara"
            dense
          >
            <template v-slot:item.created_at="{ item }">

                    {{ moment(item.created_at).format("DD-MM-YY HH:mm") }}

            </template>

            <template v-slot:item.actions="{ item }">
                <v-btn icon color="red" dark @click="remove_place(item)">
                <v-icon dark>mdi-delete-circle</v-icon>
              </v-btn>
            </template>
          </v-data-table>
        </v-card>
      </v-col>
      <v-col cols="6">
        <v-card outlined min-height="25vh" >

          <v-card outlined color="blue-grey darken-2">
            <v-container>
              <v-row>
                <v-col cols="auto" class="d-flex d-column align-center">
                  <h5 class="white--text my-0 py-0">Cmimet e fiksuara</h5>
                </v-col>
                <v-spacer></v-spacer>
                <v-col cols="auto">
                  <inertia-link
                    :href="route + '/supplier/create'"
                    style="text-decoration: none"
                  >
                    <v-btn color="primary" dark depressed small>
                      Cakto cmimet
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

export default {
  layout: AuthLayout,

  components: {},
  props: {
    product: Object,

    suppliers: Array,
    brands: Array,
    categories: Array,
    units: Array,
    quality: Array,

    resorurce_id: null,
  },

  data() {
    return {
      new_place: {
        place_no: "",
        comment: "",
      },
      new_place_errors: [],
      open_resource_id: "",
      product_obj_copy: {},
      show_add_place_form: false,
      places_table_headers: [
        {
          text: "Vendi",
          value: "place_no",
          width: "40%",
          sortable: false,
        },
        {
          text: "Koment",
          value: "comment",
          width: "30%",
          sortable: false,
        },
        {
          text: "Shuar me:",
          value: "created_at",
          width: "20%",
          sortable: true,
        },
        {
          text: "Veprimet",
          value: "actions",
          width: "10%",
          sortable: false,
        },
      ],
    };
  },

  methods: {
    remove_place(place) {
      if (!confirm("Konfirmo fshirjen")) {
        return;
      }

      this.new_place_errors = [];
      var data = new FormData();

      data.append("_method", "DELETE");

      axios
        .post("/api/product-place/" + place.id, data)
        .then((response) => {
          this.product.places = this.product.places.filter(
            (item) => item.id != place.id
          );
        })
        .catch((error) => {
          alert("Gabim! Rifresko faqen.");
        });
    },
    add_place() {
      if (!this.new_place.place_no) {
        alert("Te dhenat e zbrazeta");
        return;
      }

      this.new_place_errors = [];
      var data = new FormData();

      data.append("product_id", this.product.id);
      data.append("place_no", this.new_place.place_no);
      data.append("comment", this.new_place.comment);

      axios
        .post("/api/product-place", data)
        .then((response) => {
          this.product.places.push(response.data.place);
          this.new_place = {
            place_no: "",
            comment: "",
          };
        })
        .catch((error) => {
          this.new_place_errors = error.response.data.errors;
        });
    },

    set_stock_no() {
      this.product_obj_copy.stock_no =
        this.product_obj_copy.supplier_no +
        "-" +
        this.product_obj_copy.supplier_id;
    },
    submit() {
      this.$page.props.errors = {};
      if (!confirm("Ruaj ndryshimet?")) {
        return;
      }
      var data = new FormData();

      data.append("_method", "PUT");

      //   data.append("name", this.product_obj_copy.name);
      //   data.append("second_name", this.product_obj_copy.second_name);
      //   data.append("stock_no", this.product_obj_copy.stock_no);
      //   data.append("supplier_no", this.product_obj_copy.supplier_no);
      //   data.append("producer_no", this.product_obj_copy.producer_no);
      //   data.append("barcode", this.product_obj_copy.barcode);

      //   data.append("quality", this.product_obj_copy.quality);
      //   data.append("weight", this.product_obj_copy.weight);
      //   data.append("info", this.product_obj_copy.info);
      //   data.append("pieces_in_set", this.product_obj_copy.pieces_in_set);
      //   data.append("buying_price", this.product_obj_copy.buying_price);
      //   data.append("cost", this.product_obj_copy.cost);
      //   data.append("tax_rate", this.product_obj_copy.tax_rate);

      //   data.append("minimal_stock", this.product_obj_copy.minimal_stock);
      //   data.append("maximal_stock", this.product_obj_copy.maximal_stock);
      //   data.append("active", this.product_obj_copy.active);
      //   data.append("public", this.product_obj_copy.public);
      //   data.append("tax_rate", this.product_obj_copy.tax_rate);

      //   data.append("brand_id", this.product_obj_copy.brand_id);
      //   data.append("category_id", this.product_obj_copy.category_id);
      //   data.append("measuring_unit_id", this.product_obj_copy.measuring_unit_id);
      //   data.append("supplier_id", this.product_obj_copy.supplier_id);

      Object.keys(this.product_obj_copy).forEach((key) => {
        data.append(key, this.product_obj_copy[key]);
      });

      this.$inertia.post(
        this.route + "/product/" + this.product_obj_copy.id,
        data
      );
    },

    open_resource() {
      this.$inertia.get("/product/" + this.open_resource_id);
    },
  },

  mounted() {
    this.product_obj_copy = this.product;
    this.open_resource_id = this.product.id;
  },

  computed: {
    route() {
      return "http://" + window.location.host;
    },
  },
};
</script>
