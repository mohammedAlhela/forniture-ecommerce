

export default {
    namespaced: true,

    state: {

        showContent: false,

        employees: [],
        genders: [],
        employeeTypes: [],
        positions: [],
        nationalities: [],
        basedAtPlaces: [],

        selectedEmployeesIds: [],
        selectEmployeesIds : [],

        filter: {
            gender: '',
            based_at: '',
            employee_type: '',
            position: '',
            nationality: ''
        }
    },

    mutations: {
             // ---------- main
             assignApiData: (state, data) => {
                state.employees = data.employees;
                state.genders = data.genders;
                state.employeeTypes = data.employeeTypes;
                state.positions = data.positions;
                state.nationalities = data.nationalities;
                state.basedAtPlaces = data.basedAtPlaces;

                let apiIds = []
                state.employees.forEach(employee => {
                    apiIds.push(employee.id)
                })
                state.selectedEmployeesIds = apiIds
            },
            // ---------- main


        pushAllEmployees: (state) => {


            let apiIds = []
            state.employees.forEach(employee => {
                apiIds.push(employee.id)
            })
            state.selectedEmployeesIds = apiIds
        },

        resetEmployees: state => {
            state.selectedEmployees = []
        },

        selectEmployees: state => {
            state.selectedEmployeesIds = []
        },

        fillSelectEmployeesIds : (state, data) => { 
            state.selectEmployeesIds = data
        }

 
    },

    getters: {


        filteredEmployeesIds : (state , getters) => {
            let apiIds = []
            getters.filteredEmployees.forEach(employee => {
                apiIds.push(employee.id)
            })
            return apiIds ;
        },


        getIds : (state ) => {
          return state.selectEmployeesIds || state.selectedEmployeesIds ;
        },
        filteredEmployees: (state, getters) => {
            let conditions = []

            if (state.filter.employee_type) {
                conditions.push(getters.filterEmployeeType)
            }

            if (state.filter.gender) {
                conditions.push(getters.filterGender)
            }

            if (state.filter.based_at) {
                conditions.push(getters.filterBasedAt)
            }

            if (state.filter.position) {
                conditions.push(getters.filterPosition)
            }

            if (state.filter.nationality) {
                conditions.push(getters.filterNationality)
            }

            if (conditions.length > 0) {
                return state.employees.filter(employee => {
                    return conditions.every(condition => {
                        return condition(employee)
                    })
                })
            }

            return state.employees
        },

        filterNationality: state => item => {
            if (item.nationality) {
                return (
                    item.nationality.toLowerCase() ===
                    state.filter.nationality.toLowerCase()
                )
            } else {
                return false
            }
        },

        filterEmployeeType: state => item => {
            if (item.employee_type) {
                return (
                    item.employee_type.toLowerCase() ===
                    state.filter.employee_type.toLowerCase()
                )
            } else {
                return false
            }
        },

        filterGender: state => item => {
            if (item.gender) {
                return (
                    item.gender.toLowerCase() ===
                    state.filter.gender.toLowerCase()
                )
            } else {
                return false
            }
        },

        filterBasedAt: state => item => {
            if (item.based_at) {
                return (
                    item.based_at.toLowerCase() ===
                    state.filter.based_at.toLowerCase()
                )
            } else {
                return false
            }
        },

        filterPosition: state => item => {
            if (item.position) {
                return (
                    item.position.toLowerCase() ===
                    state.filter.position.toLowerCase()
                )
            } else {
                return false
            }
        }
    },
    actions: {
        async fetch({ commit , state }) {
            const Data = await axios
                .get("reports/getData")
                .catch((error) => {
                    toasts.methods.fireErrorToast();
                });

            commit("assignApiData", Data.data);
            commit("closeLoader", null, { root: true });
            setTimeout(() => {
                state.showContent = true;
            }, 200);
        },
    },
}
