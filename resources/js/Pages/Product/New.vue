    <template>
    <div>
        <v-row>
        <v-col cols="12">
            <v-card outlined>
            <v-card outlined color="blue-grey darken-2">
                <v-container fluid>
                <v-row>
                    <v-col cols="3" class="py-0 my-0">
                    <v-card-title class="white--text py-3">
                        Artikull i ri
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
                    Te dhenat per artikullin
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
                        <v-text-field
                        block
                        outlined
                        dense
                        clearable
                        background-color="yellow lighten-5"
                        label="Numri i stokut"
                        name="stock_no"
                        disabled
                        v-model="new_brand.stock_no"
                        :error-messages="$page.props.errors.stock_no"
                        >
                        </v-text-field>
                        <v-switch
                        v-if="$page.props.public == false"
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
                        clearable
                        label="* Pershkrimi i artikullit"
                        autofocus
                        name="name"
                        v-model="new_brand.name"
                        :error-messages="$page.props.errors.name"
                        >
                        </v-text-field>
                        <v-text-field
                        block
                        outlined
                        dense
                        clearable
                        label="Gjuha e dyte"
                        autofocus
                        name="second_name"
                        v-model="new_brand.second_name"
                        :error-messages="$page.props.errors.producing_company"
                        >
                        </v-text-field>

                        <v-text-field
                        block
                        outlined
                        dense
                        clearable
                        label="Numri i furnizuesit"
                        name="supplier_no"
                        v-model="new_brand.supplier_no"
                        :error-messages="$page.props.errors.supplier_no"
                        >
                        </v-text-field>
                        <v-text-field
                        block
                        outlined
                        dense
                        clearable
                        label="Numri i prodhuesit"
                        name="producer_no"
                        v-model="new_brand.producer_no"
                        :error-messages="$page.props.errors.producer_no"
                        >
                        </v-text-field>
                    </v-col>
                    <v-col cols="4">
                        <v-text-field
                        block
                        outlined
                        dense
                        clearable
                        label="Furnitori"
                        v-model="new_brand.producer_no"
                        :error-messages="$page.props.errors.producer_no"
                        >
                        </v-text-field>
                        <v-text-field
                        block
                        outlined
                        dense
                        clearable
                        label="Brendi"
                        v-model="new_brand.producer_no"
                        :error-messages="$page.props.errors.producer_no"
                        >
                        </v-text-field>

                        <v-text-field
                        block
                        outlined
                        dense
                        clearable
                        label="Kategoria"
                        v-model="new_brand.producer_no"
                        :error-messages="$page.props.errors.producer_no"
                        >
                        </v-text-field>

                        <v-text-field
                        block
                        outlined
                        dense
                        clearable
                        label="Kualiteti"
                        v-model="new_brand.producer_no"
                        :error-messages="$page.props.errors.producer_no"
                        >
                        </v-text-field>
                    </v-col>
                    <v-col cols="3">
                        <v-text-field
                        block
                        outlined
                        dense
                        clearable
                        label="Barcode"
                        name="producer_no"
                        v-model="new_brand.producer_no"
                        :error-messages="$page.props.errors.producer_no"
                        >
                        </v-text-field>
                    </v-col>
                    <v-col cols="3">
                        <v-text-field
                        block
                        outlined
                        dense
                        clearable
                        label="Njesia matese"
                        name="producer_no"
                        v-model="new_brand.producer_no"
                        :error-messages="$page.props.errors.producer_no"
                        >
                        </v-text-field>
                    </v-col>
                    <v-col cols="3">
                        <v-text-field
                        block
                        outlined
                        dense
                        clearable
                        label="Pesha"
                        name="producer_no"
                        v-model="new_brand.producer_no"
                        :error-messages="$page.props.errors.producer_no"
                        >
                        </v-text-field>
                    </v-col>
                    <v-col cols="3">
                        <v-text-field
                        block
                        outlined
                        dense
                        clearable
                        label="Sasia ne set"
                        name="producer_no"
                        v-model="new_brand.producer_no"
                        :error-messages="$page.props.errors.producer_no"
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
                    Gjendja aktuale
                    </p>
                    <p class="text-body-2 gray--text ml-3 pb-0 mb-0">
                    - Shto ose hiq furnitoret e brendit
                    </p>
                </v-col>
                <v-col cols="9">
                    <v-row>
                    <v-col cols="4">
                        <v-text-field
                        block
                        solo-inverted
                        dense
                        color="red"
                        background-color="grey darken-5"
                        label="Gjendja Aktuale"
                        hint="Gjendja aktuale"
                        persistent-hint
                        name="producing_company"
                        value="999"
                        :error-messages="$page.props.errors.producing_company"
                        ></v-text-field>

                        <v-text-field
                        block
                        outlined
                        dense
                        clearable
                        label="Stoku minimal"
                        v-model="new_brand.producer_no"
                        :error-messages="$page.props.errors.producer_no"
                        >
                        </v-text-field>

                        <v-text-field
                        block
                        outlined
                        dense
                        clearable
                        label="Stoku maksimal"
                        v-model="new_brand.producer_no"
                        :error-messages="$page.props.errors.producer_no"
                        >
                        </v-text-field>
                    </v-col>

                    <v-col cols="4">
                        <v-text-field
                        block
                        outlined
                        dense
                        clearable
                        label="Cmimi i blerjes"
                        v-model="new_brand.producer_no"
                        :error-messages="$page.props.errors.producer_no"
                        >
                        </v-text-field>

                        <v-text-field
                        block
                        outlined
                        dense
                        clearable
                        label="Cmimi i furnizimit"
                        v-model="new_brand.producer_no"
                        :error-messages="$page.props.errors.producer_no"
                        >
                        </v-text-field>

                        <v-text-field
                        block
                        outlined
                        dense
                        clearable
                        label="TVSH"
                        v-model="new_brand.producer_no"
                        :error-messages="$page.props.errors.producer_no"
                        >
                        </v-text-field>
                    </v-col>

                                <v-col cols="4">
                        <v-text-field
                        block
                        outlined
                        dense
                        clearable
                        label="Cmimi i fiksuar"
                        v-model="new_brand.producer_no"
                        :error-messages="$page.props.errors.producer_no"
                        >
                        </v-text-field>

                        <v-text-field
                        block
                        outlined
                        dense
                        clearable
                        label="Marzha baz"
                        v-model="new_brand.producer_no"
                        :error-messages="$page.props.errors.producer_no"
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
        suppliers: Array,
    },

    data() {
        return {
        new_brand: {
            name: "",
            producing_company: "",
            producing_country: "",
            supplier_ids: [],
        },
        };
    },

    methods: {
        submit() {
        var data = new FormData();
        data.append("name", this.new_brand.name || "");
        data.append("producing_company", this.new_brand.producing_company || "");
        data.append("producing_country", this.new_brand.producing_country || "");

        this.new_brand.supplier_ids.forEach((element) => {
            data.append("supplier_ids[]", element);
        });

        this.$inertia.post(this.route + "/brand", data);
        },
    },

    computed: {
        route() {
        return "http://" + window.location.host;
        },
    },
    };
    </script>
