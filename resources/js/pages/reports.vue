<template>
    <v-app>
        <v-main>
            <loader-component />
            <div
                class="reports-container"
                :class="{ show_content: showContent }"
            >
                <div class="reports-sub-holder">
                    <v-row>
                        <!-- date options -->
                        <v-col cols="12" md="6" class="py-0 pt-1">
                            <span class="input-header"> Choose Date </span>

                            <v-radio-group light v-model="dateType" row>
                                <v-radio
                                    label="All Time"
                                    value="all_time"
                                ></v-radio>

                                <v-radio
                                    label="Last Week"
                                    value="last_week"
                                ></v-radio>
                                <v-radio
                                    label="Last Month"
                                    value="last_month"
                                ></v-radio>

                                <v-radio
                                    label="Custom Date"
                                    value="custom_date"
                                ></v-radio>
                            </v-radio-group>
                        </v-col>

                        <v-col cols="12" md="6" class="py-0 pt-1">
                            <span class="input-header">
                                Choose Employees :
                                {{
                                    selectEmployeesIds.length ||
                                    filteredEmployeesIds.length
                                }}
                            </span>

                            <v-radio-group light v-model="employeesType" row>
                                <v-radio
                                    label="All Employees"
                                    value="all_employees"
                                    @click="pushAllEmployees"
                                ></v-radio>
                                <v-radio
                                    label="Select Employees"
                                    value="selected_employees"
                                    @click="selectEmployees"
                                ></v-radio>
                            </v-radio-group>
                        </v-col>

                        <v-row>
                            <v-col cols="12" md="6" class="py-0 pt-1">
                                <span class="input-header"> From Date : </span>

                                <v-menu
                                    :disabled="dateType != 'custom_date'"
                                    ref="fromDate"
                                    v-model="form.fromDateMenu"
                                    :close-on-content-click="false"
                                    :return-value.sync="form.fromDateValue"
                                    transition="scale-transition"
                                    offset-y
                                    min-width="auto"
                                >
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-text-field
                                            light
                                            class="textfield"
                                            solo
                                            dense
                                            v-model="form.fromDateValue"
                                            append-icon="mdi-calendar"
                                            readonly
                                            v-bind="attrs"
                                            v-on="on"
                                        ></v-text-field>
                                    </template>
                                    <v-date-picker
                                        v-model="date"
                                        no-title
                                        scrollable
                                    >
                                        <v-spacer></v-spacer>
                                        <v-btn
                                            text
                                            color="primary"
                                            class="no-focus"
                                            @click="fromDateMenu = false"
                                        >
                                            Cancel
                                        </v-btn>
                                        <v-btn
                                            text
                                            color="primary"
                                            class="no-focus"
                                            @click="$refs.fromDate.save(date)"
                                        >
                                            OK
                                        </v-btn>
                                    </v-date-picker>
                                </v-menu>
                            </v-col>

                            <v-col cols="12" md="6" class="py-0 pt-1">
                                <span class="input-header"> To Date : </span>

                                <v-menu
                                    :disabled="dateType != 'custom_date'"
                                    ref="toDate"
                                    v-model="toDateMenu"
                                    :close-on-content-click="false"
                                    :return-value.sync="form.toDateValue"
                                    transition="scale-transition"
                                    offset-y
                                    min-width="auto"
                                >
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-text-field
                                            light
                                            class="textfield"
                                            solo
                                            dense
                                            v-model="form.toDateValue"
                                            append-icon="mdi-calendar"
                                            readonly
                                            v-bind="attrs"
                                            v-on="on"
                                        >
                                        </v-text-field>
                                    </template>
                                    <v-date-picker
                                        v-model="date"
                                        no-title
                                        scrollable
                                    >
                                        <v-spacer></v-spacer>
                                        <v-btn
                                            text
                                            color="primary"
                                            class="no-focus"
                                            @click="toDateMenu = false"
                                        >
                                            Cancel
                                        </v-btn>
                                        <v-btn
                                            text
                                            color="primary"
                                            class="no-focus"
                                            @click="$refs.toDate.save(date)"
                                        >
                                            OK
                                        </v-btn>
                                    </v-date-picker>
                                </v-menu>
                            </v-col>
                        </v-row>

                        <!-- date options -->

                        <!-- Employees  options -->
                        <v-row>
                            <v-col cols="12" md="6" class="py-0 pt-1">
                                <v-select
                                    :disabled="allEmployeesAreSelected"
                                    hide-details
                                    placeholder="Gender"
                                    light
                                    v-model="filter.gender"
                                    :items="genders"
                                    solo
                                    dense
                                    class="pb-0 textfield"
                                    clearable
                                    @change="resetEmployees"
                                ></v-select>
                            </v-col>

                            <v-col cols="12" md="6" class="py-0 pt-1">
                                <v-select
                                    :disabled="allEmployeesAreSelected"
                                    hide-details
                                    placeholder="Employee Type"
                                    light
                                    v-model="filter.employee_type"
                                    :items="employeeTypes"
                                    solo
                                    dense
                                    class="pb-0 textfield"
                                    clearable
                                    @change="resetEmployees"
                                ></v-select>
                            </v-col>

                            <v-col cols="12" md="6" class="py-0 pt-1">
                                <v-select
                                    :disabled="allEmployeesAreSelected"
                                    hide-details
                                    placeholder="Position"
                                    light
                                    v-model="filter.position"
                                    :items="positions"
                                    solo
                                    dense
                                    class="pb-0 textfield"
                                    clearable
                                ></v-select>
                            </v-col>

                            <v-col cols="12" md="6" class="py-0 pt-1">
                                <v-select
                                    :disabled="allEmployeesAreSelected"
                                    hide-details
                                    placeholder="Nationality"
                                    light
                                    v-model="filter.nationality"
                                    :items="nationalities"
                                    solo
                                    dense
                                    class="pb-0 textfield"
                                    clearable
                                    @change="resetEmployees"
                                ></v-select>
                            </v-col>
                            <v-col cols="12" md="6" class="py-0 pt-1">
                                <v-select
                                    :disabled="allEmployeesAreSelected"
                                    hide-details
                                    placeholder="Based At"
                                    light
                                    v-model="filter.based_at"
                                    :items="basedAtPlaces"
                                    solo
                                    dense
                                    class="pb-0 textfield"
                                    clearable
                                    @change="resetEmployees"
                                ></v-select>
                            </v-col>

                            <v-col cols="12" md="6" class="py-0 pt-1">
                                <v-autocomplete
                                    :disabled="allEmployeesAreSelected"
                                    hide-details
                                    placeholder="Select Employees"
                                    light
                                    :value="selectEmployeesIds"
                                    :items="filteredEmployees"
                                    @change="fillSelectEmployeesIds($event)"
                                    solo
                                    dense
                                    multiple
                                    item-text="first_name"
                                    item-value="id"
                                    class="pb-0 textfield"
                                    clearable
                                ></v-autocomplete>

                            </v-col>
                        </v-row>

                        <!-- Employees options -->

                        <!-- buttons-->

                        <v-col cols="12">
                            <form
                                action="export/pdf"
                                method="post"
                                target="_blank"
                            >
                                <input
                                    type="hidden"
                                    name="_token"
                                    :value="csrf"
                                />

                                <input
                                    name="selectedEmployees"
                                    type="hidden"
                                    :value="
                                        selectEmployeesIds.length
                                            ? selectEmployeesIds
                                            : filteredEmployeesIds
                                    "
                                />

                                <input
                                    name="dateType"
                                    type="hidden"
                                    :value="dateType"
                                />

                                <input
                                    name="fromDate"
                                    type="hidden"
                                    :value="form.fromDateValue"
                                />

                                <input
                                    name="toDate"
                                    type="hidden"
                                    :value="form.toDateValue"
                                />

                                <button type="submit" class="report-button">
                                    PDF
                                </button>
                            </form>

                            <form
                                action="export/excel"
                                method="post"
                                target="_blank"
                            >
                                <input
                                    type="hidden"
                                    name="_token"
                                    :value="csrf"
                                />

                                <input
                                    name="selectedEmployees"
                                    type="hidden"
                                    :value="
                                        selectEmployeesIds.length
                                            ? selectEmployeesIds
                                            : filteredEmployeesIds
                                    "
                                />

                                <input
                                    name="dateType"
                                    type="hidden"
                                    :value="dateType"
                                />

                                <input
                                    name="fromDate"
                                    type="hidden"
                                    :value="form.fromDateValue"
                                />

                                <input
                                    name="toDate"
                                    type="hidden"
                                    :value="form.toDateValue"
                                />

                                <button
                                    type="submit"
                                    class="report-excel-button"
                                >
                                    Excel
                                </button>
                            </form>
                        </v-col>
                        <!-- buttons-->

                        <div class="clearing"></div>
                    </v-row>
                </div>
            </div>
        </v-main>
    </v-app>
</template>

<script>
import { mapState, mapActions, mapGetters, mapMutations } from "vuex";
export default {
    name: "Reports",

    data: () => ({
        csrf: document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content"),
        date: new Date(
            Date.now() - new Date().getTimezoneOffset() * 60000
        ).toISOString(),

        fromDateMenu: false,
        toDateMenu: false,
        overlay: true,

        form: {
            fromDateValue: "",
            toDateValue: "",

            employee: { first_name: "", id: "" },

            based_at: "",
            position: "",
            employee_type: "",
            position_branch_number: "",
        },

        dateType: "last_week",

        employeesType: "all_employees",
    }),

    computed: {
        ...mapState(
            "reports",

            [
                "showContent",
                "employees",
                "genders",
                "employeeTypes",
                "positions",
                "nationalities",
                "basedAtPlaces",

                "filter",
                "selectEmployeesIds",
            ]
        ),

        ...mapGetters(
            "reports",

            ["filteredEmployeesIds", "filteredEmployees"]
        ),

        allEmployeesAreSelected() {
            return this.employeesType == "all_employees";
        },
    },

    created() {
        this.$store.commit("openLoader");
    },

    mounted() {
        this.fetch();
    },

    methods: {
        ...mapActions("reports", ["fetch"]),
        ...mapMutations("reports", [
            "pushAllEmployees",
            "selectEmployees",
            "resetEmployees",
            "fillSelectEmployeesIds",
        ]),
    },
};
</script>
