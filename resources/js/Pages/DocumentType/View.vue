<template>
  <div>
    <v-row>
      <v-col cols="12">
        <v-card outlined>
          <v-card outlined tile  color="blue-grey darken-2">
            <v-container fluid>
              <v-row>
                <v-col cols="auto" class="py-0 my-0">
                  <v-card-title class="pl-0 white--text">
                    Tipi i dokumentit: [{{ document_type.id }}]
                    {{ document_type.name }}
                  </v-card-title>
                </v-col>
                <v-spacer></v-spacer>
                <v-col cols="3" class="text-right">
                  <inertia-link
                    :href="route + '/document-type'"
                    style="text-decoration: none"
                  >
                    <v-btn color="primary" dark depressed>
                      Tipet e dokumenteve
                      <v-icon right small
                        >mdi-format-list-bulleted</v-icon
                      ></v-btn
                    >
                  </inertia-link>
                </v-col>
              </v-row>
            </v-container>
          </v-card>
          <v-sheet tile>
            <v-container fluid class="py-1">
              <v-row class="pr-2">
                <v-col cols="auto">
                  <p class="text-info caption pb-0 mb-0">
                    Numri i dokumenteve:
                  </p>
                  <p class="py-0 my-0">
                    {{ document_type_copy.document_count }}
                  </p>
                </v-col>
                <v-spacer></v-spacer>

                <v-col cols="auto">
                  <p class="text-info caption pb-0 mb-0">Krijuar me:</p>
                  <p class="py-0 my-0">
                    {{
                      moment(document_type_copy.created_at).format(
                        "DD-MM-YY HH:mm"
                      )
                    }}
                  </p>
                </v-col>

                <v-col
                  cols="auto"
                  v-if="
                    document_type_copy.created_at !==
                    document_type_copy.updated_at
                  "
                >
                  <p class="text-info caption pb-0 mb-0">Modifikuar me:</p>
                  <p class="py-0 my-0">
                    {{
                      moment(document_type_copy.modified_at).format(
                        "DD-MM-YY HH:mm"
                      )
                    }}
                  </p>
                </v-col>

                <v-col cols="auto">
                  <p class="text-info caption pb-0 mb-0">Nga useri:</p>
                  <p class="py-0 my-0">
                    {{ document_type_copy.created_by }}
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
                  Te dhenat per tipin e dokumentit
                </p>
                <p class="text-body-2 gray--text ml-3 pb-0 mb-0">
                  - Me '*' duhet te plotesohen
                </p>
                <p class="text-body-2 gray--text ml-3 pb-0 mb-0">
                  - Nr. unik caktohet automatikisht
                </p>
                <p class="text-body-2 gray--text ml-3 pb-0 mb-0">
                  - Veprimi ne stok: Sasite e caktuara ne dokumentet e ketij
                  lloji duhet te heqin ose shtojn gjendjen e stokut
                </p>
                <p
                  v-if="$page.props.public == false"
                  class="text-body-2 gray--text ml-3 pb-0 mb-0"
                >
                  - P per publik, nese dokumentet e ketije tipi duhet te shfaqen
                  ne anen publike
                </p>
              </v-col>
              <v-col cols="9">
                <v-row>
                  <v-col cols="4">
                    <v-text-field
                      :value="document_type.id"
                      block
                      outlined
                      dense
                      background-color="yellow lighten-5"
                      label="Numri unik"
                      autofocus
                      disabled
                    >
                    </v-text-field>
                    <v-switch
                      v-if="$page.props.public == false"
                      v-model="document_type_copy.public"
                      true-value="TRUE"
                      false-value="FALSE"
                      inset
                      dense
                      label="P"
                      :error-messages="$page.props.errors.public"
                    ></v-switch>
                  </v-col>
                  <v-col cols="4">
                    <v-text-field
                      block
                      outlined
                      dense
                      label="* Pershkrimi"
                      autofocus
                      name="name"
                      v-model="document_type_copy.name"
                      :error-messages="$page.props.errors.name"
                    >
                    </v-text-field>

                    <v-textarea
                      block
                      outlined
                      dense
                      height="6em"
                      label="Info shtese"
                      autofocus
                      name="info"
                      v-model="document_type_copy.info"
                      :error-messages="$page.props.errors.info"
                    >
                    </v-textarea>
                  </v-col>
                  <v-col cols="4">
                    <v-select
                      :items="[
                        { text: 'Hyrje', value: 'IN' },
                        { text: 'Dalje', value: 'OUT' },
                      ]"
                      block
                      outlined
                      dense
                      label="Veprimi ne stok"
                      name="stock_type"
                      v-model="document_type_copy.stock_type"
                      :error-messages="$page.props.errors.stock_type"
                    >
                    </v-select>
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
    document_type: Object,
  },

  data() {
    return {
      document_type_copy: {
        name: "",
        info: "",
        stock_type: "",
        public: true,
      },
    };
  },

  methods: {
    submit() {
      if (!confirm("Ruaj ndryshimet?")) {
        return;
      }
      var data = new FormData();
      data.append("_method", "PUT");
      data.append("name", this.document_type_copy.name || "");
      data.append("info", this.document_type_copy.info || "");
      data.append("public", this.document_type_copy.public || "");
      data.append("stock_type", this.document_type_copy.stock_type || "");

      this.$inertia.post(
        this.route + "/document-type/" + this.document_type.id,
        data
      );
    },
  },
  mounted() {
    this.document_type_copy = JSON.parse(JSON.stringify(this.document_type));
  },

  computed: {
    route() {
      return "http://" + window.location.host;
    },
  },
};
</script>
