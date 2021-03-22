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
                    <span v-if="new_subject_type == 'supplier'">
                      Klient i ri
                    </span>
                    <span v-if="new_subject_type == 'client'">
                      Furnitor i ri
                    </span>
                  </v-card-title>
                </v-cols>
                <v-spacer></v-spacer>
                <v-col cols="3" class="text-right">
                  <v-btn text color="black" dark>
                    Anulo
                    <!-- <v-icon right small>mdi-plus-circle-outline</v-icon> -->
                  </v-btn>
                </v-col>
              </v-row>
            </v-container>
          </v-card>
          <v-container fluid>
            <v-row>
              <v-col cols="3">
                <p class="text-subtitle-1 font-weight-bold pb-1 mb-1">Te dhenat per subjektin</p>
                <p class="text-body-2 gray--text ml-3 pb-0 mb-0">- Me '*' duhet te plotesohen</p>
                <p class="text-body-2 gray--text ml-3 pb-0 mb-0">- Nr. unik caktohet automatikisht</p>
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
                      name="first_name"
                    >
                    </v-text-field>
                    <v-text-field
                      block
                      outlined
                      dense
                      clearable
                      label="Emri i subjekti"
                      autofocus
                      name="subject_name"
                    >
                    </v-text-field>
                  </v-col>
                  <v-col cols="4">
                    <v-text-field
                      block
                      outlined
                      dense
                      clearable
                      label="Adresa/Rruga"
                      autofocus
                      name="address"
                    >
                    </v-text-field>
                    <v-text-field
                      block
                      outlined
                      dense
                      clearable
                      label="Qyteti/Komuna"
                      autofocus
                      name="city"
                    >
                    </v-text-field>
                    <v-text-field
                      block
                      outlined
                      dense
                      clearable
                      label="Numri postal"
                      autofocus
                      name="postal_code"
                    >
                    </v-text-field>

                    <v-text-field
                      block
                      outlined
                      dense
                      clearable
                      label="Shteti"
                      autofocus
                      name="country"
                    >
                    </v-text-field>
                  </v-col>
                  <v-col cols="4">
                    <v-text-field
                      block
                      outlined
                      dense
                      clearable
                      label="Numri fiskal"
                      autofocus
                      name="fiscal_no"
                    >
                    </v-text-field>
                    <v-text-field
                      block
                      outlined
                      dense
                      clearable
                      label="Numri i bankes"
                      autofocus
                      name="bank_account_no"
                    >
                    </v-text-field>

                    <v-text-field
                      block
                      outlined
                      dense
                      clearable
                      label="Emri i bankes"
                      autofocus
                      name="bank_name"
                    >
                    </v-text-field>
                  </v-col>
                </v-row>
              </v-col>
            </v-row>
            <v-divider></v-divider>

            <v-row>
              <v-col cols="3">

                                <p class="text-subtitle-1 font-weight-bold pb-1 mb-1">Te dhenat per klientin</p>
                <p class="text-body-2 gray--text ml-3 pb-0 mb-0">- Me '*' duhet te plotesohen</p>
              </v-col>
              <v-col cols="9">
                <v-row>
                  <v-col cols="4">
                    <v-text-field
                      block
                      outlined
                      dense
                      clearable
                      label="Emri"
                      autofocus
                      name="first_name"
                    >
                    </v-text-field>
                    <v-text-field
                      block
                      outlined
                      dense
                      clearable
                      label="Mbiemri"
                      autofocus
                      name="last_name"
                    >
                    </v-text-field>
                  </v-col>
                  <v-col cols="4">
                    <v-text-field
                      block
                      outlined
                      dense
                      clearable
                      label="Telefon 1"
                      autofocus
                      name="phone_1"
                    >
                    </v-text-field>
                    <v-text-field
                      block
                      outlined
                      dense
                      clearable
                      label="Telefon 2"
                      autofocus
                      name="phone_2"
                    >
                    </v-text-field>
                    <v-text-field
                      block
                      outlined
                      dense
                      clearable
                      label="email"
                      autofocus
                      name="email"
                    >
                    </v-text-field>
                  </v-col>
                  <v-col cols="4">
                    <v-text-field
                      block
                      outlined
                      dense
                      clearable
                      label="Lloji i klientit"
                      autofocus
                      name="client_type"
                    >
                    </v-text-field>
                    <v-text-field
                      block
                      outlined
                      dense
                      clearable
                      label="Kredit limiti"
                      autofocus
                      name="credit_limit"
                    >
                    </v-text-field>

                    <v-text-field
                      block
                      outlined
                      dense
                      clearable
                      label="Afati i pageses(dite)"
                      autofocus
                      name="payment_limit_days"
                    >
                    </v-text-field>
                    <v-text-field
                      block
                      outlined
                      dense
                      clearable
                      label="Perqindje e ngritjes se cmimeve(1-100%)"
                      autofocus
                      name="price_increase_quota"
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
                <v-btn block color="green" dark>Ruaj</v-btn>

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
    new_subject_type: String,
  },

  data() {
    return {
      client_search: "",
      e1: 1,
      headers: [
        {
          text: "Nr. unik",
          align: "start",
          sortable: false,
          value: "subject.id",
          width: "5%",
        },
        { text: "Subjekti", value: "subject.name", width: "20%" },
        { text: "Vendi Qyteti", value: "subject.city" },
        { text: "Emri", value: "first_name", width: "10%" },
        { text: "Mbiemri", value: "last_name", width: "10%" },
        { text: "Telefon", value: "phone_1", width: "15%" },
        {
          text: "Lloji i klientit",
          value: "client_type",
          width: "10%",
        },
        {
          text: "Kategoria e klientit",
          value: "price_level.name",
          width: "10%",
        },
        {
          text: "Zgjidh",
          value: "actions",
          sortable: false,
          width: "7%",
        },
      ],
    };
  },

  methods: {
    select_client(id) {
      //   alert('selected client with id'+id);

      this.$inertia.post("/offer", { client_id: id });
    },
  },

  computed: {
    route() {
      return "http://" + window.location.host;
    },
  },
};
</script>
