<template>
  <div>
    <v-row>
      <v-col cols="9">
        <v-file-input v-model="file" show-size hide-details></v-file-input>
      </v-col>
      <v-col cols="3">
        <v-btn @click="input()" block color="green" dark>
          Importo
          <v-icon dark right>mdi-import</v-icon>
        </v-btn>
      </v-col>
      <pre>

      {{ output }}
      </pre>
    </v-row>
  </div>
</template>

<script>
import AuthLayout from "@/Layouts/Authenticated";

import XLSX from "xlsx";

export default {
  layout: AuthLayout,

  components: {},
  props: {
    document_types: Array,
  },

  data() {
    return {
      file: null,
      output:null,
      document_type: null,
      document_type_name: null,
      input_field: null,
      header: [],
    };
  },

  methods: {
    input() {
      var selectedFile = this.file;
      var reader = new FileReader();
      var this_obj = this;
      reader.onload = function (event) {
        var data = event.target.result;
        var workbook = XLSX.read(data, {
          type: "binary",
        });
        workbook.SheetNames.forEach(function (sheetName) {
          var XL_row_object = XLSX.utils.sheet_to_row_object_array(
            workbook.Sheets[sheetName]
          );
          var json_object = JSON.parse(

              JSON.stringify(XL_row_object)
          );
          this_obj.output = json_object;
        });
      };

      reader.onerror = function (event) {
        console.error(
          "File could not be read! Code " + event.target.error.code
        );
      };

      reader.readAsBinaryString(selectedFile);
    },
  },

  computed: {},
};
</script>
