<template>
  <div>
    <v-row>
      <v-col cols="12">
        <v-card outlined min-height="20vh">
          <v-card-title primary-title> Dokument Material </v-card-title>

          <v-row>
            <v-col cols="6">
              <v-container fluid>
                <v-row>
                  <v-col cols="3">
                    <VTextField
                      outlined
                      dense
                      name="name"
                      label="Tipi i dokumentit"
                      v-model="document_type"
                      @change="select_document_type()"
                    ></VTextField>
                  </v-col>
                  <v-col cols="9">
                    <p>{{document_type_name}}</p>
                  </v-col>
                </v-row>
              </v-container>
            </v-col>
            <v-col cols="6"></v-col>
            <pre>{{ document_types }}</pre>
          </v-row>
        </v-card>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12">
        <v-card outlined min-height="40vh">
          <!-- <v-simple-table dense fixed-header height="55vh">
            <template v-slot:default>
              <thead>
                <tr>
                  <th class="text-left" width="5%">Nr.</th>
                  <th class="text-left" width="5%">Nr. Unik</th>
                  <th class="text-left" width="40%">Emertimi</th>
                  <th class="text-left" width="5%">Sasia</th>
                  <th class="text-left" width="5%">Cmimi</th>
                  <th class="text-left" width="5%">Zbritje</th>
                  <th class="text-left" width="5%">Total</th>
                  <th class="text-right" width="5%">Veprimi</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="item in desserts" :key="item.name" >
                  <td width="5%" @mouseenter="input_field = 'item_no'" @keyup.enter="input_field=null" @mouseleave="input_field=null">

                        <v-text-field
                        v-if="input_field == 'item_no' "
                      dense
                      solo
                      height="10px"
                      background-color="green
                       lighten-5"
                      flat
                      :hide-details="true"
                      single-line
                      name="name"

                      :value="item.item_no"

                    ></v-text-field>
                    <span v-else>
                    {{ item.item_no }}

                    </span>

                  </td>
                  <td width="5%">{{ item.unique_no }}</td>
                  <td width="10%">
                    <v-text-field
                      dense
                      solo
                      height="10px"
                      background-color="blue-grey darken-2"
                      flat
                      :hide-details="true"
                      single-line
                      name="name"

                      :value="item.product_name"
                    ></v-text-field>
                  </td>
                  <td width="5%">
                    <v-text-field
                      dense
                      tile
                      :hide-details="true"
                      single-line
                      filled
                      name="name"

                      :value="item.quantity"
                    ></v-text-field>
                  </td>
                  <td width="5%">
                    <v-text-field

                      dense
                      tile
                      filled
                      :hide-details="true"
                      single-line
                      name="name"

                      :value="item.price"
                    ></v-text-field>
                  </td>
                  <td width="5%">
                    <v-text-field
                      dense
                      tile
                      filled
                      :hide-details="true"
                      single-line
                      name="name"

                      :value="item.discount"
                    ></v-text-field>
                  </td>
                  <td width="5%">{{ item.total }}</td>
                  <td width="5%">
                    <v-icon> mdi-delete </v-icon>
                  </td>
                </tr>
              </tbody>
            </template>
          </v-simple-table> -->
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
    document_types: Array,
  },

  data() {
    return {
      document_type: null,
      document_type_name: null,
      input_field: null,
      header: [],
      desserts: [
        {
          item_no: "1",
          unique_no: "123",
          product_name: "Kushinete para golf 123",
          quantity: 123,
          price: 34.12,
          total: "1231",
          discount: "0.10",
        },
        {
          item_no: "1",
          unique_no: "123",
          product_name: "Kushinete para golf 123",
          quantity: 123,
          price: 34.12,
          total: "1231",
          discount: "0.10",
        },
        {
          item_no: "1",
          unique_no: "123",
          product_name: "Kushinete para golf 123",
          quantity: 123,
          price: 34.12,
          total: "1231",
          discount: "0.10",
        },
        {
          item_no: "1",
          unique_no: "123",
          product_name: "Kushinete para golf 123",
          quantity: 123,
          price: 34.12,
          total: "1231",
          discount: "0.10",
        },
        {
          item_no: "1",
          unique_no: "123",
          product_name: "Kushinete para golf 123",
          quantity: 123,
          price: 34.12,
          total: "1231",
          discount: "0.10",
        },
        {
          item_no: "1",
          unique_no: "123",
          product_name: "Kushinete para golf 123",
          quantity: 123,
          price: 34.12,
          total: "1231",
          discount: "0.10",
        },
        {
          item_no: "1",
          unique_no: "123",
          product_name: "Kushinete para golf 123",
          quantity: 123,
          price: 34.12,
          total: "1231",
          discount: "0.10",
        },
        {
          item_no: "1",
          unique_no: "123",
          product_name: "Kushinete para golf 123",
          quantity: 123,
          price: 34.12,
          total: "1231",
          discount: "0.10",
        },
        {
          item_no: "1",
          unique_no: "123",
          product_name: "Kushinete para golf 123",
          quantity: 123,
          price: 34.12,
          total: "1231",
          discount: "0.10",
        },
        {
          item_no: "1",
          unique_no: "123",
          product_name: "Kushinete para golf 123",
          quantity: 123,
          price: 34.12,
          total: "1231",
          discount: "0.10",
        },
        {
          item_no: "1",
          unique_no: "123",
          product_name: "Kushinete para golf 123",
          quantity: 123,
          price: 34.12,
          total: "1231",
          discount: "0.10",
        },
        {
          item_no: "1",
          unique_no: "123",
          product_name: "Kushinete para golf 123",
          quantity: 123,
          price: 34.12,
          total: "1231",
          discount: "0.10",
        },
        {
          item_no: "1",
          unique_no: "123",
          product_name: "Kushinete para golf 123",
          quantity: 123,
          price: 34.12,
          total: "1231",
          discount: "0.10",
        },
      ],
    };
  },

  methods: {
    select_document_type() {
      var selected_doc_type = this.document_types.filter((item) => {
        return item.unique_no == this.document_type;
      })[0];
      if (selected_doc_type !== undefined) {
        this.document_type_name = selected_doc_type.name;
      }
    },
    show_input(input) {
      this.input_filed = input;
    },
  },

  computed: {},
};
</script>
