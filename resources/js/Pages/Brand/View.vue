<template>
  <div>
    <v-row>
      <v-col cols="12">
        <v-card outlined>
          <v-card outlined color="blue-grey darken-2">
            <v-container fluid>
              <v-row>
                <v-col cols="auto" class="py-0 my-0">
                  <v-card-title class="white--text"> Brendi: {{ brand.name }} </v-card-title>
                </v-col>
                <v-spacer></v-spacer>
                <v-col cols="3" class="text-right">
                  <inertia-link
                    :href="route + '/brand'"
                    style="text-decoration: none"
                  >
                    <v-btn color="primary" dark depressed>
                      Lista e brendeve
                      <v-icon right small
                        >mdi-format-list-bulleted</v-icon
                      ></v-btn
                    >
                  </inertia-link>
                </v-col>
              </v-row>
            </v-container>
          </v-card>
          <v-container fluid>
            <v-row>
              <v-col cols="3">
                <p class="text-subtitle-1 font-weight-bold pb-1 mb-1">
                  Te dhenat per brendin
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
                      :value="brand.id"
                      block
                      outlined
                      dense
                      clearable
                      background-color="yellow lighten-5"
                      label="Numri unik"
                      autofocus
                      disabled
                    >
                    </v-text-field>
                  </v-col>
                  <v-col cols="4">
                    <v-text-field
                      block
                      outlined
                      dense
                      clearable
                      label="* Emri i brendit"
                      autofocus
                      name="name"
                      v-model="brand_copy.name"
                      :error-messages="$page.props.errors.name"
                    >
                    </v-text-field>
                    <v-text-field
                      block
                      outlined
                      dense
                      clearable
                      label="* Kompania prodhuese"
                      autofocus
                      name="producing_company"
                      v-model="brand_copy.producing_company"
                      :error-messages="$page.props.errors.producing_company"
                    >
                    </v-text-field>
                    <v-text-field
                      block
                      outlined
                      dense
                      clearable
                      label="* Vendi i origjines"
                      autofocus
                      name="producing_country"
                      v-model="brand_copy.producing_country"
                      :error-messages="$page.props.errors.producing_country"
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
                  Furnitoret
                </p>
                <p class="text-body-2 gray--text ml-3 pb-0 mb-0">
                  - Shto ose hiq furnitoret e brendit
                </p>
              </v-col>
              <v-col cols="9">
                <v-row style="min-height: 200px">
                  <v-col cols="8">
                    <v-autocomplete
                      class="mt-3"
                      :items="suppliers"
                      item-text="name"
                      item-value="id"
                      outlined
                      background-color="grey lighten-5"
                      flat
                      chips
                      deletable-chips
                      label="Furnitoret"
                      multiple
                      v-model="brand_copy.supplier_ids"
                      :error-messages="$page.props.errors.supplier_ids"
                    ></v-autocomplete>
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
    brand: Object,
  },

  data() {
    return {
      brand_copy: {
        name: "",
        producing_company: "",
        producing_country: "",
        supplier_ids: [],
      },
    };
  },

  methods: {
    submit() {
        this.$page.props.errors = {};
      if (!confirm("Ruaj ndryshimet?")) {
        return;
      }
      var data = new FormData();
      data.append("_method", "PUT");
      data.append("name", this.brand_copy.name || "");
      data.append("producing_company", this.brand_copy.producing_company || "");
      data.append("producing_country", this.brand_copy.producing_country || "");

      this.brand_copy.supplier_ids.forEach((element) => {
        data.append("supplier_ids[]", element);
      });

      this.$inertia.post(this.route + "/brand/"+this.brand.id, data);
    },
  },
  mounted() {
    this.brand_copy = JSON.parse(JSON.stringify(this.brand));
  },

  computed: {
    route() {
      return "http://" + window.location.host;
    },
  },
};
</script>
