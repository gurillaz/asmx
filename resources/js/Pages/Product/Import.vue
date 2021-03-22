<template>
  <div>
    <v-row>
      <v-col cols="12">
        <v-card outlined>
          <v-card outlined color="blue-grey darken-2">
            <v-container fluid>
              <v-row>
                <v-cols cols="3">
                  <v-card-title class="white--text">
                      Importo artikujt
                  </v-card-title>
                </v-cols>
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
                >
                  <v-icon dark left small>mdi-download</v-icon>
                  Shkarko</v-btn
                >
                <p class="text-body-2 mt-5">
                  2. Ploteso shabllonin: Informatat në shabllon duhet të
                  plotësohen të gjitha. Nuk duhet të ketë asnjë informatë më
                  shumë ose më pak. Informatat duhet të jenë saktë në kolonat me
                  shkronja si ne Shabllon.
                </p>

                <p class="text-body-2 mt-5">
                  3. Ngarko shabllonin duke plotesuar paraprakisht rubrikat ne
                  te djathte.
                </p>
              </v-col>
              <v-col cols="4">
                <v-autocomplete
                  v-model="form_data.supplier_id"
                  :items="suppliers"
                  item-text="subject.name"
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

                <v-text-field
                  v-model="form_data.measuring_unit"
                  label="Njesia Matese"
                  dense
                  outlined
                  clearable
                ></v-text-field>

                <v-autocomplete
                  v-model="form_data.quality"
                  :items="[0,1,2,3,4,5,]"
                  label="Kualiteti"
                  dense
                  outlined
                  clearable
                ></v-autocomplete>

                <v-divider></v-divider>
                <p class="caption">
                  Shto fajllin per importimin e artkujve te ri.
                </p>
                <v-file-input
                  clearable
                  append-icon="mdi-file"
                  prepend-icon=""
                  show-size
                  label="Fajlli per importimin e artikujve te ri"
                  outlined
                  dense
                  block
                  v-model="form_data.file"
                ></v-file-input>

                <v-btn block color="green" dark @click="submit_form()">
                  Ruaj
                  <v-icon dark right>mdi-import</v-icon>
                </v-btn>
              </v-col>

              <v-col cols="4"></v-col>
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
    categories: Array,
    brands: Array,
    suppliers: Array,
  },

  data() {
    return {
      form_data: {
        category_id: "",
        supplier_id: "",
        brand_id: "",
        brand_id: "",
        measuring_unit:'',
        quality: "",
        file: null,
      },
    };
  },

  methods: {
    submit_form() {
      // console.log(this.form_data.file);
      // return;
      var data = new FormData();
      data.append("category_id", this.form_data.category_id || "");
      data.append("supplier_id", this.form_data.supplier_id || "");
      data.append("brand_id", this.form_data.brand_id || "");
      data.append("measuring_unit", this.form_data.measuring_unit || "");
      data.append("quality", this.form_data.quality || "");
      data.append("file", this.form_data.file || "");

      this.$inertia.post(this.route + "/product/import_store", data);
    },
  },
  computed: {
    route() {
      return "http://" + window.location.host;
    },
  },
};
</script>
