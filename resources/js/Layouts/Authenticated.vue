<template>
  <v-app>
    <v-app-bar color="blue-grey darken-3" fixed dense dark app height="30px">
      <!-- <v-toolbar-title id="logo-format" class="pl-3" style="width:150px">asmX</v-toolbar-title> -->
      <inertia-link :href="route" as="button" class="mr-7">
        <v-toolbar-title class="pl-7 font-weight-bold"
          >ASM<span class="font-weight-bold red--text">x</span></v-toolbar-title
        >
      </inertia-link>

      <v-menu
        right
        offset-y
        bottom
        tile
        light
        v-for="menuItem in menu"
        v-bind:key="menuItem.text"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-btn
            text
            tile
            small
            v-bind="attrs"
            v-on="on"
            class="text-capitalize"
            >{{ menuItem.text }}</v-btn
          >
        </template>

        <v-list dense>
          <span v-for="listItem in menuItem.items" v-bind:key="listItem.text">
            <v-list-item @click="() => {}" v-if="listItem.submenu.length > 0">
              <v-list-item-title>
                <v-menu
                tile
                  offset-x
                  right
                  nudge-right="17"
                  nudge-top="20"
                  :elevation="0"
                >
                  <template v-slot:activator="{ on, attrs }">
                    <v-list-item-title v-bind="attrs" v-on="on">

                      <v-icon small left>{{ listItem.icon }}</v-icon>

                      {{ listItem.text }}
                      <v-icon small right color="red" >mdi-chevron-right</v-icon>
                    </v-list-item-title>
                    <!-- <v-btn text tile small class="pa-0 ma-0" plain v-bind="attrs" v-on="on">Faktura</v-btn> -->
                  </template>

                  <v-list dense>
                    <inertia-link
                      v-for="subemnuItem in listItem.submenu"
                      v-bind:key="subemnuItem.text"
                      :href="route + subemnuItem.link"
                      style="text-decoration: none"
                    >
                      <v-list-item @click="() => {}">
                        <v-list-item-title>
                          <v-icon small left>{{ subemnuItem.icon }}</v-icon>

                          {{ subemnuItem.text }}
                        </v-list-item-title>
                      </v-list-item>
                    </inertia-link>

                    <!-- <inertia-link
                      :href="route + '/document-type/create'"
                      style="text-decoration: none"
                    >
                      <v-list-item @click="() => {}">
                        <v-list-item-title>
                          <v-icon small left>mdi-plus-circle</v-icon>

                          Tip i ri i dok. materiale
                        </v-list-item-title>
                      </v-list-item>
                    </inertia-link> -->
                  </v-list>
                </v-menu>
              </v-list-item-title>
            </v-list-item>
            <inertia-link
              v-else
              :href="route + listItem.link"
              style="text-decoration: none"
            >
              <v-list-item @click="() => {}">
                <v-list-item-title>
                  <v-icon small left>{{ listItem.icon }}</v-icon>

                  {{ listItem.text }}
                </v-list-item-title>
              </v-list-item>
            </inertia-link>
          </span>
        </v-list>
      </v-menu>

      <v-spacer></v-spacer>

      <v-menu right offset-y bottom tile>
        <template v-slot:activator="{ on, attrs }">
          <v-btn
            :text="session_public"
            :elevation="0"
            tile
            small
            :color="session_public ? '' : 'red'"
            v-bind="attrs"
            v-on="on"
            >{{ user.name }}

            <v-icon small right x-small>mdi-account</v-icon>
          </v-btn>
        </template>

        <v-list dense>
          <v-list-item @click="() => {}">
            <v-list-item-title>Llogaria </v-list-item-title>
          </v-list-item>
          <v-list-item @click="logout()">
            <v-list-item-title> Shkyqu </v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
    </v-app-bar>
    <v-main class="auth-layout-bg-color">
      <v-container fluid>
        <flash-messages />
        <!-- {{$page.props.flash}} -->
        <slot />
      </v-container>
    </v-main>
    <Keypress
      key-event="keyup"
      :key-code="80"
      @success="onevent"
      :modifiers="['altKey']"
    />
  </v-app>
</template>

<script>
//https://github.com/lupas/vue-keypress

import Keypress from "vue-keypress";
import FlashMessages from "../Components/FlashMessages";

export default {
  components: {
    Keypress,
    FlashMessages,
  },

  data() {
    return {
      menu: [
        {
          text: "Oferta",
          items: [
            {
              text: "Ofert e re",
              icon: "mdi-plus-circle",
              link: "/offer/create",
              submenu: [],
            },
            {
              text: "Oferta e fundit",
              icon: "mdi-page-last",
              link: "/offer/last",
              submenu: [],
            },
            {
              text: "Ofertat sot",
              icon: "mdi-calendar-today",
              link: "/offer/today",
              submenu: [],
            },
            {
              text: "Filtro ofertat",
              icon: "mdi-format-list-bulleted",
              link: "/offer",
              submenu: [],
            },
          ],
        },

        {
          text: "Faktura",
          items: [
            {
              text: "Faktura e fundit",
              icon: "mdi-page-last",
              link: "/offer/create",
              submenu: [],
            },

            {
              text: "Tipet e dok. materiale",
              icon: "mdi-format-list-bulleted",
              link: "/document-type",
              submenu: [],
            },
            {
              text: "Tip i ri i dok. materiale",
              icon: "mdi-plus-circle",
              link: "/document-type/create",
              submenu: [],
            },
          ],
        },

        {
          text: "Raporte",
          items: [],
        },
        {
          text: "Klientet",
          items: [
            {
              text: "Hap klientin",
              icon: "mdi-folder-open",
              link: "/offer/create",
              data: { new_subject_type: "client" },
              submenu: [],
            },
            {
              text: "Lista e klienteve",
              icon: "mdi-format-list-bulleted",

              link: "/offer/create",
              data: { },
              submenu: [],
            },

            {
              text: "Klient i ri",
              icon: "mdi-plus-circle",
              link: "/offer/create",
              data: {  },
              submenu: [],
            },
            {
              text: "Kategorite",
              icon: "mdi-alpha-k-box-outline",
              submenu: [
                {
                  text: "Kategorite e klientit",
              icon: "mdi-format-list-bulleted",

                  link: "/offer/create",
                  data: {  },
                },

                {
                  text: "Kategori e re",
                  icon: "mdi-plus-circle",
                  link: "/offer/create",
                  data: {  },
                },
              ],
            },
          ],
        },

        {
          text: "Artikuj",
          items: [
            {
              text: "Hap artikullin",
              icon: "mdi-folder-open",
              link: "/product/last",
              submenu: [],
              data: null,
            },
            {
              text: "Artikull i ri",
              icon: "mdi-plus-circle",
              link: "/product/create",
              submenu: [],
              data: null,
            },

            {
              text: "Importo artikujt",
              icon: "mdi-import",
              link: "/product/import",
              submenu: [],
              data: null,
            },

            {
              text: "Filtro dhe eksporto artikujt",
              icon: "mdi-export",
              link: "/product/import",
              submenu: [],
              data: null,
            },

            {
              text: "Brendet",
              icon: "mdi-alpha-b-box-outline",
              submenu: [
                {
                  text: "Lista e brendeve",
                  icon: "mdi-format-list-bulleted",
                  link: "/brand",
                  submenu: [],
                  data: null,
                },
                {
                  text: "Brand i ri",
                  icon: "mdi-plus-circle",
                  link: "/brand/create",
                  submenu: [],
                  data: null,
                },
              ],
              data: null,
            },

            {
              text: "Furnitoret",
              icon: "mdi-truck-fast-outline",
              submenu: [
                {
                  text: "Lista e brendeve",
                  icon: "mdi-format-list-bulleted",
                  link: "/supplier",
                  submenu: [],
                  data: null,
                },
                {
                  text: "Furnitor i ri",
                  icon: "mdi-plus-circle",
                  link: "/supplier/create",
                  submenu: [],
                  data: null,
                },
              ],
              data: null,
            },
          ],
        },
        {
          text: "Tjera",
          items: [],
        },
      ],
    };
  },
  methods: {
    logout() {
      this.$inertia.post("/logout");
    },
    onevent() {
      this.$inertia.post("/session/toggle");
    },
  },
  computed: {
    route() {
      return "http://" + window.location.host;
    },

    user() {
      return this.$page.props.user;
    },
    session_public() {
      return this.$page.props.public;
    },
  },
};
</script>


<style scoped>
.auth-layout-bg-color {
  background-color: rgba(0, 0, 0, 0.03);
  /* background-color: rgba(0, 0, 0, 0.3); */
}
</style>
