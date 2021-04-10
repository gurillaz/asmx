<template>
  <div>
    <v-row>
      <v-col cols="12">
        <v-card outlined>
          <v-card outlined color="blue-grey darken-2">
            <v-container fluid>
              <v-row>
                <v-col cols="3" class="py-0 my-0">
                  <v-card-title class="white--text"
                    >Kategori e re e artikujve
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
                  Te dhenat per kategorine
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
                      label="* Emri i kategoris"
                      autofocus
                      name="name"
                      v-model="new_category.name"
                      :error-messages="$page.props.errors.name"
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
                <v-btn block color="green" dark @click="submit_new()"
                  >Ruaj</v-btn
                >
              </v-col>
            </v-row>
          </v-container>
        </v-card>
      </v-col>
    </v-row>
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
                    placeholder="Kerko kategorite"
                    autofocus
                    v-model="categories_search"
                  >
                  </v-text-field>
                </v-col>
                <v-spacer></v-spacer>
                <v-col cols="auto" class="py-0 my-0 text-center">
                  <v-card-title class="white--text">
                    Lista e kategorive te artikujve
                  </v-card-title>
                </v-col>
                <v-spacer></v-spacer>
                <v-col cols="3" class="text-right">
                  <!-- <v-btn
                    color="primary"
                    dark
                    depressed
                    @click="new_category = true"
                  >
                    Shto kategori te re
                    <v-icon right small>mdi-plus-circle-outline</v-icon></v-btn
                  > -->
                </v-col>
              </v-row>
            </v-container>
          </v-card>
          <v-data-table
            :headers="headers"
            :items="categories"
            :search="categories_search"
            :items-per-page="8"
          >
            <template v-slot:item.actions="{ item }">
               <inertia-link
                :href="route + '/product/category/' + item.id"
                as="button"
                block
              >
                <v-btn small color="secondary" dark @click="() => {}">
                  Shiko
                  <v-icon dark right small>mdi-page-next-outline</v-icon>
                </v-btn>
              </inertia-link>
            </template>

            <template v-slot:item.created_at="{ item }">
              <span>
                {{ moment(item.created_at).format("DD-MM-YYYY HH:mm") }}
              </span>
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
    categories: Array,
  },

  data() {
    return {
      new_category: {
        name: "",
      },

      categories_search: "",
      headers: [
        {
          text: "# Unik",
          value: "id",
          width: "6%",
          sortable: false,
        },
        {
          text: "Kategoria",
          value: "name",
          width: "49%",
        },
        {
          text: "Numri i artikujve",
          value: "product_count",
          width: "10%",
          align: "center",
        },
        {
          text: "Shtuar nga",
          value: "created_by",
          width: "15%",
          align: "right",
        },
        {
          text: "Shtuar date",
          value: "created_at",
          width: "10%",
        },
        {
          text: "Veprimet",
          value: "actions",
          sortable: false,
          width: "10%",
        },
      ],
    };
  },

  methods: {
    submit_new() {
      if (!confirm("Konfirmo?")) {
        return;
      }
      var data = new FormData();
      data.append("name", this.new_category.name || "");

      this.$inertia.post(this.route + "/product/category", data);
    },
  },

  computed: {
    route() {
      return "http://" + window.location.host;
    },
  },
};
</script>
