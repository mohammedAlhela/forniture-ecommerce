<template>
    <v-app>
        <v-main>
            <v-card flat>
                <div class="home-container">

                    <div class="home-holder">

                        <div class="content-holder">
                            <v-row>
                                <v-col cols="12" md="6">
                                    <div class="home-link" @click = "routing( 'employee:show' , 'reports')"  :class="{
                                        disabled_link: checkAbility('employee:show')
                                    }">
                                        Employees
                                    </div>
                                </v-col>

                                <v-col cols="12" md="6">
                                    <div class="home-link"  @click = "routing( 'user:show' , 'reports')" :class="{
                                        disabled_link: checkAbility('user:show')
                                    }">
                                        users
                                    </div>

                                </v-col>
                                <v-col cols="12" md="6">
                                    <div class="home-link" @click = "routing( 'expense:show' , 'reports')" :class="{
                                        disabled_link: checkAbility('expense:show')
                                    }">
                                        Expenses
                                    </div>

                                </v-col>
                                <v-col cols="12" md="6">
                                    <div class="home-link"  @click = "routing( 'report:show' , 'reports')" :class="{
                                        disabled_link: checkAbility('report:show')
                                    }">
                                        Reports
                                    </div>

                                </v-col>

                                <v-col cols="12" md="6">
                                    <div class="home-link"  @click = "routing( 'deduction:show' , 'reports')"  :class="{
                                        disabled_link: checkAbility('deduction:show')
                                    }">
                                        Deduction and Bouns
                                    </div>


                                </v-col>

                                <v-col cols="12" md="6">
                                    <div class="home-link" @click = "routing( 'report:show' , 'reports')" :class="{
                                        disabled_link: checkAbility('report:show')
                                    }">
                                        Analytics and Charts
                                    </div>

                                </v-col>
                            </v-row>

                            <v-row class="">
                                <v-col cols="12">
                                    <div class="date">
                                        {{
        $store.getters['formatedDate'](
            new Date()
        )
                                        }}
                                    </div>
                                </v-col>
                            </v-row>
                        </div>
                    </div>

                </div>
            </v-card>
        </v-main>
    </v-app>
</template>

<script>
export default {
    name: "Home",

    methods: {
        checkAbility(ability) {
            return this.$store.getters['getPermissionsNames'].indexOf(ability) == -1
        },

        routing(ability , route) {
          !this.checkAbility(ability) ?   window.location.href = `${route}` : console.log('no permissions');
        }
    
    }
}

</script>
