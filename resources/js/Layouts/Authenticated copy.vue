<template>
  <v-app>
    <v-app-bar color="blue-grey darken-3" fixed dense dark app height="30px">
      <!-- <v-toolbar-title id="logo-format" class="pl-3" style="width:150px">asmX</v-toolbar-title> -->
      <inertia-link :href="route" as="button" class="mr-7">
        <v-toolbar-title class="pl-7 font-weight-bold"
          >ASM<span class="font-weight-bold red--text">x</span></v-toolbar-title
        >
      </inertia-link>

      <v-menu right offset-y bottom>
        <template v-slot:activator="{ on, attrs }">
          <v-btn text tile small v-bind="attrs" v-on="on">Oferta</v-btn>
        </template>

        <v-list dense>
          <inertia-link
            :href="route + '/offer/create'"
            style="text-decoration: none"
          >
            <v-list-item @click="() => {}">
              <v-list-item-title>
                <v-icon small left>mdi-plus-circle</v-icon>
                Oferte e re
              </v-list-item-title>
            </v-list-item>
          </inertia-link>

          <inertia-link
            :href="route + '/offer/last'"
            style="text-decoration: none"
          >
            <v-list-item @click="() => {}">
              <v-list-item-title>
                <v-icon small left>mdi-page-last</v-icon>

                Oferta e fundit
              </v-list-item-title>
            </v-list-item>
          </inertia-link>

          <inertia-link
            :href="route + '/offer/today'"
            style="text-decoration: none"
          >
            <v-list-item @click="() => {}">
              <v-list-item-title>
                <v-icon small left>mdi-format-list-bulleted</v-icon>

                Liste e ofertave(sot)
              </v-list-item-title>
            </v-list-item>
          </inertia-link>

          <inertia-link :href="route + '/offer'" style="text-decoration: none">
            <v-list-item @click="() => {}">
              <v-list-item-title>
                <v-icon small left>mdi-filter</v-icon>

                Filtro ofertat
              </v-list-item-title>
            </v-list-item>
          </inertia-link>
        </v-list>
      </v-menu>
      <v-menu right offset-y bottom tile light>
        <template v-slot:activator="{ on, attrs }">
          <v-btn text tile small v-bind="attrs" v-on="on">Faktura</v-btn>
        </template>

        <v-list dense>
          <v-list-item @click="() => {}">
            <v-list-item-title>
              <v-menu
                offset-x
                right
                nudge-right="17"
                nudge-top="20"
                :elevation="0"
              >
                <template v-slot:activator="{ on, attrs }">
                  <v-list-item-title v-bind="attrs" v-on="on">
                    <v-icon small left>mdi-format-list-bulleted</v-icon>

                    Tipet e dok.
                    <v-icon small right>mdi-chevron-right</v-icon>
                  </v-list-item-title>
                  <!-- <v-btn text tile small class="pa-0 ma-0" plain v-bind="attrs" v-on="on">Faktura</v-btn> -->
                </template>

                <v-list dense>
                  <inertia-link
                    :href="route + '/document-type'"
                    style="text-decoration: none"
                  >
                    <v-list-item @click="() => {}">
                      <v-list-item-title>
                        <v-icon small left>mdi-format-list-bulleted</v-icon>

                        Tipet e dok. materiale
                      </v-list-item-title>
                    </v-list-item>
                  </inertia-link>

                  <inertia-link
                    :href="route + '/document-type/create'"
                    style="text-decoration: none"
                  >
                    <v-list-item @click="() => {}">
                      <v-list-item-title>
                        <v-icon small left>mdi-plus-circle</v-icon>

                        Tip i ri i dok. materiale
                      </v-list-item-title>
                    </v-list-item>
                  </inertia-link>
                </v-list>
              </v-menu>
            </v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
      <v-menu right offset-y bottom>
        <template v-slot:activator="{ on, attrs }">
          <v-btn text tile small v-bind="attrs" v-on="on">Dok. Materiale</v-btn>
        </template>

        <v-list dense>
          <inertia-link
            :href="route + '/document-type'"
            style="text-decoration: none"
          >
            <v-list-item @click="() => {}">
              <v-list-item-title>
                <v-icon small left>mdi-format-list-bulleted</v-icon>

                Tipet e dok. materiale
              </v-list-item-title>
            </v-list-item>
          </inertia-link>

          <inertia-link
            :href="route + '/document-type/create'"
            style="text-decoration: none"
          >
            <v-list-item @click="() => {}">
              <v-list-item-title>
                <v-icon small left>mdi-plus-circle</v-icon>

                Tip i ri i dok. materiale
              </v-list-item-title>
            </v-list-item>
          </inertia-link>
        </v-list>
      </v-menu>

      <v-menu right offset-y bottom>
        <template v-slot:activator="{ on, attrs }">
          <v-btn text tile small v-bind="attrs" v-on="on">Subjektet</v-btn>
        </template>

        <v-list dense>
          <inertia-link
            :href="route + '/subject/create'"
            :data="{ new_subject_type: 'client' }"
            style="text-decoration: none"
          >
            <v-list-item @click="() => {}">
              <v-list-item-title>
                <v-icon small left>mdi-plus-circle</v-icon>

                Klient i ri
              </v-list-item-title>
            </v-list-item>
          </inertia-link>
          <inertia-link :href="route + '/client'" style="text-decoration: none">
            <v-list-item @click="() => {}">
              <v-list-item-title>
                <v-icon small left>mdi-format-list-bulleted</v-icon>

                Lista e klienteve
              </v-list-item-title>
            </v-list-item>
          </inertia-link>
          <v-divider class="py-0 my-0"></v-divider>

          <inertia-link
            :href="route + '/subject/create'"
            :data="{ new_subject_type: 'supplier' }"
            style="text-decoration: none"
          >
            <v-list-item @click="() => {}">
              <v-list-item-title>
                <v-icon small left>mdi-plus-circle</v-icon>

                Furnitor i ri
              </v-list-item-title>
            </v-list-item>
          </inertia-link>

          <inertia-link
            :href="route + '/supplier'"
            style="text-decoration: none"
          >
            <v-list-item @click="() => {}">
              <v-list-item-title>
                <v-icon small left>mdi-format-list-bulleted</v-icon>

                Lista e furnitoreve
              </v-list-item-title>
            </v-list-item>
          </inertia-link>
          <!-- <v-divider class="py-0 my-0"></v-divider> -->
        </v-list>
      </v-menu>
      <v-menu right offset-y bottom>
        <template v-slot:activator="{ on, attrs }">
          <v-btn text tile small v-bind="attrs" v-on="on">Profatura</v-btn>
        </template>

        <v-list dense> </v-list>
      </v-menu>

      <v-menu right offset-y bottom>
        <template v-slot:activator="{ on, attrs }">
          <v-btn text tile small v-bind="attrs" v-on="on">Artikujt</v-btn>
        </template>

        <v-list dense>
          <!-- --------------------------------------- -->

          <inertia-link :href="route + '/brand'" style="text-decoration: none">
            <v-list-item @click="() => {}">
              <v-list-item-title>
                <v-icon small left>mdi-folder-open</v-icon>

                Hap artikullin
              </v-list-item-title>
            </v-list-item>
          </inertia-link>
          <!-- --------------------------------------- -->

          <inertia-link
            :href="route + '/product/import'"
            style="text-decoration: none"
          >
            <v-list-item @click="() => {}">
              <v-list-item-title>
                <v-icon small left>mdi-import</v-icon>

                Importo artikujt e ri
              </v-list-item-title>
            </v-list-item>
          </inertia-link>
          <!-- --------------------------------------- -->
          <v-divider class="my-0 py-0"></v-divider>

          <inertia-link :href="route + '/brand'" style="text-decoration: none">
            <v-list-item @click="() => {}">
              <v-list-item-title>
                <v-icon small left>mdi-format-list-bulleted</v-icon>

                Lista e brendeve
              </v-list-item-title>
            </v-list-item>
          </inertia-link>
          <inertia-link
            :href="route + '/brand/create'"
            style="text-decoration: none"
          >
            <v-list-item @click="() => {}">
              <v-list-item-title>
                <v-icon small left>mdi-plus-circle</v-icon>

                Shto brend te ri
              </v-list-item-title>
            </v-list-item>
          </inertia-link>
          <!-- --------------------------------------- -->
        </v-list>
        <!-- --------------------------------------- -->
      </v-menu>
      <v-menu right offset-y bottom>
        <template v-slot:activator="{ on, attrs }">
          <v-btn text tile small v-bind="attrs" v-on="on">Blerjet</v-btn>
        </template>

        <v-list dense> </v-list>
      </v-menu>

      <v-menu right offset-y bottom>
        <template v-slot:activator="{ on, attrs }">
          <v-btn text tile small v-bind="attrs" v-on="on">Tjera</v-btn>
        </template>

        <v-list dense> </v-list>
      </v-menu>

      <v-spacer></v-spacer>

      <v-menu right offset-y bottom>
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
              link: "/offer/create'",
              submenu: [],
            },
            {
              text: "Ofert e fundit",
              icon: "mdi-page-last",
              link: "/offer/create'",
              submenu: [],
            },
            {
              text: "Ofertat sot",
              icon: "mdi-format-list-bulleted",
              link: "/offer/today'",
              submenu: [],
            },
            {
              text: "Filtro ofertat",
              icon: "mdi-format-list-bulleted",
              link: "/offer'",
              submenu: [],
            },
          ],
        },

         {
          text: "Fakture",
          items: [
            {
              text: "Ofert e re",
              icon: "mdi-plus-circle",
              link: "/offer/create'",
              submenu: [],
            },
            {
              text: "Ofert e fundit",
              icon: "mdi-page-last",
              link: "/offer/create'",
              submenu: [],
            },
            {
              text: "Ofertat sot",
              icon: "mdi-format-list-bulleted",
              link: "/offer/today'",
              submenu: [],
            },
            {
              text: "Filtro ofertat",
              icon: "mdi-format-list-bulleted",
              link: "/offer'",
              submenu: [],
            },
          ],
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
