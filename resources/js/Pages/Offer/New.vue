<template>
  <div>
    <v-row>
      <v-col cols="3"> </v-col>

      <v-col cols="6">
        <v-text-field
          class="mt-9"
          outlined
          background-color="blue-grey lighten-5"
          autofocus
          append-icon="mdi-magnify"
          label="Zgjidh klientin"
          hide-details
          v-model="client_search"
        >
        </v-text-field>
      </v-col>
      <v-col cols="3"> </v-col>

      <v-col cols="12">
        <v-data-table
          :headers="headers"
          :items="clients"
          :search="client_search"
        >
          <template v-slot:item.actions="{ item }">
            <v-btn block color="primary" dark @click="select_client(item.id)">
              Vazhdo
              <v-icon dark right>mdi-page-next-outline</v-icon>
            </v-btn>
          </template>
        </v-data-table>
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
    clients: Array,
  },

  data() {
    return {
      client_search: "",
      headers: [
        {
          text: "Nr. unik",
          align: "start",
          sortable: false,
          value: "id",
          width: "5%",
        },
        { text: "Subjekti", value: "name", width: "20%" },
        { text: "Vendi Qyteti", value: "city" },
        { text: "Emri", value: "contact_name", width: "10%" },
        { text: "Telefon", value: "phone_1", width: "15%" },
        { text: "Lloji i klientit", value: "client_type", width: "10%" },
        {
          text: "Kategoria e klientit",
          value: "price_level.name",
          width: "10%",
        },
        { text: "Zgjidh", value: "actions", sortable: false, width: "7%" },
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

