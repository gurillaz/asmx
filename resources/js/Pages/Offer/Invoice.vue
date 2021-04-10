<template>
  <div class="invoice-font">
      <!-- TODO: Shto adresen dhe komentet nga db jo fixed -->
    <v-row class="d-print-none">
      <v-col cols="auto">
        <inertia-link
          :href="route + '/offer/' + offer.id"
          style="text-decoration: none"
        >
          <v-btn  outlined class="mr-2">
            <v-icon left>mdi-keyboard-backspace</v-icon>
            Kthehu te fatura</v-btn
          >
        </inertia-link>
        <v-btn outlined color="green" class="mr-2" @click="open_print_dialog()">
          <v-icon left>mdi-printer</v-icon>
          Printo</v-btn
        >
        <v-btn  outlined color="red accent-5" class="mr-2">
          <v-icon left>mdi-printer-pos</v-icon>

            Printo Fiskal</v-btn>

        <!-- {{ offer }} -->
      </v-col>
    </v-row>
    <v-row class="mt-12">
      <v-col cols="6">
        <span>Numri i klientit: {{ offer.subject.id }}</span>
        <br />
        <b>{{ offer.subject.name }}</b>
        <br />
        <b>--</b>
        <br />
        <span>Rr. "Skenderbeu", Pa nr.</span>
        <br />
        <span>Suhareke, Kosovë</span>
      </v-col>

      <v-col cols="6">
        <h2>Profaturë</h2>
        <span>Numri i faturës: {{ offer.id }}</span>
        <br />
        <span
          >Data e faturës:
          {{ moment(offer.created_at).format("DD-MM-YYYY HH:mm") }}</span
        >
        <br />
        <span>Data e shtypjes: {{ moment().format("DD-MM-YYYY HH:mm") }}</span>
      </v-col>
      <v-col cols="12">
        <table class="table">
          <thead>
            <tr>
              <th align="left">Nr. i Artikullit</th>
              <th align="left">Përshkrimi</th>
              <th style="text-align: right">Sasia</th>
              <th style="text-align: right">
                Çmimi<br />
                pa Tvsh
              </th>
              <th style="text-align: right">Tvsh<br />(18.00%)</th>
              <th style="text-align: right">
                Çmimi<br />
                me Tvsh
              </th>
              <th style="text-align: right">
                Vlera<br />
                me Tvsh
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in offer.products" :key="item.id">
              <td>{{ item.stock_no }}</td>
              <td>{{ item.custom_product_name }}</td>
              <td style="text-align: right; white-space: nowrap">
                {{ item.quantity }} Copë
              </td>
              <td style="text-align: right; white-space: nowrap">
                {{ (item.price - item.price * item.tax_rate).toFixed(2) }}
              </td>
              <td style="text-align: right; white-space: nowrap">
                {{ (item.price * item.tax_rate).toFixed(2) }}
              </td>
              <td style="text-align: right; white-space: nowrap">
                {{ item.price.toFixed(2) }}
              </td>
              <td style="text-align: right; white-space: nowrap">
                {{ (item.price * item.quantity).toFixed(2) }} €
              </td>
            </tr>
          </tbody>
        </table>
      </v-col>
    </v-row>
    <v-row>
      <v-spacer></v-spacer>
      <v-col cols="4">
        <table class="table col-xs-12" id="totalet">
          <tbody>
            <tr>
              <th>Neto:</th>
              <td>{{ net_total }} €</td>
            </tr>
            <tr>
              <th>TVSH:</th>
              <td>{{ tax_total }} €</td>
            </tr>
            <tr>
              <th>Total:</th>
              <td>{{ total }} €</td>
            </tr>
            <tr>
              <th>&nbsp;</th>
              <td>&nbsp;</td>
            </tr>
          </tbody>
        </table>
      </v-col>
    </v-row>
    <v-row class="mt-6">
      <v-col cols="12">
        <i
          >Vërejtje: Pjesët e kësaj fature nuk kanë garanci. Asnjë reklamacion
          nuk pranohet!</i
        >
      </v-col>
    </v-row>
    <v-row class="mt-12">
      <v-col cols="6" class="text-center">
        <span>____________________________________</span>
        <br />
        <b>Dorëzoi: {{ $page.props.user.name }}</b>
      </v-col>

      <v-col cols="6" class="text-center">
        <span>____________________________________</span>

        <br />
        <bold>Pranoi:</bold>
      </v-col>
    </v-row>
  </div>
</template>

<script>
import InvoiceLayout from "@/Layouts/Invoice";

export default {
  layout: InvoiceLayout,

  components: {},
  props: {
    offer: Object,
  },

  data() {
    return {};
  },

  methods: {
    open_print_dialog() {
      window.print();
    },
  },

  computed: {
    net_total() {
      var total = 0;

      this.offer.products.forEach((item) => {
        total =
          total + item.quantity * (item.price - item.price * item.tax_rate);
      });
      return total.toFixed(2);
    },

    tax_total() {
      var total = 0;

      this.offer.products.forEach((item) => {
        total = total + item.quantity * (item.price * item.tax_rate);
      });
      return total.toFixed(2);
    },

    total() {
      return (parseFloat(this.net_total) + parseFloat(this.tax_total)).toFixed(
        2
      );
    },
    route() {
      return "http://" + window.location.host;
    },
  },
};
</script>

<style scoped>
.invoice-font {
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 14px;
  line-height: 1.42857143;
}
</style>
