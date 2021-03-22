<template>
    <v-row no-gutters class="d-flex d-column justify-center align-center">
        <v-col cols="12" sm="6" md="5" lg="4" xl="4"
            ><v-card class="pa-3 elevation-12">
                <v-container fluid>
                    <form @submit.prevent="submit">
                        <v-row no-gutters="">
                            <v-col cols="12">
                                <h3>Kyqu</h3>
                                <v-spacer></v-spacer>
                                <h6>
                                    ASMX
                                </h6>
                            </v-col>

                            <v-col cols="12">
                                <ul class="caption red--text">
                                    <li
                                        v-for="(error, key) in errors"
                                        :key="key"
                                    >
                                        {{ error }}
                                    </li>
                                </ul>
                            </v-col>

                            <v-col cols="12">
                                <v-text-field
                                    label="Email"
                                    name="email"
                                    id="email"
                                    type="email"
                                    v-model="form.email"
                                    required
                                    outlined
                                    dense
                                    autofocus
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" class="mt-0 my-0">
                                <v-text-field
                                    label="Password"
                                    name="password"
                                    id="password"
                                    type="password"
                                    v-model="form.password"
                                    required
                            outlined
                                    dense

                                ></v-text-field>
                            </v-col>

                            <v-col cols="12" class="mt-5">
                                <input
                                    type="checkbox"
                                    name="remember"
                                    v-model="remember"
                                    hidden
                                />

                                <v-switch
                                    class="mt-n2 mb-3"
                                    hide-details
                                    label="Me mbaj mend"
                                    v-model="form.remember"
                                    :true-value="true"
                                >
                                </v-switch>
                            </v-col>

                            <v-col cols="12">
                                <v-btn
                                    block
                                    :disabled="form.processing"
                                    color="primary"
                                    type="submit"
                                    >Kyqu</v-btn
                                >
                            </v-col>
                            <!-- <inertia-link
                                v-if="canResetPassword"
                                href="#"
                                class="caption mt-1"
                            >
                                Kam harruar fjalkalimin
                            </inertia-link> -->
                        </v-row>
                    </form>
                </v-container>
            </v-card>
        </v-col>
    </v-row>
</template>

<script>
import GuestLayout from "@/Layouts/Guest";

export default {
    layout: GuestLayout,

    components: {},

    props: {
        canResetPassword: Boolean,
        status: String
    },

    data() {
        return {
            remember: false,
            form: this.$inertia.form({
                email: "",
                password: "",
                remember: false
            })
        };
    },

    computed: {
        errors() {
            return this.$page.props.errors;
        },

        hasErrors() {
            return Object.keys(this.errors).length > 0;
        }
    },

    methods: {
        submit() {
            this.form
                .transform(data => ({
                    ...data,
                    remember: this.form.remember ? "on" : ""
                }))
                .post("/login", {
                    onFinish: () => this.form.reset("password")
                });
        }
    }
};
</script>
