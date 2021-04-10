    <template>
  <div>
    <v-row>
      <v-col cols="12">
        <v-card outlined>
          <v-card outlined color="blue-grey darken-2">
            <v-container fluid>
              <v-row>
                <v-col cols="3" class="py-0 my-0">
                  <v-card-title class="white--text py-3">
                    Artikull i ri
                  </v-card-title>
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
                  Te dhenat per artikullin
                </p>
                <p class="text-body-2 gray--text ml-3 pb-0 mb-0">
                  - Me '*' duhet te plotesohen
                </p>
                <p class="text-body-2 gray--text ml-3 pb-0 mb-0">
                  - Nr. unik caktohet automatikisht
                </p>

                <p class="text-body-2 gray--text ml-3 pb-0 mb-0">
                  - Nr. i stokut caktohet automatikisht sipas numrit te
                  furnizuesit dhe furnitorit
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
                      v-model="new_product.supplier_id"
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
                      v-model="new_product.brand_id"
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
                      v-model="new_product.category_id"
                      :error-messages="$page.props.errors.category_id"
                    ></v-autocomplete>
                    <v-text-field
                      block
                      outlined
                      dense
                      background-color="yellow lighten-5"
                      label="Numri unik"
                      readonly
                      v-model="new_product.id"
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
                      v-model="new_product.stock_no"
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
                      v-model="new_product.public"
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
                      v-model="new_product.name"
                      :error-messages="$page.props.errors.name"
                    >
                    </v-text-field>
                    <v-text-field
                      block
                      outlined
                      dense
                      label="Gjuha e dyte"
                      name="second_name"
                      v-model="new_product.second_name"
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
                      v-model="new_product.supplier_no"
                      :error-messages="$page.props.errors.supplier_no"
                    >
                    </v-text-field>
                    <v-text-field
                      block
                      outlined
                      dense
                      label="* Numri i prodhuesit"
                      name="producer_no"
                      v-model="new_product.producer_no"
                      :error-messages="$page.props.errors.producer_no"
                    >
                    </v-text-field>

                    <v-text-field
                      block
                      outlined
                      dense
                      label="* Numri orgjinal"
                      name="original_no"
                      v-model="new_product.original_no"
                      :error-messages="$page.props.errors.original_no"
                    >
                    </v-text-field>
                    <v-text-field
                      block
                      outlined
                      dense
                      label="Barkodi"
                      name="barcode"
                      v-model="new_product.barcode"
                      :error-messages="$page.props.errors.barcode"
                    >
                    </v-text-field>
                  </v-col>
                  <v-col cols="4">
                    <v-autocomplete
                      :items="quality"
                      item-text="value"
                      item-value="value"
                      outlined
                      background-color="grey lighten-5"
                      flat
                      dense
                      label="Kualiteti"
                      v-model="new_product.quality"
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
                      v-model="new_product.measuring_unit_id"
                      :error-messages="$page.props.errors.measuring_unit_id"
                    ></v-autocomplete>
                    <v-text-field
                      block
                      outlined
                      dense
                      label="Pesha"
                      name="weight"
                      v-model="new_product.weight"
                      :error-messages="$page.props.errors.weight"
                    >
                    </v-text-field>
                    <v-text-field
                      block
                      outlined
                      dense
                      label="Sasia ne set"
                      name="pieces_in_set"
                      v-model="new_product.pieces_in_set"
                      :error-messages="$page.props.errors.pieces_in_set"
                    >
                    </v-text-field>
                    <v-textarea
                      outlined
                      dense
                      height="6.6rem"
                      label="Te dhena shtese"
                      name="info"
                      v-model="new_product.info"
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
                  - Kosto e furnizimit => Cmimi i blerjes + Trasport + Tatime
                  <b>(pa TVSH)</b>
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
                      v-model="new_product.stock"
                      :error-messages="$page.props.errors.stock"
                    >
                    </v-text-field>
                    <v-text-field
                      block
                      outlined
                      dense
                      label="Stoku minimal"
                      v-model="new_product.minimal_stock"
                      :error-messages="$page.props.errors.minimal_stock"
                    >
                    </v-text-field>

                    <v-text-field
                      block
                      outlined
                      dense
                      label="Stoku maksimal"
                      v-model="new_product.maximal_stock"
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
                      v-model="new_product.buying_price"
                      :error-messages="$page.props.errors.buying_price"
                    >
                    </v-text-field>

                    <v-text-field
                      block
                      outlined
                      dense
                      label="* Kosto e furnizimit"
                      v-model="new_product.cost"
                      :error-messages="$page.props.errors.cost"
                    >
                    </v-text-field>

                    <v-text-field
                      block
                      outlined
                      dense
                      label="* TVSH"
                      append-icon="mdi-percent-outline"
                      v-model="new_product.tax_rate"
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
  </div>
</template>

    <script>
import AuthLayout from "@/Layouts/Authenticated";

export default {
  layout: AuthLayout,

  components: {},
  props: {
    suppliers: Array,
    brands: Array,
    categories: Array,
    units: Array,
    quality: Array,
  },

  data() {
    return {
      new_product: {
        quality: "I pacaktuar",
        pieces_in_set: 1,
        minimal_stock: 1,
        maximal_stock: 1,
        public: "TRUE",
      },
    };
  },

  methods: {
    set_stock_no() {
      this.new_product.stock_no =
        this.new_product.supplier_no + "-" + this.new_product.supplier_id;
    },
    submit() {
      this.$page.props.errors = {};
      var data = new FormData();

      Object.keys(this.new_product).forEach((key) => {
        data.append(key, this.new_product[key]);
      });

      this.$inertia.post(this.route + "/product", data);
    },
  },

  computed: {
    route() {
      return "http://" + window.location.host;
    },
  },
};
</script>
