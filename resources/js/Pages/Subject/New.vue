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
                    Subjekt i ri
                  </v-card-title>
                </v-col>
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
                      v-model="new_subject.subject_type"
                      :error-messages="$page.props.errors.subject_type"
                    ></v-autocomplete>
                  </v-col>
                  <v-col cols="8">
                    <v-text-field
                      :disabled="!new_subject.subject_type"
                      block
                      outlined
                      dense
                      clearable
                      label="* Emri i subjektit"
                      v-model="new_subject.name"
                      :error-messages="$page.props.errors.name"
                    >
                    </v-text-field>

                    <v-row>
                      <v-col cols="6">
                        <v-text-field
                          :disabled="!new_subject.subject_type"
                          block
                          outlined
                          dense
                          clearable
                          label="Adresa"
                          hint="Rruga ose fshati"
                          v-model="new_subject.address"
                          :error-messages="$page.props.errors.address"
                        >
                        </v-text-field>
                        <v-text-field
                          :disabled="!new_subject.subject_type"
                          block
                          outlined
                          dense
                          clearable
                          label="* Qyteti"
                          hint="Komuna"
                          v-model="new_subject.city"
                          :error-messages="$page.props.errors.city"
                        >
                        </v-text-field>
                        <v-text-field
                          :disabled="!new_subject.subject_type"
                          block
                          outlined
                          dense
                          clearable
                          label="Numri postal"
                          v-model="new_subject.postal_code"
                          :error-messages="$page.props.errors.postal_code"
                        >
                        </v-text-field>
                      </v-col>
                      <v-col cols="6">
                        <v-text-field
                          :disabled="!new_subject.subject_type"
                          block
                          outlined
                          dense
                          clearable
                          label="* Shteti"
                          v-model="new_subject.country"
                          :error-messages="$page.props.errors.country"
                        >
                        </v-text-field>

                        <v-textarea
                          :disabled="!new_subject.subject_type"
                          outlined
                          dense
                          height="6.6rem"
                          label="Te dhena shtese"
                          v-model="new_subject.info"
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
                      :disabled="!new_subject.subject_type"
                      block
                      outlined
                      dense
                      clearable
                      label="Personi kontaktues"
                      v-model="new_subject.contact_name"
                      :error-messages="$page.props.errors.contact_name"
                    >
                    </v-text-field>
                  </v-col>

                  <v-col cols="4">
                    <v-text-field
                      :disabled="!new_subject.subject_type"
                      block
                      outlined
                      dense
                      clearable
                      label="* Telefon 1"
                      v-model="new_subject.phone_1"
                      :error-messages="$page.props.errors.phone_1"
                    >
                    </v-text-field>
                    <v-text-field
                      :disabled="!new_subject.subject_type"
                      block
                      outlined
                      dense
                      clearable
                      label="Telefon 2"
                      v-model="new_subject.phone_2"
                      :error-messages="$page.props.errors.phone_2"
                    >
                    </v-text-field>
                  </v-col>
                  <v-col cols="4">
                    <v-text-field
                      :disabled="!new_subject.subject_type"
                      block
                      outlined
                      dense
                      clearable
                      label="Email"
                      type="email"
                      v-model="new_subject.email"
                      :error-messages="$page.props.errors.email"
                    >
                    </v-text-field>
                    <v-text-field
                      :disabled="!new_subject.subject_type"
                      block
                      outlined
                      dense
                      clearable
                      label="Website"
                      v-model="new_subject.website"
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
                      :disabled="!new_subject.subject_type"
                      :items="price_levels"
                      item-text="name"
                      item-value="id"
                      outlined
                      background-color="grey lighten-5"
                      flat
                      dense
                      label="** Kategoria e cmimeve"
                      v-model="new_subject.price_level_id"
                      :error-messages="$page.props.errors.price_level_id"
                    ></v-autocomplete>

                    <v-text-field
                      :disabled="!new_subject.subject_type"
                      block
                      outlined
                      dense
                      clearable
                      label="** Kuote e ngritjes se cmimeve"
                      hint="P.sh: 1.01, 1.3 etj"
                      v-model="new_subject.price_increase_quota"
                      :error-messages="$page.props.errors.price_increase_quota"
                    >
                    </v-text-field>
                  </v-col>

                  <v-col cols="4">
                    <v-text-field
                      :disabled="!new_subject.subject_type"
                      block
                      outlined
                      dense
                      clearable
                      label="** Kredit limiti"
                      v-model="new_subject.credit_limit"
                      :error-messages="$page.props.errors.credit_limit"
                    >
                    </v-text-field>
                    <v-text-field
                      :disabled="!new_subject.subject_type"
                      block
                      outlined
                      dense
                      clearable
                      label="** Afati i pageses(dite)"
                      v-model="new_subject.payment_limit_days"
                      :error-messages="$page.props.errors.payment_limit_days"
                    >
                    </v-text-field>
                  </v-col>
                  <v-col cols="4">
                    <v-text-field
                      :disabled="!new_subject.subject_type"
                      block
                      outlined
                      dense
                      clearable
                      label="Numri fiskal"
                      v-model="new_subject.fiscal_no"
                      :error-messages="$page.props.errors.fiscal_no"
                    >
                    </v-text-field>
                    <v-text-field
                      :disabled="!new_subject.subject_type"
                      block
                      outlined
                      dense
                      clearable
                      label="Emri i bankes"
                      v-model="new_subject.bank_name"
                      :error-messages="$page.props.errors.bank_name"
                    >
                    </v-text-field>
                    <v-text-field
                      :disabled="!new_subject.subject_type"
                      block
                      outlined
                      dense
                      clearable
                      label="Llogaria bankare"
                      v-model="new_subject.bank_account_no"
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
                  :disabled="!new_subject.subject_type"
                  @click="submit()"
                  dark
                  >Ruaj</v-btn
                >
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
    price_levels: Array,
    subject_types: Array,
  },

  data() {
    return {
      new_subject: {
        price_increase_quota: 1,
      },
    };
  },

  methods: {
    submit() {
      this.$page.props.errors = {};
      var data = new FormData();

      Object.keys(this.new_subject).forEach((key) => {
        data.append(key, this.new_subject[key]);
      });

      this.$inertia.post(this.route + "/subject", data);
    },
  },

  computed: {
    route() {
      return "http://" + window.location.host;
    },
  },
};
</script>
